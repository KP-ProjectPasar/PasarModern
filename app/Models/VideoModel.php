<?php
namespace App\Models;
use CodeIgniter\Model;

class VideoModel extends Model
{
    protected $table = 'video';
    protected $primaryKey = 'id';
    protected $allowedFields = ['judul', 'url', 'file_video', 'tipe', 'created_at', 'updated_at'];
} 