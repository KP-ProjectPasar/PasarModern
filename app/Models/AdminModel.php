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
        'role', 
        'email',
        'last_login', 
        'last_activity', 
        'created_at', 
        'updated_at'
    ];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    // Disable model-level validation to avoid conflict with controller validations
    // Controller handles stricter, context-aware validation for create/update
    protected $skipValidation = true;

    // Keep rules/messages for reference if needed elsewhere (not enforced by model)
    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[50]',
        'email' => 'required|valid_email',
        'password' => 'permit_empty|min_length[6]',
        'role' => 'required|max_length[50]'
    ];
    
    protected $validationMessages = [
        'username' => [
            'required' => 'Username harus diisi',
            'min_length' => 'Username minimal 3 karakter',
            'max_length' => 'Username maksimal 50 karakter',
            'is_unique' => 'Username sudah digunakan'
        ],
        'email' => [
            'required' => 'Email harus diisi',
            'valid_email' => 'Format email tidak valid',
            'is_unique' => 'Email sudah digunakan'
        ],
        'password' => [
            'required' => 'Password harus diisi',
            'min_length' => 'Password minimal 6 karakter'
        ],
        'role' => [
            'required' => 'Role harus diisi',
            'max_length' => 'Role maksimal 50 karakter'
        ]
    ];
    
    /**
     * Hash password before insert/update
     */
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];
    
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }
    
    /**
     * Update last activity timestamp
     */
    public function updateLastActivity($adminId)
    {
        return $this->update($adminId, [
            'last_activity' => date('Y-m-d H:i:s')
        ]);
    }
    
    /**
     * Update last login timestamp
     */
    public function updateLastLogin($adminId)
    {
        return $this->update($adminId, [
            'last_login' => date('Y-m-d H:i:s'),
            'last_activity' => date('Y-m-d H:i:s')
        ]);
    }
    
    /**
     * Get admin status based on last activity
     */
    public function getAdminStatus($adminId)
    {
        $admin = $this->find($adminId);
        if (!$admin) {
            return 'unknown';
        }
        
        $lastActivity = strtotime($admin['last_activity']);
        $now = time();
        $timeDiff = $now - $lastActivity;
        
        // Jika tidak ada aktivitas dalam 30 menit terakhir, dianggap offline
        if ($timeDiff > 1800) { // 30 menit = 1800 detik
            return 'offline';
        }
        
        return 'online';
    }
    
    /**
     * Get all admins with their current status
     */
    public function getAdminsWithStatus()
    {
        $admins = $this->findAll();
        
        foreach ($admins as &$admin) {
            $admin['current_status'] = $this->getAdminStatus($admin['id']);
        }
        
        return $admins;
    }
} 