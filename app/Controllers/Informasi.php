<?php
namespace App\Controllers;
use CodeIgniter\Controller;

class Informasi extends Controller
{
    public function berita() { return view('informasi/berita'); }
    public function harga() { return view('informasi/harga'); }
    public function informasi_pasar() { return view('informasi/informasi_pasar'); }
} 