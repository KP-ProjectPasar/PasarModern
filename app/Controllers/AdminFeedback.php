<?php
namespace App\Controllers;

class AdminFeedback extends BaseController
{
    public function index()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }
        
        // For now, we'll show a placeholder page
        return view('admin/lists/feedback_list', $data);
    }
} 