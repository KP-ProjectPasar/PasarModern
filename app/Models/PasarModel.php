<?php

namespace App\Models;

use CodeIgniter\Model;

class PasarModel extends Model
{
    protected $table            = 'pasar';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_pasar',
        'alamat',
        'deskripsi',
        'telepon',
        'email',
        'jam_buka',
        'jam_tutup',
        'status'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'nama_pasar' => 'required|min_length[3]|max_length[255]',
        'alamat'     => 'required|min_length[10]',
        'telepon'    => 'permit_empty|min_length[10]|max_length[20]',
        'email'      => 'permit_empty|valid_email|max_length[255]',
        'status'     => 'required|in_list[aktif,nonaktif,maintenance]'
    ];
    protected $validationMessages   = [
        'nama_pasar' => [
            'required'   => 'Nama pasar wajib diisi',
            'min_length' => 'Nama pasar minimal 3 karakter',
            'max_length' => 'Nama pasar maksimal 255 karakter'
        ],
        'alamat' => [
            'required'   => 'Alamat wajib diisi',
            'min_length' => 'Alamat minimal 10 karakter'
        ],
        'telepon' => [
            'min_length' => 'Nomor telepon minimal 10 digit',
            'max_length' => 'Nomor telepon maksimal 20 digit'
        ],
        'email' => [
            'valid_email' => 'Format email tidak valid',
            'max_length'  => 'Email maksimal 255 karakter'
        ],
        'status' => [
            'required' => 'Status wajib dipilih',
            'in_list'  => 'Status tidak valid'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Get active markets
     */
    public function getActiveMarkets()
    {
        return $this->where('status', 'aktif')
                    ->orderBy('nama_pasar', 'ASC')
                    ->findAll();
    }

    /**
     * Get market by status
     */
    public function getMarketsByStatus($status)
    {
        return $this->where('status', $status)
                    ->orderBy('nama_pasar', 'ASC')
                    ->findAll();
    }

    /**
     * Get dashboard stats
     */
    public function getDashboardStats()
    {
        try {
            $total = $this->countAllResults();
            $aktif = $this->where('status', 'aktif')->countAllResults();
            $nonaktif = $this->where('status', 'nonaktif')->countAllResults();
            $maintenance = $this->where('status', 'maintenance')->countAllResults();

            return [
                'total_pasar' => $total,
                'aktif' => $aktif,
                'nonaktif' => $nonaktif,
                'maintenance' => $maintenance
            ];
        } catch (\Exception $e) {
            log_message('error', '[PasarModel::getDashboardStats] Error: ' . $e->getMessage());
            return [
                'total_pasar' => 0,
                'aktif' => 0,
                'nonaktif' => 0,
                'maintenance' => 0
            ];
        }
    }

    /**
     * Search markets
     */
    public function searchMarkets($keyword)
    {
        return $this->like('nama_pasar', $keyword)
                    ->orLike('alamat', $keyword)
                    ->orLike('deskripsi', $keyword)
                    ->orderBy('nama_pasar', 'ASC')
                    ->findAll();
    }
}
