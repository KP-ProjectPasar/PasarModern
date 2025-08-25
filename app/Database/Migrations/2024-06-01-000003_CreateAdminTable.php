<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class CreateAdminTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'       => [
                'type' => 'INT', 
                'constraint' => 11, 
                'unsigned' => true, 
                'auto_increment' => true
            ],
            'username' => [
                'type' => 'VARCHAR', 
                'constraint' => 50, 
                'unique' => true,
                'null' => false
            ],
            'password' => [
                'type' => 'VARCHAR', 
                'constraint' => 255,
                'null' => false
            ],
            'role'     => [
                'type' => 'VARCHAR', 
                'constraint' => 20, 
                'default' => 'admin',
                'null' => false
            ],
            'email'    => [
                'type' => 'VARCHAR', 
                'constraint' => 100, 
                'null' => true
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['online', 'offline'],
                'default' => 'offline',
                'null' => false,
            ],
            'last_login' => [
                'type' => 'DATETIME', 
                'null' => true
            ],
            'last_activity' => [
                'type' => 'DATETIME', 
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
        $this->forge->addKey('username');
        $this->forge->addKey('role');
        $this->forge->addKey('status');
        
        // Create table with proper charset and collation
        $this->forge->createTable('admin', true, [
            'ENGINE' => 'InnoDB',
            'CHARSET' => 'utf8mb4',
            'COLLATE' => 'utf8mb4_unicode_ci'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('admin');
    }
} 