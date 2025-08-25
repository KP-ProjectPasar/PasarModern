<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class CreateVideoTable extends Migration
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
                'constraint' => 100,
                'null' => false
            ],
            'url'   => [
                'type' => 'VARCHAR', 
                'constraint' => 255,
                'null' => true
            ],
            'file_video' => [
                'type' => 'VARCHAR', 
                'constraint' => 255,
                'null' => true
            ],
            'tipe' => [
                'type' => 'ENUM',
                'constraint' => ['url', 'file'],
                'default' => 'url',
                'null' => false
            ],
            'views' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
                'null' => false
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['draft', 'published', 'archived'],
                'default' => 'draft',
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
        
        $this->forge->addKey('id', true);
        $this->forge->addKey('views');
        $this->forge->addKey('status');
        $this->forge->addKey('created_by');
        
        // Create table with proper charset and collation
        $this->forge->createTable('video', true, [
            'ENGINE' => 'InnoDB',
            'CHARSET' => 'utf8mb4',
            'COLLATE' => 'utf8mb4_unicode_ci'
        ]);
    }
    
    public function down()
    {
        $this->forge->dropTable('video');
    }
} 