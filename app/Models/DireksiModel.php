<?php
namespace App\Models;
use CodeIgniter\Model;

class DireksiModel extends Model
{
    protected $table = 'direksi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'jabatan', 'foto', 'pesan'];
}
