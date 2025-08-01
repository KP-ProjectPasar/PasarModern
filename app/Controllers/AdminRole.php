<?php
namespace App\Controllers;
use App\Models\RoleModel;
use CodeIgniter\Controller;

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

        $roleModel = new RoleModel();
        $roles = $roleModel->findAll();
        return view('admin/role_list', [
            'roles' => $roles,
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

        // Check if user has permission to create roles (only superadmin)
        $admin_role = session()->get('admin_role');
        if ($admin_role !== 'superadmin') {
            return redirect()->to('/admin/role')->with('error', 'Anda tidak memiliki akses untuk menambah role!');
        }

        return view('admin/role_form', [
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
        $data = [
            'nama' => $this->request->getPost('nama'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'permissions' => json_encode($this->request->getPost('permissions') ?? []),
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
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
        return view('admin/role_form', [
            'role' => $role,
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
        $data = [
            'nama' => $this->request->getPost('nama'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'permissions' => json_encode($this->request->getPost('permissions') ?? []),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        
        try {
            $roleModel->update($id, $data);
            return redirect()->to('/admin/role')->with('success', 'Role berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui role: ' . $e->getMessage());
        }
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
        $roleModel->delete($id);
        return redirect()->to('/admin/role')->with('success', 'Role berhasil dihapus!');
    }
} 