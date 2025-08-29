<?php
namespace App\Models;
use CodeIgniter\Model;

class GaleriModel extends Model
{
    protected $table = 'galeri';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'judul', 
        'gambar', 
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
        'gambar' => 'permit_empty|max_length[255]',
        'status' => 'permit_empty|in_list[draft,published]',
        'featured' => 'permit_empty|in_list[0,1]'
    ];
    
    protected $validationMessages = [
        'judul' => [
            'required' => 'Judul galeri harus diisi',
            'min_length' => 'Judul galeri minimal 3 karakter',
            'max_length' => 'Judul galeri maksimal 100 karakter'
        ],
        'status' => [
            'in_list' => 'Status harus berupa draft atau published'
        ],
        'featured' => [
            'in_list' => 'Featured harus berupa 0 atau 1'
        ]
    ];
    
    // Get featured galeri for landing page
    public function getFeaturedGaleri($limit = 6)
    {
        try {
            return $this->where('status', 'published')
                        ->where('featured', 1)
                        ->orderBy('created_at', 'DESC')
                        ->limit($limit)
                        ->findAll() ?? [];
        } catch (\Exception $e) {
            log_message('error', '[GaleriModel::getFeaturedGaleri] Error: ' . $e->getMessage());
            return [];
        }
    }
    
    // Get published galeri
    public function getPublishedGaleri()
    {
        try {
            return $this->where('status', 'published')
                        ->orderBy('created_at', 'DESC')
                        ->findAll() ?? [];
        } catch (\Exception $e) {
            log_message('error', '[GaleriModel::getPublishedGaleri] Error: ' . $e->getMessage());
            return [];
        }
    }
    
    // Get draft galeri
    public function getDraftGaleri()
    {
        try {
            return $this->where('status', 'draft')
                        ->orderBy('created_at', 'DESC')
                        ->findAll() ?? [];
        } catch (\Exception $e) {
            log_message('error', '[GaleriModel::getDraftGaleri] Error: ' . $e->getMessage());
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
            log_message('error', '[GaleriModel::toggleFeatured] Error: ' . $e->getMessage());
            return false;
        }
    }
    
    // Set featured status
    public function setFeatured($id, $featured = 1)
    {
        try {
            return $this->update($id, ['featured' => $featured]);
        } catch (\Exception $e) {
            log_message('error', '[GaleriModel::setFeatured] Error: ' . $e->getMessage());
            return false;
        }
    }
    
    // Increment views for a specific galeri
    public function incrementViews($id)
    {
        try {
            return $this->set('views', 'views + 1', false)
                        ->where('id', $id)
                        ->update();
        } catch (\Exception $e) {
            log_message('error', '[GaleriModel::incrementViews] Error: ' . $e->getMessage());
            return false;
        }
    }
    
    // Get total views for all published galeri
    public function getTotalViews()
    {
        try {
            $result = $this->select('SUM(views) as total_views')
                           ->where('status', 'published')
                           ->first();
            return $result ? (int)$result['total_views'] : 0;
        } catch (\Exception $e) {
            log_message('error', '[GaleriModel::getTotalViews] Error: ' . $e->getMessage());
            return 0;
        }
    }
    
    // Get dashboard statistics
    public function getDashboardStats()
    {
        try {
            // Fetch minimal fields for stats
            $allGaleri = $this->select('id,gambar,views,status,featured')->findAll();

            $stats = [
                'total_galeri' => count($allGaleri),
                'with_image' => 0,
                'without_image' => 0,
                'published' => 0,
                'draft' => 0,
                'featured' => 0,
                'total_views' => 0
            ];

            foreach ($allGaleri as $galeri) {
                if (!empty($galeri['gambar'])) {
                    $stats['with_image']++;
                } else {
                    $stats['without_image']++;
                }
                
                if ($galeri['status'] === 'published') {
                    $stats['published']++;
                } elseif ($galeri['status'] === 'draft') {
                    $stats['draft']++;
                }
                
                if ($galeri['featured']) {
                    $stats['featured']++;
                }
                
                $stats['total_views'] += (int)($galeri['views'] ?? 0);
            }

            return $stats;
        } catch (\Exception $e) {
            log_message('error', '[GaleriModel::getDashboardStats] Error: ' . $e->getMessage());
            return [
                'total_galeri' => 0,
                'with_image' => 0,
                'without_image' => 0,
                'published' => 0,
                'draft' => 0,
                'featured' => 0,
                'total_views' => 0
            ];
        }
    }
    
    // Get galeri with views for admin dashboard
    public function getGaleriWithViews()
    {
        try {
            // Simple approach - just get all galeri without complex joins
            $result = $this->orderBy('created_at', 'DESC')->findAll();
            
            // Add default penulis if not available
            foreach ($result as &$item) {
                $item['penulis'] = $item['penulis'] ?? 'Admin';
            }
            
            log_message('debug', '[GaleriModel::getGaleriWithViews] Found ' . count($result) . ' galeri');
            return $result ?? [];
        } catch (\Exception $e) {
            log_message('error', '[GaleriModel::getGaleriWithViews] Error: ' . $e->getMessage());
            return [];
        }
    }
} 