<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class CreateBeritaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'judul' => ['type' => 'VARCHAR', 'constraint' => 150],
            'isi'   => ['type' => 'TEXT'],
            'gambar'=> ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'tanggal_publish' => ['type' => 'DATE', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('berita');
    }
    public function down()
    {
        $this->forge->dropTable('berita');
    }
} 