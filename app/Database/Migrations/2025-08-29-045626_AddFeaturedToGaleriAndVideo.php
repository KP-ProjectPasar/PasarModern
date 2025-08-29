<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFeaturedToGaleriAndVideo extends Migration
{
    public function up()
    {
        // Add featured field to galeri table
        $this->forge->addColumn('galeri', [
            'featured' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'comment' => '0: not featured, 1: featured on landing page'
            ]
        ]);

        // Add featured field to video table
        $this->forge->addColumn('video', [
            'featured' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'comment' => '0: not featured, 1: featured on landing page'
            ]
        ]);
    }

    public function down()
    {
        // Remove featured field from galeri table
        $this->forge->dropColumn('galeri', 'featured');
        
        // Remove featured field from video table
        $this->forge->dropColumn('video', 'featured');
    }
}
