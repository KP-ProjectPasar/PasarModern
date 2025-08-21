<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DireksiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'nama' => 'Ir. Siti Rahmawati, M.M.',
            'jabatan' => 'Direktur Utama',
            'foto' => '/assets/img/direksi/siti-rahmawati.jpg', // Ganti dengan path gambar asli jika sudah ada
            'pesan' => 'Selamat datang di website Pasar Modern Tangerang. Kami berkomitmen untuk memberikan layanan terbaik, transparansi informasi, dan inovasi demi kemajuan pasar modern yang profesional, bersih, dan nyaman untuk semua. Mari bersama-sama membangun ekosistem pasar yang sehat dan berdaya saing.'
        ];
        $this->db->table('direksi')->insert($data);
    }
}
