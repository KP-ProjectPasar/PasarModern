<?php

if (!function_exists('update_admin_activity')) {
    function update_admin_activity($admin_id, $activity = 'general')
    {
        try {
            $adminModel = new \App\Models\AdminModel();
            $adminModel->update($admin_id, [
                'last_activity' => date('Y-m-d H:i:s')
            ]);
            return true;
        } catch (\Exception $e) {
            log_message('error', 'Failed to update admin activity: ' . $e->getMessage());
            return false;
        }
    }
}

if (!function_exists('is_admin_online')) {
    function is_admin_online($last_activity)
    {
        if (!$last_activity) {
            return false;
        }
        
        try {
            $lastActivity = strtotime($last_activity);
            $currentTime = time();
            
            // Consider online if activity within last 5 minutes
            return ($currentTime - $lastActivity) < 300;
        } catch (\Exception $e) {
            return false;
        }
    }
}

if (!function_exists('get_admin_status_text')) {
    function get_admin_status_text($last_activity)
    {
        if (!$last_activity) {
            return 'Belum pernah login';
        }
        
        try {
            if (is_admin_online($last_activity)) {
                return 'Online';
            }
            
            $lastActivity = strtotime($last_activity);
            $currentTime = time();
            $diffMinutes = floor(($currentTime - $lastActivity) / 60);
            
            if ($diffMinutes < 60) {
                return "Offline ({$diffMinutes} menit yang lalu)";
            } elseif ($diffMinutes < 1440) {
                $diffHours = floor($diffMinutes / 60);
                return "Offline ({$diffHours} jam yang lalu)";
            } else {
                $diffDays = floor($diffMinutes / 1440);
                return "Offline ({$diffDays} hari yang lalu)";
            }
        } catch (\Exception $e) {
            return 'Status tidak tersedia';
        }
    }
}

if (!function_exists('is_role_active')) {
    function is_role_active($role_name)
    {
        try {
            $roleModel = new \App\Models\RoleModel();
            $role = $roleModel->where('nama', $role_name)->first();
            
            return $role && $role['is_active'] == 1;
        } catch (\Exception $e) {
            log_message('error', 'Failed to check role status: ' . $e->getMessage());
            return false;
        }
    }
}

if (!function_exists('check_user_permissions')) {
    function check_user_permissions($user_role, $required_permission)
    {
        try {
            // Check if user role is active
            if (!is_role_active($user_role)) {
                return false;
            }
            
            // Get role permissions
            $roleModel = new \App\Models\RoleModel();
            $role = $roleModel->where('nama', $user_role)->first();
            
            if (!$role) {
                return false;
            }
            
            $permissions = json_decode($role['permissions'] ?? '[]', true);
            
            return in_array($required_permission, $permissions);
        } catch (\Exception $e) {
            log_message('error', 'Failed to check user permissions: ' . $e->getMessage());
            return false;
        }
    }
} 