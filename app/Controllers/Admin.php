<?php
namespace App\Controllers;
use App\Models\AdminModel;

class Admin extends BaseController
{
    public function login()
    {
        helper(['form']);
        $error = null;
        $debug = null;
        
        if (strtolower($this->request->getMethod()) === 'post') {
            $debug = 'POST diterima: ' . json_encode($this->request->getPost());
            file_put_contents(WRITEPATH . 'debug.txt', $debug . PHP_EOL, FILE_APPEND);
            
            $validation = \Config\Services::validation();
            $validation->setRules([
                'username' => 'required',
                'password' => 'required'
            ]);
            
            if (!$validation->withRequest($this->request)->run()) {
                $error = 'Username dan password wajib diisi';
                $debug .= ' | Validasi gagal';
            } else {
                $username = $this->request->getPost('username');
                $password = $this->request->getPost('password');
                
                try {
                    $adminModel = new AdminModel();
                    $admin = $adminModel->where('username', $username)->first();
                    
                    if ($admin && password_verify($password, $admin['password'])) {
                        // Check if user's role is still active
                        try {
                            $roleModel = new \App\Models\RoleModel();
                            $userRole = $roleModel->where('nama', $admin['role'])->first();
                            
                            if (!$userRole || $userRole['is_active'] == 0) {
                                $error = 'Akun Anda tidak dapat login karena role telah dinonaktifkan. Silakan hubungi administrator.';
                                $debug .= ' | Role inactive or not found';
                            } else {
                                // Update last_activity on successful login
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
                        } catch (\Exception $e) {
                            // If RoleModel doesn't exist or has issues, allow login with warning
                            log_message('error', 'RoleModel error: ' . $e->getMessage());
                            session()->set('is_admin', true);
                            session()->set('admin_id', $admin['id']);
                            session()->set('admin_nama', $admin['username']);
                            session()->set('admin_role', $admin['role']);
                            return redirect()->to('/admin/dashboard');
                        }
                    } else {
                        $error = 'Username atau password salah';
                        $debug .= ' | Username/password salah';
                    }
                } catch (\Exception $e) {
                    $error = 'Terjadi kesalahan sistem. Silakan coba lagi.';
                    $debug .= ' | Exception: ' . $e->getMessage();
                    log_message('error', 'Login error: ' . $e->getMessage());
                }
            }
            file_put_contents(WRITEPATH . 'debug.txt', $debug . PHP_EOL, FILE_APPEND);
        } else {
            $debug = 'Bukan POST, method: ' . $this->request->getMethod();
            file_put_contents(WRITEPATH . 'debug.txt', $debug . PHP_EOL, FILE_APPEND);
        }
        
        return view('admin/login', ['error' => $error, 'debug' => $debug]);
    }

    public function dashboard()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }
        
        // Update user activity to keep status online
        $this->updateUserActivity();
        
        // Check if user's role is still active
        $admin_role = session()->get('admin_role');
        
        try {
            $roleModel = new \App\Models\RoleModel();
            $userRole = $roleModel->where('nama', $admin_role)->first();
            
            if (!$userRole || $userRole['is_active'] == 0) {
                session()->destroy();
                return redirect()->to('/admin/login')->with('error', 'Akun Anda tidak dapat diakses karena role telah dinonaktifkan. Silakan hubungi administrator.');
            }
        } catch (\Exception $e) {
            // If RoleModel has issues, log error but allow access
            log_message('error', 'Dashboard role check error: ' . $e->getMessage());
        }
        
        // TODO: Ambil data dari database
        // Untuk sementara menggunakan data dummy
        $total_berita = 0;
        $total_galeri = 0;
        $total_pasar = 3;
        $total_feedback = 0;
        
        // Tambahkan data galeri jika model tersedia
        try {
            // TODO: Implementasi dengan model yang sesuai
            // $galeriModel = new \App\Models\GaleriModel();
            // $total_galeri = $galeriModel->countAllResults();
        } catch (\Exception $e) {
            log_message('error', 'Galeri model error: ' . $e->getMessage());
        }
        
        return view('admin/dashboard', [
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
