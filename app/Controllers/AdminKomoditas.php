<?php
namespace App\Controllers;
use App\Models\KomoditasModel;

class AdminKomoditas extends BaseController
{
    public function index()
    {
        $komoditasModel = new KomoditasModel();
        $komoditas = $komoditasModel->findAll();
        return view('admin/komoditas_list', ['komoditas' => $komoditas]);
    }

    public function create()
    {
        return view('admin/komoditas_form');
    }

    public function store()
    {
        $komoditasModel = new KomoditasModel();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'gambar'=> $this->request->getPost('gambar'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $komoditasModel->insert($data);
        return redirect()->to('/admin/komoditas');
    }

    public function edit($id)
    {
        $komoditasModel = new KomoditasModel();
        $komoditas = $komoditasModel->find($id);
        return view('admin/komoditas_form', ['komoditas' => $komoditas]);
    }

    public function update($id)
    {
        $komoditasModel = new KomoditasModel();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'gambar'=> $this->request->getPost('gambar'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $komoditasModel->update($id, $data);
        return redirect()->to('/admin/komoditas');
    }

    public function delete($id)
    {
        $komoditasModel = new KomoditasModel();
        $komoditasModel->delete($id);
        return redirect()->to('/admin/komoditas');
    }
} 