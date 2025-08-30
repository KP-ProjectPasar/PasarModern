<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PasarModel;

class AdminPasar extends BaseController
{
    /**
     * Check if current user has permission for specific action
     */
    private function checkPermission($permission)
    {
        $currentRole = session()->get('admin_role');
        
        if (!$currentRole) {
            return false;
        }
        
        // Superadmin has all permissions
        if (strtolower($currentRole) === 'superadmin') {
            return true;
        }
        
        try {
            $roleModel = new \App\Models\RoleModel();
            $role = $roleModel->getRoleByName($currentRole);
            
            if ($role && !empty($role['permissions'])) {
                $permissions = json_decode($role['permissions'], true) ?: [];
                return isset($permissions[$permission]) && $permissions[$permission] === true;
            }
        } catch (\Exception $e) {
            log_message('error', 'Permission check error: ' . $e->getMessage());
        }
        
        return false;
    }

    public function index()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // Check permission
        if (!$this->checkPermission('pasar_management')) {
            session()->setFlashdata('error', 'Anda tidak memiliki akses untuk fitur ini!');
            return redirect()->to('/admin/dashboard');
        }
        
        $pasarModel = new PasarModel();
        $pasar = $pasarModel->findAll();
        
        $data = [
            'title' => 'Data Pasar',
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'pasar' => $pasar,
            'active_page' => 'pasar'
        ];

        return view('admin/pasar/pasar_list', $data);
    }

    public function create()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // Check permission
        if (!$this->checkPermission('pasar_management')) {
            session()->setFlashdata('error', 'Anda tidak memiliki akses untuk fitur ini!');
            return redirect()->to('/admin/dashboard');
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

        // Check permission
        if (!$this->checkPermission('pasar_management')) {
            session()->setFlashdata('error', 'Anda tidak memiliki akses untuk fitur ini!');
            return redirect()->to('/admin/dashboard');
        }

        $pasarModel = new PasarModel();
        
        // Log request data
        log_message('info', '[AdminPasar::store] Request data: ' . json_encode($this->request->getPost()));
        
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_pasar' => 'required|min_length[3]|max_length[255]',
            'alamat' => 'required|min_length[10]',
            'status' => 'required|in_list[aktif,nonaktif,maintenance]',
            'telepon' => 'permit_empty|min_length[10]|max_length[20]',
            'email' => 'permit_empty|valid_email|max_length[255]',
            'jam_buka' => 'permit_empty',
            'jam_tutup' => 'permit_empty',
            'deskripsi' => 'permit_empty|min_length[10]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            log_message('error', '[AdminPasar::store] Validation failed: ' . json_encode($validation->getErrors()));
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        try {
            // Siapkan data untuk disimpan
            $data = [
                'nama_pasar' => $this->request->getPost('nama_pasar'),
                'alamat' => $this->request->getPost('alamat'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'telepon' => $this->request->getPost('telepon'),
                'email' => $this->request->getPost('email'),
                'jam_buka' => $this->request->getPost('jam_buka'),
                'jam_tutup' => $this->request->getPost('jam_tutup'),
                'status' => $this->request->getPost('status')
            ];
            
            log_message('info', '[AdminPasar::store] Data to insert: ' . json_encode($data));
            
            // Simpan ke database
            $result = $pasarModel->insert($data);
            
            if ($result === false) {
                $errors = $pasarModel->errors();
                log_message('error', '[AdminPasar::store] Insert failed: ' . json_encode($errors));
                return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data pasar');
            }
            
            log_message('info', '[AdminPasar::store] Successfully inserted with ID: ' . $result);
            
            // Redirect ke halaman list dengan pesan sukses
            return redirect()->to('/admin/pasar')->with('success', 'Data pasar berhasil ditambahkan!');
            
        } catch (\Exception $e) {
            log_message('error', '[AdminPasar::store] Error: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }
        
        $pasarModel = new PasarModel();
        $pasar = $pasarModel->find($id);
        
        if (!$pasar) {
            return redirect()->to('/admin/pasar')->with('error', 'Data pasar tidak ditemukan');
        }
        
        $data = [
            'title' => 'Edit Data Pasar',
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'pasar' => $pasar,
            'active_page' => 'pasar'
        ];

        return view('admin/pasar/pasar_form', $data);
    }

    public function update($id)
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $pasarModel = new PasarModel();
        
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_pasar' => 'required|min_length[3]|max_length[255]',
            'alamat' => 'required|min_length[10]',
            'status' => 'required|in_list[aktif,nonaktif,maintenance]',
            'telepon' => 'permit_empty|min_length[10]|max_length[20]',
            'email' => 'permit_empty|valid_email|max_length[255]',
            'jam_buka' => 'permit_empty',
            'jam_tutup' => 'permit_empty',
            'deskripsi' => 'permit_empty|min_length[10]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        try {
            // Siapkan data untuk diupdate
            $data = [
                'nama_pasar' => $this->request->getPost('nama_pasar'),
                'alamat' => $this->request->getPost('alamat'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'telepon' => $this->request->getPost('telepon'),
                'email' => $this->request->getPost('email'),
                'jam_buka' => $this->request->getPost('jam_buka'),
                'jam_tutup' => $this->request->getPost('jam_tutup'),
                'status' => $this->request->getPost('status')
            ];
            
            // Update ke database
            $result = $pasarModel->update($id, $data);
            
            if ($result === false) {
                $errors = $pasarModel->errors();
                return redirect()->back()->withInput()->with('error', 'Gagal mengupdate data pasar');
            }
            
            // Redirect ke halaman list dengan pesan sukses
            return redirect()->to('/admin/pasar')->with('success', 'Data pasar berhasil diperbarui!');
            
        } catch (\Exception $e) {
            log_message('error', '[AdminPasar::update] Error: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $pasarModel = new PasarModel();
        
        try {
            $result = $pasarModel->delete($id);
            
            if ($result === false) {
                return redirect()->to('/admin/pasar')->with('error', 'Gagal menghapus data pasar');
            }
            
            return redirect()->to('/admin/pasar')->with('success', 'Data pasar berhasil dihapus!');
            
        } catch (\Exception $e) {
            log_message('error', '[AdminPasar::delete] Error: ' . $e->getMessage());
            return redirect()->to('/admin/pasar')->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }
} 
