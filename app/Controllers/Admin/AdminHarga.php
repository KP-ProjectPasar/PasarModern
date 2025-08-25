<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\HargaModel;
use App\Models\KomoditasModel;

class AdminHarga extends BaseController
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $hargaModel = new HargaModel();
        $harga = $hargaModel->findAll();
        $data = [
            'harga' => $harga,
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'active_page' => 'harga',
        ];
        return view('admin/harga/harga_list', $data);
    }

    public function create()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $komoditasModel = new KomoditasModel();
        $komoditas = $komoditasModel->findAll();
        
        return view('admin/harga/harga_form', [
            'komoditas' => $komoditas,
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'title' => 'Tambah Harga',
            'active_page' => 'harga',
        ]);
    }

    public function store()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // Validation
        $validation = \Config\Services::validation();
        $validation->setRules([
            'komoditas_id' => 'required|numeric',
            'harga' => 'required|numeric|greater_than[0]',
            'satuan' => 'required|min_length[2]|max_length[20]',
            'tanggal' => 'required|valid_date',
            'keterangan' => 'permit_empty|max_length[500]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $hargaModel = new HargaModel();
        
        try {
            $data = [
                'komoditas_id' => $this->request->getPost('komoditas_id'),
                'harga' => $this->request->getPost('harga'),
                'satuan' => $this->request->getPost('satuan'),
                'tanggal' => $this->request->getPost('tanggal'),
                'keterangan' => $this->request->getPost('keterangan') ?? '',
            ];
            
            $hargaModel->insert($data);
            return redirect()->to('/admin/harga')->with('success', 'Data harga berhasil ditambahkan!');
            
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data harga: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $hargaModel = new HargaModel();
        $komoditasModel = new KomoditasModel();
        
        $harga = $hargaModel->find($id);
        $komoditas = $komoditasModel->findAll();
        
        if (!$harga) {
            return redirect()->to('/admin/harga')->with('error', 'Data harga tidak ditemukan!');
        }
        
        $data = [
            'harga' => $harga,
            'komoditas' => $komoditas,
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'title' => 'Edit Harga',
            'active_page' => 'harga',
        ];
        return view('admin/harga/harga_form', $data);
    }

    public function update($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // Validation
        $validation = \Config\Services::validation();
        $validation->setRules([
            'komoditas_id' => 'required|numeric',
            'harga' => 'required|numeric|greater_than[0]',
            'satuan' => 'required|min_length[2]|max_length[20]',
            'tanggal' => 'required|valid_date',
            'keterangan' => 'permit_empty|max_length[500]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $hargaModel = new HargaModel();
        
        try {
            $data = [
                'komoditas_id' => $this->request->getPost('komoditas_id'),
                'harga' => $this->request->getPost('harga'),
                'satuan' => $this->request->getPost('satuan'),
                'tanggal' => $this->request->getPost('tanggal'),
                'keterangan' => $this->request->getPost('keterangan') ?? '',
            ];
            
            $hargaModel->update($id, $data);
            return redirect()->to('/admin/harga')->with('success', 'Data harga berhasil diperbarui!');
            
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data harga: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        try {
            $hargaModel = new HargaModel();
            $hargaModel->delete($id);
            return redirect()->to('/admin/harga')->with('success', 'Data harga berhasil dihapus!');
            
        } catch (\Exception $e) {
            return redirect()->to('/admin/harga')->with('error', 'Gagal menghapus data harga: ' . $e->getMessage());
        }
    }
} 
