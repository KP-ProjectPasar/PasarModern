<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<!-- Government Style Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-title">
                <i class="bi bi-shield-check me-2"></i>Kelola Role Sistem
            </h1>
            <p class="page-subtitle mb-0">Manajemen role dan hak akses sistem informasi pasar modern</p>
        </div>
        <div class="col-auto">
            <a href="/admin/role/create" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Tambah Role
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

<!-- Government Statistics -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-primary">
            <div class="stat-card-mini-icon">
                <i class="bi bi-shield-check"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count($roles) ?></div>
                <div class="stat-card-mini-label">Total Role</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-success">
            <div class="stat-card-mini-icon">
                <i class="bi bi-check-circle"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count(array_filter($roles, function($role) { return $role['is_active'] == 1; })) ?></div>
                <div class="stat-card-mini-label">Role Aktif</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-warning">
            <div class="stat-card-mini-icon">
                <i class="bi bi-x-circle"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count(array_filter($roles, function($role) { return $role['is_active'] == 0; })) ?></div>
                <div class="stat-card-mini-label">Role Nonaktif</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-info">
            <div class="stat-card-mini-icon">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= date('d') ?></div>
                <div class="stat-card-mini-label">Update Hari Ini</div>
            </div>
        </div>
    </div>
</div>

<!-- Government Style Table -->
<div class="content-card">
    <div class="content-card-header">
        <div class="content-card-title">
            <h3><i class="bi bi-table me-2"></i>Daftar Role Sistem</h3>
        </div>
        <div class="content-card-actions">
            <div class="input-group" style="max-width: 300px;">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control" id="searchInput" placeholder="Cari role...">
            </div>
        </div>
    </div>
    
    <div class="content-card-body">
        <?php if (empty($roles)): ?>
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h4>Belum ada data role</h4>
                <p>Mulai dengan menambahkan role pertama untuk sistem</p>
                <a href="/admin/role/create" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Role Pertama
                </a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover government-table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="text-center" style="width: 50px;">
                                <i class="bi bi-hash"></i>
                            </th>
                            <th scope="col">
                                <i class="bi bi-shield me-2"></i>Informasi Role
                            </th>
                            <th scope="col">
                                <i class="bi bi-key me-2"></i>Permissions
                            </th>
                            <th scope="col">
                                <i class="bi bi-circle me-2"></i>Status
                            </th>
                            <th scope="col">
                                <i class="bi bi-people me-2"></i>Jumlah User
                            </th>
                            <th scope="col">
                                <i class="bi bi-calendar me-2"></i>Tanggal Dibuat
                            </th>
                            <th scope="col" class="text-center" style="width: 150px;">
                                <i class="bi bi-gear me-2"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($roles as $index => $role): ?>
                            <tr class="role-row" data-name="<?= strtolower($role['nama']) ?>" 
                                data-status="<?= $role['is_active'] ? 'active' : 'inactive' ?>">
                                <td class="text-center">
                                    <span class="badge bg-secondary"><?= $index + 1 ?></span>
                                </td>
                                <td>
                                    <div class="role-info-cell">
                                        <div class="role-icon-mini">
                                            <i class="bi bi-shield-check"></i>
                                        </div>
                                        <div class="role-details">
                                            <div class="role-name"><?= esc($role['nama']) ?></div>
                                            <div class="role-description">
                                                <i class="bi bi-info-circle me-1"></i>
                                                <?= esc($role['deskripsi'] ?? 'Tidak ada deskripsi') ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="permissions-display">
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
                                                    if ($displayedPermissions < 3):
                                        ?>
                                        <span class="permission-badge-mini"><?= ucfirst(str_replace('_', ' ', $permission)) ?></span>
                                        <?php 
                                                        $displayedPermissions++;
                                                    endif;
                                                endforeach;
                                                if (count($activePermissions) > 3):
                                        ?>
                                        <span class="permission-badge-mini text-muted">+<?= count($activePermissions) - 3 ?></span>
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
                                </td>
                                <td>
                                    <div class="status-indicator <?= $role['is_active'] ? 'active' : 'inactive' ?>">
                                        <i class="bi bi-circle-fill me-1"></i>
                                        <?= $role['is_active'] ? 'Aktif' : 'Nonaktif' ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="user-count">
                                        <?php 
                                        $adminModel = new \App\Models\AdminModel();
                                        $userCount = $adminModel->where('role', $role['nama'])->countAllResults();
                                        ?>
                                        <i class="bi bi-people me-1"></i>
                                        <?= $userCount ?> user
                                    </div>
                                </td>
                                <td>
                                    <div class="created-date">
                                        <i class="bi bi-calendar me-1"></i>
                                        <?= date('d M Y', strtotime($role['created_at'])) ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button type="button" class="btn btn-sm btn-outline-warning" 
                                                onclick="editRole(<?= $role['id'] ?>)" 
                                                title="Edit Role">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                onclick="deleteRole(<?= $role['id'] ?>, '<?= esc($role['nama']) ?>')" 
                                                title="Hapus Role">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Government Style Summary -->
            <div class="table-summary mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="summary-item">
                            <i class="bi bi-info-circle me-2"></i>
                            <span>Total: <strong><?= count($roles) ?></strong> role</span>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="summary-item">
                            <i class="bi bi-clock me-2"></i>
                            <span>Update terakhir: <strong><?= date('d M Y H:i') ?></strong></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const roleRows = document.querySelectorAll('.role-row');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        roleRows.forEach(row => {
            const name = row.getAttribute('data-name');
            const status = row.getAttribute('data-status');
            
            const matches = name.includes(searchTerm) || 
                           status.includes(searchTerm);
            
            row.style.display = matches ? '' : 'none';
        });
    });
    
    // Role action functions
    window.editRole = function(id) {
        window.location.href = `/admin/role/edit/${id}`;
    };
    
    window.deleteRole = function(id, name) {
        if (confirm(`Apakah Anda yakin ingin menghapus role "${name}"?\n\nTindakan ini tidak dapat dibatalkan.`)) {
            window.location.href = `/admin/role/delete/${id}`;
        }
    };
});
</script>

<style>
/* Government Table Styles for Role */
.role-info-cell {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.role-icon-mini {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.role-details {
    flex: 1;
}

.role-name {
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.25rem;
}

.role-description {
    font-size: 0.875rem;
    color: #64748b;
}

.permissions-display {
    display: flex;
    flex-wrap: wrap;
    gap: 0.25rem;
}

.permission-badge-mini {
    display: inline-block;
    padding: 0.25rem 0.5rem;
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    font-size: 0.75rem;
    color: #475569;
    font-weight: 500;
}

.status-indicator.active {
    color: #059669;
}

.status-indicator.inactive {
    color: #6b7280;
}

.status-indicator i {
    font-size: 0.75rem;
}

.user-count {
    font-size: 0.875rem;
    color: #64748b;
}

.created-date {
    font-size: 0.875rem;
    color: #64748b;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
}

.action-buttons .btn {
    width: 36px;
    height: 36px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    transition: all 0.2s ease;
    font-size: 0.875rem;
}

.action-buttons .btn:hover {
    transform: scale(1.1);
}

.action-buttons .btn-outline-warning:hover {
    background-color: #f59e0b;
    border-color: #f59e0b;
    color: white;
}

.action-buttons .btn-outline-danger:hover {
    background-color: #dc2626;
    border-color: #dc2626;
    color: white;
}

/* Responsive */
@media (max-width: 768px) {
    .government-table {
        font-size: 0.875rem;
    }
    
    .government-table thead th,
    .government-table tbody td {
        padding: 0.75rem 0.5rem;
    }
    
    .role-info-cell {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 0.25rem;
    }
}
</style>

<?= $this->endSection() ?> 