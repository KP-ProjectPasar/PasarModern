<?= $this->extend('admin/layout') ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="/assets/css/admin/role/role-list-styles.css">
<script src="/assets/js/admin/role/role-list.js" defer></script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-title">
                <i class="bi bi-shield-fill me-2"></i>Kelola Role
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

<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="stat-card-mini stat-card-primary">
            <div class="stat-card-mini-icon">
                <i class="bi bi-shield"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count($roles) ?></div>
                <div class="stat-card-mini-label">Total Role</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stat-card-mini stat-card-success">
            <div class="stat-card-mini-icon">
                <i class="bi bi-check-circle"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count(array_filter($roles, function($role) { return isset($role['is_active']) && $role['is_active'] == 1; })) ?></div>
                <div class="stat-card-mini-label">Aktif</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stat-card-mini stat-card-warning">
            <div class="stat-card-mini-icon">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= array_sum(array_column($roles, 'user_count') ?? []) ?></div>
                <div class="stat-card-mini-label">Total User</div>
            </div>
        </div>
    </div>
</div>

<div class="content-card">
    <div class="content-card-header">
        <div class="content-card-title">
            <h3><i class="bi bi-table me-2"></i>Daftar Role</h3>
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
                    <i class="bi bi-shield"></i>
                </div>
                <h4>Belum ada data role</h4>
                <p>Mulai dengan menambahkan role pertama untuk sistem</p>
                <a href="/admin/role/create" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Role Pertama
                </a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover admin-table">
                    <thead>
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

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="delete-modal">
    <div class="delete-modal-content">
        <div class="delete-modal-header">
            <h5 class="delete-modal-title">Konfirmasi Hapus</h5>
            <button type="button" class="delete-modal-close" onclick="closeDeleteModal()">&times;</button>
        </div>
        <div class="delete-modal-body">
            <p class="delete-modal-text">Anda yakin ingin menghapus role "<span id="deleteRoleTitle"></span>"?</p>
            <p class="delete-modal-warning">Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="delete-modal-footer">
            <button type="button" class="delete-modal-btn delete-modal-btn-cancel" onclick="closeDeleteModal()">Batal</button>
            <a href="#" id="deleteRoleBtn" class="delete-modal-btn delete-modal-btn-delete">Hapus</a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
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
    
    window.editRole = function(id) {
        window.location.href = `/admin/role/edit/${id}`;
    };
    
    window.deleteRole = function(id, name) {
        const titleEl = document.getElementById('deleteRoleTitle');
        const btnEl = document.getElementById('deleteRoleBtn');
        const modal = document.getElementById('deleteModal');
        if (titleEl && btnEl && modal) {
            titleEl.textContent = name;
            btnEl.href = `/admin/role/delete/${id}`;
            modal.classList.add('show');

            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeDeleteModal();
                }
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeDeleteModal();
                }
            });
        } else {
            if (confirm(`Apakah Anda yakin ingin menghapus role "${name}"?\n\nTindakan ini tidak dapat dibatalkan.`)) {
                window.location.href = `/admin/role/delete/${id}`;
            }
        }
    };

    window.closeDeleteModal = function() {
        const modal = document.getElementById('deleteModal');
        if (modal) modal.classList.remove('show');
    }
});
</script>

<?= $this->endSection() ?> 