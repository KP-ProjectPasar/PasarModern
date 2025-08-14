<?php
namespace App\Controllers;
use App\Models\VideoModel;

class AdminVideo extends BaseController
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $videoModel = new VideoModel();
        $video = $videoModel->findAll();
        $data = [
            'videos' => $video,
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'active_page' => 'video',
        ];
        return view('admin/lists/video_list', $data);
    }

    public function create()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        return view('admin/forms/video_form', [
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

        // Validation
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => 'required|min_length[3]|max_length[200]',
            'deskripsi' => 'required|min_length[10]|max_length[500]',
            'url_video' => 'required|valid_url',
            'thumbnail' => 'uploaded[thumbnail]|is_image[thumbnail]|max_size[thumbnail,5120]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $videoModel = new VideoModel();
        
        try {
            // Handle thumbnail upload
            $thumbnail = $this->request->getFile('thumbnail');
            $thumbnailName = '';
            
            if ($thumbnail->isValid() && !$thumbnail->hasMoved()) {
                // Ensure upload directory exists
                $uploadPath = ROOTPATH . 'public/uploads/video';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                
                $thumbnailName = $thumbnail->getRandomName();
                $thumbnail->move($uploadPath, $thumbnailName);
            }
            
            $data = [
                'judul' => $this->request->getPost('judul'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'url_video' => $this->request->getPost('url_video'),
                'thumbnail' => $thumbnailName,
            ];
            
            $videoModel->insert($data);
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
        return view('admin/forms/video_form', $data);
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
            'judul' => 'required|min_length[3]|max_length[200]',
            'deskripsi' => 'required|min_length[10]|max_length[500]',
            'url_video' => 'required|valid_url',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $videoModel = new VideoModel();
        
        try {
            $data = [
                'judul' => $this->request->getPost('judul'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'url_video' => $this->request->getPost('url_video'),
            ];
            
            // Handle thumbnail upload if new thumbnail is uploaded
            $thumbnail = $this->request->getFile('thumbnail');
            if ($thumbnail->isValid() && !$thumbnail->hasMoved()) {
                // Additional validation for new thumbnail
                $imageValidation = \Config\Services::validation();
                $imageValidation->setRules([
                    'thumbnail' => 'is_image[thumbnail]|max_size[thumbnail,5120]'
                ]);
                
                if (!$imageValidation->withRequest($this->request)->run()) {
                    return redirect()->back()->withInput()->with('errors', $imageValidation->getErrors());
                }
                
                // Ensure upload directory exists
                $uploadPath = ROOTPATH . 'public/uploads/video';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                
                $thumbnailName = $thumbnail->getRandomName();
                $thumbnail->move($uploadPath, $thumbnailName);
                $data['thumbnail'] = $thumbnailName;
            }
            
            $videoModel->update($id, $data);
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
            
            if ($video && $video['thumbnail']) {
                // Delete thumbnail file
                $imagePath = ROOTPATH . 'public/uploads/video/' . $video['thumbnail'];
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            
            $videoModel->delete($id);
            return redirect()->to('/admin/video')->with('success', 'Video berhasil dihapus!');
            
        } catch (\Exception $e) {
            return redirect()->to('/admin/video')->with('error', 'Gagal menghapus video: ' . $e->getMessage());
        }
    }
} 
