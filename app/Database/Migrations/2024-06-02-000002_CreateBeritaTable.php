<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class CreateBeritaTable extends Migration
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
            'judul' => [
                'type' => 'VARCHAR', 
                'constraint' => 200, 
                'null' => false
            ],
            'isi'   => [
                'type' => 'LONGTEXT', 
                'null' => false
            ],
            'gambar'=> [
                'type' => 'VARCHAR', 
                'constraint' => 255, 
                'null' => true
            ],
            'additional_images' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'gambar'
            ],
            'tanggal_publish' => [
                'type' => 'DATE', 
                'null' => false
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['draft', 'published', 'archived'],
                'default' => 'draft',
                'null' => false
            ],
            'views' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
                'null' => false
            ],
            'created_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true
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
        
        // Add indexes for better performance
        $this->forge->addKey('id', true);
        $this->forge->addKey('tanggal_publish');
        $this->forge->addKey('status');
        $this->forge->addKey('views');
        $this->forge->addKey('created_by');
        
        // Create table with proper charset and collation
        $this->forge->createTable('berita', true, [
            'ENGINE' => 'InnoDB',
            'CHARSET' => 'utf8mb4',
            'COLLATE' => 'utf8mb4_unicode_ci'
        ]);
    }
    
    public function down()
    {
        $this->forge->dropTable('berita');
    }
} 