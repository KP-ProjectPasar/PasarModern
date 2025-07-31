<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<!-- Header Section -->
<div class="page-header mb-4">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2 class="page-title">
                Daftar User Admin
            </h2>
            <p class="page-subtitle mb-0">Kelola semua user admin dalam sistem</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="/admin/user/create" class="btn btn-primary btn-lg">
                <i class="bi bi-plus-circle me-2"></i>
                Tambah User
            </a>
        </div>
    </div>
</div>

<!-- Search and Filter Section -->
<div class="search-filter-section mb-4">
    <div class="row">
        <div class="col-md-6">
            <div class="search-box">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" id="searchUser" placeholder="Cari user...">
                </div>
            </div>
        </div>
        <div class="col-md-6 text-end">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-secondary active" data-filter="all">
                    <i class="bi bi-grid me-1"></i> Semua
                </button>
                <button type="button" class="btn btn-outline-secondary" data-filter="superadmin">
                    <i class="bi bi-shield-check me-1"></i> Super Admin
                </button>
                <button type="button" class="btn btn-outline-secondary" data-filter="admin">
                    <i class="bi bi-person-gear me-1"></i> Admin
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-primary">
            <div class="stat-card-mini-icon">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-card-mini-content">
                <h4 class="stat-card-mini-number"><?= count($users) ?></h4>
                <p class="stat-card-mini-label">Total Users</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-success">
            <div class="stat-card-mini-icon">
                <i class="bi bi-shield-check"></i>
            </div>
            <div class="stat-card-mini-content">
                <h4 class="stat-card-mini-number"><?= count(array_filter($users, function($u) { return $u['level'] === 'superadmin'; })) ?></h4>
                <p class="stat-card-mini-label">Super Admin</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-warning">
            <div class="stat-card-mini-icon">
                <i class="bi bi-person-gear"></i>
            </div>
            <div class="stat-card-mini-content">
                <h4 class="stat-card-mini-number"><?= count(array_filter($users, function($u) { return $u['level'] === 'admin'; })) ?></h4>
                <p class="stat-card-mini-label">Admin</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-info">
            <div class="stat-card-mini-icon">
                <i class="bi bi-clock"></i>
            </div>
            <div class="stat-card-mini-content">
                <h4 class="stat-card-mini-number"><?= count(array_filter($users, function($u) { return $u['level'] === 'berita' || $u['level'] === 'harga' || $u['level'] === 'galeri'; })) ?></h4>
                <p class="stat-card-mini-label">Specialist</p>
            </div>
        </div>
    </div>
</div>

<!-- User Grid -->
<div class="user-grid" id="userGrid">
    <div class="row">
        <?php foreach ($users as $user): ?>
        <div class="col-lg-4 col-md-6 mb-4 user-item" data-level="<?= $user['level'] ?>">
            <div class="user-card">
                <div class="user-card-header">
                    <div class="user-card-avatar">
                        <i class="bi bi-person-circle"></i>
                    </div>
                    <div class="user-card-status <?= $user['level'] === 'superadmin' ? 'superadmin' : ($user['level'] === 'admin' ? 'admin' : 'specialist') ?>">
                        <?= esc($user['level']) ?>
                    </div>
                    <div class="user-card-online-status">
                        <?php
                        $isOnline = is_admin_online($user['last_activity'] ?? null);
                        $statusText = get_admin_status_text($user['last_activity'] ?? null);
                        ?>
                        <span class="status-indicator <?= $isOnline ? 'online' : 'offline' ?>">
                            <i class="bi bi-circle-fill"></i>
                            <?= $isOnline ? 'Online' : 'Offline' ?>
                        </span>
                    </div>
                </div>
                
                <div class="user-card-body">
                    <h5 class="user-card-name"><?= esc($user['nama']) ?></h5>
                    <p class="user-card-username">@<?= esc($user['username']) ?></p>
                    
                    <div class="user-card-info">
                        <div class="info-item">
                            <i class="bi bi-envelope"></i>
                            <span><?= esc($user['email'] ?? 'email@example.com') ?></span>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-clock"></i>
                            <span><?= $statusText ?></span>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-calendar3"></i>
                            <span>Bergabung <?= date('M Y', strtotime($user['created_at'] ?? 'now')) ?></span>
                        </div>
                    </div>
                    
                    <div class="user-card-permissions">
                        <?php
                        $permissions = [];
                        switch($user['level']) {
                            case 'superadmin':
                                $permissions = ['Semua Akses', 'User Management', 'System Settings'];
                                break;
                            case 'admin':
                                $permissions = ['Dashboard', 'Content Management', 'Reports'];
                                break;
                            case 'berita':
                                $permissions = ['Berita Management'];
                                break;
                            case 'harga':
                                $permissions = ['Harga Management'];
                                break;
                            case 'galeri':
                                $permissions = ['Galeri Management'];
                                break;
                        }
                        ?>
                        <?php foreach($permissions as $permission): ?>
                        <span class="permission-badge"><?= $permission ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div class="user-card-footer">
                    <div class="user-card-actions">
                        <a href="/admin/user/edit/<?= $user['id'] ?>" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Edit User">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete(<?= $user['id'] ?>, '<?= esc($user['nama']) ?>')" data-bs-toggle="tooltip" title="Hapus User">
                            <i class="bi bi-trash"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-info" onclick="showUserDetails('<?= esc($user['nama']) ?>', '<?= esc($user['level']) ?>')" data-bs-toggle="tooltip" title="Lihat Detail">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Empty State -->
<div class="empty-state" id="emptyState" style="display: none;">
    <div class="empty-state-icon">
        <i class="bi bi-people"></i>
    </div>
    <h4>Tidak ada user ditemukan</h4>
    <p class="text-muted">Coba ubah filter atau kata kunci pencarian Anda</p>
    <a href="/admin/user/create" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>
        Tambah User Pertama
    </a>
</div>

<script>
// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Search functionality
    const searchInput = document.getElementById('searchUser');
    const userItems = document.querySelectorAll('.user-item');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        userItems.forEach(item => {
            const name = item.querySelector('.user-card-name').textContent.toLowerCase();
            const username = item.querySelector('.user-card-username').textContent.toLowerCase();
            
            if (name.includes(searchTerm) || username.includes(searchTerm)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
        
        updateEmptyState();
    });

    // Filter functionality
    const filterButtons = document.querySelectorAll('[data-filter]');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Filter items
            userItems.forEach(item => {
                const level = item.getAttribute('data-level');
                
                if (filter === 'all' || level === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
            
            updateEmptyState();
        });
    });

    function updateEmptyState() {
        const visibleItems = document.querySelectorAll('.user-item[style*="block"], .user-item:not([style*="none"])');
        const emptyState = document.getElementById('emptyState');
        
        if (visibleItems.length === 0) {
            emptyState.style.display = 'block';
        } else {
            emptyState.style.display = 'none';
        }
    }
});

function confirmDelete(id, nama) {
    if (confirm(`Yakin ingin menghapus user "${nama}"? Tindakan ini tidak dapat dibatalkan.`)) {
        window.location.href = `/admin/user/delete/${id}`;
    }
}

function showUserDetails(nama, level) {
    const details = {
        'superadmin': 'Super Admin memiliki akses penuh ke semua fitur sistem termasuk manajemen user, pengaturan sistem, dan semua modul konten.',
        'admin': 'Admin memiliki akses ke dashboard, manajemen konten, dan laporan sistem.',
        'berita': 'Specialist Berita hanya memiliki akses ke manajemen berita dan publikasi konten.',
        'harga': 'Specialist Harga hanya memiliki akses ke manajemen harga komoditas.',
        'galeri': 'Specialist Galeri hanya memiliki akses ke manajemen galeri dan video.'
    };
    
    alert(`Detail User: ${nama} (${level})\n\n${details[level] || 'Tidak ada detail tersedia'}`);
}

// Auto-hide alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            if (alert.parentNode) {
                alert.remove();
            }
        }, 5000);
    });
});
</script>

<?= $this->endSection() ?> 