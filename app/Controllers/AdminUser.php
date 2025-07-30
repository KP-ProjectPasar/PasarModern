<?php
namespace App\Controllers;
use App\Models\AdminModel;
use App\Models\LevelModel;
use CodeIgniter\Controller;

class AdminUser extends BaseController
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $adminModel = new AdminModel();
        $users = $adminModel->findAll();
        return view('admin/user_list', [
            'users' => $users,
            'admin_nama' => session()->get('admin_nama'),
            'admin_level' => session()->get('admin_level'),
        ]);
    }

    public function create()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $levelModel = new LevelModel();
        $levels = $levelModel->findAll();
        return view('admin/user_form', [
            'levels' => $levels,
            'admin_nama' => session()->get('admin_nama'),
            'admin_level' => session()->get('admin_level'),
        ]);
    }

    public function store()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $adminModel = new AdminModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'nama'     => $this->request->getPost('nama'),
            'level'    => $this->request->getPost('level'),
        ];
        $adminModel->insert($data);
        return redirect()->to('/admin/user');
    }

    public function edit($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $adminModel = new AdminModel();
        $levelModel = new LevelModel();
        $user = $adminModel->find($id);
        $levels = $levelModel->findAll();
        return view('admin/user_form', [
            'user' => $user,
            'levels' => $levels,
            'admin_nama' => session()->get('admin_nama'),
            'admin_level' => session()->get('admin_level'),
        ]);
    }

    public function update($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $adminModel = new AdminModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'nama'     => $this->request->getPost('nama'),
            'level'    => $this->request->getPost('level'),
        ];
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }
        $adminModel->update($id, $data);
        return redirect()->to('/admin/user');
    }

    public function delete($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $adminModel = new AdminModel();
        $adminModel->delete($id);
        return redirect()->to('/admin/user');
    }
} 