<?php

if (!function_exists('checkPermission')) {
    /**
     * Check if current user has permission for specific action
     * 
     * @param string $permission Permission name
     * @return bool
     */
    function checkPermission($permission)
    {
        $currentRole = session()->get('admin_role');
        
        if (!$currentRole) {
            return false;
        }
        
        // Superadmin has all permissions
        if (strtolower($currentRole) === 'superadmin') {
            return true;
        }
        
        try {
            $roleModel = new \App\Models\RoleModel();
            $role = $roleModel->getRoleByName($currentRole);
            
            if ($role && !empty($role['permissions'])) {
                $permissions = json_decode($role['permissions'], true) ?: [];
                return isset($permissions[$permission]) && $permissions[$permission] === true;
            }
        } catch (\Exception $e) {
            log_message('error', 'Permission check error: ' . $e->getMessage());
        }
        
        return false;
    }
}

if (!function_exists('requirePermission')) {
    /**
     * Require permission or redirect with error
     * 
     * @param string $permission Permission name
     * @param string $redirectUrl Redirect URL if no permission
     * @return void
     */
    function requirePermission($permission, $redirectUrl = '/admin/dashboard')
    {
        if (!checkPermission($permission)) {
            session()->setFlashdata('error', 'Anda tidak memiliki akses untuk fitur ini!');
            return redirect()->to($redirectUrl);
        }
    }
}

if (!function_exists('getCurrentPermissions')) {
    /**
     * Get all permissions for current user
     * 
     * @return array
     */
    function getCurrentPermissions()
    {
        $currentRole = session()->get('admin_role');
        $permissions = [
            'user_management' => false,
            'role_management' => false,
            'berita_management' => false,
            'galeri_management' => false,
            'video_management' => false,
            'pasar_management' => false,
            'harga_management' => false,
            'feedback_management' => false,
        ];
        
        if (!$currentRole) {
            return $permissions;
        }
        
        // Superadmin has all permissions
        if (strtolower($currentRole) === 'superadmin') {
            foreach ($permissions as $k => $v) {
                $permissions[$k] = true;
            }
            return $permissions;
        }
        
        try {
            $roleModel = new \App\Models\RoleModel();
            $role = $roleModel->getRoleByName($currentRole);
            
            if ($role && !empty($role['permissions'])) {
                $decoded = json_decode($role['permissions'], true) ?: [];
                $permissions = array_merge($permissions, $decoded);
            }
        } catch (\Exception $e) {
            log_message('error', 'Get permissions error: ' . $e->getMessage());
        }
        
        return $permissions;
    }
}
