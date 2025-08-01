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
                'role' => 'superadmin',
                'email' => 'admin@pasar.com',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'user',
                'password' => password_hash('user123', PASSWORD_DEFAULT),
                'role' => 'admin',
                'email' => 'user@pasar.com',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'berita',
                'password' => password_hash('berita123', PASSWORD_DEFAULT),
                'role' => 'berita',
                'email' => 'berita@pasar.com',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($data as $row) {
            $existing = $this->db->table('admin')->where('username', $row['username'])->get()->getRow();
            if (!$existing) {
                $this->db->table('admin')->insert($row);
            }
        }
    }
} 