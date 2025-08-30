<?php
namespace App\Controllers;
use App\Controllers\BaseController;

class TentangKami extends BaseController
{
    public function ringkasan() { return view('tentang_kami/ringkasan'); }
    public function visi_misi() { return view('tentang_kami/visi_misi'); }
    public function peraturan() { return view('tentang_kami/peraturan'); }
    public function pesan_direksi() {
        // Data direksi sekarang menggunakan data statis karena tabel direksi sudah dihapus
        $direksi = [
            'nama' => 'Direktur Utama',
            'jabatan' => 'Direktur Utama',
            'pesan' => 'Selamat datang di Sistem Informasi Pasar Modern. Kami berkomitmen untuk memberikan informasi pasar yang akurat dan terpercaya kepada masyarakat.'
        ];
        return view('tentang_kami/pesan_direksi', compact('direksi'));
    }
}
