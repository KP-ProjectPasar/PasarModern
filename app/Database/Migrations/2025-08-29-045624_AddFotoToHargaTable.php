<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFotoToHargaTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('harga', [
            'foto' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'tanggal'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('harga', 'foto');
    }
}
