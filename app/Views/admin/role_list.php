<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<!-- Header Section -->
<div class="page-header mb-4">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2 class="page-title">
                <i class="bi bi-shield-check me-2"></i>
                Daftar Role
            </h2>
            <p class="page-subtitle mb-0">Kelola semua role dalam sistem</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="/admin/role/create" class="btn btn-primary btn-lg">
                <i class="bi bi-plus-circle me-2"></i>
                Tambah Role
            </a>
        </div>
    </div>
</div>

<!-- Flash Messages -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i>
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('role_deactivation_warning')): ?>
    <?php $warning = session()->getFlashdata('role_deactivation_warning'); ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i>
        <strong>Peringatan:</strong> Role "<?= $warning['role_name'] ?>" telah dinonaktifkan.
        <br>
        <small class="text-muted">
            <?= $warning['affected_users'] ?> user terpengaruh: 
            <?= implode(', ', $warning['user_list']) ?>
        </small>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- Search and Filter Section -->
<div class="search-filter-section mb-4">
    <div class="row">
        <div class="col-md-6">
            <div class="search-box">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" id="searchRole" placeholder="Cari role...">
                </div>
            </div>
        </div>
        <div class="col-md-6 text-end">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-secondary active" data-filter="all">
                    <i class="bi bi-grid me-1"></i> Semua
                </button>
                <button type="button" class="btn btn-outline-secondary" data-filter="active">
                    <i class="bi bi-check-circle me-1"></i> Aktif
                </button>
                <button type="button" class="btn btn-outline-secondary" data-filter="inactive">
                    <i class="bi bi-x-circle me-1"></i> Tidak Aktif
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
                <i class="bi bi-shield-check"></i>
            </div>
            <div class="stat-card-mini-content">
                <h4 class="stat-card-mini-number"><?= count($roles) ?></h4>
                <p class="stat-card-mini-label">Total Role</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-success">
            <div class="stat-card-mini-icon">
                <i class="bi bi-check-circle"></i>
            </div>
            <div class="stat-card-mini-content">
                <h4 class="stat-card-mini-number"><?= count(array_filter($roles, function($r) { return $r['is_active'] == 1; })) ?></h4>
                <p class="stat-card-mini-label">Role Aktif</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-warning">
            <div class="stat-card-mini-icon">
                <i class="bi bi-x-circle"></i>
            </div>
            <div class="stat-card-mini-content">
                <h4 class="stat-card-mini-number"><?= count(array_filter($roles, function($r) { return $r['is_active'] == 0; })) ?></h4>
                <p class="stat-card-mini-label">Role Tidak Aktif</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-info">
            <div class="stat-card-mini-icon">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-card-mini-content">
                <h4 class="stat-card-mini-number">5</h4>
                <p class="stat-card-mini-label">Permission Types</p>
            </div>
        </div>
    </div>
</div>

<!-- Role Grid -->
<div class="role-grid" id="roleGrid">
    <div class="row">
        <?php foreach ($roles as $role): ?>
        <div class="col-lg-4 col-md-6 mb-4 role-item" data-status="<?= $role['is_active'] ? 'active' : 'inactive' ?>">
            <div class="user-card">
                <div class="user-card-header">
                    <div class="user-card-avatar">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div class="user-card-status <?= $role['is_active'] ? 'success' : 'danger' ?>">
                        <?= $role['is_active'] ? 'Aktif' : 'Tidak Aktif' ?>
                    </div>
                </div>
                
                <div class="user-card-body">
                    <h5 class="user-card-name"><?= esc(ucfirst($role['nama'])) ?></h5>
                    <p class="user-card-username"><?= esc($role['deskripsi']) ?></p>
                    
                    <div class="user-card-info">
                        <div class="info-item">
                            <i class="bi bi-calendar3"></i>
                            <span>Dibuat <?= date('d M Y', strtotime($role['created_at'])) ?></span>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-gear"></i>
                            <span><?php 
                                $permissions = json_decode($role['permissions'] ?? '[]', true);
                                $activePermissions = 0;
                                if (is_array($permissions)):
                                    foreach ($permissions as $permission => $enabled):
                                        if ($enabled === true):
                                            $activePermissions++;
                                        endif;
                                    endforeach;
                                endif;
                                echo $activePermissions . ' Permissions';
                            ?></span>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-people"></i>
                            <span><?php 
                                $adminModel = new \App\Models\AdminModel();
                                $userCount = $adminModel->where('role', $role['nama'])->countAllResults();
                                echo $userCount . ' User';
                            ?></span>
                        </div>
                    </div>
                    
                    <div class="user-card-permissions">
                        <?php 
                        $permissions = json_decode($role['permissions'] ?? '[]', true);
                        if (is_array($permissions) && !empty($permissions)):
                            $activePermissions = [];
                            foreach ($permissions as $permission => $enabled):
                                if ($enabled === true):
                                    $activePermissions[] = $permission;
                                endif;
                            endforeach;
                            
                            if (!empty($activePermissions)):
                                $displayedPermissions = 0;
                                foreach ($activePermissions as $permission):
                                    if ($displayedPermissions < 3): // Hanya tampilkan 3 permission pertama
                        ?>
                        <span class="permission-badge"><?= ucfirst(str_replace('_', ' ', $permission)) ?></span>
                        <?php 
                                        $displayedPermissions++;
                                    endif;
                                endforeach;
                                if (count($activePermissions) > 3):
                        ?>
                        <span class="permission-badge text-muted">+<?= count($activePermissions) - 3 ?> more</span>
                        <?php 
                                endif;
                            else:
                        ?>
                        <span class="text-muted small">Tidak ada permission aktif</span>
                        <?php 
                            endif;
                        else:
                        ?>
                        <span class="text-muted small">Tidak ada permission</span>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="user-card-footer">
                    <div class="user-card-actions">
                        <a href="/admin/role/edit/<?= $role['id'] ?>" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Edit Role">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete(<?= $role['id'] ?>, '<?= esc($role['nama']) ?>')" data-bs-toggle="tooltip" title="Hapus Role">
                            <i class="bi bi-trash"></i>
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
        <i class="bi bi-shield-check"></i>
    </div>
    <h4>Tidak ada role ditemukan</h4>
    <p class="text-muted">Coba ubah filter atau kata kunci pencarian Anda</p>
    <a href="/admin/role/create" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>
        Tambah Role Pertama
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
    const searchInput = document.getElementById('searchRole');
    const roleItems = document.querySelectorAll('.role-item');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        roleItems.forEach(item => {
            const name = item.querySelector('.user-card-name').textContent.toLowerCase();
            const description = item.querySelector('.user-card-username').textContent.toLowerCase();
            
            if (name.includes(searchTerm) || description.includes(searchTerm)) {
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
            roleItems.forEach(item => {
                const status = item.getAttribute('data-status');
                
                if (filter === 'all' || status === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
            
            updateEmptyState();
        });
    });

    function updateEmptyState() {
        const visibleItems = document.querySelectorAll('.role-item[style*="block"], .role-item:not([style*="none"])');
        const emptyState = document.getElementById('emptyState');
        
        if (visibleItems.length === 0) {
            emptyState.style.display = 'block';
        } else {
            emptyState.style.display = 'none';
        }
    }
});

function confirmDelete(id, nama) {
    if (confirm(`Yakin ingin menghapus role "${nama}"? Tindakan ini tidak dapat dibatalkan.`)) {
        window.location.href = `/admin/role/delete/${id}`;
    }
}
</script>

<?= $this->endSection() ?> 