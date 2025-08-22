<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class Api extends Controller
{
    use ResponseTrait;

    public function komoditas()
    {
        return $this->respond([]);
    }
    
    public function galeri()
    {
        $galeriModel = new \App\Models\GaleriModel();
        $data = $galeriModel->findAll(); // Get all galeri for debugging
        return $this->respond($data);
    }

    public function berita()
    {
        $beritaModel = new \App\Models\BeritaModel();
        $data = $beritaModel->findAll(); // Get all berita for debugging
        return $this->respond($data);
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
        $beritaModel = new \App\Models\BeritaModel();
        $galeriModel = new \App\Models\GaleriModel();
        
        $beritaStats = $beritaModel->getDashboardStats();
        $galeriStats = $galeriModel->getDashboardStats();
        
        return $this->respond([
            'total_users' => 0,
            'total_komoditas' => 0,
            'total_berita' => $beritaStats['total_berita'],
            'total_galeri' => $galeriStats['total_galeri'],
            'total_views' => $beritaStats['total_views'] + $galeriStats['total_views'],
            'berita_published' => $beritaStats['published'],
            'berita_draft' => $beritaStats['draft'],
            'galeri_published' => $galeriStats['published'],
            'galeri_draft' => $galeriStats['draft'],
            'chart_data' => []
        ]);
    }

    public function dashboardActivities()
    {
        return $this->respond([]);
    }
    
    public function testDb()
    {
        try {
            $db = \Config\Database::connect();
            $query = $db->query('SELECT COUNT(*) as count FROM berita');
            $result = $query->getRow();
            
            return $this->respond([
                'status' => 'success',
                'message' => 'Database connection successful',
                'berita_count' => $result->count ?? 0,
                'timestamp' => date('Y-m-d H:i:s')
            ]);
        } catch (\Exception $e) {
            return $this->failServerError('Database connection failed: ' . $e->getMessage());
        }
    }
} 
