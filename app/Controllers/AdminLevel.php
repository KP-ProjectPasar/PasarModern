<?php
namespace App\Controllers;
use App\Models\LevelModel;

class AdminLevel extends BaseController
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $levelModel = new LevelModel();
        $levels = $levelModel->findAll();
        return view('admin/level_list', [
            'levels' => $levels,
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

        return view('admin/level_form', [
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

        $levelModel = new LevelModel();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];
        $levelModel->insert($data);
        return redirect()->to('/admin/level');
    }

    public function edit($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $levelModel = new LevelModel();
        $level = $levelModel->find($id);
        return view('admin/level_form', [
            'level' => $level,
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

        $levelModel = new LevelModel();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];
        $levelModel->update($id, $data);
        return redirect()->to('/admin/level');
    }

    public function delete($id)
    {
        // Check if user is logged in
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $levelModel = new LevelModel();
        $levelModel->delete($id);
        return redirect()->to('/admin/level');
    }
} 
