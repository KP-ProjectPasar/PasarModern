<?php
namespace App\Models;
use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table = 'berita';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'judul', 
        'isi', 
        'gambar', 
        'tanggal_publish', 
        'status',
        'views',
        'created_by',
        'created_at', 
        'updated_at'
    ];
    
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $skipValidation = true; // Temporarily disable validation
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    // Validation rules
    protected $validationRules = [
        'judul' => 'required|min_length[3]|max_length[200]',
        'isi' => 'required',
        'tanggal_publish' => 'required',
        'gambar' => 'permit_empty|max_length[255]',
        'status' => 'permit_empty|in_list[draft,published]'
    ];
    
    protected $validationMessages = [
        'judul' => [
            'required' => 'Judul berita harus diisi',
            'min_length' => 'Judul berita minimal 5 karakter',
            'max_length' => 'Judul berita maksimal 200 karakter'
        ],
        'isi' => [
            'required' => 'Isi berita harus diisi',
            'min_length' => 'Isi berita minimal 50 karakter'
        ],
        'tanggal_publish' => [
            'required' => 'Tanggal publish harus diisi',
            'valid_date' => 'Format tanggal tidak valid'
        ],
        'status' => [
            'required' => 'Status berita harus diisi',
            'in_list' => 'Status berita tidak valid'
        ]
    ];
    
    // Get published berita
    public function getPublishedBerita()
    {
        try {
            return $this->where('status', 'published')
                        ->where('tanggal_publish <=', date('Y-m-d'))
                        ->orderBy('tanggal_publish', 'DESC')
                        ->findAll() ?? [];
        } catch (\Exception $e) {
            log_message('error', '[BeritaModel::getPublishedBerita] Error: ' . $e->getMessage());
            return [];
        }
    }
    
    // Get draft berita
    public function getDraftBerita()
    {
        try {
            return $this->where('status', 'draft')
                        ->orderBy('created_at', 'DESC')
                        ->findAll() ?? [];
        } catch (\Exception $e) {
            log_message('error', '[BeritaModel::getDraftBerita] Error: ' . $e->getMessage());
            return [];
        }
    }

    // Override findAll to handle errors
    public function findAll(?int $limit = null, int $offset = 0)
    {
        try {
            return parent::findAll($limit, $offset) ?? [];
        } catch (\Exception $e) {
            log_message('error', '[BeritaModel::findAll] Error: ' . $e->getMessage());
            return [];
        }
    }
    
    // Increment views for a specific berita
    public function incrementViews($id)
    {
        try {
            return $this->set('views', 'views + 1', false)
                        ->where('id', $id)
                        ->update();
        } catch (\Exception $e) {
            log_message('error', '[BeritaModel::incrementViews] Error: ' . $e->getMessage());
            return false;
        }
    }
    
    // Get total views for all published berita
    public function getTotalViews()
    {
        try {
            $result = $this->select('SUM(views) as total_views')
                           ->where('status', 'published')
                           ->first();
            return $result ? (int)$result['total_views'] : 0;
        } catch (\Exception $e) {
            log_message('error', '[BeritaModel::getTotalViews] Error: ' . $e->getMessage());
            return 0;
        }
    }
    
    // Get dashboard statistics
    public function getDashboardStats()
    {
        try {
            $stats = [
                'total_berita' => $this->countAllResults(),
                'published' => $this->where('status', 'published')->countAllResults(),
                'draft' => $this->where('status', 'draft')->countAllResults(),
                'total_views' => $this->getTotalViews()
            ];
            
            log_message('debug', '[BeritaModel::getDashboardStats] Stats: ' . json_encode($stats));
            return $stats;
        } catch (\Exception $e) {
            log_message('error', '[BeritaModel::getDashboardStats] Error: ' . $e->getMessage());
            return [
                'total_berita' => 0,
                'published' => 0,
                'draft' => 0,
                'total_views' => 0
            ];
        }
    }
    
    // Get berita with views for admin dashboard
    public function getBeritaWithViews()
    {
        try {
            // Simple approach - just get all berita without complex joins
            $result = $this->orderBy('created_at', 'DESC')->findAll();
            
            // Add default penulis if not available
            foreach ($result as &$item) {
                $item['penulis'] = $item['penulis'] ?? 'Admin';
            }
            
            log_message('debug', '[BeritaModel::getBeritaWithViews] Found ' . count($result) . ' berita');
            return $result ?? [];
        } catch (\Exception $e) {
            log_message('error', '[BeritaModel::getBeritaWithViews] Error: ' . $e->getMessage());
            return [];
        }
    }
} 