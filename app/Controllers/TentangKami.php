<?php
namespace App\Controllers;
use App\Models\DireksiModel;
use App\Controllers\BaseController;

class TentangKami extends BaseController
{
    public function ringkasan() { return view('tentang_kami/ringkasan'); }
    public function visi_misi() { return view('tentang_kami/visi_misi'); }
    public function peraturan() { return view('tentang_kami/peraturan'); }
    public function pesan_direksi() {
        $direksi = (new DireksiModel())->first();
        return view('tentang_kami/pesan_direksi', compact('direksi'));
    }
}
