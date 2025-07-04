<?php
namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;

class KomoditasSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'Beras IR I', 'kategori' => 'beras', 'harga' => 14000, 'satuan' => 'kg', 'perubahan' => 'turun', 'last_update' => '2024-06-01'
            ],
            [
                'nama' => 'Beras IR II', 'kategori' => 'beras', 'harga' => 13000, 'satuan' => 'kg', 'perubahan' => 'naik', 'last_update' => '2024-06-01'
            ],
            [
                'nama' => 'Gula Pasir Lokal', 'kategori' => 'gula', 'harga' => 19000, 'satuan' => 'kg', 'perubahan' => 'turun', 'last_update' => '2024-06-01'
            ],
            [
                'nama' => 'Daging Sapi', 'kategori' => 'daging', 'harga' => 140000, 'satuan' => 'kg', 'perubahan' => 'naik', 'last_update' => '2024-06-01'
            ],
            [
                'nama' => 'Daging Ayam Broiler', 'kategori' => 'daging', 'harga' => 40000, 'satuan' => 'kg', 'perubahan' => 'turun', 'last_update' => '2024-06-01'
            ],
            [
                'nama' => 'Telur Ayam', 'kategori' => 'telur', 'harga' => 3000, 'satuan' => 'butir', 'perubahan' => 'naik', 'last_update' => '2024-06-01'
            ],
            [
                'nama' => 'Kacang Kedelai', 'kategori' => 'kacang', 'harga' => 16000, 'satuan' => 'kg', 'perubahan' => 'turun', 'last_update' => '2024-06-01'
            ],
        ];
        $this->db->table('komoditas')->insertBatch($data);
    }
} 