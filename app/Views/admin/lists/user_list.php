<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<!-- Government Style Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-title">
                <i class="bi bi-people-fill me-2"></i>Kelola User Sistem
            </h1>
            <p class="page-subtitle mb-0">Manajemen user dan hak akses sistem informasi pasar modern</p>
        </div>
        <div class="col-auto">
            <a href="/admin/user/create" class="btn btn-primary">
                <i class="bi bi-person-plus me-2"></i>Tambah User
            </a>
        </div>
    </div>
</div>

<!-- Government Statistics -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-primary">
            <div class="stat-card-mini-icon">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count($users) ?></div>
                <div class="stat-card-mini-label">Total User</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-success">
            <div class="stat-card-mini-icon">
                <i class="bi bi-circle-fill"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count(array_filter($users, function($user) { return isset($user['status']) && $user['status'] == 'online'; })) ?></div>
                <div class="stat-card-mini-label">Sedang Online</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-warning">
            <div class="stat-card-mini-icon">
                <i class="bi bi-shield-check"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count(array_unique(array_column($users, 'role'))) ?></div>
                <div class="stat-card-mini-label">Level Akses</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-info">
            <div class="stat-card-mini-icon">
                <i class="bi bi-calendar-check"></i>
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
            <h3><i class="bi bi-table me-2"></i>Daftar User Sistem</h3>
                    </div>
        <div class="content-card-actions">
            <div class="input-group" style="max-width: 300px;">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                        </span>
                <input type="text" class="form-control" id="searchInput" placeholder="Cari user...">
            </div>
                    </div>
                </div>
                
    <div class="content-card-body">
        <?php if (empty($users)): ?>
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-people"></i>
                </div>
                <h4>Belum ada data user</h4>
                <p>Mulai dengan menambahkan user pertama untuk sistem</p>
                <a href="/admin/user/create" class="btn btn-primary">
                    <i class="bi bi-person-plus me-2"></i>Tambah User Pertama
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
                                <i class="bi bi-person me-2"></i>Informasi User
                            </th>
                            <th scope="col">
                                <i class="bi bi-shield me-2"></i>Level Akses
                            </th>
                            <th scope="col">
                                <i class="bi bi-circle me-2"></i>Status
                            </th>
                            <th scope="col">
                                <i class="bi bi-clock me-2"></i>Aktivitas Terakhir
                            </th>
                            <th scope="col">
                                <i class="bi bi-calendar me-2"></i>Tanggal Bergabung
                            </th>
                            <th scope="col" class="text-center" style="width: 150px;">
                                <i class="bi bi-gear me-2"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $index => $user): ?>
                            <tr class="user-row" data-username="<?= strtolower($user['username']) ?>" 
                                data-role="<?= strtolower($user['role']) ?>" 
                                data-status="<?= strtolower($user['status'] ?? 'offline') ?>">
                                <td class="text-center">
                                    <span class="badge bg-secondary"><?= $index + 1 ?></span>
                                </td>
                                <td>
                                    <div class="user-info-cell">
                                        <div class="user-avatar-mini">
                                            <i class="bi bi-person-circle"></i>
                        </div>
                                        <div class="user-details">
                                            <div class="user-name"><?= esc($user['username']) ?></div>
                                            <div class="user-email">
                                                <i class="bi bi-envelope me-1"></i>
                                                <?= esc($user['email'] ?? 'N/A') ?>
                        </div>
                        </div>
                    </div>
                                </td>
                                <td>
                                    <div class="role-badge role-<?= strtolower($user['role']) ?>">
                                        <i class="bi bi-shield-check me-1"></i>
                                        <?= ucfirst($user['role']) ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="status-indicator <?= $user['status'] ?? 'offline' ?>">
                                        <i class="bi bi-circle-fill me-1"></i>
                                        <?= ucfirst($user['status'] ?? 'Offline') ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="last-activity">
                                        <?php if (isset($user['last_login']) && $user['last_login']): ?>
                                            <i class="bi bi-clock me-1"></i>
                                            <?= date('d M Y H:i', strtotime($user['last_login'])) ?>
                                        <?php else: ?>
                                            <span class="text-muted">
                                                <i class="bi bi-clock me-1"></i>
                                                Belum pernah login
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="join-date">
                                        <i class="bi bi-calendar me-1"></i>
                                        <?= date('M Y', strtotime($user['created_at'] ?? 'now')) ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button type="button" class="btn btn-sm btn-outline-warning" 
                                                onclick="editUser(<?= $user['id'] ?>)" 
                                                title="Edit User">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                onclick="deleteUser(<?= $user['id'] ?>, '<?= esc($user['username']) ?>')" 
                                                title="Hapus User">
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
                            <span>Total: <strong><?= count($users) ?></strong> user</span>
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
    const userRows = document.querySelectorAll('.user-row');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        userRows.forEach(row => {
            const username = row.getAttribute('data-username');
            const role = row.getAttribute('data-role');
            const status = row.getAttribute('data-status');
            
            const matches = username.includes(searchTerm) || 
                           role.includes(searchTerm) || 
                           status.includes(searchTerm);
            
            row.style.display = matches ? '' : 'none';
        });
    });

    // User action functions
    window.editUser = function(id) {
        window.location.href = `/admin/user/edit/${id}`;
    };
    
    window.deleteUser = function(id, username) {
        if (confirm(`Apakah Anda yakin ingin menghapus user "${username}"?\n\nTindakan ini tidak dapat dibatalkan.`)) {
            window.location.href = `/admin/user/delete/${id}`;
        }
    };
});
</script>

<style>
/* Government Table Styles */
.government-table {
    border: 1px solid #dee2e6;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.government-table thead th {
    background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
    color: white;
    border: none;
    padding: 1rem;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.875rem;
    letter-spacing: 0.5px;
}

.government-table tbody tr {
    border-bottom: 1px solid #f1f5f9;
    transition: all 0.2s ease;
}

.government-table tbody tr:hover {
    background-color: #f8fafc;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.government-table tbody td {
    padding: 1rem;
    vertical-align: middle;
    border: none;
}

/* User Info Cell */
.user-info-cell {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.user-avatar-mini {
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

.user-details {
    flex: 1;
}

.user-name {
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.25rem;
}

.user-email {
    font-size: 0.875rem;
    color: #64748b;
}

/* Role Badge */
.role-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.375rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.role-badge.role-superadmin {
    background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
    color: white;
}

.role-badge.role-admin {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    color: white;
}

.role-badge.role-specialist {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
}

.role-badge.role-berita {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: white;
}

.role-badge.role-harga {
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    color: white;
}

.role-badge.role-galeri {
    background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);
    color: white;
}

/* Status Indicator */
.status-indicator {
    display: inline-flex;
    align-items: center;
    font-size: 0.875rem;
    font-weight: 500;
}

.status-indicator.online {
    color: #059669;
}

.status-indicator.offline {
    color: #6b7280;
}

.status-indicator i {
    font-size: 0.75rem;
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

/* Table Summary */
.table-summary {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 1rem;
    margin-top: 1rem;
}

.summary-item {
    display: flex;
    align-items: center;
    color: #64748b;
    font-size: 0.875rem;
        }

.summary-item i {
    color: #3b82f6;
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
    
    .user-info-cell {
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