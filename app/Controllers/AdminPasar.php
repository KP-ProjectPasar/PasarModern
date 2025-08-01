<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AdminPasar extends Controller
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // TODO: Replace with database query
        // $pasarModel = new PasarModel();
        // $pasars = $pasarModel->findAll();
        
        $data = [
            'title' => 'Data Pasar',
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'pasars' => [] // Empty array for now, will be populated from database
        ];

        return view('admin/pasar_list', $data);
    }

    public function create()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $data = [
            'title' => 'Tambah Data Pasar',
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role')
        ];

        return view('admin/pasar_form', $data);
    }

    public function store()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // TODO: Implement database save with file upload
        // $pasarModel = new PasarModel();
        
        // Handle file upload
        // $foto = $this->request->getFile('foto');
        // $fotoName = '';
        
        // if ($foto->isValid() && !$foto->hasMoved()) {
        //     $fotoName = $foto->getRandomName();
        //     $foto->move(ROOTPATH . 'public/uploads/galeri', $fotoName);
        // }
        
        // $data = [
        //     'nama' => $this->request->getPost('nama_pasar'),
        //     'alamat' => $this->request->getPost('alamat'),
        //     'telepon' => $this->request->getPost('telepon'),
        //     'status' => $this->request->getPost('status'),
        //     'jam_operasional' => $this->request->getPost('jam_operasional'),
        //     'jumlah_pedagang' => $this->request->getPost('jumlah_pedagang'),
        //     'deskripsi' => $this->request->getPost('deskripsi'),
        //     'foto' => $fotoName // Path ke file di uploads/galeri/
        // ];
        // $pasarModel->insert($data);

        session()->setFlashdata('success', 'Data pasar berhasil ditambahkan!');
        return redirect()->to('/admin/pasar');
    }

    public function edit($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // TODO: Replace with database query
        // $pasarModel = new PasarModel();
        // $pasar = $pasarModel->find($id);
        
        $data = [
            'title' => 'Edit Data Pasar',
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'pasar' => null // Will be populated from database
        ];

        return view('admin/pasar_form', $data);
    }

    public function update($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // TODO: Implement database update with file upload
        // $pasarModel = new PasarModel();
        
        // Handle file upload
        // $foto = $this->request->getFile('foto');
        // $fotoName = '';
        
        // if ($foto->isValid() && !$foto->hasMoved()) {
        //     $fotoName = $foto->getRandomName();
        //     $foto->move(ROOTPATH . 'public/uploads/galeri', $fotoName);
        // }
        
        // $data = [
        //     'nama' => $this->request->getPost('nama_pasar'),
        //     'alamat' => $this->request->getPost('alamat'),
        //     'telepon' => $this->request->getPost('telepon'),
        //     'status' => $this->request->getPost('status'),
        //     'jam_operasional' => $this->request->getPost('jam_operasional'),
        //     'jumlah_pedagang' => $this->request->getPost('jumlah_pedagang'),
        //     'deskripsi' => $this->request->getPost('deskripsi')
        // ];
        
        // if (!empty($fotoName)) {
        //     $data['foto'] = $fotoName;
        // }
        
        // $pasarModel->update($id, $data);

        session()->setFlashdata('success', 'Data pasar berhasil diperbarui!');
        return redirect()->to('/admin/pasar');
    }

    public function delete($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // TODO: Implement database delete
        // $pasarModel = new PasarModel();
        // $pasarModel->delete($id);

        session()->setFlashdata('success', 'Data pasar berhasil dihapus!');
        return redirect()->to('/admin/pasar');
    }
} 
