<?php

namespace App\Models;

use CodeIgniter\Model;

class HargaModel extends Model
{
    protected $table = 'harga';
    protected $primaryKey = 'id';
    protected $allowedFields = ['komoditas', 'kategori', 'harga', 'tanggal', 'foto', 'previous_price', 'previous_updated_at', 'created_at', 'updated_at'];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    protected $validationRules = [
        'komoditas' => 'required|min_length[3]|max_length[100]',
        'harga' => 'required|numeric|greater_than[0]',
        'tanggal' => 'required|valid_date'
    ];
    
    protected $validationMessages = [
        'komoditas' => [
            'required' => 'Nama komoditas harus diisi',
            'min_length' => 'Nama komoditas minimal 3 karakter',
            'max_length' => 'Nama komoditas maksimal 100 karakter'
        ],
        'harga' => [
            'required' => 'Harga harus diisi',
            'numeric' => 'Harga harus berupa angka',
            'greater_than' => 'Harga harus lebih dari 0'
        ],
        'tanggal' => [
            'required' => 'Tanggal harus diisi',
            'valid_date' => 'Format tanggal tidak valid'
        ]
    ];
    
    public function getLatestPerKomoditas(): array
    {
        $rows = $this->orderBy('tanggal', 'DESC')
            ->orderBy('updated_at', 'DESC')
            ->findAll(500);
        $seen = [];
        $result = [];
        foreach ($rows as $row) {
            $key = trim($row['komoditas']);
            if (!isset($seen[$key])) {
                $result[] = $row;
                $seen[$key] = true;
            }
        }
        return $result;
    }

    public function getLatestWithChange(int $limit = 6): array
    {
        $latestRows = $this->orderBy('tanggal', 'DESC')
            ->orderBy('updated_at', 'DESC')
            ->findAll(100);

        $seenKomoditas = [];
        $result = [];

        foreach ($latestRows as $row) {
            $key = trim($row['komoditas']);
            if (isset($seenKomoditas[$key])) {
                continue;
            }

            $changeAmount = null;
            $changePercent = null;
            $changeStatus = 'flat';

            // 0) Prefer previous_price column if available
            if (isset($row['previous_price']) && $row['previous_price'] !== null && $row['previous_price'] !== '') {
                $current = (float) $row['harga'];
                $previous = (float) $row['previous_price'];
                if ($previous > 0) {
                    $changeAmount = $current - $previous;
                    $changePercent = ($changeAmount / $previous) * 100.0;
                    $changeStatus = $changeAmount > 0 ? 'up' : ($changeAmount < 0 ? 'down' : 'flat');
                }
            } else {
                // 1) Cari baris sebelumnya dengan tanggal lebih kecil
                $builder = $this->builder();
                $builder->where('komoditas', $key)
                    ->where('id !=', $row['id'])
                    ->where('tanggal <', $row['tanggal'])
                    ->orderBy('tanggal', 'DESC')
                    ->orderBy('updated_at', 'DESC')
                    ->limit(1);
                $prev = $builder->get()->getRowArray();

                // 2) Jika tidak ada, fallback: cari baris di tanggal yang sama tapi updated_at lebih lama
                if (!$prev) {
                    $builder = $this->builder();
                    $builder->where('komoditas', $key)
                        ->where('id !=', $row['id'])
                        ->where('tanggal', $row['tanggal'])
                        ->where('updated_at <', $row['updated_at'])
                        ->orderBy('updated_at', 'DESC')
                        ->limit(1);
                    $prev = $builder->get()->getRowArray();
                }

                if ($prev && isset($prev['harga'])) {
                    $current = (float) $row['harga'];
                    $previous = (float) $prev['harga'];
                    if ($previous > 0) {
                        $changeAmount = $current - $previous;
                        $changePercent = ($changeAmount / $previous) * 100.0;
                        $changeStatus = $changeAmount > 0 ? 'up' : ($changeAmount < 0 ? 'down' : 'flat');
                    }
                }
            }

            $row['change_status'] = $changeStatus;
            $row['change_amount'] = $changeAmount;
            $row['change_percent'] = $changePercent;

            $result[] = $row;
            $seenKomoditas[$key] = true;

            if (count($result) >= $limit) {
                break;
            }
        }

        return $result;
    }

    public function getDashboardStats()
    {
        try {
            $stats = [
                'total_harga' => $this->countAllResults(),
                'with_foto' => $this->where('foto IS NOT NULL AND foto != ""')->countAllResults(),
                'without_foto' => $this->where('foto IS NULL OR foto = ""')->countAllResults(),
                'latest_update' => $this->select('MAX(updated_at) as latest_date')->first()['latest_date'] ?? null
            ];
            return $stats;
        } catch (\Exception $e) {
            log_message('error', '[HargaModel::getDashboardStats] Error: ' . $e->getMessage());
            return [
                'total_harga' => 0,
                'with_foto' => 0,
                'without_foto' => 0,
                'latest_update' => null
            ];
        }
    }
}
