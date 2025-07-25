<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class CreateLevelTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama'  => ['type' => 'VARCHAR', 'constraint' => 50, 'unique' => true],
            'keterangan' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('level');
    }
    public function down()
    {
        $this->forge->dropTable('level');
    }
} 