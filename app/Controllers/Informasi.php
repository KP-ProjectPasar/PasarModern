<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\HargaModel;
use App\Models\KomoditasModel;

class Informasi extends Controller
{
	public function harga()
	{
		$hargaModel = new \App\Models\HargaModel();
		$q = $this->request->getGet('q');
		$kategori = $this->request->getGet('kategori');

		$komoditasList = [];
		$kategoriList = [];
		$lastUpdate = '-';
		try {
			$builder = $hargaModel;
			if ($q) { $builder = $builder->like('komoditas', $q); }
			$fields = $hargaModel->getFieldNames();
			if (in_array('kategori', $fields) && $kategori) { $builder = $builder->where('kategori', $kategori); }
			$komoditasList = $builder->orderBy('komoditas', 'asc')->findAll();

			// Build category list
			if (in_array('kategori', $fields)) {
				$kategoriRows = $hargaModel->select('kategori')->distinct()->orderBy('kategori','asc')->findAll();
				$kategoriList = array_filter(array_map(function($row){ return $row['kategori']; }, $kategoriRows));
			}
			if (empty($kategoriList) && !empty($komoditasList)) {
				$kategoriList = array_values(array_unique(array_filter(array_map(function($h){ return $h['kategori'] ?? null; }, $komoditasList))));
				sort($kategoriList);
			}

			// Fallback filter in PHP to ensure table reflects selected category
			if (!empty($kategori)) {
				$komoditasList = array_values(array_filter($komoditasList, function($h) use ($kategori) {
					return strtolower(trim($h['kategori'] ?? '')) === strtolower(trim($kategori));
				}));
			}

			$last = $hargaModel->select('updated_at')->orderBy('updated_at','desc')->first();
			$lastUpdate = $last ? date('d F Y, H:i', strtotime($last['updated_at'])) : '-';
		} catch (\Throwable $e) {
			$komoditasList = $hargaModel->orderBy('komoditas','asc')->findAll();
			$kategoriList = array_values(array_unique(array_filter(array_map(function($h){ return $h['kategori'] ?? null; }, $komoditasList))));
			sort($kategoriList);
			if (!empty($kategori)) {
				$komoditasList = array_values(array_filter($komoditasList, function($h) use ($kategori) {
					return strtolower(trim($h['kategori'] ?? '')) === strtolower(trim($kategori));
				}));
			}
			$last = $hargaModel->select('updated_at')->orderBy('updated_at','desc')->first();
			$lastUpdate = $last ? date('d F Y, H:i', strtotime($last['updated_at'])) : '-';
		}

		return view('informasi/harga', [
			'komoditasList' => $komoditasList,
			'kategoriList' => $kategoriList,
			'kategori' => $kategori,
			'q' => $q,
			'lastUpdate' => $lastUpdate,
		]);
	}

	public function berita() 
	{
		$beritaModel = new \App\Models\BeritaModel();
		$data['berita'] = $beritaModel->where('status', 'published')
								 ->orderBy('tanggal_publish', 'DESC')
								 ->findAll();
		return view('informasi/berita', $data);
	}
	
	public function beritaDetail($id) 
	{
		$beritaModel = new \App\Models\BeritaModel();
		$data['berita'] = $beritaModel->find($id);
		
		if (!$data['berita'] || $data['berita']['status'] !== 'published') {
			return redirect()->to('/informasi/berita')->with('error', 'Berita tidak ditemukan');
		}
		
		return view('informasi/berita_detail', $data);
	}
	
	public function informasi_pasar() { return view('informasi/informasi_pasar'); }

	public function galeri() { return view('informasi/galeri'); }
}
