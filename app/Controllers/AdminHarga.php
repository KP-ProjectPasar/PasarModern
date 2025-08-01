<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AdminHarga extends Controller
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // TODO: Replace with database query
        // $hargaModel = new HargaModel();
        // $hargas = $hargaModel->findAll();

        return view('admin/harga_list', [
            'hargas' => [], // Empty array for now, will be populated from database
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

        // TODO: Get komoditas from database
        // $komoditasModel = new KomoditasModel();
        // $komoditas = $komoditasModel->findAll();
        
        return view('admin/harga_form', [
            'komoditas' => [], // Empty array for now, will be populated from database
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

        // TODO: Implement database save with file upload
        // $hargaModel = new HargaModel();
        
        // Handle file upload
        // $foto = $this->request->getFile('foto');
        // $fotoName = '';
        
        // if ($foto->isValid() && !$foto->hasMoved()) {
        //     $fotoName = $foto->getRandomName();
        //     $foto->move(ROOTPATH . 'public/uploads/komoditas', $fotoName);
        // }
        
        // $data = [
        //     'komoditas' => $this->request->getPost('komoditas'),
        //     'harga' => $this->request->getPost('harga'),
        //     'tanggal' => $this->request->getPost('tanggal'),
        //     'kategori' => $this->request->getPost('kategori'),
        //     'foto' => $fotoName,
        //     'deskripsi' => $this->request->getPost('deskripsi'),
        // ];
        // $hargaModel->insert($data);

        session()->setFlashdata('success', 'Data harga berhasil ditambahkan!');
        return redirect()->to('/admin/harga');
    }

    public function edit($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // TODO: Replace with database query
        // $hargaModel = new HargaModel();
        // $harga = $hargaModel->find($id);
        
        // $komoditasModel = new KomoditasModel();
        // $komoditas = $komoditasModel->findAll();
        
        return view('admin/harga_form', [
            'harga' => null, // Will be populated from database
            'komoditas' => [], // Will be populated from database
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

        // TODO: Implement database update with file upload
        // $hargaModel = new HargaModel();
        
        // Handle file upload
        // $foto = $this->request->getFile('foto');
        // $fotoName = '';
        
        // if ($foto->isValid() && !$foto->hasMoved()) {
        //     $fotoName = $foto->getRandomName();
        //     $foto->move(ROOTPATH . 'public/uploads/komoditas', $fotoName);
        // }
        
        // $data = [
        //     'komoditas' => $this->request->getPost('komoditas'),
        //     'harga' => $this->request->getPost('harga'),
        //     'tanggal' => $this->request->getPost('tanggal'),
        //     'kategori' => $this->request->getPost('kategori'),
        //     'deskripsi' => $this->request->getPost('deskripsi'),
        // ];
        
        // if (!empty($fotoName)) {
        //     $data['foto'] = $fotoName;
        // }
        
        // $hargaModel->update($id, $data);

        session()->setFlashdata('success', 'Data harga berhasil diperbarui!');
        return redirect()->to('/admin/harga');
    }

    public function delete($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // TODO: Implement database delete
        // $hargaModel = new HargaModel();
        // $hargaModel->delete($id);

        session()->setFlashdata('success', 'Data harga berhasil dihapus!');
        return redirect()->to('/admin/harga');
    }
} 
