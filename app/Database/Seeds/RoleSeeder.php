<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'superadmin',
                'deskripsi' => 'Super Administrator dengan akses penuh ke semua fitur',
                'permissions' => json_encode([
                    'user_management' => true,
                    'berita_management' => true,
                    'harga_management' => true,
                    'galeri_management' => true,
                    'video_management' => true,
                    'pasar_management' => true,
                    'role_management' => true,
                    'system_settings' => true
                ]),
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'admin',
                'deskripsi' => 'Administrator dengan akses terbatas',
                'permissions' => json_encode([
                    'user_management' => true,
                    'berita_management' => true,
                    'harga_management' => true,
                    'galeri_management' => true,
                    'video_management' => true,
                    'pasar_management' => true,
                    'role_management' => false,
                    'system_settings' => false
                ]),
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'berita',
                'deskripsi' => 'Admin khusus untuk manajemen berita',
                'permissions' => json_encode([
                    'user_management' => false,
                    'berita_management' => true,
                    'harga_management' => false,
                    'galeri_management' => false,
                    'video_management' => false,
                    'pasar_management' => false,
                    'role_management' => false,
                    'system_settings' => false
                ]),
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'harga',
                'deskripsi' => 'Admin khusus untuk manajemen harga komoditas',
                'permissions' => json_encode([
                    'user_management' => false,
                    'berita_management' => false,
                    'harga_management' => true,
                    'galeri_management' => false,
                    'video_management' => false,
                    'pasar_management' => false,
                    'role_management' => false,
                    'system_settings' => false
                ]),
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'galeri',
                'deskripsi' => 'Admin khusus untuk manajemen galeri',
                'permissions' => json_encode([
                    'user_management' => false,
                    'berita_management' => false,
                    'harga_management' => false,
                    'galeri_management' => true,
                    'video_management' => false,
                    'pasar_management' => false,
                    'role_management' => false,
                    'system_settings' => false
                ]),
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($data as $row) {
            $existing = $this->db->table('role')->where('nama', $row['nama'])->get()->getRow();
            if (!$existing) {
                $this->db->table('role')->insert($row);
            }
        }
    }
} 