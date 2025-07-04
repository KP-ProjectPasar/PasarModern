<?php
namespace App\Models;
use CodeIgniter\Model;

class KomoditasModel extends Model
{
    protected $table = 'komoditas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'kategori', 'harga', 'satuan', 'perubahan', 'last_update'];
} 