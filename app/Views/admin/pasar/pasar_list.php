<?= $this->extend('admin/layout') ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="/assets/css/admin/pasar/pasar-list-styles.css">
<script src="/assets/js/admin/pasar/pasar-list.js" defer></script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-title">
                <i class="bi bi-building-fill me-2"></i>Kelola Pasar
            </h1>
            <p class="page-subtitle mb-0">Manajemen data pasar dalam sistem informasi pasar modern</p>
        </div>
        <div class="col-auto">
            <a href="/admin/pasar/create" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Tambah Pasar
            </a>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-primary">
            <div class="stat-card-mini-icon">
                <i class="bi bi-building"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count($pasar) ?></div>
                <div class="stat-card-mini-label">Total Pasar</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-success">
            <div class="stat-card-mini-icon">
                <i class="bi bi-check-circle"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count(array_filter($pasar, function($p) { return isset($p['status']) && $p['status'] == 'aktif'; })) ?></div>
                <div class="stat-card-mini-label">Aktif</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-warning">
            <div class="stat-card-mini-icon">
                <i class="bi bi-exclamation-triangle"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count(array_filter($pasar, function($p) { return isset($p['status']) && $p['status'] == 'nonaktif'; })) ?></div>
                <div class="stat-card-mini-label">Nonaktif</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-danger">
            <div class="stat-card-mini-icon">
                <i class="bi bi-gear"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count(array_filter($pasar, function($p) { return isset($p['status']) && $p['status'] == 'maintenance'; })) ?></div>
                <div class="stat-card-mini-label">Maintenance</div>
            </div>
        </div>
    </div>
</div>

<!-- Flash Messages -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i>
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="content-card">
    <div class="content-card-header">
        <div class="content-card-title">
            <h3><i class="bi bi-table me-2"></i>Daftar Pasar</h3>
        </div>
        <div class="content-card-actions">
            <div class="input-group" style="max-width: 300px;">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control" id="searchInput" placeholder="Cari pasar...">
            </div>
        </div>
    </div>
                
    <div class="content-card-body">
        <?php if (empty($pasar)): ?>
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-building"></i>
                </div>
                <h4>Belum ada data pasar</h4>
                <p>Mulai dengan menambahkan pasar pertama untuk sistem</p>
                <a href="/admin/pasar/create" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Pasar Pertama
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
                                <i class="bi bi-building me-2"></i>Informasi Pasar
                            </th>
                            <th scope="col">
                                <i class="bi bi-geo-alt me-2"></i>Lokasi
                            </th>
                            <th scope="col">
                                <i class="bi bi-circle me-2"></i>Status
                            </th>
                            <th scope="col">
                                <i class="bi bi-clock me-2"></i>Jam Operasional
                            </th>
                            <th scope="col" class="text-center" style="width: 150px;">
                                <i class="bi bi-gear me-2"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (($pasar ?? []) as $index => $pasar_item): ?>
                            <tr class="pasar-row" data-name="<?= strtolower($pasar_item['nama_pasar']) ?>" 
                                data-status="<?= strtolower($pasar_item['status']) ?>">
                                <td class="text-center">
                                    <span class="badge bg-secondary"><?= $index + 1 ?></span>
                                </td>
                                <td>
                                    <div class="pasar-info-cell">
                                        <div class="pasar-icon-mini">
                                            <i class="bi bi-building"></i>
                </div>
                                        <div class="pasar-details">
                                            <div class="pasar-name"><?= esc($pasar_item['nama_pasar']) ?></div>
                                            <div class="pasar-phone">
                                                <i class="bi bi-telephone me-1"></i>
                                                <?= esc($pasar_item['telepon'] ?? 'N/A') ?>
                    </div>
                </div>
            </div>
                                </td>
                                <td>
                                    <div class="pasar-location">
                                        <i class="bi bi-geo-alt me-1"></i>
                                        <?= esc($pasar_item['alamat']) ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="status-indicator <?= $pasar_item['status'] ?>">
                                        <i class="bi bi-circle-fill me-1"></i>
                                        <?= ucfirst($pasar_item['status']) ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="operational-hours">
                                        <i class="bi bi-clock me-1"></i>
                                        <?php if (!empty($pasar_item['jam_buka']) && !empty($pasar_item['jam_tutup'])): ?>
                                            <?= date('H:i', strtotime($pasar_item['jam_buka'])) ?> - <?= date('H:i', strtotime($pasar_item['jam_tutup'])) ?>
                                        <?php else: ?>
                                            N/A
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button type="button" class="btn btn-sm btn-outline-warning" 
                                                onclick="editPasar(<?= $pasar_item['id'] ?>)" 
                                                title="Edit Data Pasar">
                            <i class="bi bi-pencil"></i>
                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                onclick="deletePasar(<?= $pasar_item['id'] ?>, '<?= esc($pasar_item['nama_pasar']) ?>')" 
                                                title="Hapus Data Pasar">
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
                    <div class="col-12 text-center">
                        <div class="summary-item">
                            <i class="bi bi-info-circle me-2"></i>
                            <span>Total: <strong><?= count($pasar ?? []) ?></strong> pasar</span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- JavaScript sudah dipindah ke file terpisah -->

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="delete-modal">
    <div class="delete-modal-content">
        <div class="delete-modal-header">
            <h5 class="delete-modal-title">Konfirmasi Hapus</h5>
            <button type="button" class="delete-modal-close" onclick="closeDeleteModal()">&times;</button>
        </div>
        <div class="delete-modal-body">
            <p class="delete-modal-text">Anda yakin ingin menghapus data pasar "<span id="deletePasarName"></span>"?</p>
            <p class="delete-modal-warning">Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="delete-modal-footer">
            <button type="button" class="delete-modal-btn delete-modal-btn-cancel" onclick="closeDeleteModal()">Batal</button>
            <a href="#" id="deletePasarBtn" class="delete-modal-btn delete-modal-btn-delete">Hapus</a>
        </div>
    </div>
</div>

<?= $this->endSection() ?> 