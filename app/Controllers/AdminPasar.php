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

        // Validate input
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
            // Handle file upload
            $fotoName = '';
            $foto = $this->request->getFile('foto');
            
            if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                // Validate file
                if ($foto->getSize() > 2 * 1024 * 1024) { // 2MB limit
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'File terlalu besar. Maksimal 2MB.'
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
            
            // TODO: Replace with actual database save
            // $pasarModel = new PasarModel();
            // $data = [
            //     'nama' => $this->request->getPost('nama_pasar'),
            //     'alamat' => $this->request->getPost('alamat'),
            //     'telepon' => $this->request->getPost('telepon'),
            //     'status' => $this->request->getPost('status'),
            //     'jam_operasional' => $this->request->getPost('jam_operasional'),
            //     'jumlah_pedagang' => $this->request->getPost('jumlah_pedagang'),
            //     'deskripsi' => $this->request->getPost('deskripsi'),
            //     'foto' => $fotoName
            // ];
            // $pasarModel->insert($data);
            
            // For now, just return success
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
