<?php
namespace App\Controllers;
use App\Models\BeritaModel;

class AdminBerita extends BaseController
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $beritaModel = new BeritaModel();
        $beritas = $beritaModel->findAll();
        return view('admin/berita_list', [
            'beritas' => $beritas,
            'admin_nama' => session()->get('admin_nama'),
            'admin_level' => session()->get('admin_level'),
        ]);
    }

    public function create()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        return view('admin/berita_form', [
            'admin_nama' => session()->get('admin_nama'),
            'admin_level' => session()->get('admin_level'),
        ]);
    }

    public function store()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $beritaModel = new BeritaModel();
        
        // Handle file upload
        $gambar = $this->request->getFile('gambar');
        $gambarName = '';
        
        if ($gambar->isValid() && !$gambar->hasMoved()) {
            $gambarName = $gambar->getRandomName();
            $gambar->move(ROOTPATH . 'public/uploads/berita', $gambarName);
        }
        
        $data = [
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
            'gambar' => $gambarName,
        ];
        $beritaModel->insert($data);
        return redirect()->to('/admin/berita');
    }

    public function edit($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $beritaModel = new BeritaModel();
        $berita = $beritaModel->find($id);
        return view('admin/berita_form', [
            'berita' => $berita,
            'admin_nama' => session()->get('admin_nama'),
            'admin_level' => session()->get('admin_level'),
        ]);
    }

    public function update($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $beritaModel = new BeritaModel();
        
        $data = [
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
        ];
        
        // Handle file upload if new image is uploaded
        $gambar = $this->request->getFile('gambar');
        if ($gambar->isValid() && !$gambar->hasMoved()) {
            $gambarName = $gambar->getRandomName();
            $gambar->move(ROOTPATH . 'public/uploads/berita', $gambarName);
            $data['gambar'] = $gambarName;
        }
        
        $beritaModel->update($id, $data);
        return redirect()->to('/admin/berita');
    }

    public function delete($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $beritaModel = new BeritaModel();
        $beritaModel->delete($id);
        return redirect()->to('/admin/berita');
    }
} 