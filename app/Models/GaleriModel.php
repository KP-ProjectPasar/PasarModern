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
        'status' => 'permit_empty|in_list[draft,published]'
    ];
    
    protected $validationMessages = [
        'judul' => [
            'required' => 'Judul galeri harus diisi',
            'min_length' => 'Judul galeri minimal 3 karakter',
            'max_length' => 'Judul galeri maksimal 100 karakter'
        ],
        'status' => [
            'in_list' => 'Status harus berupa draft atau published'
        ]
    ];
    
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
            $allGaleri = $this->select('id,gambar,views,status')->findAll();

            $stats = [
                'total_galeri' => 0,   // realtime based on uploaded image records/files
                'published'     => 0,
                'draft'         => 0,
                'total_views'   => 0,  // sum views for published items
            ];

            $uploadPath = rtrim(ROOTPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'galeri' . DIRECTORY_SEPARATOR;

            foreach ($allGaleri as $galeri) {
                $rawStatus = $galeri['status'] ?? null;
                $status = is_string($rawStatus) ? strtolower($rawStatus) : $rawStatus;

                // Count statuses exactly as stored
                if ($status === 'published') {
                    $stats['published']++;
                } elseif ($status === 'draft') {
                    $stats['draft']++;
                }

                // Consider an item a "real" photo only if there is a filename
                // and (optionally) the file exists on disk
                $filename = trim((string)($galeri['gambar'] ?? ''));
                if ($filename !== '') {
                    $fileExists = is_file($uploadPath . $filename);
                    if ($fileExists) {
                        $stats['total_galeri']++;
                    }
                }

                // Sum views for published only
                if ($status === 'published') {
                    $stats['total_views'] += (int)($galeri['views'] ?? 0);
                }
            }

            log_message('debug', '[GaleriModel::getDashboardStats] Items: ' . count($allGaleri) . ', Stats: ' . json_encode($stats));
            return $stats;
        } catch (\Exception $e) {
            log_message('error', '[GaleriModel::getDashboardStats] Error: ' . $e->getMessage());
            return [
                'total_galeri' => 0,
                'published' => 0,
                'draft' => 0,
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