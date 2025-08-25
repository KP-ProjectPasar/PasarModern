<?= $this->extend('admin/layout') ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="/assets/css/admin/user/user-list-styles.css">
<script src="/assets/js/admin/user/user-list.js" defer></script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

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

<div class="row mb-4">
    <div class="col-md-4 mb-3">
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
    <div class="col-md-4 mb-3">
        <div class="stat-card-mini stat-card-success">
            <div class="stat-card-mini-icon">
                <i class="bi bi-circle-fill"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count(array_filter($users, function($user) { return isset($user['current_status']) && $user['current_status'] == 'online'; })) ?></div>
                <div class="stat-card-mini-label">Sedang Online</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stat-card-mini stat-card-warning">
            <div class="stat-card-mini-icon">
                <i class="bi bi-shield-check"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count(array_unique(array_column($users, 'role'))) ?></div>
                <div class="stat-card-mini-label">Role</div>
            </div>
        </div>
    </div>
</div>

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
                <table class="table table-hover admin-table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="text-center" style="width: 50px;">
                                <i class="bi bi-hash"></i>
                            </th>
                            <th scope="col">
                                <i class="bi bi-person me-2"></i>Informasi User
                            </th>
                            <th scope="col">
                                <i class="bi bi-shield me-2"></i>Role
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
                                data-status="<?= strtolower($user['current_status'] ?? 'offline') ?>">
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
                                    <div class="status-indicator <?= $user['current_status'] ?? 'offline' ?>">
                                        <i class="bi bi-circle-fill me-1"></i>
                                        <?= ucfirst($user['current_status'] ?? 'Offline') ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="last-activity">
                                        <?php if (isset($user['last_activity']) && $user['last_activity']): ?>
                                            <i class="bi bi-clock me-1"></i>
                                            <?= date('d M Y H:i', strtotime($user['last_activity'])) ?>
                                        <?php else: ?>
                                            <span class="text-muted">
                                                <i class="bi bi-clock me-1"></i>
                                                Belum ada aktivitas
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

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="delete-modal">
    <div class="delete-modal-content">
        <div class="delete-modal-header">
            <h5 class="delete-modal-title">Konfirmasi Hapus</h5>
            <button type="button" class="delete-modal-close" onclick="closeDeleteModal()">&times;</button>
        </div>
        <div class="delete-modal-body">
            <p class="delete-modal-text">Anda yakin ingin menghapus user "<span id="deleteUserTitle"></span>"?</p>
            <p class="delete-modal-warning">Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="delete-modal-footer">
            <button type="button" class="delete-modal-btn delete-modal-btn-cancel" onclick="closeDeleteModal()">Batal</button>
            <a href="#" id="deleteUserBtn" class="delete-modal-btn delete-modal-btn-delete">Hapus</a>
        </div>
    </div>
    </div>

<?= $this->endSection() ?> 