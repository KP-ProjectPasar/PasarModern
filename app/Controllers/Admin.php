<?php
namespace App\Controllers;
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
                        // Check role status
                        try {
                            $roleModel = new \App\Models\RoleModel();
                            $userRole = $roleModel->where('nama', $admin['role'])->first();
                            
                            if ($userRole && $userRole['is_active'] == 1) {
                                // Update admin status
                                $adminModel->update($admin['id'], [
                                    'last_activity' => date('Y-m-d H:i:s'),
                                    'last_login' => date('Y-m-d H:i:s'),
                                    'status' => 'online'
                                ]);
                                
                                // Set session
                                session()->set('is_admin', true);
                                session()->set('admin_id', $admin['id']);
                                session()->set('admin_nama', $admin['username']);
                                session()->set('admin_role', $admin['role']);
                                
                                return redirect()->to('/admin/dashboard');
                            } else {
                                $error = 'Akun Anda tidak dapat login karena role telah dinonaktifkan.';
                            }
                        } catch (\Exception $e) {
                            // If role check fails, still allow login
                            $adminModel->update($admin['id'], [
                                'last_activity' => date('Y-m-d H:i:s'),
                                'last_login' => date('Y-m-d H:i:s'),
                                'status' => 'online'
                            ]);
                            
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
        
        try {
            $feedbackModel = new \App\Models\FeedbackModel();
            $total_feedback = $feedbackModel->countAllResults();
        } catch (\Exception $e) {
            log_message('error', 'Feedback model error: ' . $e->getMessage());
        }
        
        return view('admin/dashboard', [
            'title' => 'Dashboard',
            'active_page' => 'dashboard',
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'total_berita' => $total_berita,
            'total_galeri' => $total_galeri,
            'total_pasar' => $total_pasar,
            'total_feedback' => $total_feedback,
        ]);
    }

    private function updateUserActivity()
    {
        if (session()->get('is_admin')) {
            $adminModel = new AdminModel();
            $adminId = session()->get('admin_id');
            if ($adminId) {
                $adminModel->update($adminId, [
                    'last_activity' => date('Y-m-d H:i:s'),
                    'status' => 'online'
                ]);
            }
        }
    }

    public function updateActivity()
    {
        if (!session()->get('is_admin')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }
        
        $this->updateUserActivity();
        
        return $this->response->setJSON(['success' => true, 'message' => 'Activity updated']);
    }

    public function logout()
    {
        // Set user status to offline before destroying session
        if (session()->get('is_admin')) {
            $adminModel = new AdminModel();
            $adminId = session()->get('admin_id');
            if ($adminId) {
                $adminModel->update($adminId, [
                    'status' => 'offline',
                    'last_activity' => date('Y-m-d H:i:s')
                ]);
            }
        }
        
        session()->destroy();
        return redirect()->to('/admin/login');
    }
}
