<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFeedbacksTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'telepon' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
                'null' => true,
            ],
            'subjek' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false,
            ],
            'pesan' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'jenis_feedback' => [
                'type' => 'ENUM',
                'constraint' => ['keluhan', 'saran', 'pujian', 'laporan', 'pertanyaan'],
                'null' => false,
            ],
            'file_lampiran' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'dibaca', 'dibalas', 'selesai'],
                'default' => 'pending',
                'null' => false,
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true,
            ],
            'user_agent' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
                'default' => 'CURRENT_TIMESTAMP'
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false,
                'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
            ],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addKey('status');
        $this->forge->addKey('jenis_feedback');
        $this->forge->addKey('created_at');
        $this->forge->addKey('email');
        
        // Create table with proper charset and collation
        $this->forge->createTable('feedbacks', true, [
            'ENGINE' => 'InnoDB',
            'CHARSET' => 'utf8mb4',
            'COLLATE' => 'utf8mb4_unicode_ci'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('feedbacks');
    }
} 