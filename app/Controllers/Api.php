<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;
use App\Models\KomoditasModel;
use App\Models\BeritaModel;

class Api extends Controller
{
    use ResponseTrait;

    // GET /api/komoditas
    public function komoditas()
    {
        $model = new KomoditasModel();
        $data = $model->findAll();
        return $this->respond($data);
    }

    // GET /api/berita
    public function berita()
    {
        $model = new BeritaModel();
        $data = $model->findAll();
        return $this->respond($data);
    }
} 