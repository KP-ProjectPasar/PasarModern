<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveStatusFromAdminTable extends Migration
{
    public function up()
    {
        // Remove status column from admin table
        $this->forge->dropColumn('admin', 'status');
    }

    public function down()
    {
        // Add status column back if migration is rolled back
        $fields = [
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['online', 'offline', 'inactive'],
                'default' => 'offline',
                'null' => false,
            ]
        ];
        
        $this->forge->addColumn('admin', $fields);
    }
}
