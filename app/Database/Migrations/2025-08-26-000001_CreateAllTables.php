<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class CreateAllTables extends Migration
{
    public function up()
    {
        // Tabel harga
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'komoditas_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'harga' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => false],
            'satuan' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true, 'default' => 'kg'],
            'tanggal' => ['type' => 'DATE', 'null' => false],
            'keterangan' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'],
            'updated_at' => ['type' => 'DATETIME', 'null' => false, 'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('komoditas_id');
        $this->forge->createTable('harga', true);

        // Tabel komoditas
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
            'gambar' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'deskripsi' => ['type' => 'TEXT', 'null' => true],
            'kategori' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'satuan' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true, 'default' => 'kg'],
            'created_at' => ['type' => 'DATETIME', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'],
            'updated_at' => ['type' => 'DATETIME', 'null' => false, 'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('nama');
        $this->forge->createTable('komoditas', true);

        // Tabel berita
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'judul' => ['type' => 'VARCHAR', 'constraint' => 200, 'null' => false],
            'isi' => ['type' => 'LONGTEXT', 'null' => false],
            'gambar' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'tanggal_publish' => ['type' => 'DATE', 'null' => false],
            'status' => ['type' => 'ENUM', 'constraint' => ['draft', 'published', 'archived'], 'default' => 'draft', 'null' => false],
            'views' => ['type' => 'INT', 'constraint' => 11, 'default' => 0, 'null' => false],
            'created_by' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'],
            'updated_at' => ['type' => 'DATETIME', 'null' => false, 'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('tanggal_publish');
        $this->forge->addKey('status');
        $this->forge->addKey('views');
        $this->forge->addKey('created_by');
        $this->forge->createTable('berita', true);

        // Tabel galeri
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'judul' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
            'gambar' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
            'views' => ['type' => 'INT', 'constraint' => 11, 'default' => 0, 'null' => false],
            'status' => ['type' => 'ENUM', 'constraint' => ['draft', 'published', 'archived'], 'default' => 'draft', 'null' => false],
            'created_by' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'],
            'updated_at' => ['type' => 'DATETIME', 'null' => false, 'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('views');
        $this->forge->addKey('status');
        $this->forge->addKey('created_by');
        $this->forge->createTable('galeri', true);

        // Tabel video
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'judul' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
            'url' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'file_video' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'tipe' => ['type' => 'ENUM', 'constraint' => ['url', 'file'], 'default' => 'url', 'null' => false],
            'views' => ['type' => 'INT', 'constraint' => 11, 'default' => 0, 'null' => false],
            'status' => ['type' => 'ENUM', 'constraint' => ['draft', 'published', 'archived'], 'default' => 'draft', 'null' => false],
            'created_by' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'],
            'updated_at' => ['type' => 'DATETIME', 'null' => false, 'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('views');
        $this->forge->addKey('status');
        $this->forge->addKey('created_by');
        $this->forge->createTable('video', true);

        // Tabel admin
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'username' => ['type' => 'VARCHAR', 'constraint' => 50, 'unique' => true, 'null' => false],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
            'role' => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'admin', 'null' => false],
            'email' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'status' => ['type' => 'ENUM', 'constraint' => ['online', 'offline'], 'default' => 'offline', 'null' => false],
            'last_login' => ['type' => 'DATETIME', 'null' => true],
            'last_activity' => ['type' => 'DATETIME', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'],
            'updated_at' => ['type' => 'DATETIME', 'null' => false, 'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('username');
        $this->forge->addKey('role');
        $this->forge->addKey('status');
        $this->forge->createTable('admin', true);

        // Tabel role
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true, 'null' => false],
            'deskripsi' => ['type' => 'TEXT', 'null' => true],
            'permissions' => ['type' => 'TEXT', 'null' => true],
            'is_active' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1, 'null' => false],
            'created_at' => ['type' => 'DATETIME', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'],
            'updated_at' => ['type' => 'DATETIME', 'null' => false, 'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('nama');
        $this->forge->addKey('is_active');
        $this->forge->createTable('role', true);

        // Tabel feedbacks
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
            'email' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
            'telepon' => ['type' => 'VARCHAR', 'constraint' => 15, 'null' => true],
            'subjek' => ['type' => 'VARCHAR', 'constraint' => 200, 'null' => false],
            'pesan' => ['type' => 'TEXT', 'null' => false],
            'jenis_feedback' => ['type' => 'ENUM', 'constraint' => ['keluhan', 'saran', 'pujian', 'laporan', 'pertanyaan'], 'null' => false],
            'file_lampiran' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status' => ['type' => 'ENUM', 'constraint' => ['pending', 'dibaca', 'dibalas', 'selesai'], 'default' => 'pending', 'null' => false],
            'ip_address' => ['type' => 'VARCHAR', 'constraint' => 45, 'null' => true],
            'user_agent' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'],
            'updated_at' => ['type' => 'DATETIME', 'null' => false, 'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('status');
        $this->forge->addKey('jenis_feedback');
        $this->forge->addKey('created_at');
        $this->forge->addKey('email');
        $this->forge->createTable('feedbacks', true);

        // Tabel direksi
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
            'jabatan' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
            'foto' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'pesan' => ['type' => 'TEXT', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('direksi', true);
    }

    public function down()
    {
        $this->forge->dropTable('harga');
        $this->forge->dropTable('komoditas');
        $this->forge->dropTable('berita');
        $this->forge->dropTable('galeri');
        $this->forge->dropTable('video');
        $this->forge->dropTable('admin');
        $this->forge->dropTable('role');
        $this->forge->dropTable('feedbacks');
        $this->forge->dropTable('direksi');
    }
}
