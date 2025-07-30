<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class Api extends Controller
{
    use ResponseTrait;

    // GET /api/komoditas
    public function komoditas()
    {
        // TODO: Implementasi dengan database
        // $model = new KomoditasModel();
        // $data = $model->findAll();
        // return $this->respond($data);
        
        // Untuk sementara, return empty array
        return $this->respond([]);
    }

    // GET /api/berita
    public function berita()
    {
        // TODO: Implementasi dengan database
        // $model = new BeritaModel();
        // $data = $model->findAll();
        // return $this->respond($data);
        
        // Untuk sementara, return empty array
        return $this->respond([]);
    }

    // GET /api/dashboard/stats
    public function dashboardStats()
    {
        // TODO: Implementasi statistik dashboard dari database
        // $stats = [
        //     'total_users' => $userModel->countAll(),
        //     'total_komoditas' => $komoditasModel->countAll(),
        //     'total_berita' => $beritaModel->countAll(),
        //     'total_galeri' => $galeriModel->countAll(),
        //     'chart_data' => $this->getChartData()
        // ];
        // return $this->respond($stats);
        
        // Untuk sementara, return empty stats
        return $this->respond([
            'total_users' => 0,
            'total_komoditas' => 0,
            'total_berita' => 0,
            'total_galeri' => 0,
            'chart_data' => []
        ]);
    }

    // GET /api/dashboard/activities
    public function dashboardActivities()
    {
        // TODO: Implementasi aktivitas dashboard dari database
        // $activities = $this->getRecentActivities();
        // return $this->respond($activities);
        
        // Untuk sementara, return empty activities
        return $this->respond([]);
    }
} 