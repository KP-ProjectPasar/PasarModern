<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class CreateHargaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'    => [
                'type' => 'INT', 
                'constraint' => 11, 
                'unsigned' => true, 
                'auto_increment' => true
            ],
            'komoditas' => [
                'type' => 'VARCHAR', 
                'constraint' => 100,
                'null' => false
            ],
            'harga' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => false
            ],
            'tanggal' => [
                'type' => 'DATE',
                'null' => false
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
        $this->forge->addKey('komoditas');
        $this->forge->addKey('tanggal');
        
        // Create table with proper charset and collation
        $this->forge->createTable('harga', true, [
            'ENGINE' => 'InnoDB',
            'CHARSET' => 'utf8mb4',
            'COLLATE' => 'utf8mb4_unicode_ci'
        ]);
    }
    
    public function down()
    {
        $this->forge->dropTable('harga');
    }
} 