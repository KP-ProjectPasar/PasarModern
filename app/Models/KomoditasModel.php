<?php
namespace App\Models;
use CodeIgniter\Model;

class KomoditasModel extends Model
{
    protected $table = 'komoditas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'gambar', 'deskripsi', 'created_at', 'updated_at'];
} 