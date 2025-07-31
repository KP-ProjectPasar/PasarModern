<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'nama' => 'Administrator',
                'level' => 'superadmin',
                'email' => 'admin@pasar.com',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'user',
                'password' => password_hash('user123', PASSWORD_DEFAULT),
                'nama' => 'User Admin',
                'level' => 'admin',
                'email' => 'user@pasar.com',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'berita',
                'password' => password_hash('berita123', PASSWORD_DEFAULT),
                'nama' => 'Admin Berita',
                'level' => 'berita',
                'email' => 'berita@pasar.com',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('admin')->insertBatch($data);
    }
} 