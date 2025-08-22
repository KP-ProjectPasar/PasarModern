<?php
namespace App\Models;
use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table= 'berita';
    protected $primaryKey = 'id';
    protected $allowedFields = ['judul', 'isi', 'gambar', 'tanggal_publish', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}           