<?php

namespace App\Models;

use CodeIgniter\Model;

class FeedbackModel extends Model
{
    protected $table            = 'feedbacks';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama',
        'email',
        'telepon',
        'subjek',
        'pesan',
        'jenis_feedback',
        'file_lampiran',
        'status',
        'ip_address',
        'user_agent'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'nama' => 'required|min_length[3]|max_length[100]',
        'email' => 'required|valid_email|max_length[100]',
        'telepon' => 'permit_empty|min_length[10]|max_length[15]',
        'subjek' => 'required|min_length[5]|max_length[200]',
        'pesan' => 'required|min_length[10]|max_length[1000]',
        'jenis_feedback' => 'required|in_list[keluhan,saran,pujian,laporan,pertanyaan]',
        'status' => 'permit_empty|in_list[pending,dibaca,dibalas,selesai]'
    ];

    protected $validationMessages = [
        'nama' => [
            'required' => 'Nama wajib diisi',
            'min_length' => 'Nama minimal 3 karakter',
            'max_length' => 'Nama maksimal 100 karakter'
        ],
        'email' => [
            'required' => 'Email wajib diisi',
            'valid_email' => 'Format email tidak valid',
            'max_length' => 'Email maksimal 100 karakter'
        ],
        'telepon' => [
            'min_length' => 'Nomor telepon minimal 10 digit',
            'max_length' => 'Nomor telepon maksimal 15 digit'
        ],
        'subjek' => [
            'required' => 'Subjek wajib diisi',
            'min_length' => 'Subjek minimal 5 karakter',
            'max_length' => 'Subjek maksimal 200 karakter'
        ],
        'pesan' => [
            'required' => 'Pesan wajib diisi',
            'min_length' => 'Pesan minimal 10 karakter',
            'max_length' => 'Pesan maksimal 1000 karakter'
        ],
        'jenis_feedback' => [
            'required' => 'Jenis feedback wajib dipilih',
            'in_list' => 'Jenis feedback tidak valid'
        ]
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['setDefaultValues'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function setDefaultValues(array $data)
    {
        if (!isset($data['data']['status'])) {
            $data['data']['status'] = 'pending';
        }
        
        if (!isset($data['data']['ip_address'])) {
            $data['data']['ip_address'] = $this->request->getIPAddress();
        }
        
        if (!isset($data['data']['user_agent'])) {
            $data['data']['user_agent'] = $this->request->getUserAgent()->getAgentString();
        }
        
        return $data;
    }
}
