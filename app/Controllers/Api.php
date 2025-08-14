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

    public function berita()
    {
        return $this->respond([]);
    }

    public function dashboardStats()
    {
        return $this->respond([
            'total_users' => 0,
            'total_komoditas' => 0,
            'total_berita' => 0,
            'total_galeri' => 0,
            'chart_data' => []
        ]);
    }

    public function dashboardActivities()
    {
        return $this->respond([]);
    }
} 
