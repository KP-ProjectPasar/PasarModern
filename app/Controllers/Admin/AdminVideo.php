<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\VideoModel;

class AdminVideo extends BaseController
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
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // Check permission
        if (!$this->checkPermission('video_management')) {
            session()->setFlashdata('error', 'Anda tidak memiliki akses untuk fitur ini!');
            return redirect()->to('/admin/dashboard');
        }

        $videoModel = new VideoModel();
        $video = $videoModel->orderBy('created_at', 'DESC')->findAll();
        
        // Get dashboard statistics
        $stats = [
            'total' => count($video),
            'published' => count(array_filter($video, fn($item) => ($item['status'] ?? 'draft') === 'published')),
            'draft' => count(array_filter($video, fn($item) => ($item['status'] ?? 'draft') === 'draft')),
            // archived removed from stats
            'total_views' => array_reduce($video, fn($sum, $item) => $sum + ($item['views'] ?? 0), 0)
        ];
        
        $data = [
            'videos' => $video,
            'stats' => $stats,
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'active_page' => 'video',
        ];
        return view('admin/video/video_list', $data);
    }

    public function create()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // Check permission
        if (!$this->checkPermission('video_management')) {
            session()->setFlashdata('error', 'Anda tidak memiliki akses untuk fitur ini!');
            return redirect()->to('/admin/dashboard');
        }

        return view('admin/video/video_form', [
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'title' => 'Tambah Video',
            'active_page' => 'video',
        ]);
    }

    public function store()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // Check permission
        if (!$this->checkPermission('video_management')) {
            session()->setFlashdata('error', 'Anda tidak memiliki akses untuk fitur ini!');
            return redirect()->to('/admin/dashboard');
        }

        $videoModel = new VideoModel();
        
        try {
            $judul = trim((string) $this->request->getPost('judul'));
            $tipe = $this->request->getPost('tipe') ?: 'url';

            if (empty($judul) || strlen($judul) < 3) {
                return redirect()->back()->withInput()->with('errors', ['judul' => 'Judul minimal 3 karakter']);
            }

            // Ensure upload directory exists
            $uploadPath = ROOTPATH . 'public/uploads/video';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Normalisasi dan validasi status
            $statusInput = strtolower(trim((string) $this->request->getPost('status')));
            $allowedStatuses = ['draft', 'published'];
            $status = in_array($statusInput, $allowedStatuses, true) ? $statusInput : 'draft';

            $data = [
                'judul' => $judul,
                'views' => 0,
                'status' => $status,
                'created_by' => session()->get('admin_id'),
                'tipe' => $tipe,
            ];

            if ($tipe === 'url') {
                $url = trim((string) $this->request->getPost('url_video'));
                if (empty($url) || !filter_var($url, FILTER_VALIDATE_URL)) {
                    return redirect()->back()->withInput()->with('errors', ['url_video' => 'URL video tidak valid']);
                }
                $data['url'] = $url;
                $data['file_video'] = null;
            } else {
                $videoFile = $this->request->getFile('video_file');
                if (!$videoFile || !$videoFile->isValid() || $videoFile->hasMoved()) {
                    return redirect()->back()->withInput()->with('errors', ['video_file' => 'File video tidak valid']);
                }
                
                // Basic validation for video file
                $allowedExt = ['mp4','mov','avi','wmv','flv','webm','mkv'];
                $allowedMime = ['video/mp4','video/quicktime','video/x-msvideo','video/x-ms-wmv','video/x-flv','video/webm','video/x-matroska'];
                if (!in_array(strtolower($videoFile->getExtension()), $allowedExt, true)) {
                    return redirect()->back()->withInput()->with('errors', ['video_file' => 'Ekstensi video tidak didukung']);
                }
                if (!in_array(strtolower($videoFile->getMimeType()), $allowedMime, true)) {
                    return redirect()->back()->withInput()->with('errors', ['video_file' => 'Tipe MIME video tidak didukung']);
                }
                // 100MB limit
                if ($videoFile->getSize() > 100 * 1024 * 1024) {
                    return redirect()->back()->withInput()->with('errors', ['video_file' => 'Ukuran video maksimal 100MB']);
                }
                
                $videoName = $videoFile->getRandomName();
                $videoFile->move($uploadPath, $videoName);
                $data['file_video'] = $videoName;
                
                // Untuk file video, set URL ke path lokal file
                $data['url'] = '/uploads/video/' . $videoName;
            }

            // Align with existing DB columns to avoid unknown column errors
            $db = \Config\Database::connect();
            $fields = $db->getFieldNames('video');

            // Remove keys not present in table
            $data = array_intersect_key($data, array_flip($fields));

            // Skip model-level validation to avoid rules referencing missing columns
            $videoModel->skipValidation(true)->insert($data);
            return redirect()->to('/admin/video')->with('success', 'Video berhasil ditambahkan!');
            
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan video: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $videoModel = new VideoModel();
        $video = $videoModel->find($id);
        
        if (!$video) {
            return redirect()->to('/admin/video')->with('error', 'Video tidak ditemukan!');
        }
        
        $data = [
            'video' => $video,
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'title' => 'Edit Video',
            'active_page' => 'video',
        ];
        // Fix view path to match actual location
        return view('admin/video/video_form', $data);
    }

    public function update($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $videoModel = new VideoModel();
        
        try {
            $judul = trim((string) $this->request->getPost('judul'));
            $tipe = $this->request->getPost('tipe') ?: 'url';

            if (empty($judul) || strlen($judul) < 3) {
                return redirect()->back()->withInput()->with('errors', ['judul' => 'Judul minimal 3 karakter']);
            }

            // Normalisasi dan validasi status (ambil dari input form; jika kosong, gunakan status saat ini)
            $statusInput = strtolower(trim((string) $this->request->getPost('status')));
            $allowedStatuses = ['draft', 'published'];
            $current = (new VideoModel())->find($id);
            $currentStatus = $current['status'] ?? 'draft';
            $status = in_array($statusInput, $allowedStatuses, true) ? $statusInput : $currentStatus;

            $data = [
                'judul' => $judul,
                'tipe' => $tipe,
                'status' => $status,
            ];

            if ($tipe === 'url') {
                $url = trim((string) $this->request->getPost('url_video'));
                if (empty($url) || !filter_var($url, FILTER_VALIDATE_URL)) {
                    return redirect()->back()->withInput()->with('errors', ['url_video' => 'URL video tidak valid']);
                }
                $data['url'] = $url;
                $data['file_video'] = null; // clear file if switching to URL
            } else {
                $videoFile = $this->request->getFile('video_file');
                if ($videoFile && $videoFile->isValid() && !$videoFile->hasMoved()) {
                    // Basic validation
                    $allowedExt = ['mp4','mov','avi','wmv','flv','webm','mkv'];
                    $allowedMime = ['video/mp4','video/quicktime','video/x-msvideo','video/x-ms-wmv','video/x-flv','video/webm','video/x-matroska'];
                    if (!in_array(strtolower($videoFile->getExtension()), $allowedExt, true)) {
                        return redirect()->back()->withInput()->with('errors', ['video_file' => 'Ekstensi video tidak didukung']);
                    }
                    if (!in_array(strtolower($videoFile->getMimeType()), $allowedMime, true)) {
                        return redirect()->back()->withInput()->with('errors', ['video_file' => 'Tipe MIME video tidak didukung']);
                    }
                    if ($videoFile->getSize() > 100 * 1024 * 1024) {
                        return redirect()->back()->withInput()->with('errors', ['video_file' => 'Ukuran video maksimal 100MB']);
                    }

                    // Ensure upload directory exists
                    $uploadPath = ROOTPATH . 'public/uploads/video';
                    if (!is_dir($uploadPath)) {
                        mkdir($uploadPath, 0755, true);
                    }

                    // Delete old file if exists
                    $existing = $videoModel->find($id);
                    if ($existing && isset($existing['file_video']) && $existing['file_video']) {
                        $oldPath = $uploadPath . DIRECTORY_SEPARATOR . $existing['file_video'];
                        if (file_exists($oldPath)) {
                            @unlink($oldPath);
                        }
                    }

                    $videoName = $videoFile->getRandomName();
                    $videoFile->move($uploadPath, $videoName);
                    $data['file_video'] = $videoName;
                    
                    // Untuk file video, set URL ke path lokal file
                    $data['url'] = '/uploads/video/' . $videoName;
                } else {
                    // Jika tidak ada file baru yang diupload, pertahankan file yang ada jika masih ada
                    $existing = $videoModel->find($id);
                    $hasExisting = (bool) $this->request->getPost('existing_file');
                    
                    // Log for debugging
                    log_message('info', '[AdminVideo::update] File handling: existing=' . json_encode($existing) . ', hasExisting=' . ($hasExisting ? 'true' : 'false'));
                    
                    if ($hasExisting && $existing && !empty($existing['file_video'])) {
                        $data['file_video'] = $existing['file_video'];
                        $data['url'] = '/uploads/video/' . $existing['file_video'];
                        log_message('info', '[AdminVideo::update] Keeping existing file: ' . $existing['file_video']);
                    } else {
                        log_message('warning', '[AdminVideo::update] No new file uploaded and no existing file found');
                        return redirect()->back()->withInput()->with('errors', ['video_file' => 'Silakan pilih file video atau gunakan tipe URL.']);
                    }
                }
            }
            
            // Align with existing DB columns to avoid unknown column errors
            $db = \Config\Database::connect();
            $fields = $db->getFieldNames('video');

            // Remove keys not present in table
            $data = array_intersect_key($data, array_flip($fields));

            $videoModel->skipValidation(true)->update($id, $data);
            return redirect()->to('/admin/video')->with('success', 'Video berhasil diperbarui!');
            
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui video: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        try {
            $videoModel = new VideoModel();
            $video = $videoModel->find($id);
            
            // Delete local video file if any
            if ($video && isset($video['file_video']) && $video['file_video']) {
                $filePath = ROOTPATH . 'public/uploads/video/' . $video['file_video'];
                if (file_exists($filePath)) {
                    @unlink($filePath);
                }
            }
            
            $videoModel->delete($id);
            return redirect()->to('/admin/video')->with('success', 'Video berhasil dihapus!');
            
        } catch (\Exception $e) {
            return redirect()->to('/admin/video')->with('error', 'Gagal menghapus video: ' . $e->getMessage());
        }
    }

    // Quick status change
    public function changeStatus($id, $status)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $allowedStatuses = ['draft', 'published'];
        if (!in_array($status, $allowedStatuses)) {
            return redirect()->to('/admin/video')->with('error', 'Status tidak valid');
        }

        try {
            $videoModel = new VideoModel();
            $video = $videoModel->find($id);

            if (!$video) {
                return redirect()->to('/admin/video')->with('error', 'Video tidak ditemukan');
            }

            $videoModel->update($id, ['status' => $status]);
            return redirect()->to('/admin/video')->with('success', 'Status video berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->to('/admin/video')->with('error', 'Gagal mengubah status video: ' . $e->getMessage());
        }
    }

    /**
     * Toggle featured status for video item
     */
    public function toggleFeatured($id = null)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }

        try {
            $videoModel = new \App\Models\VideoModel();
            $result = $videoModel->toggleFeatured($id);
            
            if ($result) {
                return $this->response->setJSON(['success' => true, 'message' => 'Status featured berhasil diubah']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal mengubah status featured']);
            }
        } catch (\Exception $e) {
            log_message('error', '[AdminVideo::toggleFeatured] Error: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'message' => 'Terjadi kesalahan sistem']);
        }
    }
} 
