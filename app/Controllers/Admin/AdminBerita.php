<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BeritaModel;

class AdminBerita extends BaseController
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
        try {
            // Check if user is logged in
            if (!session()->get('is_admin')) {
                return redirect()->to('/admin/login');
            }

            // Check permission
            if (!$this->checkPermission('berita_management')) {
                session()->setFlashdata('error', 'Anda tidak memiliki akses untuk fitur ini!');
                return redirect()->to('/admin/dashboard');
            }

            $beritaModel = new BeritaModel();
            
            // Get berita data
            $berita = $beritaModel->getBeritaWithViews() ?? [];
            
            // Get dashboard statistics
            $stats = $beritaModel->getDashboardStats();
            
            log_message('debug', '[AdminBerita::index] Berita count: ' . count($berita));
            log_message('debug', '[AdminBerita::index] Stats: ' . json_encode($stats));
            
            $data = [
                'berita' => $berita,
                'stats' => $stats,
                'admin_nama' => session()->get('admin_nama'),
                'admin_role' => session()->get('admin_role'),
                'active_page' => 'berita',
            ];
            return view('admin/berita/berita_list', $data);
        } catch (\Exception $e) {
            log_message('error', '[AdminBerita::index] Error: ' . $e->getMessage());
            session()->setFlashdata('error', 'Terjadi kesalahan saat memuat data berita.');
            return redirect()->back();
        }
    }

    public function create()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // Check permission
        if (!$this->checkPermission('berita_management')) {
            session()->setFlashdata('error', 'Anda tidak memiliki akses untuk fitur ini!');
            return redirect()->to('/admin/dashboard');
        }

        return view('admin/berita/berita_form', [
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'title' => 'Tambah Berita',
            'active_page' => 'berita',
        ]);
    }

    public function store()
    {
        try {
            // Check if user is logged in
            if (!session()->get('is_admin')) {
                return redirect()->to('/admin/login');
            }

            // Check permission
            if (!$this->checkPermission('berita_management')) {
                session()->setFlashdata('error', 'Anda tidak memiliki akses untuk fitur ini!');
                return redirect()->to('/admin/dashboard');
            }

            // Validation
            $validation = \Config\Services::validation();
            $rules = [
                'judul' => [
                    'rules' => 'required|min_length[5]|max_length[200]',
                    'errors' => [
                        'required' => 'Judul berita harus diisi',
                        'min_length' => 'Judul berita minimal 5 karakter',
                        'max_length' => 'Judul berita maksimal 200 karakter'
                    ]
                ],
                'isi' => [
                    'rules' => 'required|min_length[50]',
                    'errors' => [
                        'required' => 'Isi berita harus diisi',
                        'min_length' => 'Isi berita minimal 50 karakter'
                    ]
                ],
                'status' => [
                    'rules' => 'required|in_list[draft,published]',
                    'errors' => [
                        'required' => 'Status berita harus dipilih',
                        'in_list' => 'Status berita tidak valid'
                    ]
                ]
            ];

            // Note: input name is "gambar[]" (multiple). We'll validate manually below

            $validation->setRules($rules);

            if (!$validation->withRequest($this->request)->run()) {
                return redirect()->back()
                               ->withInput()
                               ->with('errors', $validation->getErrors());
            }

            $beritaModel = new BeritaModel();
            
            // Handle file upload
            $gambarName = '';
            $files = $this->request->getFileMultiple('gambar');
            $firstFile = (!empty($files) && isset($files[0])) ? $files[0] : null;

            if ($firstFile && $firstFile->isValid() && !$firstFile->hasMoved()) {
                try {
                    // Basic manual file validation
                    $allowedMime = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                    $allowedExt  = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                    $maxSize     = 5 * 1024 * 1024; // 5MB

                    if (!in_array(strtolower($firstFile->getMimeType()), $allowedMime, true)) {
                        throw new \Exception('Format gambar harus JPG, JPEG, PNG, GIF, atau WebP');
                    }
                    if (!in_array(strtolower($firstFile->getExtension()), $allowedExt, true)) {
                        throw new \Exception('Ekstensi gambar tidak valid');
                    }
                    if ($firstFile->getSize() > $maxSize) {
                        throw new \Exception('Ukuran gambar maksimal 5MB');
                    }

                    // Ensure upload directory exists (public path to be web-accessible)
                    $uploadPath = ROOTPATH . 'public/uploads/berita';
                    if (!is_dir($uploadPath)) {
                        mkdir($uploadPath, 0755, true);
                    }

                    // Generate random name and move
                    $gambarName = $firstFile->getRandomName();
                    if ($firstFile->move($uploadPath, $gambarName)) {
                        @chmod($uploadPath . DIRECTORY_SEPARATOR . $gambarName, 0644);
                        log_message('debug', 'Berita store - File uploaded successfully: ' . $gambarName);
                        log_message('debug', 'Berita store - File path: ' . $uploadPath . '/' . $gambarName);
                        log_message('debug', 'Berita store - File exists: ' . (file_exists($uploadPath . '/' . $gambarName) ? 'true' : 'false'));
                    } else {
                        log_message('error', 'Berita store - File move failed');
                        throw new \Exception('Gagal memindahkan file upload');
                    }
                } catch (\Exception $e) {
                    log_message('error', 'Berita store - File upload error: ' . $e->getMessage());
                    throw new \Exception('Gagal mengupload gambar: ' . $e->getMessage());
                }
            }
            
            $data = [
                'judul' => $this->request->getPost('judul'),
                'isi' => $this->request->getPost('isi'),
                'tanggal_publish' => date('Y-m-d'),
                'gambar' => $gambarName,
                'status' => $this->request->getPost('status'),
                'views' => 0, // Default views
                'created_by' => session()->get('admin_id'), // Set admin yang membuat
            ];
            
            log_message('debug', 'Berita store - Data to insert: ' . json_encode($data));
            log_message('debug', 'Berita store - Gambar name: ' . $gambarName);
            log_message('debug', 'Berita store - Isi field length: ' . strlen($data['isi']));
            log_message('debug', 'Berita store - Isi field content (first 200 chars): ' . substr($data['isi'], 0, 200));
            
            // Validate data before insert
            if (empty($data['isi']) || strlen(trim(strip_tags($data['isi']))) < 50) {
                log_message('error', 'Berita store - Isi field validation failed: content too short or empty');
                throw new \Exception('Isi berita minimal 50 karakter');
            }
            
            $insertResult = $beritaModel->insert($data);
            log_message('debug', 'Berita store - Insert result: ' . $insertResult);
            
            if ($insertResult) {
                log_message('debug', 'Berita store - Success: Berita berhasil ditambahkan dengan ID: ' . $insertResult);
                return redirect()->to('/admin/berita')->with('success', 'Berita berhasil ditambahkan!');
            } else {
                log_message('error', 'Berita store - Failed: Gagal insert ke database');
                throw new \Exception('Gagal menyimpan berita ke database');
            }
            
        } catch (\Exception $e) {
            log_message('error', 'Berita store - Exception: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan berita: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $beritaModel = new BeritaModel();
        $berita = $beritaModel->find($id);
        
        if (!$berita) {
            return redirect()->to('/admin/berita')->with('error', 'Berita tidak ditemukan!');
        }
        
        $data = [
            'berita' => $berita,
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'title' => 'Edit Berita',
            'active_page' => 'berita',
        ];
        // Fix view path: the form resides in admin/berita/berita_form.php
        return view('admin/berita/berita_form', $data);
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
            'judul' => 'required|min_length[5]|max_length[200]',
            'isi' => 'required|min_length[50]',
            'status' => 'required|in_list[draft,published]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $beritaModel = new BeritaModel();
        
        try {
            $data = [
                'judul' => $this->request->getPost('judul'),
                'isi' => $this->request->getPost('isi'),
                // Keep existing publish date if already set, else default to today when publishing
                'tanggal_publish' => $this->request->getPost('status') === 'published' 
                    ? date('Y-m-d') 
                    : ($this->request->getPost('tanggal_publish') ?: null),
                'status' => $this->request->getPost('status'),
            ];

            // Handle file upload if new image is uploaded (input name: gambar[])
            $files = $this->request->getFileMultiple('gambar');
            $firstFile = (!empty($files) && isset($files[0])) ? $files[0] : null;

            if ($firstFile && $firstFile->isValid() && !$firstFile->hasMoved()) {
                // Manual validation
                $allowedMime = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                $allowedExt  = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $maxSize     = 5 * 1024 * 1024; // 5MB

                if (!in_array(strtolower($firstFile->getMimeType()), $allowedMime, true)) {
                    return redirect()->back()->withInput()->with('errors', ['gambar' => 'Format file tidak didukung. Gunakan JPG, JPEG, PNG, GIF, atau WebP.']);
                }
                if (!in_array(strtolower($firstFile->getExtension()), $allowedExt, true)) {
                    return redirect()->back()->withInput()->with('errors', ['gambar' => 'Ekstensi gambar tidak valid.']);
                }
                if ($firstFile->getSize() > $maxSize) {
                    return redirect()->back()->withInput()->with('errors', ['gambar' => 'Ukuran file terlalu besar. Maksimal 5MB.']);
                }

                // Ensure upload directory exists
                $uploadPath = ROOTPATH . 'public/uploads/berita';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                $gambarName = $firstFile->getRandomName();
                $firstFile->move($uploadPath, $gambarName);
                $data['gambar'] = $gambarName;
            }

            $beritaModel->update($id, $data);
            return redirect()->to('/admin/berita')->with('success', 'Berita berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui berita: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        try {
            $beritaModel = new BeritaModel();
            $berita = $beritaModel->find($id);
            
            if ($berita && $berita['gambar']) {
                // Delete image file
                $imagePath = ROOTPATH . 'public/uploads/berita/' . $berita['gambar'];
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            
            $beritaModel->delete($id);
            return redirect()->to('/admin/berita')->with('success', 'Berita berhasil dihapus!');
            
        } catch (\Exception $e) {
            return redirect()->to('/admin/berita')->with('error', 'Gagal menghapus berita: ' . $e->getMessage());
        }
    }
    
    // Quick status change
    public function changeStatus($id, $status)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }
        
        // Validate status (archived removed)
        $allowedStatuses = ['draft', 'published'];
        if (!in_array($status, $allowedStatuses)) {
            return redirect()->to('/admin/berita')->with('error', 'Status tidak valid');
        }
        
        try {
            $beritaModel = new BeritaModel();
            $berita = $beritaModel->find($id);
            
            if (!$berita) {
                return redirect()->to('/admin/berita')->with('error', 'Berita tidak ditemukan');
            }
            
            $beritaModel->update($id, ['status' => $status]);
            
            $statusLabels = [
                'draft' => 'Draft',
                'published' => 'Published'
            ];
            
            return redirect()->to('/admin/berita')->with('success', 'Status berita berhasil diubah ke ' . $statusLabels[$status]);
            
        } catch (\Exception $e) {
            return redirect()->to('/admin/berita')->with('error', 'Gagal mengubah status berita: ' . $e->getMessage());
        }
    }
} 
