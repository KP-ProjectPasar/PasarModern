<?php
namespace App\Controllers;
use App\Models\BeritaModel;

class AdminBerita extends BaseController
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $beritaModel = new BeritaModel();
        $berita = $beritaModel->findAll();
        $data = [
            'berita' => $berita,
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'active_page' => 'berita',
        ];
        return view('admin/lists/berita_list', $data);
    }

    public function create()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        return view('admin/forms/berita_form', [
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'title' => 'Tambah Berita',
            'active_page' => 'berita',
        ]);
    }

    public function store()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // Debug: Log request data
        log_message('debug', '=== BERITA STORE START ===');
        log_message('debug', 'Berita store - POST data: ' . json_encode($this->request->getPost()));
        log_message('debug', 'Berita store - FILES data: ' . json_encode($this->request->getFiles()));
        log_message('debug', 'Berita store - Request method: ' . $this->request->getMethod());
        log_message('debug', 'Berita store - Content type: ' . $this->request->getHeaderLine('Content-Type'));
        log_message('debug', 'Berita store - Raw POST: ' . file_get_contents('php://input'));

        // Validation
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => 'required|min_length[5]|max_length[200]',
            'isi' => 'required|min_length[50]',
            'tanggal_publish' => 'required|valid_date',
            'gambar' => 'uploaded[gambar]|is_image[gambar]|max_size[gambar,5120]|mime_in[gambar,image/jpg,image/jpeg,image/png,image/gif,image/webp]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            log_message('error', 'Berita store - Validation failed: ' . json_encode($validation->getErrors()));
            log_message('error', 'Berita store - Validation rules: ' . json_encode($validation->getRules()));
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $beritaModel = new BeritaModel();
        
        try {
            // Handle file upload
            $gambar = $this->request->getFile('gambar');
            $gambarName = '';
            
            log_message('debug', 'Berita store - File object check: ' . ($gambar ? 'exists' : 'null'));
            
            if ($gambar) {
                log_message('debug', 'Berita store - File object: ' . json_encode([
                    'isValid' => $gambar->isValid(),
                    'hasMoved' => $gambar->hasMoved(),
                    'getName' => $gambar->getName(),
                    'getSize' => $gambar->getSize(),
                    'getError' => $gambar->getError(),
                    'getMimeType' => $gambar->getMimeType(),
                    'getExtension' => $gambar->getExtension()
                ]));
            }
            
            if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
                log_message('debug', 'Berita store - File validation passed, proceeding with upload');
                
                // Ensure upload directory exists
                $uploadPath = ROOTPATH . 'public/uploads/berita';
                log_message('debug', 'Berita store - Upload path: ' . $uploadPath);
                
                if (!is_dir($uploadPath)) {
                    log_message('debug', 'Berita store - Creating upload directory');
                    mkdir($uploadPath, 0755, true);
                }
                
                // Check directory permissions
                if (!is_writable($uploadPath)) {
                    log_message('error', 'Berita store - Upload directory not writable: ' . $uploadPath);
                    throw new \Exception('Upload directory tidak dapat ditulis');
                }
                
                // Get file extension and create proper filename
                $extension = $gambar->getExtension();
                $gambarName = $gambar->getRandomName();
                
                // Ensure proper extension
                if (!empty($extension)) {
                    $gambarName = pathinfo($gambarName, PATHINFO_FILENAME) . '.' . $extension;
                }
                
                // Move file to upload directory
                if ($gambar->move($uploadPath, $gambarName)) {
                    log_message('debug', 'Berita store - File uploaded successfully: ' . $gambarName);
                    log_message('debug', 'Berita store - File path: ' . $uploadPath . '/' . $gambarName);
                    log_message('debug', 'Berita store - File exists: ' . (file_exists($uploadPath . '/' . $gambarName) ? 'true' : 'false'));
                    log_message('debug', 'Berita store - File size: ' . filesize($uploadPath . '/' . $gambarName));
                    log_message('debug', 'Berita store - File permissions: ' . substr(sprintf('%o', fileperms($uploadPath . '/' . $gambarName)), -4));
                } else {
                    log_message('error', 'Berita store - File move failed');
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
                log_message('error', 'Berita store - ' . $errorMsg);
            }
            
            $data = [
                'judul' => $this->request->getPost('judul'),
                'isi' => $this->request->getPost('isi'),
                'tanggal_publish' => $this->request->getPost('tanggal_publish'),
                'gambar' => $gambarName,
            ];
            
            log_message('debug', 'Berita store - Data to insert: ' . json_encode($data));
            log_message('debug', 'Berita store - Gambar name: ' . $gambarName);
            
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
        return view('admin/forms/berita_form', $data);
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
            'tanggal_publish' => 'required|valid_date',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $beritaModel = new BeritaModel();
        
        try {
            $data = [
                'judul' => $this->request->getPost('judul'),
                'isi' => $this->request->getPost('isi'),
                'tanggal_publish' => $this->request->getPost('tanggal_publish'),
            ];
            
            // Handle file upload if new image is uploaded
            $gambar = $this->request->getFile('gambar');
            if ($gambar->isValid() && !$gambar->hasMoved()) {
                // Additional validation for new image
                $imageValidation = \Config\Services::validation();
                $imageValidation->setRules([
                    'gambar' => 'is_image[gambar]|max_size[gambar,5120]|mime_in[gambar,image/jpg,image/jpeg,image/png,image/gif,image/webp]'
                ]);
                
                if (!$imageValidation->withRequest($this->request)->run()) {
                    return redirect()->back()->withInput()->with('errors', $imageValidation->getErrors());
                }
                
                // Ensure upload directory exists
                $uploadPath = ROOTPATH . 'public/uploads/berita';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                
                // Get file extension and create proper filename
                $extension = $gambar->getExtension();
                $gambarName = $gambar->getRandomName();
                
                // Ensure proper extension
                if (!empty($extension)) {
                    $gambarName = pathinfo($gambarName, PATHINFO_FILENAME) . '.' . $extension;
                }
                
                $gambar->move($uploadPath, $gambarName);
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
} 
