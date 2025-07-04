<?php
namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;

class BeritaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'judul' => 'Peresmian Fasilitas Baru',
                'isi' => 'Pasar Modern kini memiliki area parkir baru dan fasilitas ramah difabel.',
                'tanggal' => '2024-06-01'
            ],
            [
                'judul' => 'Kegiatan Sosial Pasar',
                'isi' => 'Santunan anak yatim dan bakti sosial di lingkungan pasar modern Tangerang.',
                'tanggal' => '2024-05-10'
            ],
            [
                'judul' => 'Pemantauan Harga',
                'isi' => 'Pemantauan harga dan pasokan bahan pangan di pasar modern Tangerang.',
                'tanggal' => '2024-03-07'
            ],
        ];
        $this->db->table('berita')->insertBatch($data);
    }
} 