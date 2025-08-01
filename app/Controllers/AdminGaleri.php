<?php
namespace App\Controllers;
use App\Models\GaleriModel;

class AdminGaleri extends BaseController
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $galeriModel = new GaleriModel();
        $galeris = $galeriModel->findAll();
        return view('admin/galeri_list', [
            'galeris' => $galeris,
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
        ]);
    }

    public function create()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        return view('admin/galeri_form', [
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
        ]);
    }

    public function store()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $galeriModel = new GaleriModel();
        
        // Handle file upload
        $gambar = $this->request->getFile('gambar');
        $gambarName = '';
        
        if ($gambar->isValid() && !$gambar->hasMoved()) {
            $gambarName = $gambar->getRandomName();
            $gambar->move(ROOTPATH . 'public/uploads/galeri', $gambarName);
        }
        
        $data = [
            'judul' => $this->request->getPost('judul'),
            'gambar' => $gambarName,
        ];
        $galeriModel->insert($data);
        return redirect()->to('/admin/galeri');
    }

    public function edit($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $galeriModel = new GaleriModel();
        $galeri = $galeriModel->find($id);
        return view('admin/galeri_form', [
            'galeri' => $galeri,
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
        ]);
    }

    public function update($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $galeriModel = new GaleriModel();
        
        $data = [
            'judul' => $this->request->getPost('judul'),
        ];
        
        // Handle file upload if new image is uploaded
        $gambar = $this->request->getFile('gambar');
        if ($gambar->isValid() && !$gambar->hasMoved()) {
            $gambarName = $gambar->getRandomName();
            $gambar->move(ROOTPATH . 'public/uploads/galeri', $gambarName);
            $data['gambar'] = $gambarName;
        }
        
        $galeriModel->update($id, $data);
        return redirect()->to('/admin/galeri');
    }

    public function delete($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $galeriModel = new GaleriModel();
        $galeriModel->delete($id);
        return redirect()->to('/admin/galeri');
    }
} 
