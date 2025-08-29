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
        'featured',
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
        'status' => 'permit_empty|in_list[draft,published]',
        'featured' => 'permit_empty|in_list[0,1]'
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
        ],
        'featured' => [
            'in_list' => 'Featured harus berupa 0 atau 1'
        ]
    ];

    // Get featured videos for landing page
    public function getFeaturedVideos($limit = 3)
    {
        try {
            return $this->where('status', 'published')
                        ->where('featured', 1)
                        ->orderBy('created_at', 'DESC')
                        ->limit($limit)
                        ->findAll() ?? [];
        } catch (\Exception $e) {
            log_message('error', '[VideoModel::getFeaturedVideos] Error: ' . $e->getMessage());
            return [];
        }
    }

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

    // Toggle featured status
    public function toggleFeatured($id)
    {
        try {
            $current = $this->find($id);
            if (!$current) return false;
            
            $newStatus = $current['featured'] ? 0 : 1;
            return $this->update($id, ['featured' => $newStatus]);
        } catch (\Exception $e) {
            log_message('error', '[VideoModel::toggleFeatured] Error: ' . $e->getMessage());
            return false;
        }
    }
    
    // Set featured status
    public function setFeatured($id, $featured = 1)
    {
        try {
            return $this->update($id, ['featured' => $featured]);
        } catch (\Exception $e) {
            log_message('error', '[VideoModel::setFeatured] Error: ' . $e->getMessage());
            return false;
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