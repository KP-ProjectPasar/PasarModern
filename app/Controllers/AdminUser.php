<?php
namespace App\Controllers;
use App\Models\AdminModel;
use App\Models\RoleModel;
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
            'admin_role' => session()->get('admin_role'),
        ]);
    }

    public function create()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // Check if user has permission to create users (only superadmin and admin)
        $admin_role = session()->get('admin_role');
        if (!in_array($admin_role, ['superadmin', 'admin'])) {
            return redirect()->to('/admin/user')->with('error', 'Anda tidak memiliki akses untuk menambah user!');
        }

        $roleModel = new RoleModel();
        $roles = $roleModel->findAll();
        return view('admin/user_form', [
            'roles' => $roles,
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
        ]);
    }

    public function store()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // Check if user has permission to create users (only superadmin and admin)
        $admin_role = session()->get('admin_role');
        if (!in_array($admin_role, ['superadmin', 'admin'])) {
            return redirect()->to('/admin/user')->with('error', 'Anda tidak memiliki akses untuk menambah user!');
        }

        // Get available roles from database
        $roleModel = new RoleModel();
        $availableRoles = $roleModel->where('is_active', 1)->findAll();
        $roleNames = array_column($availableRoles, 'nama');

        // Validate input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required|min_length[3]|is_unique[admin.username]',
            'password' => 'required|min_length[6]',
            'role'     => 'required|in_list[' . implode(',', $roleNames) . ']',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Return to form with errors
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $adminModel = new AdminModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => $this->request->getPost('role'),
            'email'    => $this->request->getPost('email'),
            'created_at' => date('Y-m-d H:i:s'),
        ];
        
        try {
            $adminModel->insert($data);
            return redirect()->to('/admin/user')->with('success', 'User berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan user: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // Check if user has permission to edit users (only superadmin and admin)
        $admin_role = session()->get('admin_role');
        if (!in_array($admin_role, ['superadmin', 'admin'])) {
            return redirect()->to('/admin/user')->with('error', 'Anda tidak memiliki akses untuk mengedit user!');
        }

        $adminModel = new AdminModel();
        $roleModel = new RoleModel();
        $user = $adminModel->find($id);
        $roles = $roleModel->findAll();
        return view('admin/user_form', [
            'user' => $user,
            'roles' => $roles,
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
        ]);
    }

    public function update($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // Check if user has permission to edit users (only superadmin and admin)
        $admin_role = session()->get('admin_role');
        if (!in_array($admin_role, ['superadmin', 'admin'])) {
            return redirect()->to('/admin/user')->with('error', 'Anda tidak memiliki akses untuk mengedit user!');
        }

        // Get available roles from database
        $roleModel = new RoleModel();
        $availableRoles = $roleModel->where('is_active', 1)->findAll();
        $roleNames = array_column($availableRoles, 'nama');

        // Debug: Check what data is being received
        $postData = $this->request->getPost();
        log_message('info', 'Update user data received: ' . json_encode($postData));

        // Validate input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required|min_length[3]|is_unique[admin.username,id,' . $id . ']',
            'role'     => 'required|in_list[' . implode(',', $roleNames) . ']',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            log_message('error', 'Validation failed: ' . json_encode($validation->getErrors()));
            // Return to form with errors
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $adminModel = new AdminModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'role'     => $this->request->getPost('role'),
            'email'    => $this->request->getPost('email'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        
        // Only update password if provided
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }
        
        log_message('info', 'Data to update: ' . json_encode($data));
        
        try {
            $result = $adminModel->update($id, $data);
            log_message('info', 'Update result: ' . ($result ? 'true' : 'false'));
            
            if ($result) {
                return redirect()->to('/admin/user')->with('success', 'User berhasil diperbarui!');
            } else {
                return redirect()->back()->withInput()->with('error', 'Gagal memperbarui user. Tidak ada perubahan data.');
            }
        } catch (\Exception $e) {
            log_message('error', 'Update exception: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui user: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // Check if user has permission to delete users (only superadmin and admin)
        $admin_role = session()->get('admin_role');
        if (!in_array($admin_role, ['superadmin', 'admin'])) {
            return redirect()->to('/admin/user')->with('error', 'Anda tidak memiliki akses untuk menghapus user!');
        }

        $adminModel = new AdminModel();
        $adminModel->delete($id);
        return redirect()->to('/admin/user')->with('success', 'User berhasil dihapus!');
    }
} 
