<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class CreateKomoditasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama'        => ['type' => 'VARCHAR', 'constraint' => 100],
            'kategori'    => ['type' => 'VARCHAR', 'constraint' => 50],
            'harga'       => ['type' => 'INT', 'constraint' => 11],
            'satuan'      => ['type' => 'VARCHAR', 'constraint' => 20],
            'perubahan'   => ['type' => 'VARCHAR', 'constraint' => 10],
            'last_update' => ['type' => 'DATE'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('komoditas');
    }

    public function down()
    {
        $this->forge->dropTable('komoditas');
    }
} 