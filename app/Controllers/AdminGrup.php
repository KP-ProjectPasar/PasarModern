<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AdminGrup extends Controller
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // TODO: Replace with database query
        // $grupModel = new GrupModel();
        // $grups = $grupModel->findAll();
        
        $data = [
            'title' => 'Kelola Grup',
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'grups' => [] // Empty array for now, will be populated from database
        ];

        return view('admin/grup_list', $data);
    }

    public function create()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $data = [
            'title' => 'Tambah Grup',
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role')
        ];

        return view('admin/grup_form', $data);
    }

    public function store()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // TODO: Implement database save
        // $grupModel = new GrupModel();
        // $data = [
        //     'nama_grup' => $this->request->getPost('nama_grup'),
        //     'deskripsi' => $this->request->getPost('deskripsi'),
        //     'status' => $this->request->getPost('status'),
        //     'jumlah_anggota' => $this->request->getPost('jumlah_anggota'),
        //     'kategori' => $this->request->getPost('kategori')
        // ];
        // $grupModel->insert($data);

        session()->setFlashdata('success', 'Grup berhasil ditambahkan!');
        return redirect()->to('/admin/grup');
    }

    public function edit($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // TODO: Replace with database query
        // $grupModel = new GrupModel();
        // $grup = $grupModel->find($id);
        
        $data = [
            'title' => 'Edit Grup',
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'grup' => null // Will be populated from database
        ];

        return view('admin/grup_form', $data);
    }

    public function update($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // TODO: Implement database update
        // $grupModel = new GrupModel();
        // $data = [
        //     'nama_grup' => $this->request->getPost('nama_grup'),
        //     'deskripsi' => $this->request->getPost('deskripsi'),
        //     'status' => $this->request->getPost('status'),
        //     'jumlah_anggota' => $this->request->getPost('jumlah_anggota'),
        //     'kategori' => $this->request->getPost('kategori')
        // ];
        // $grupModel->update($id, $data);

        session()->setFlashdata('success', 'Grup berhasil diperbarui!');
        return redirect()->to('/admin/grup');
    }

    public function delete($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // TODO: Implement database delete
        // $grupModel = new GrupModel();
        // $grupModel->delete($id);

        session()->setFlashdata('success', 'Grup berhasil dihapus!');
        return redirect()->to('/admin/grup');
    }
} 
