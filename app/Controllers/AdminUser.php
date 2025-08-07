<?php
namespace App\Controllers;
use App\Models\AdminModel;
use App\Models\RoleModel;

class AdminUser extends BaseController
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $adminModel = new AdminModel();
        
        // Get all users
        $users = $adminModel->findAll();
        
        // Update user status based on last activity
        foreach ($users as $user) {
            $status = 'offline';
            $lastLogin = null;
            
            // Check if user has last_activity
            if (isset($user['last_activity']) && $user['last_activity']) {
                $lastActivity = strtotime($user['last_activity']);
                $currentTime = time();
                $timeDiff = $currentTime - $lastActivity;
                
                // Consider user online if last activity was within 15 minutes
                if ($timeDiff <= 900) { // 15 minutes = 900 seconds
                    $status = 'online';
                }
                
                $lastLogin = $user['last_activity'];
            }
            
            // Update user status in database
            $adminModel->update($user['id'], [
                'status' => $status,
                'last_login' => $lastLogin
            ]);
        }
        
        // Get updated users with proper status
        $users = $adminModel->findAll();
        
        return view('admin/lists/user_list', [
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
        $data = [
            'roles' => $roles,
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
        ];
        return view('admin/forms/user_form', $data);
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
        return view('admin/forms/user_form', [
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

        // Validate input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required|min_length[3]|is_unique[admin.username,id,' . $id . ']',
            'role'     => 'required|in_list[' . implode(',', $roleNames) . ']',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
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
        
        try {
            $result = $adminModel->update($id, $data);
            
            if ($result) {
            return redirect()->to('/admin/user')->with('success', 'User berhasil diperbarui!');
            } else {
                return redirect()->back()->withInput()->with('error', 'Gagal memperbarui user. Tidak ada perubahan data.');
            }
        } catch (\Exception $e) {
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
