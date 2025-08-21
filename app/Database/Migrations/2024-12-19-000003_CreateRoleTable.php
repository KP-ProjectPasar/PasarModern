<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRoleTable extends Migration
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
            ],        
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'permissions' => [
                'type' => 'TEXT',
                'null' => true,
                'comment' => 'JSON encoded permissions array',
            ],
            'is_active' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
            ],      
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('role');
    }

    public function down()
    {
        $this->forge->dropTable('role');
    }
}