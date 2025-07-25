<?php
namespace App\Models;
use CodeIgniter\Model;

class GaleriModel extends Model
{
    protected $table = 'galeri';
    protected $primaryKey = 'id';
    protected $allowedFields = ['judul', 'gambar', 'created_at', 'updated_at'];
} 