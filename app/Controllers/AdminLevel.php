<?php
namespace App\Controllers;
use App\Models\LevelModel;

class AdminLevel extends BaseController
{
    public function index()
    {
        $levelModel = new LevelModel();
        $levels = $levelModel->findAll();
        return view('admin/level_list', ['levels' => $levels]);
    }

    public function create()
    {
        return view('admin/level_form');
    }

    public function store()
    {
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
        $levelModel = new LevelModel();
        $level = $levelModel->find($id);
        return view('admin/level_form', ['level' => $level]);
    }

    public function update($id)
    {
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
        $levelModel = new LevelModel();
        $levelModel->delete($id);
        return redirect()->to('/admin/level');
    }
} 