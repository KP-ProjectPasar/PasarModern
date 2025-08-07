<?php
namespace App\Controllers;
use App\Models\RoleModel;

class AdminRole extends BaseController
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // Check if user has permission to manage roles (only superadmin)
        $admin_role = session()->get('admin_role');
        if ($admin_role !== 'superadmin') {
            return redirect()->to('/admin/dashboard')->with('error', 'Anda tidak memiliki akses untuk mengelola role!');
        }
        
        // Check if superadmin role is still active
        $roleModel = new RoleModel();
        $userRole = $roleModel->where('nama', $admin_role)->first();
        
        if (!$userRole || $userRole['is_active'] == 0) {
            session()->destroy();
            return redirect()->to('/admin/login')->with('error', 'Akun Anda tidak dapat diakses karena role telah dinonaktifkan. Silakan hubungi administrator.');
        }

        $roles = $roleModel->findAll();
        
        return view('admin/lists/role_list', [
            'roles' => $roles,
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'title' => 'Kelola Role'
        ]);
    }

    public function create()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // Check if user has permission to create roles (only superadmin)
        $admin_role = session()->get('admin_role');
        if ($admin_role !== 'superadmin') {
            return redirect()->to('/admin/role')->with('error', 'Anda tidak memiliki akses untuk menambah role!');
        }

        $data = [
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'title' => 'Tambah Role Baru'
        ];

        return view('admin/forms/role_form', $data);
    }

    public function store()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // Check if user has permission to create roles (only superadmin)
        $admin_role = session()->get('admin_role');
        if ($admin_role !== 'superadmin') {
            return redirect()->to('/admin/role')->with('error', 'Anda tidak memiliki akses untuk menambah role!');
        }

        // Validate input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required|min_length[3]|is_unique[role.nama]',
            'deskripsi' => 'required|min_length[10]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $roleModel = new RoleModel();
        $permissions = $this->request->getPost('permissions') ?? [];
        
        // Convert permissions array to associative array with true values
        $permissionsArray = [];
        foreach ($permissions as $permission) {
            $permissionsArray[$permission] = true;
        }
        
        $data = [
            'nama' => $this->request->getPost('nama'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'permissions' => json_encode($permissionsArray),
            'is_active' => $this->request->getPost('is_active') ?? 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        
        try {
            $roleModel->insert($data);
            return redirect()->to('/admin/role')->with('success', 'Role berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan role: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // Check if user has permission to edit roles (only superadmin)
        $admin_role = session()->get('admin_role');
        if ($admin_role !== 'superadmin') {
            return redirect()->to('/admin/role')->with('error', 'Anda tidak memiliki akses untuk mengedit role!');
        }

        $roleModel = new RoleModel();
        $role = $roleModel->find($id);
        
        if (!$role) {
            return redirect()->to('/admin/role')->with('error', 'Role tidak ditemukan!');
        }
        
        return view('admin/forms/role_form', [
            'role' => $role,
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'title' => 'Edit Role'
        ]);
    }

    public function update($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // Check if user has permission to edit roles (only superadmin)
        $admin_role = session()->get('admin_role');
        if ($admin_role !== 'superadmin') {
            return redirect()->to('/admin/role')->with('error', 'Anda tidak memiliki akses untuk mengedit role!');
        }

        // Validate input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required|min_length[3]|is_unique[role.nama,id,' . $id . ']',
            'deskripsi' => 'required|min_length[10]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $roleModel = new RoleModel();
        $permissions = $this->request->getPost('permissions') ?? [];
        $newStatus = $this->request->getPost('is_active') ?? 1;
        
        // Get current role data to check status change
        $currentRole = $roleModel->find($id);
        $oldStatus = $currentRole['is_active'];
        
        // Convert permissions array to associative array with true values
        $permissionsArray = [];
        foreach ($permissions as $permission) {
            $permissionsArray[$permission] = true;
        }
        
        $data = [
            'nama' => $this->request->getPost('nama'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'permissions' => json_encode($permissionsArray),
            'is_active' => $newStatus,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        
        try {
            $roleModel->update($id, $data);
            
            // Handle role deactivation
            if ($oldStatus == 1 && $newStatus == 0) {
                $this->handleRoleDeactivation($currentRole['nama']);
            }
            
            return redirect()->to('/admin/role')->with('success', 'Role berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui role: ' . $e->getMessage());
        }
    }

    private function handleRoleDeactivation($roleName)
    {
        $adminModel = new \App\Models\AdminModel();
        $affectedUsers = $adminModel->where('role', $roleName)->findAll();
        
        if (!empty($affectedUsers)) {
            // Store warning about affected users
            session()->setFlashdata('role_deactivation_warning', [
                'role_name' => $roleName,
                'affected_users' => count($affectedUsers),
                'user_list' => array_column($affectedUsers, 'username')
            ]);
        }
    }
    
    private function getUserCountForRole($roleName)
    {
        $adminModel = new \App\Models\AdminModel();
        return $adminModel->where('role', $roleName)->countAllResults();
    }

    public function delete($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // Check if user has permission to delete roles (only superadmin)
        $admin_role = session()->get('admin_role');
        if ($admin_role !== 'superadmin') {
            return redirect()->to('/admin/role')->with('error', 'Anda tidak memiliki akses untuk menghapus role!');
        }

        $roleModel = new RoleModel();
        
        // Check if role exists
        $role = $roleModel->find($id);
        if (!$role) {
            return redirect()->to('/admin/role')->with('error', 'Role tidak ditemukan!');
        }
        
        // Check if role is being used by any user
        $adminModel = new \App\Models\AdminModel();
        $usersWithRole = $adminModel->where('role', $role['nama'])->countAllResults();
        
        if ($usersWithRole > 0) {
            return redirect()->to('/admin/role')->with('error', 'Role tidak dapat dihapus karena masih digunakan oleh ' . $usersWithRole . ' user!');
        }
        
        try {
            $roleModel->delete($id);
            return redirect()->to('/admin/role')->with('success', 'Role berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->to('/admin/role')->with('error', 'Gagal menghapus role: ' . $e->getMessage());
        }
    }
} 