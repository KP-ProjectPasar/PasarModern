<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateHargaTableStructure extends Migration
{
    public function up()
    {
        // Check if columns exist before dropping them
        $db = \Config\Database::connect();
        $fields = $db->getFieldNames('harga');
        
        // Drop unnecessary columns if they exist
        if (in_array('satuan', $fields)) {
            $this->forge->dropColumn('harga', 'satuan');
        }
        
        if (in_array('keterangan', $fields)) {
            $this->forge->dropColumn('harga', 'keterangan');
        }
        
        // Add kategori column only if it doesn't exist
        if (!in_array('kategori', $fields)) {
            $this->forge->addColumn('harga', [
                'kategori' => [
                    'type' => 'VARCHAR',
                    'constraint' => 50,
                    'null' => false,
                    'default' => 'sayuran',
                    'after' => 'komoditas'
                ]
            ]);
        }
    }

    public function down()
    {
        // Add back the removed columns (for rollback)
        $this->forge->addColumn('harga', [
            'satuan' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
                'after' => 'harga'
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'tanggal'
            ]
        ]);
        
        // Remove kategori column if it was added
        $this->forge->dropColumn('harga', 'kategori');
    }
}
