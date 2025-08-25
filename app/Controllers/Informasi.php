<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\HargaModel;
use App\Models\KomoditasModel;

class Informasi extends Controller
{

    public function berita() { return view('informasi/berita'); }
    public function harga()
    {
        $hargaModel = new \App\Models\HargaModel();
        $komoditasModel = new \App\Models\KomoditasModel();
        $q = $this->request->getGet('q');
        $kategori = $this->request->getGet('kategori');

        $komoditasList = [];
        $kategoriList = [];
        $lastUpdate = '-';
        try {
            // Join harga dengan komoditas
            $builder = $hargaModel->select('harga.*, komoditas.nama as nama_komoditas, komoditas.gambar, komoditas.deskripsi')
                ->join('komoditas', 'komoditas.id = harga.komoditas', 'left');
            if ($q) {
                $builder->like('komoditas.nama', $q);
            }
            $fields = $hargaModel->getFieldNames();
            if (in_array('kategori', $fields) && $kategori) {
                $builder->where('harga.kategori', $kategori);
            }
            $komoditasList = $builder->orderBy('komoditas.nama', 'asc')->findAll();

            // Ambil semua kategori unik jika ada field kategori
            if (in_array('kategori', $fields)) {
                $kategoriList = $hargaModel->select('kategori')->distinct()->orderBy('kategori','asc')->findAll();
                $kategoriList = array_filter(array_map(function($row){ return $row['kategori']; }, $kategoriList));
            }

            // Tanggal update terakhir
            $last = $hargaModel->select('updated_at')->orderBy('updated_at','desc')->first();
            $lastUpdate = $last ? date('d F Y, H:i', strtotime($last['updated_at'])) : '-';
        } catch (\Throwable $e) {
            // Fallback: tampilkan data harga seadanya tanpa join
            $komoditasList = $hargaModel->findAll();
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
    
    public function harga() { return view('informasi/harga'); }
>>>>>>> 41309aba68f649b79701eed1bdd7a31fc29d3139
    public function informasi_pasar() { return view('informasi/informasi_pasar'); }
}
