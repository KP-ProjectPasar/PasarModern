<?php
namespace App\Controllers;
use App\Models\GaleriModel;

class AdminGaleri extends BaseController
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $galeriModel = new GaleriModel();
        $galeri = $galeriModel->findAll();
        $data = [
            'galeri' => $galeri,
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'active_page' => 'galeri',
        ];
        return view('admin/lists/galeri_list', $data);
    }

    public function create()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        return view('admin/forms/galeri_form', [
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

        // Validation
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => 'required|min_length[3]|max_length[100]',
            'gambar' => 'uploaded[gambar]|is_image[gambar]|max_size[gambar,5120]'
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
            
            // Handle file upload
            $gambar = $this->request->getFile('gambar');
            $gambarName = '';
            
            log_message('debug', 'Galeri store - File object check: ' . ($gambar ? 'exists' : 'null'));
            
            if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
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
                
                // Get file extension and create proper filename
                $extension = $gambar->getExtension();
                $gambarName = $gambar->getRandomName();
                
                // Ensure proper extension
                if (!empty($extension)) {
                    $gambarName = pathinfo($gambarName, PATHINFO_FILENAME) . '.' . $extension;
                }
                
                log_message('debug', 'Galeri store - Generated filename: ' . $gambarName);
                log_message('debug', 'Galeri store - File extension: ' . $extension);
                
                // Move file to upload directory
                if ($gambar->move($uploadPath, $gambarName)) {
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
                if (!$gambar) {
                    $errorMsg .= 'File object is null';
                } else {
                    $errorMsg .= 'isValid=' . ($gambar->isValid() ? 'true' : 'false') . 
                                ', hasMoved=' . ($gambar->hasMoved() ? 'true' : 'false') . 
                                ', error=' . $gambar->getError();
                }
                log_message('error', 'Galeri store - ' . $errorMsg);
            }
            
            $data = [
                'judul' => $this->request->getPost('judul'),
                'gambar' => $gambarName,
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
        return view('admin/forms/galeri_form', $data);
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
            ];
            
            // Handle file upload if new image is uploaded
            $gambar = $this->request->getFile('gambar');
            if ($gambar->isValid() && !$gambar->hasMoved()) {
                // Additional validation for new image
                $imageValidation = \Config\Services::validation();
                $imageValidation->setRules([
                    'gambar' => 'is_image[gambar]|max_size[gambar,5120]'
                ]);
                
                if (!$imageValidation->withRequest($this->request)->run()) {
                    return redirect()->back()->withInput()->with('errors', $imageValidation->getErrors());
                }
                
                // Ensure upload directory exists
                $uploadPath = ROOTPATH . 'public/uploads/galeri';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                
                $gambarName = $gambar->getRandomName();
                $gambar->move($uploadPath, $gambarName);
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
} 
