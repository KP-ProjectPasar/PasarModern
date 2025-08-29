<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\HargaModel;
use App\Models\KomoditasModel;

class AdminHarga extends BaseController
{
	public function index()
	{
		if (!session()->get('is_admin')) {
			return redirect()->to('/admin/login');
		}

		$hargaModel = new HargaModel();
		$harga = $hargaModel->getLatestPerKomoditas();
		$stats = $hargaModel->getDashboardStats();
		
		return view('admin/harga/harga_list', [
			'harga' => $harga,
			'stats' => $stats,
			'admin_nama' => session()->get('admin_nama'),
			'admin_role' => session()->get('admin_role'),
			'active_page' => 'harga',
		]);
	}

	public function create()
	{
		if (!session()->get('is_admin')) {
			return redirect()->to('/admin/login');
		}

		$komoditasModel = new KomoditasModel();
		$komoditas = $komoditasModel->findAll();
		
		return view('admin/harga/harga_form', [
			'komoditas' => $komoditas,
			'admin_nama' => session()->get('admin_nama'),
			'admin_role' => session()->get('admin_role'),
			'title' => 'Tambah Harga',
			'active_page' => 'harga',
		]);
	}

	public function store()
	{
		if (!session()->get('is_admin')) {
			return redirect()->to('/admin/login');
		}

		$validation = \Config\Services::validation();
		$validation->setRules([
			'komoditas' => 'required|min_length[3]|max_length[100]',
			'kategori' => 'required|in_list[sayuran,buah,daging,lainnya]',
			'harga' => 'required|numeric|greater_than[0]',
			'tanggal' => 'required|valid_date',
			'foto' => 'permit_empty|uploaded[foto]|max_size[foto,5120]|is_image[foto]'
		]);

		if (!$validation->withRequest($this->request)->run()) {
			return redirect()->back()->withInput()->with('errors', $validation->getErrors());
		}

		$hargaModel = new HargaModel();

		try {
			$komoditas = $this->request->getPost('komoditas');
			$tanggal = $this->request->getPost('tanggal');
			$data = [
				'komoditas' => $komoditas,
				'kategori' => $this->request->getPost('kategori'),
				'harga' => $this->request->getPost('harga'),
				'tanggal' => $tanggal,
			];

			$existing = $hargaModel->where('komoditas', $komoditas)
				->where('tanggal', $tanggal)
				->first();

			$foto = $this->request->getFile('foto');
			if ($foto && $foto->isValid() && !$foto->hasMoved()) {
				$newName = $foto->getRandomName();
				$foto->move(ROOTPATH . 'public/uploads/harga', $newName);
				$data['foto'] = $newName;
			} elseif ($existing && !empty($existing['foto'])) {
				// Pertahankan foto lama jika tidak ada upload baru
				$data['foto'] = $existing['foto'];
			}

			if ($existing) {
				// Simpan metadata harga sebelumnya agar indikator bisa menentukan Tetap/Naik/Turun
				$data['previous_price'] = $existing['harga'];
				$data['previous_updated_at'] = $existing['updated_at'];
				$hargaModel->update($existing['id'], $data);
			} else {
				$hargaModel->insert($data);
			}

			return redirect()->to('/admin/harga')->with('success', 'Data harga berhasil disimpan!');
			
		} catch (\Exception $e) {
			return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data harga: ' . $e->getMessage());
		}
	}

	public function edit($id)
	{
		if (!session()->get('is_admin')) {
			return redirect()->to('/admin/login');
		}

		$hargaModel = new HargaModel();
		$komoditasModel = new KomoditasModel();
		
		$harga = $hargaModel->find($id);
		$komoditas = $komoditasModel->findAll();
		
		if (!$harga) {
			return redirect()->to('/admin/harga')->with('error', 'Data harga tidak ditemukan!');
		}
		
		return view('admin/harga/harga_form', [
			'harga' => $harga,
			'komoditas' => $komoditas,
			'admin_nama' => session()->get('admin_nama'),
			'admin_role' => session()->get('admin_role'),
			'title' => 'Edit Harga',
			'active_page' => 'harga',
		]);
	}

	public function update($id)
	{
		if (!session()->get('is_admin')) {
			return redirect()->to('/admin/login');
		}

		$validation = \Config\Services::get('validation');
		$validation->setRules([
			'komoditas' => 'required|min_length[3]|max_length[100]',
			'kategori' => 'required|in_list[sayuran,buah,daging,lainnya]',
			'harga' => 'required|numeric|greater_than[0]',
			'tanggal' => 'required|valid_date',
			'foto' => 'permit_empty|uploaded[foto]|max_size[foto,5120]|is_image[foto]'
		]);

		if (!$validation->withRequest($this->request)->run()) {
			return redirect()->back()->withInput()->with('errors', $validation->getErrors());
		}

		$hargaModel = new HargaModel();

		try {
			$komoditas = $this->request->getPost('komoditas');
			$tanggal = $this->request->getPost('tanggal');
			$data = [
				'komoditas' => $komoditas,
				'kategori' => $this->request->getPost('kategori'),
				'harga' => $this->request->getPost('harga'),
				'tanggal' => $tanggal,
			];

			$existing = $hargaModel->where('komoditas', $komoditas)
				->where('tanggal', $tanggal)
				->first();

			$foto = $this->request->getFile('foto');
			if ($foto && $foto->isValid() && !$foto->hasMoved()) {
				$newName = $foto->getRandomName();
				$foto->move(ROOTPATH . 'public/uploads/harga', $newName);
				$data['foto'] = $newName;
			} elseif ($existing && !empty($existing['foto'])) {
				$data['foto'] = $existing['foto'];
			}

			if ($existing) {
				$data['previous_price'] = $existing['harga'];
				$data['previous_updated_at'] = $existing['updated_at'];
				$hargaModel->update($existing['id'], $data);
			} else {
				$hargaModel->update($id, $data);
			}

			return redirect()->to('/admin/harga')->with('success', 'Data harga berhasil diperbarui!');
			
		} catch (\Exception $e) {
			return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data harga: ' . $e->getMessage());
		}
	}

	public function delete($id)
	{
		if (!session()->get('is_admin')) {
			return redirect()->to('/admin/login');
		}

		try {
			$hargaModel = new HargaModel();
			$hargaModel->delete($id);
			return redirect()->to('/admin/harga')->with('success', 'Data harga berhasil dihapus!');
		} catch (\Exception $e) {
			return redirect()->to('/admin/harga')->with('error', 'Gagal menghapus data harga: ' . $e->getMessage());
		}
	}
} 
