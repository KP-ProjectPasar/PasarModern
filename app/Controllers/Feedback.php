<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FeedbackModel;
use CodeIgniter\HTTP\ResponseInterface;

class Feedback extends BaseController
{
    public function index()
    {
        return view('feedback_form');
    }

    public function submit()
    {
        $feedbackModel = new FeedbackModel();
        
        // Validate input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email|max_length[100]',
            'telepon' => 'permit_empty|min_length[10]|max_length[15]',
            'subjek' => 'required|min_length[5]|max_length[200]',
            'pesan' => 'required|min_length[10]|max_length[1000]',
            'jenis_feedback' => 'required|in_list[keluhan,saran,pujian,laporan,pertanyaan]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validation->getErrors()
            ]);
        }

        try {
            $fileLampiran = '';
            $file = $this->request->getFile('file_lampiran');
            
            if ($file && $file->isValid() && !$file->hasMoved()) {
                // Validate file size (50MB limit)
                if ($file->getSize() > 50 * 1024 * 1024) {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'File terlalu besar. Maksimal 50MB.'
                    ]);
                }
                
                // Validate file type
                $allowedTypes = [
                    'image/jpeg', 'image/jpg', 'image/png', 'image/gif',
                    'video/mp4', 'video/avi', 'video/mov', 'video/wmv',
                    'application/pdf', 'application/msword', 
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ];
                
                if (!in_array($file->getMimeType(), $allowedTypes)) {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Format file tidak didukung. Gunakan JPG, PNG, GIF, MP4, AVI, MOV, WMV, PDF, atau DOC.'
                    ]);
                }
                
                $fileLampiran = $file->getRandomName();
                $file->move(ROOTPATH . 'public/uploads/feedback', $fileLampiran);
            }
            
            $data = [
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'telepon' => $this->request->getPost('telepon'),
                'subjek' => $this->request->getPost('subjek'),
                'pesan' => $this->request->getPost('pesan'),
                'jenis_feedback' => $this->request->getPost('jenis_feedback'),
                'file_lampiran' => $fileLampiran,
                'status' => 'pending'
            ];
            
            $feedbackModel->insert($data);
            
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Feedback berhasil dikirim! Terima kasih atas masukan Anda.'
            ]);
            
        } catch (\Exception $e) {
            log_message('error', 'Feedback submission error: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengirim feedback. Silakan coba lagi.'
            ]);
        }
    }
}
