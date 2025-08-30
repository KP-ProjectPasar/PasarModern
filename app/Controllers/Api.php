<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class Api extends Controller
{
	use ResponseTrait;
	
	/**
     * Get galeri data for landing page
     */
    public function galeri()
    {
        try {
            $galeriModel = new \App\Models\GaleriModel();
            $galeri = $galeriModel->getFeaturedGaleri(6); // Get 6 featured photos
            
            return $this->response->setJSON([
                'success' => true,
                'data' => $galeri
            ]);
        } catch (\Exception $e) {
            log_message('error', '[Api::galeri] Error: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal mengambil data galeri'
            ]);
        }
    }

    /**
     * Get video data for landing page
     */
    public function video()
    {
        try {
            $videoModel = new \App\Models\VideoModel();
            $videos = $videoModel->getFeaturedVideos(3); // Get 3 featured videos
            
            return $this->response->setJSON([
                'success' => true,
                'data' => $videos
            ]);
        } catch (\Exception $e) {
            log_message('error', '[Api::video] Error: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal mengambil data video'
            ]);
        }
    }

	public function berita()
	{
		$beritaModel = new \App\Models\BeritaModel();
		$data = $beritaModel->getPublishedBerita(); // Get only published berita with current date
		return $this->respond($data);
	}
	
	public function harga()
	{
		// Trigger auto update sekali per hari pada request pertama setelah jam 06:00
		$marketService = new \App\Services\MarketPriceService();
		$marketService->maybeRunDailyUpdate('auto_price_update_last_run', '06:00');
		
		$hargaModel = new \App\Models\HargaModel();
		$harga = $hargaModel->getLatestWithChange(6);
		
		return $this->respond($harga);
	}
	
	public function incrementBeritaView($id)
	{
		$beritaModel = new \App\Models\BeritaModel();
		$berita = $beritaModel->find($id);
		
		if (!$berita || $berita['status'] !== 'published') {
			return $this->failNotFound('Berita tidak ditemukan');
		}
		
		if ($beritaModel->incrementViews($id)) {
			return $this->respond(['success' => true, 'message' => 'View berita berhasil diincrement']);
		} else {
			return $this->failServerError('Gagal increment view berita');
		}
	}
	
	public function incrementGaleriView($id)
	{
		$galeriModel = new \App\Models\GaleriModel();
		$galeri = $galeriModel->find($id);
		
		if (!$galeri || $galeri['status'] !== 'published') {
			return $this->failNotFound('Galeri tidak ditemukan');
		}
		
		if ($galeriModel->incrementViews($id)) {
			return $this->respond(['success' => true, 'message' => 'View galeri berhasil diincrement']);
		} else {
			return $this->failServerError('Gagal increment view galeri');
		}
	}

	public function dashboardStats()
	{
		try {
			$beritaModel = new \App\Models\BeritaModel();
			$galeriModel = new \App\Models\GaleriModel();
			$pasarModel = new \App\Models\PasarModel();
			$feedbackModel = new \App\Models\FeedbackModel();
			
			// Get stats from each model
			$beritaStats = $beritaModel->getDashboardStats();
			$galeriStats = $galeriModel->getDashboardStats();
			$pasarStats = $pasarModel->getDashboardStats();
			
			// Get feedback count
			$feedbackCount = $feedbackModel->countAllResults();
			
			// Get total views
			$totalViews = $beritaStats['total_views'] + $galeriStats['total_views'];
			
			// Get chart data for daily prices
			$chartData = $this->getDailyPriceChartData();
			
			// Get content distribution
			$contentDistribution = $this->getContentDistribution($beritaStats, $galeriStats, $pasarStats['total_pasar'], $feedbackCount);
			
			return $this->respond([
				'total_pasar' => $pasarStats['total_pasar'], // Jumlah data pasar
				'total_berita' => $beritaStats['total_berita'],
				'total_feedback' => $feedbackCount,
				'total_views' => $totalViews,
				'berita_published' => $beritaStats['published'],
				'berita_draft' => $beritaStats['draft'],
				'galeri_published' => $galeriStats['published'],
				'galeri_draft' => $galeriStats['draft'],
				'chart_data' => $chartData,
				'content_distribution' => $contentDistribution
			]);
			
		} catch (\Exception $e) {
			log_message('error', '[Api::dashboardStats] Error: ' . $e->getMessage());
			return $this->respond([
				'total_pasar' => 0,
				'total_berita' => 0,
				'total_feedback' => 0,
				'total_views' => 0,
				'berita_published' => 0,
				'berita_draft' => 0,
				'galeri_published' => 0,
				'galeri_draft' => 0,
				'chart_data' => [],
				'content_distribution' => []
			]);
		}
	}
	
	private function getDailyPriceChartData()
	{
		try {
			$hargaModel = new \App\Models\HargaModel();
			
			// Get last 7 days of price data
			$sevenDaysAgo = date('Y-m-d', strtotime('-6 days'));
			$today = date('Y-m-d');
			
			$dailyPrices = $hargaModel->select('tanggal, AVG(harga) as avg_price')
				->where('tanggal >=', $sevenDaysAgo)
				->where('tanggal <=', $today)
				->groupBy('tanggal')
				->orderBy('tanggal', 'ASC')
				->findAll();
			
			// Create chart data with all 7 days
			$chartData = [];
			$dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
			
			for ($i = 0; $i < 7; $i++) {
				$date = date('Y-m-d', strtotime("-{$i} days"));
				$dayName = $dayNames[date('w', strtotime($date))];
				
				// Find price for this date
				$price = 0;
				foreach ($dailyPrices as $dailyPrice) {
					if ($dailyPrice['tanggal'] === $date) {
						$price = (float) $dailyPrice['avg_price'];
						break;
					}
				}
				
				$chartData[] = [
					'day' => $dayName,
					'price' => $price
				];
			}
			
			// Reverse to show oldest to newest
			return array_reverse($chartData);
			
		} catch (\Exception $e) {
			log_message('error', '[Api::getDailyPriceChartData] Error: ' . $e->getMessage());
			return [];
		}
	}
	
	private function getContentDistribution($beritaStats, $galeriStats, $pasarCount, $feedbackCount)
	{
		$total = $beritaStats['total_berita'] + $galeriStats['total_galeri'] + $pasarCount + $feedbackCount;
		
		if ($total === 0) {
			return [
				['label' => 'Berita', 'value' => 0, 'percentage' => 0, 'color' => '#007bff'],
				['label' => 'Galeri', 'value' => 0, 'percentage' => 0, 'color' => '#28a745'],
				['label' => 'Pasar', 'value' => 0, 'percentage' => 0, 'color' => '#fd7e14'],
				['label' => 'Feedback', 'value' => 0, 'percentage' => 0, 'color' => '#17a2b8']
			];
		}
		
		return [
			[
				'label' => 'Berita',
				'value' => $beritaStats['total_berita'],
				'percentage' => round(($beritaStats['total_berita'] / $total) * 100, 1),
				'color' => '#007bff'
			],
			[
				'label' => 'Galeri',
				'value' => $galeriStats['total_galeri'],
				'percentage' => round(($galeriStats['total_galeri'] / $total) * 100, 1),
				'color' => '#28a745'
			],
			[
				'label' => 'Pasar',
				'value' => $pasarCount,
				'percentage' => round(($pasarCount / $total) * 100, 1),
				'color' => '#fd7e14'
			],
			[
				'label' => 'Feedback',
				'value' => $feedbackCount,
				'percentage' => round(($feedbackCount / $total) * 100, 1),
				'color' => '#17a2b8'
			]
		];
	}

	public function dashboardActivities()
	{
		return $this->respond([]);
	}
	

} 
