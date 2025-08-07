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
        $videos = $videoModel->findAll();
        return view('admin/lists/video_list', [
            'videos' => $videos,
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
        ]);
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
        ]);
    }

    public function store()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $videoModel = new VideoModel();
        
        $tipe = $this->request->getPost('tipe');
        $url = '';
        $fileVideo = '';
        
        if ($tipe === 'url') {
            $url = $this->request->getPost('url');
        } elseif ($tipe === 'file') {
            // Handle file upload
            $video = $this->request->getFile('file_video');
            if ($video->isValid() && !$video->hasMoved()) {
                $fileVideo = $video->getRandomName();
                $video->move(ROOTPATH . 'public/uploads/video', $fileVideo);
            }
        }
        
        $data = [
            'judul' => $this->request->getPost('judul'),
            'url' => $url,
            'file_video' => $fileVideo,
            'tipe' => $tipe,
        ];
        $videoModel->insert($data);
        return redirect()->to('/admin/video');
    }

    public function edit($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $videoModel = new VideoModel();
        $video = $videoModel->find($id);
        return view('admin/forms/video_form', [
            'video' => $video,
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
        ]);
    }

    public function update($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $videoModel = new VideoModel();
        
        $tipe = $this->request->getPost('tipe');
        $url = '';
        $fileVideo = '';
        
        if ($tipe === 'url') {
            $url = $this->request->getPost('url');
        } elseif ($tipe === 'file') {
            // Handle file upload if new video is uploaded
            $video = $this->request->getFile('file_video');
            if ($video->isValid() && !$video->hasMoved()) {
                $fileVideo = $video->getRandomName();
                $video->move(ROOTPATH . 'public/uploads/video', $fileVideo);
            }
        }
        
        $data = [
            'judul' => $this->request->getPost('judul'),
            'url' => $url,
            'file_video' => $fileVideo,
            'tipe' => $tipe,
        ];
        
        $videoModel->update($id, $data);
        return redirect()->to('/admin/video');
    }

    public function delete($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $videoModel = new VideoModel();
        $videoModel->delete($id);
        return redirect()->to('/admin/video');
    }
} 
