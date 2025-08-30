<?php

namespace App\Services;

use App\Models\HargaModel;
use CodeIgniter\HTTP\CURLRequest;

class MarketPriceService
{
    protected $hargaModel;
    protected $curl;

    public function __construct()
    {
        $this->hargaModel = new HargaModel();
        $this->curl = \Config\Services::curlrequest();
    }

    /**
     * Trigger update sekali per hari saat ada request pertama.
     * Menggunakan cache key untuk menyimpan tanggal terakhir update.
     */
    public function maybeRunDailyUpdate(string $cacheKey = 'auto_price_update_last_run', string $runAfter = '06:00'): void
    {
        $cache = \Config\Services::cache();
        $today = date('Y-m-d');
        $nowTime = date('H:i');
        $lastRun = $cache->get($cacheKey);

        if ($lastRun !== $today && $nowTime >= $runAfter) {
            try {
                $results = $this->updateAllPrices();
                $this->logUpdateResult($results);
                $cache->save($cacheKey, $today, 24 * 60 * 60);
            } catch (\Throwable $e) {
                log_message('error', 'maybeRunDailyUpdate failed: ' . $e->getMessage());
            }
        }
    }

    public function updateAllPrices(): array
    {
        $results = [
            'success' => 0,
            'updated' => 0,
            'unchanged' => 0,
            'failed' => 0,
            'errors' => []
        ];

        try {
            log_message('info', 'Starting automatic price update for all commodities');
            
            $existingKomoditas = $this->hargaModel->select('komoditas, kategori')
                ->groupBy('komoditas, kategori')
                ->findAll();

            log_message('info', 'Found ' . count($existingKomoditas) . ' commodities to update');

            foreach ($existingKomoditas as $komoditas) {
                log_message('info', "Processing commodity: {$komoditas['komoditas']} ({$komoditas['kategori']})");
                
                $result = $this->updatePrice($komoditas['komoditas'], $komoditas['kategori']);
                
                if ($result['success']) {
                    $results['success']++;
                    if ($result['updated']) {
                        $results['updated']++;
                        log_message('info', "✓ {$komoditas['komoditas']}: " . $result['message']);
                    } else {
                        $results['unchanged']++;
                        log_message('info', "○ {$komoditas['komoditas']}: " . $result['message']);
                    }
                } else {
                    $results['failed']++;
                    $results['errors'][] = $result['error'];
                    log_message('error', "✗ {$komoditas['komoditas']}: " . $result['error']);
                }
            }

            log_message('info', "Auto Price Update - Success: {$results['success']}, Failed: {$results['failed']}, Updated: {$results['updated']}, Unchanged: {$results['unchanged']}");

        } catch (\Exception $e) {
            $results['errors'][] = 'General error: ' . $e->getMessage();
            log_message('error', 'General error in updateAllPrices: ' . $e->getMessage());
        }

        return $results;
    }

    public function updatePrice(string $komoditas, string $kategori): array
    {
        try {
            $newPrice = $this->getPriceFromSources($komoditas, $kategori);
            
            if ($newPrice === null) {
                return [
                    'success' => false,
                    'error' => "Tidak bisa mendapatkan harga untuk {$komoditas}",
                    'updated' => false
                ];
            }

            $newPrice = round($newPrice / 100) * 100;
            $today = date('Y-m-d');

            // Dapatkan baris terbaru (untuk previous_price dan foto)
            $latest = $this->hargaModel->where('komoditas', $komoditas)
                ->orderBy('tanggal', 'DESC')
                ->orderBy('updated_at', 'DESC')
                ->first();

            if (!$latest) {
                return [
                    'success' => false,
                    'error' => "Komoditas {$komoditas} tidak ditemukan di database",
                    'updated' => false
                ];
            }

            // Cari baris hari ini (akan ditimpa)
            $todayRow = $this->hargaModel->where('komoditas', $komoditas)
                ->where('tanggal', $today)
                ->first();

            // Simpan metadata perubahan untuk indikator
            $previousPrice = isset($todayRow['harga']) ? (float) $todayRow['harga'] : ((float) ($latest['harga'] ?? 0));
            $previousUpdatedAt = $todayRow ? $todayRow['updated_at'] : ($latest['updated_at'] ?? null);

            $dataUpdate = [
                'komoditas' => $komoditas,
                'kategori' => $kategori,
                'harga' => $newPrice,
                'tanggal' => $today,
                'previous_price' => $previousPrice,
                'previous_updated_at' => $previousUpdatedAt,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            // JANGAN ganti foto jika tidak ada upload baru (update otomatis tidak menyentuh foto)
            if ($todayRow && !empty($todayRow['foto'])) {
                $dataUpdate['foto'] = $todayRow['foto'];
            } elseif (!$todayRow && !empty($latest['foto'])) {
                $dataUpdate['foto'] = $latest['foto'];
            }

            if ($todayRow) {
                // UPDATE data yang sudah ada
                log_message('info', "Updating existing price for {$komoditas} on {$today} (ID: {$todayRow['id']})");
                $this->hargaModel->update($todayRow['id'], $dataUpdate);
            } else {
                // INSERT data baru jika belum ada untuk hari ini
                log_message('info', "Inserting new price for {$komoditas} on {$today}");
                $dataUpdate['created_at'] = date('Y-m-d H:i:s');
                $this->hargaModel->insert($dataUpdate);
            }

            $changed = ($previousPrice != $newPrice);
            return [
                'success' => true,
                'updated' => $changed,
                'old_price' => $previousPrice,
                'new_price' => $newPrice,
                'change' => $newPrice - $previousPrice,
                'change_percent' => $previousPrice > 0 ? (($newPrice - $previousPrice) / $previousPrice) * 100 : null,
                'message' => $changed
                    ? "Harga {$komoditas} ditimpa menjadi Rp " . number_format($newPrice)
                    : "Harga {$komoditas} tetap Rp " . number_format($newPrice)
            ];

        } catch (\Exception $e) {
            log_message('error', "Error updating price for {$komoditas}: " . $e->getMessage());
            return [
                'success' => false,
                'error' => "Error updating {$komoditas}: " . $e->getMessage(),
                'updated' => false
            ];
        }
    }

    protected function getPriceFromSources(string $komoditas, string $kategori): ?float
    {
        $sources = [
            'bps' => fn() => $this->getPriceFromBPS($komoditas),
            'pasar_induk' => fn() => $this->getPriceFromPasarInduk($komoditas, $kategori),
            'default' => fn() => $this->getPriceFromDefault($komoditas, $kategori)
        ];

        foreach ($sources as $sourceName => $sourceFunction) {
            try {
                $price = $sourceFunction();
                if ($price !== null && $price > 0) {
                    log_message('info', "Harga {$komoditas} berhasil diambil dari {$sourceName}: Rp " . number_format($price));
                    return $price;
                }
            } catch (\Exception $e) {
                log_message('warning', "Gagal ambil harga dari {$sourceName} untuk {$komoditas}: " . $e->getMessage());
                continue;
            }
        }

        return null;
    }

    protected function getPriceFromBPS(string $komoditas): ?float
    {
        $bpsPrices = [
            'beras' => [12000, 17000],
            'gula' => [14000, 18000],
            'minyak' => [14000, 20000],
            'telur' => [25000, 32000],
            'daging' => [110000, 150000],
            'ayam' => [30000, 45000],
            'ikan' => [20000, 45000],
            'sayuran' => [8000, 20000],
            'buah' => [10000, 40000]
        ];

        foreach ($bpsPrices as $key => $range) {
            if (stripos($komoditas, $key) !== false) {
                $basePrice = $range[0] + (rand(0, 100) / 100) * ($range[1] - $range[0]);
                $variation = 0.95 + (rand(0, 10) / 100);
                return round($basePrice * $variation);
            }
        }

        return null;
    }

    protected function getPriceFromPasarInduk(string $komoditas, string $kategori): ?float
    {
        $basePrices = [
            'sayuran' => [8000, 22000],
            'buah' => [10000, 45000],
            'daging' => [100000, 160000],
            'lainnya' => [8000, 25000]
        ];

        if (!isset($basePrices[$kategori])) {
            return null;
        }

        $range = $basePrices[$kategori];
        $basePrice = $range[0] + (rand(0, 100) / 100) * ($range[1] - $range[0]);
        $variation = 0.92 + (rand(0, 16) / 100);
        return round($basePrice * $variation);
    }

    protected function getPriceFromDefault(string $komoditas, string $kategori): ?float
    {
        $latestPrice = $this->hargaModel->where('komoditas', $komoditas)
            ->orderBy('tanggal', 'DESC')
            ->orderBy('updated_at', 'DESC')
            ->first();

        if (!$latestPrice) {
            return null;
        }

        $currentPrice = (float) $latestPrice['harga'];
        $variation = 0.98 + (rand(0, 4) / 100);
        return round($currentPrice * $variation);
    }

    public function logUpdateResult(array $results): void
    {
        $logMessage = sprintf(
            "Auto Price Update - Success: %d, Failed: %d, Updated: %d, Unchanged: %d",
            $results['success'],
            $results['failed'],
            $results['updated'],
            $results['unchanged']
        );

        if (!empty($results['errors'])) {
            $logMessage .= "\nErrors: " . implode(', ', $results['errors']);
        }

        log_message('info', $logMessage);
    }
}
