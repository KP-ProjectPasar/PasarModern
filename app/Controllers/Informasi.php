<?php
namespace App\Controllers;
use CodeIgniter\Controller;

class Informasi extends Controller
{
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
    public function informasi_pasar() { return view('informasi/informasi_pasar'); }
} 
