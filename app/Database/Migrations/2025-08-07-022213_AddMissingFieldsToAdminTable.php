<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMissingFieldsToAdminTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('admin', [
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['online', 'offline'],
                'default' => 'offline',
                'null' => false,
            ],
            'last_login' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('admin', ['status', 'last_login']);
    }
}
