<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FeedbackModel;
use CodeIgniter\HTTP\ResponseInterface;

class Feedback extends BaseController
{
    public function index()
    {
        return redirect()->to('/#feedback');
    }

    public function submit()
    {
        // Set JSON response header
        $this->response->setContentType('application/json');
        
        // Add CORS headers for browser requests
        $this->response->setHeader('Access-Control-Allow-Origin', '*');
        $this->response->setHeader('Access-Control-Allow-Methods', 'POST, OPTIONS');
        $this->response->setHeader('Access-Control-Allow-Headers', 'Content-Type');
        
        // Handle preflight OPTIONS request
        if ($this->request->getMethod() === 'options') {
            return $this->response->setStatusCode(200);
        }
        
        // Log awal request
        log_message('info', '[Feedback::submit] ===== START FEEDBACK SUBMISSION =====');
        log_message('info', '[Feedback::submit] Request method: ' . $this->request->getMethod());
        log_message('info', '[Feedback::submit] Request URI: ' . $this->request->getUri());
        log_message('info', '[Feedback::submit] Content-Type: ' . $this->request->getHeaderLine('Content-Type'));
        log_message('info', '[Feedback::submit] User Agent: ' . $this->request->getHeaderLine('User-Agent'));
        log_message('info', '[Feedback::submit] Remote IP: ' . $this->request->getIPAddress());
        
        try {
            // Check if this is a POST request
            if (!$this->request->is('post')) {
                log_message('error', '[Feedback::submit] Invalid request method: ' . $this->request->getMethod());
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Invalid request method'
                ]);
            }
            
            // Get all POST data
            $postData = $this->request->getPost();
            log_message('info', '[Feedback::submit] POST data received: ' . json_encode($postData));
            
            // Get all FILES data
            $filesData = $this->request->getFiles();
            log_message('info', '[Feedback::submit] FILES data received: ' . json_encode($filesData));
            
            // Check if form data is empty
            if (empty($postData)) {
                log_message('error', '[Feedback::submit] No POST data received');
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Tidak ada data yang diterima'
                ]);
            }
            
            // Check required fields manually
            $requiredFields = ['nama', 'email', 'subjek', 'pesan', 'jenis_feedback'];
            $missingFields = [];
            
            foreach ($requiredFields as $field) {
                if (empty($postData[$field])) {
                    $missingFields[] = $field;
                }
            }
            
            if (!empty($missingFields)) {
                log_message('error', '[Feedback::submit] Missing required fields: ' . implode(', ', $missingFields));
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Field yang wajib diisi: ' . implode(', ', $missingFields)
                ]);
            }
            
            // Validate email format
            if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
                log_message('error', '[Feedback::submit] Invalid email format: ' . $postData['email']);
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Format email tidak valid'
                ]);
            }
            
            // Validate message length
            if (strlen($postData['pesan']) < 10) {
                log_message('error', '[Feedback::submit] Message too short: ' . strlen($postData['pesan']) . ' characters');
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Pesan minimal 10 karakter'
                ]);
            }
            
            // Validate jenis_feedback
            $allowedTypes = ['keluhan', 'saran', 'pujian', 'laporan', 'pertanyaan'];
            if (!in_array($postData['jenis_feedback'], $allowedTypes)) {
                log_message('error', '[Feedback::submit] Invalid feedback type: ' . $postData['jenis_feedback']);
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Jenis feedback tidak valid'
                ]);
            }
            
            log_message('info', '[Feedback::submit] All validations passed');
            
            $feedbackModel = new FeedbackModel();
            
            // Handle file upload if exists
            $fileLampiran = '';
            $file = $this->request->getFile('file_lampiran');
            
            if ($file && $file->isValid() && !$file->hasMoved()) {
                log_message('info', '[Feedback::submit] File uploaded: ' . $file->getName() . ' (' . $file->getSize() . ' bytes)');
                
                // Validate file size (50MB limit)
                if ($file->getSize() > 50 * 1024 * 1024) {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'File terlalu besar. Maksimal 50MB.'
                    ]);
                }
                
                // Ensure upload directory exists and is writable
                $uploadPath = ROOTPATH . 'public/uploads/feedback';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                
                if (!is_writable($uploadPath)) {
                    log_message('error', '[Feedback::submit] Upload directory not writable: ' . $uploadPath);
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Gagal mengupload file. Silakan coba lagi.'
                    ]);
                }
                
                $fileLampiran = $file->getRandomName();
                $file->move($uploadPath, $fileLampiran);
                
                log_message('info', '[Feedback::submit] File saved as: ' . $fileLampiran);
            } else {
                log_message('info', '[Feedback::submit] No file uploaded or file invalid');
            }
            
            // Prepare data for database
            $data = [
                'nama' => $postData['nama'],
                'email' => $postData['email'],
                'telepon' => $postData['telepon'] ?? '',
                'subjek' => $postData['subjek'],
                'pesan' => $postData['pesan'],
                'jenis_feedback' => $postData['jenis_feedback'],
                'file_lampiran' => $fileLampiran,
                'status' => 'pending'
            ];
            
            log_message('info', '[Feedback::submit] Data to insert: ' . json_encode($data));
            
            // Try to insert into database
            try {
                $result = $feedbackModel->insert($data);
                
                if ($result === false) {
                    $errors = $feedbackModel->errors();
                    log_message('error', '[Feedback::submit] Insert failed with errors: ' . json_encode($errors));
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Gagal menyimpan feedback ke database.',
                        'errors' => $errors
                    ]);
                }
                
                log_message('info', '[Feedback::submit] Successfully inserted feedback with ID: ' . $result);
                log_message('info', '[Feedback::submit] ===== FEEDBACK SUBMISSION SUCCESS =====');
                
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Feedback berhasil dikirim! Terima kasih atas masukan Anda.',
                    'feedback_id' => $result
                ]);
                
            } catch (\Exception $e) {
                log_message('error', '[Feedback::submit] Database error: ' . $e->getMessage());
                log_message('error', '[Feedback::submit] Database error trace: ' . $e->getTraceAsString());
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menyimpan ke database: ' . $e->getMessage()
                ]);
            }
            
        } catch (\Exception $e) {
            log_message('error', '[Feedback::submit] General error: ' . $e->getMessage());
            log_message('error', '[Feedback::submit] Error trace: ' . $e->getTraceAsString());
            log_message('error', '[Feedback::submit] ===== FEEDBACK SUBMISSION FAILED =====');
            
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
            ]);
        }
    }
}
