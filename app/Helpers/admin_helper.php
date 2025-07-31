<?php

if (!function_exists('update_admin_activity')) {
    /**
     * Update admin activity timestamp
     */
    function update_admin_activity($admin_id) {
        try {
            $adminModel = new \App\Models\AdminModel();
            $adminModel->update($admin_id, [
                'last_activity' => date('Y-m-d H:i:s')
            ]);
        } catch (\Exception $e) {
            // Log error but don't break the application
            log_message('error', 'Failed to update admin activity: ' . $e->getMessage());
        }
    }
}

if (!function_exists('is_admin_online')) {
    /**
     * Check if admin is online (active within last 5 minutes)
     */
    function is_admin_online($last_activity) {
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
    /**
     * Get admin status text based on last activity
     */
    function get_admin_status_text($last_activity) {
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