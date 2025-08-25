<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class CreateKomoditasTable extends Migration
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
            'nama'  => [
                'type' => 'VARCHAR', 
                'constraint' => 100,
                'null' => false
            ],
            'gambar'=> [
                'type' => 'VARCHAR', 
                'constraint' => 255, 
                'null' => true
            ],
            'deskripsi' => [
                'type' => 'TEXT', 
                'null' => true
            ],
            'kategori' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'satuan' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
                'default' => 'kg'
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
        $this->forge->addKey('nama');
        $this->forge->addKey('kategori');
        
        // Create table with proper charset and collation
        $this->forge->createTable('komoditas', true, [
            'ENGINE' => 'InnoDB',
            'CHARSET' => 'utf8mb4',
            'COLLATE' => 'utf8mb4_unicode_ci'
        ]);
    }
    
    public function down()
    {
        $this->forge->dropTable('komoditas');
    }
} 