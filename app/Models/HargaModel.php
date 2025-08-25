<?php

namespace App\Models;

use CodeIgniter\Model;

class HargaModel extends Model
{
    protected $table = 'harga';
    protected $primaryKey = 'id';
    protected $allowedFields = ['komoditas_id', 'harga', 'satuan', 'tanggal', 'keterangan', 'created_at', 'updated_at'];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    // Validation rules
    protected $validationRules = [
        'komoditas' => 'required|min_length[3]|max_length[100]',
        'harga' => 'required|numeric|greater_than[0]',
        'tanggal' => 'required|valid_date'
    ];
    
    protected $validationMessages = [
        'komoditas' => [
            'required' => 'Nama komoditas harus diisi',
            'min_length' => 'Nama komoditas minimal 3 karakter',
            'max_length' => 'Nama komoditas maksimal 100 karakter'
        ],
        'harga' => [
            'required' => 'Harga harus diisi',
            'numeric' => 'Harga harus berupa angka',
            'greater_than' => 'Harga harus lebih dari 0'
        ],
        'tanggal' => [
            'required' => 'Tanggal harus diisi',
            'valid_date' => 'Format tanggal tidak valid'
        ]
    ];
    
    /**
     * Get latest prices by date
     */
    public function getLatestPrices()
    {
        try {
            return $this->orderBy('tanggal', 'DESC')
                        ->orderBy('created_at', 'DESC')
                        ->findAll();
        } catch (\Exception $e) {
            log_message('error', '[HargaModel::getLatestPrices] Error: ' . $e->getMessage());
            return [];
        }
    }
    
    /**
     * Get prices by commodity name
     */
    public function getPricesByCommodity($komoditas)
    {
        try {
            return $this->where('komoditas', $komoditas)
                        ->orderBy('tanggal', 'DESC')
                        ->findAll();
        } catch (\Exception $e) {
            log_message('error', '[HargaModel::getPricesByCommodity] Error: ' . $e->getMessage());
            return [];
        }
    }
}
