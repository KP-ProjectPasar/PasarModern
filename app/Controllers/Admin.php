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
                $adminModel = new AdminModel();
                $admin = $adminModel->where('username', $username)->first();
                if ($admin && password_verify($password, $admin['password'])) {
                    session()->set('is_admin', true);
                    session()->set('admin_id', $admin['id']);
                    session()->set('admin_nama', $admin['username']);
                    session()->set('admin_role', $admin['role']);
                    return redirect()->to('/admin/dashboard');
                } else {
                    $error = 'Username atau password salah';
                    $debug .= ' | Username/password salah';
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
        
        // Get real data from database
        $adminModel = new \App\Models\AdminModel();
        $beritaModel = new \App\Models\BeritaModel();
        $galeriModel = new \App\Models\GaleriModel();
        $hargaModel = new \App\Models\HargaModel();
        
        // Count data
        $total_berita = $beritaModel->countAllResults();
        $total_galeri = $galeriModel->countAllResults();
        $total_komoditas = $hargaModel->countAllResults();
        
        return view('admin/dashboard', [
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'total_berita' => $total_berita,
            'total_galeri' => $total_galeri,
            'total_komoditas' => $total_komoditas,
        ]);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/login');
    }
}
