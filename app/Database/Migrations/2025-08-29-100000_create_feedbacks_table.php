<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFeedbacksTable extends Migration
{
    public function up()
    {
        // Check if table already exists
        if ($this->db->tableExists('feedbacks')) {
            // If table exists, just remove IP and user_agent columns if they exist
            $fields = $this->db->getFieldNames('feedbacks');
            $drop = [];
            if (in_array('ip_address', $fields)) {
                $drop['ip_address'] = ['type' => 'VARCHAR', 'constraint' => 45];
            }
            if (in_array('user_agent', $fields)) {
                $drop['user_agent'] = ['type' => 'TEXT'];
            }
            if (!empty($drop)) {
                $this->forge->dropColumn('feedbacks', array_keys($drop));
            }
            return;
        }

        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
                'null'       => true,
            ],
            'subjek' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
            ],
            'pesan' => [
                'type'       => 'TEXT',
            ],
            'jenis_feedback' => [
                'type'       => 'ENUM',
                'constraint' => ['keluhan', 'saran', 'pujian', 'laporan', 'pertanyaan'],
                'default'    => 'keluhan',
            ],
            'file_lampiran' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'dibaca', 'dibalas', 'selesai'],
                'default'    => 'pending',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('feedbacks');
    }

    public function down()
    {
        $this->forge->dropTable('feedbacks');
    }
}
