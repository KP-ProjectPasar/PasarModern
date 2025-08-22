<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FeedbackModel;

class AdminFeedback extends BaseController
{
    public function index()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }
        
        $feedbackModel = new FeedbackModel();
        $feedbacks = $feedbackModel->orderBy('created_at', 'DESC')->findAll();
        
        $data = [
            'title' => 'Kelola Feedback',
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'feedbacks' => $feedbacks,
            'active_page' => 'feedback'
        ];
        
        return view('admin/feedback/feedback_list', $data);
    }

    public function view($id)
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }
        
        $feedbackModel = new FeedbackModel();
        $feedback = $feedbackModel->find($id);
        
        if (!$feedback) {
            return redirect()->to('/admin/feedback')->with('error', 'Feedback tidak ditemukan');
        }
        
        // Update status to 'dibaca' if still pending
        if ($feedback['status'] === 'pending') {
            $feedbackModel->update($id, ['status' => 'dibaca']);
            $feedback['status'] = 'dibaca';
        }
        
        $data = [
            'title' => 'Detail Feedback',
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'feedback' => $feedback,
            'active_page' => 'feedback'
        ];
        
        return view('admin/feedback/feedback_detail', $data);
    }

    public function updateStatus($id)
    {
        if (!session()->get('is_admin')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }
        
        $status = $this->request->getPost('status');
        $validStatuses = ['pending', 'dibaca', 'dibalas', 'selesai'];
        
        if (!in_array($status, $validStatuses)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Status tidak valid']);
        }
        
        $feedbackModel = new FeedbackModel();
        $feedbackModel->update($id, ['status' => $status]);
        
        return $this->response->setJSON(['success' => true, 'message' => 'Status berhasil diperbarui']);
    }

    public function delete($id)
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }
        
        $feedbackModel = new FeedbackModel();
        $feedback = $feedbackModel->find($id);
        
        if ($feedback) {
            // Delete file if exists
            if ($feedback['file_lampiran'] && file_exists(ROOTPATH . 'public/uploads/feedback/' . $feedback['file_lampiran'])) {
                unlink(ROOTPATH . 'public/uploads/feedback/' . $feedback['file_lampiran']);
            }
            
            $feedbackModel->delete($id);
            return redirect()->to('/admin/feedback')->with('success', 'Feedback berhasil dihapus');
        }
        
        return redirect()->to('/admin/feedback')->with('error', 'Feedback tidak ditemukan');
    }
} 