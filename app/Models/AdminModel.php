<?php
namespace App\Models;
use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'username', 
        'password', 
        'nama', 
        'level', 
        'email', 
        'last_login', 
        'last_activity', 
        'created_at', 
        'updated_at'
    ];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
} 