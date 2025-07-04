<?php
namespace App\Controllers;
use CodeIgniter\Controller;

class TentangKami extends Controller
{
    public function ringkasan() { return view('tentang_kami/ringkasan'); }
    public function visi_misi() { return view('tentang_kami/visi_misi'); }
    public function peraturan() { return view('tentang_kami/peraturan'); }
    public function pesan_direksi() { return view('tentang_kami/pesan_direksi'); }
} 