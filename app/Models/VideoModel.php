<?php
namespace App\Models;
use CodeIgniter\Model;

class VideoModel extends Model
{
    protected $table = 'video';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'judul',
        'url',
        'file_video',
        'tipe',
        'views',
        'status',
        'created_by',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation rules
    protected $validationRules = [
        'judul' => 'required|min_length[3]|max_length[100]',
        'tipe' => 'required|in_list[url,file]',
        'status' => 'permit_empty|in_list[draft,published]'
    ];
    
    protected $validationMessages = [
        'judul' => [
            'required' => 'Judul video harus diisi',
            'min_length' => 'Judul video minimal 3 karakter',
            'max_length' => 'Judul video maksimal 100 karakter'
        ],
        'tipe' => [
            'required' => 'Tipe video harus dipilih',
            'in_list' => 'Tipe video harus URL atau File'
        ],
        'status' => [
            'in_list' => 'Status harus berupa draft atau published'
        ]
    ];

    // Get published videos
    public function getPublishedVideos()
    {
        try {
            return $this->where('status', 'published')
                        ->orderBy('created_at', 'DESC')
                        ->findAll() ?? [];
        } catch (\Exception $e) {
            log_message('error', '[VideoModel::getPublishedVideos] Error: ' . $e->getMessage());
            return [];
        }
    }

    // Get draft videos
    public function getDraftVideos()
    {
        try {
            return $this->where('status', 'draft')
                        ->orderBy('created_at', 'DESC')
                        ->findAll() ?? [];
        } catch (\Exception $e) {
            log_message('error', '[VideoModel::getDraftVideos] Error: ' . $e->getMessage());
            return [];
        }
    }

    // Increment views for a specific video
    public function incrementViews($id)
    {
        try {
            $this->set('views', 'views+1', false)
                 ->where('id', $id)
                 ->update();
            return true;
        } catch (\Exception $e) {
            log_message('error', '[VideoModel::incrementViews] Error: ' . $e->getMessage());
            return false;
        }
    }
} 