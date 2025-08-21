<?php
namespace App\Controllers;
use App\Models\DireksiModel;

class AdminDireksi extends BaseController
{
    public function index()
    {
        $direksi = (new DireksiModel())->findAll();
        return view('admin/lists/direksi_list', compact('direksi'));
    }

    public function edit($id)
    {
        $direksi = (new DireksiModel())->find($id);
        return view('admin/forms/direksi_form', compact('direksi'));
    }

    public function update($id)
    {
        $model = new DireksiModel();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'jabatan' => $this->request->getPost('jabatan'),
            'pesan' => $this->request->getPost('pesan'),
        ];
        // Handle upload foto jika ada
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $foto->move('uploads/direksi', $newName);
            $data['foto'] = '/uploads/direksi/' . $newName;
        }
        $model->update($id, $data);
        return redirect()->to('/admin/direksi')->with('success', 'Data direksi berhasil diperbarui!');
    }
}
