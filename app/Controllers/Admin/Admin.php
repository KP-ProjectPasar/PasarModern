<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Admin extends BaseController
{

    public function login()
    {
        helper(['form']);
        $error = null;
        
        if (strtolower($this->request->getMethod()) === 'post') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            
            if (empty($username) || empty($password)) {
                $error = 'Username dan password wajib diisi';
            } else {
                try {
                    $adminModel = new AdminModel();
                    $admin = $adminModel->where('username', $username)->first();
                    
                    if ($admin && password_verify($password, $admin['password'])) {
                        try {
                            $roleModel = new \App\Models\RoleModel();
                            $userRole = $roleModel->where('nama', $admin['role'])->first();
                            
                            if ($userRole && $userRole['is_active'] == 1) {
                                // Update last login and activity using new method
                                $adminModel->updateLastLogin($admin['id']);
                                
                                session()->set('is_admin', true);
                                session()->set('admin_id', $admin['id']);
                                session()->set('admin_nama', $admin['username']);
                                session()->set('admin_role', $admin['role']);
                                
                                return redirect()->to('/admin/dashboard');
                            } else {
                                $error = 'Akun Anda tidak dapat login karena role telah dinonaktifkan.';
                            }
                        } catch (\Exception $e) {
                            // Update last login and activity using new method
                            $adminModel->updateLastLogin($admin['id']);
                            
                            session()->set('is_admin', true);
                            session()->set('admin_id', $admin['id']);
                            session()->set('admin_nama', $admin['username']);
                            session()->set('admin_role', $admin['role']);
                            
                            return redirect()->to('/admin/dashboard');
                        }
                    } else {
                        $error = 'Username atau password salah';
                    }
                } catch (\Exception $e) {
                    $error = 'Terjadi kesalahan sistem. Silakan coba lagi.';
                    log_message('error', 'Login error: ' . $e->getMessage());
                }
            }
        }
        
        return view('admin/login', ['error' => $error]);
    }

    public function dashboard()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }
        
        $this->updateUserActivity();
        
        $admin_role = session()->get('admin_role');
        
        try {
            $roleModel = new \App\Models\RoleModel();
            $userRole = $roleModel->where('nama', $admin_role)->first();
            
            if (!$userRole || $userRole['is_active'] == 0) {
                session()->destroy();
                return redirect()->to('/admin/login')->with('error', 'Akun Anda tidak dapat diakses karena role telah dinonaktifkan. Silakan hubungi administrator.');
            }
        } catch (\Exception $e) {
            log_message('error', 'Dashboard role check error: ' . $e->getMessage());
        }
        
        $total_berita = 0;
        $total_galeri = 0;
        $total_pasar = 3;
        $total_feedback = 0;
        $total_views = 0;
        
        try {
            // Get total berita
            $beritaModel = new \App\Models\BeritaModel();
            $total_berita = $beritaModel->countAllResults();
            
            // Get total galeri
            $galeriModel = new \App\Models\GaleriModel();
            $total_galeri = $galeriModel->countAllResults();
            
            // Get total feedback
            $feedbackModel = new \App\Models\FeedbackModel();
            $total_feedback = $feedbackModel->countAllResults();
            
            // Get total views
            $total_views = $beritaModel->selectSum('views')->get()->getRow()->views ?? 0;
            $total_views += $galeriModel->selectSum('views')->get()->getRow()->views ?? 0;
            
        } catch (\Exception $e) {
            log_message('error', 'Dashboard stats error: ' . $e->getMessage());
        }
        
        $data = [
            'title' => 'Dashboard Admin',
            'active_page' => 'dashboard',
            'admin_nama' => session()->get('admin_nama'),
            'total_berita' => $total_berita,
            'total_galeri' => $total_galeri,
            'total_pasar' => $total_pasar,
            'total_feedback' => $total_feedback,
            'total_views' => $total_views
        ];
        
        return view('admin/dashboard', $data);
    }
    
    public function logout()
    {
        if (session()->get('is_admin')) {
            try {
                $adminModel = new AdminModel();
                // Update last activity when logout
                $adminModel->updateLastActivity(session()->get('admin_id'));
            } catch (\Exception $e) {
                log_message('error', 'Logout update error: ' . $e->getMessage());
            }
        }
        
        session()->destroy();
        return redirect()->to('/admin/login')->with('success', 'Anda telah berhasil logout');
    }
    
    public function updateActivity()
    {
        if (!session()->get('is_admin')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }
        
        try {
            $adminModel = new AdminModel();
            // Update last activity using new method
            $adminModel->updateLastActivity(session()->get('admin_id'));
            
            return $this->response->setJSON(['success' => true]);
        } catch (\Exception $e) {
            log_message('error', 'Update activity error: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'message' => 'Error updating activity']);
        }
    }
    
    private function updateUserActivity()
    {
        // Update user activity functionality removed as it's not essential
        // Can be re-implemented later if needed
    }
}
