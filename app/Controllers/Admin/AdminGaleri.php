<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GaleriModel;

class AdminGaleri extends BaseController
{
    public function index()
    {
        try {
            // Check if user is logged in
            if (!session()->get('is_admin')) {
                return redirect()->to('/admin/login');
            }

            $galeriModel = new GaleriModel();
            
            // Get galeri data
            $galeri = $galeriModel->getGaleriWithViews() ?? [];
            
            // Get dashboard statistics
            $stats = $galeriModel->getDashboardStats();
            
            log_message('debug', '[AdminGaleri::index] Galeri count: ' . count($galeri));
            log_message('debug', '[AdminGaleri::index] Stats: ' . json_encode($stats));
            
            $data = [
                'galeri' => $galeri,
                'stats' => $stats,
                'admin_nama' => session()->get('admin_nama'),
                'admin_role' => session()->get('admin_role'),
                'active_page' => 'galeri',
            ];
            return view('admin/galeri/galeri_list', $data);
        } catch (\Exception $e) {
            log_message('error', '[AdminGaleri::index] Error: ' . $e->getMessage());
            session()->setFlashdata('error', 'Terjadi kesalahan saat memuat data galeri.');
            return redirect()->back();
        }
    }

    public function create()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        return view('admin/galeri/galeri_form', [
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'title' => 'Tambah Galeri',
            'active_page' => 'galeri',
        ]);
    }

    public function store()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // Validation (client sends multiple as gambar[])
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => 'required|min_length[3]|max_length[100]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $galeriModel = new GaleriModel();
        
        try {
            // Debug: Log request data
            log_message('debug', '=== GALERI STORE START ===');
            log_message('debug', 'Galeri store - POST data: ' . json_encode($this->request->getPost()));
            log_message('debug', 'Galeri store - FILES data: ' . json_encode($this->request->getFiles()));
            
            // Handle file upload (multiple). Use first as utama
            $gambarName = '';
            $files = $this->request->getFileMultiple('gambar');
            $firstFile = (!empty($files) && isset($files[0])) ? $files[0] : null;
            
            log_message('debug', 'Galeri store - First file check: ' . ($firstFile ? 'exists' : 'null'));
            
            if (!$firstFile) {
                return redirect()->back()->withInput()->with('errors', ['gambar' => 'Gambar harus dipilih']);
            }

            if ($firstFile && $firstFile->isValid() && !$firstFile->hasMoved()) {
                log_message('debug', 'Galeri store - File validation passed, proceeding with upload');
                
                // Ensure upload directory exists
                $uploadPath = ROOTPATH . 'public/uploads/galeri';
                log_message('debug', 'Galeri store - Upload path: ' . $uploadPath);
                
                if (!is_dir($uploadPath)) {
                    log_message('debug', 'Galeri store - Creating upload directory');
                    mkdir($uploadPath, 0755, true);
                }
                
                // Check directory permissions
                if (!is_writable($uploadPath)) {
                    log_message('error', 'Galeri store - Upload directory not writable: ' . $uploadPath);
                    throw new \Exception('Upload directory tidak dapat ditulis');
                }
                
                // Basic manual file validation for first file
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

                // Get file extension and create proper filename
                $extension = $firstFile->getExtension();
                $gambarName = $firstFile->getRandomName();
                
                // Ensure proper extension
                if (!empty($extension)) {
                    $gambarName = pathinfo($gambarName, PATHINFO_FILENAME) . '.' . $extension;
                }
                
                log_message('debug', 'Galeri store - Generated filename: ' . $gambarName);
                log_message('debug', 'Galeri store - File extension: ' . $extension);
                
                // Move file to upload directory
                if ($firstFile->move($uploadPath, $gambarName)) {
                    log_message('debug', 'Galeri store - File uploaded successfully: ' . $gambarName);
                    log_message('debug', 'Galeri store - File path: ' . $uploadPath . '/' . $gambarName);
                    log_message('debug', 'Galeri store - File exists: ' . (file_exists($uploadPath . '/' . $gambarName) ? 'true' : 'false'));
                    log_message('debug', 'Galeri store - File size: ' . filesize($uploadPath . '/' . $gambarName));
                    log_message('debug', 'Galeri store - File permissions: ' . substr(sprintf('%o', fileperms($uploadPath . '/' . $gambarName)), -4));
                } else {
                    log_message('error', 'Galeri store - File move failed');
                    throw new \Exception('Gagal memindahkan file upload');
                }
            } else {
                $errorMsg = 'File upload failed: ';
                if (!$firstFile) {
                    $errorMsg .= 'File object is null';
                } else {
                    $errorMsg .= 'isValid=' . ($firstFile->isValid() ? 'true' : 'false') . 
                                ', hasMoved=' . ($firstFile->hasMoved() ? 'true' : 'false') . 
                                ', error=' . $firstFile->getError();
                }
                log_message('error', 'Galeri store - ' . $errorMsg);
            }
            
            $data = [
                'judul' => $this->request->getPost('judul'),
                'gambar' => $gambarName,
                'views' => 0, // Default views
                'status' => $this->request->getPost('status') ?? 'draft', // Default draft
                'created_by' => session()->get('admin_id'), // Set admin yang membuat
            ];
            
            log_message('debug', 'Galeri store - Data to insert: ' . json_encode($data));
            log_message('debug', 'Galeri store - Gambar name: ' . $gambarName);
            
            $insertResult = $galeriModel->insert($data);
            log_message('debug', 'Galeri store - Insert result: ' . $insertResult);
            
            if ($insertResult) {
                log_message('debug', 'Galeri store - Success: Galeri berhasil ditambahkan dengan ID: ' . $insertResult);
                return redirect()->to('/admin/galeri')->with('success', 'Galeri berhasil ditambahkan!');
            } else {
                log_message('error', 'Galeri store - Failed: Gagal insert ke database');
                throw new \Exception('Gagal menyimpan galeri ke database');
            }
            
        } catch (\Exception $e) {
            log_message('error', 'Galeri store - Exception: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan galeri: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $galeriModel = new GaleriModel();
        $galeri = $galeriModel->find($id);
        
        if (!$galeri) {
            return redirect()->to('/admin/galeri')->with('error', 'Galeri tidak ditemukan!');
        }
        
        $data = [
            'galeri' => $galeri,
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'title' => 'Edit Galeri',
            'active_page' => 'galeri',
        ];
        // Fix view path: the form resides in admin/galeri/galeri_form.php
        return view('admin/galeri/galeri_form', $data);
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
            'judul' => 'required|min_length[3]|max_length[100]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $galeriModel = new GaleriModel();
        
        try {
            $data = [
                'judul' => $this->request->getPost('judul'),
                'status' => $this->request->getPost('status') ?? 'draft',
            ];
            
            // Handle file upload if new images uploaded (take first)
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
                $uploadPath = ROOTPATH . 'public/uploads/galeri';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                $gambarName = $firstFile->getRandomName();
                $firstFile->move($uploadPath, $gambarName);
                $data['gambar'] = $gambarName;
            }
            
            $galeriModel->update($id, $data);
            return redirect()->to('/admin/galeri')->with('success', 'Galeri berhasil diperbarui!');
            
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui galeri: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        try {
            $galeriModel = new GaleriModel();
            $galeri = $galeriModel->find($id);
            
            if ($galeri && $galeri['gambar']) {
                // Delete image file
                $imagePath = ROOTPATH . 'public/uploads/galeri/' . $galeri['gambar'];
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            
            $galeriModel->delete($id);
            return redirect()->to('/admin/galeri')->with('success', 'Galeri berhasil dihapus!');
            
        } catch (\Exception $e) {
            return redirect()->to('/admin/galeri')->with('error', 'Gagal menghapus galeri: ' . $e->getMessage());
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
            return redirect()->to('/admin/galeri')->with('error', 'Status tidak valid');
        }
        
        try {
            $galeriModel = new GaleriModel();
            $galeri = $galeriModel->find($id);
            
            if (!$galeri) {
                return redirect()->to('/admin/galeri')->with('error', 'Galeri tidak ditemukan');
            }
            
            $normalized = strtolower($status);

            // Try model update first
            $galeriModel->update($id, ['status' => $normalized]);

            // Verify
            $updated = $galeriModel->find($id);
            $storedStatus = $updated['status'] ?? '';
            if (!is_string($storedStatus) || strtolower($storedStatus) !== $normalized) {
                // Try Title Case variant for legacy ENUMs
                $fallbackStatus = ucfirst($normalized); // 'draft' -> 'Draft'
                $galeriModel->update($id, ['status' => $fallbackStatus]);

                // Verify again
                $updated = $galeriModel->find($id);
                $storedStatus = $updated['status'] ?? '';
            }

            if (!is_string($storedStatus) || (strtolower($storedStatus) !== $normalized && $storedStatus !== ucfirst($normalized))) {
                // Last resort: direct builder update (bypass field protection quirks)
                $builder = $galeriModel->builder();
                $builder->set('status', $normalized)->where('id', $id)->update();
            }
            
            $statusLabels = [
                'draft' => 'Draft',
                'published' => 'Published'
            ];
            
            return redirect()->to('/admin/galeri');
            
        } catch (\Exception $e) {
            return redirect()->to('/admin/galeri')->with('error', 'Gagal mengubah status galeri: ' . $e->getMessage());
        }
    }
} 
