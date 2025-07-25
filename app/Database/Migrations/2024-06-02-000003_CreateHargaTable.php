<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class CreateHargaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'komoditas' => ['type' => 'VARCHAR', 'constraint' => 100],
            'harga' => ['type' => 'INT', 'constraint' => 11],
            'tanggal' => ['type' => 'DATE'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('harga');
    }
    public function down()
    {
        $this->forge->dropTable('harga');
    }
} 