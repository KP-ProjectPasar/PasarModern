<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class AdminPasar extends BaseController
{
    public function index()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }
        
        $data = [
            'title' => 'Data Pasar',
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'pasar' => [],
            'active_page' => 'pasar'
        ];

        return view('admin/pasar/pasar_list', $data);
    }

    public function create()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $data = [
            'title' => 'Tambah Data Pasar',
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'active_page' => 'pasar'
        ];

        return view('admin/pasar/pasar_form', $data);
    }

    public function store()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_pasar' => 'required|min_length[3]',
            'alamat' => 'required|min_length[10]',
            'status' => 'required|in_list[aktif,perbaikan,nonaktif]',
            'telepon' => 'permit_empty|numeric',
            'jam_operasional' => 'permit_empty|min_length[5]',
            'jumlah_pedagang' => 'permit_empty|numeric',
            'deskripsi' => 'permit_empty|min_length[10]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validation->getErrors()
            ]);
        }

        try {
            $fotoName = '';
            $foto = $this->request->getFile('foto');
            
            if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                if ($foto->getSize() > 50 * 1024 * 1024) {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'File terlalu besar. Maksimal 50MB.'
                    ]);
                }
                
                $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                if (!in_array($foto->getMimeType(), $allowedTypes)) {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Format file tidak didukung. Gunakan JPG, PNG, atau GIF.'
                    ]);
                }
                
                $fotoName = $foto->getRandomName();
                $foto->move(ROOTPATH . 'public/uploads/pasar', $fotoName);
            }
            
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Data pasar berhasil ditambahkan!'
            ]);
            
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function edit($id)
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }
        
        $data = [
            'title' => 'Edit Data Pasar',
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'pasar' => null
        ];

        return view('admin/pasar/pasar_form', $data);
    }

    public function update($id)
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        session()->setFlashdata('success', 'Data pasar berhasil diperbarui!');
        return redirect()->to('/admin/pasar');
    }

    public function delete($id)
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        session()->setFlashdata('success', 'Data pasar berhasil dihapus!');
        return redirect()->to('/admin/pasar');
    }
} 
