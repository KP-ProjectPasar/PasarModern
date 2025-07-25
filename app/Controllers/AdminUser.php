<?php
namespace App\Controllers;
use App\Models\AdminModel;
use CodeIgniter\Controller;

class AdminUser extends BaseController
{
    public function index()
    {
        $adminModel = new AdminModel();
        $users = $adminModel->findAll();
        return view('admin/user_list', ['users' => $users]);
    }

    public function create()
    {
        return view('admin/user_form');
    }

    public function store()
    {
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
        $adminModel = new AdminModel();
        $user = $adminModel->find($id);
        return view('admin/user_form', ['user' => $user]);
    }

    public function update($id)
    {
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
        $adminModel = new AdminModel();
        $adminModel->delete($id);
        return redirect()->to('/admin/user');
    }
} 