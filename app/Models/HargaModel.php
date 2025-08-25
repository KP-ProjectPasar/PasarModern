<?php
namespace App\Models;
use CodeIgniter\Model;

class HargaModel extends Model
{
    protected $table = 'harga';
    protected $primaryKey = 'id';
    protected $allowedFields = ['komoditas_id', 'harga', 'satuan', 'tanggal', 'keterangan', 'created_at', 'updated_at'];
}