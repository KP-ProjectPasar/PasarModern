<?php
namespace App\Models;
use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama', 
        'deskripsi', 
        'permissions', 
        'is_active', 
        'created_at', 
        'updated_at'
    ];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Get active roles only
    public function getActiveRoles()
    {
        return $this->where('is_active', 1)->findAll();
    }

    // Get role by name
    public function getRoleByName($nama)
    {
        return $this->where('nama', $nama)->where('is_active', 1)->first();
    }

    // Get permissions for a role
    public function getRolePermissions($roleId)
    {
        $role = $this->find($roleId);
        if ($role && $role['permissions']) {
            return json_decode($role['permissions'], true);
        }
        return [];
    }

    // Set permissions for a role
    public function setRolePermissions($roleId, $permissions)
    {
        return $this->update($roleId, [
            'permissions' => json_encode($permissions)
        ]);
    }
} 