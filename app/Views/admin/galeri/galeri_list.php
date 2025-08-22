<?= $this->extend('admin/layout') ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="/assets/css/admin/galeri/galeri-list-styles.css">
<script src="/assets/js/admin/galeri/galeri-list.js" defer></script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-title">
                <i class="bi bi-images me-2"></i>Kelola Galeri
            </h1>
            <p class="page-subtitle mb-0">Manajemen galeri foto untuk sistem informasi pasar modern</p>
        </div>
        <div class="col-auto">
            <a href="/admin/galeri/create" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Tambah Foto
            </a>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-primary">
            <div class="stat-card-mini-icon">
                <i class="bi bi-images"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= $stats['total_galeri'] ?? 0 ?></div>
                <div class="stat-card-mini-label">Total Foto</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-success">
            <div class="stat-card-mini-icon">
                <i class="bi bi-check-circle"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= $stats['published'] ?? 0 ?></div>
                <div class="stat-card-mini-label">Dipublikasikan</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-warning">
            <div class="stat-card-mini-icon">
                <i class="bi bi-clock"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= $stats['draft'] ?? 0 ?></div>
                <div class="stat-card-mini-label">Draft</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-info">
            <div class="stat-card-mini-icon">
                <i class="bi bi-eye"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= $stats['total_views'] ?? 0 ?></div>
                <div class="stat-card-mini-label">Total Views</div>
            </div>
        </div>
    </div>
</div>

<div class="content-card">
    <div class="content-card-header">
        <div class="content-card-title">
            <h3><i class="bi bi-table me-2"></i>Daftar Galeri</h3>
        </div>
        <div class="content-card-actions">
            <div class="input-group" style="max-width: 300px;">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control" id="searchInput" placeholder="Cari foto...">
            </div>
        </div>
    </div>
                
    <div class="content-card-body">
        <?php if (empty($galeri)): ?>
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-images"></i>
                </div>
                <h4>Belum ada data galeri</h4>
                <p>Mulai dengan menambahkan foto pertama untuk sistem</p>
                <a href="/admin/galeri/create" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Foto Pertama
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
                                <i class="bi bi-image me-2"></i>Informasi Foto
                            </th>
                            <th scope="col">
                                <i class="bi bi-circle me-2"></i>Status
                            </th>
                            <th scope="col">
                                <i class="bi bi-eye me-2"></i>Views
                            </th>
                            <th scope="col">
                                <i class="bi bi-calendar me-2"></i>Tanggal Upload
                            </th>

                            <th scope="col" class="text-center" style="width: 150px;">
                                <i class="bi bi-gear me-2"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (($galeri ?? []) as $index => $galeri): ?>
                            <tr class="galeri-row" data-title="<?= strtolower($galeri['judul']) ?>">
                                <td class="text-center">
                                    <span class="badge bg-secondary"><?= $index + 1 ?></span>
                                </td>
                                <td>
                                    <div class="galeri-info-cell">
                                        <div class="galeri-thumbnail">
                    <?php if ($galeri['gambar']): ?>
                                                <img src="/uploads/galeri/<?= esc($galeri['gambar']) ?>" 
                                                     alt="<?= esc($galeri['judul']) ?>" 
                                                     class="galeri-thumb">
                    <?php else: ?>
                                                <div class="galeri-placeholder">
                            <i class="bi bi-image"></i>
                        </div>
                    <?php endif; ?>
                                        </div>
                                        <div class="galeri-details">
                                            <div class="galeri-title"><?= esc($galeri['judul']) ?></div>

                                        </div>
                                    </div>
                                </td>
                                
                                <td>
                                    <div class="status-indicator">
                                        <?php 
                                        $statusRaw = $galeri['status'] ?? null;
                                        $status = is_string($statusRaw) ? strtolower($statusRaw) : $statusRaw; 
                                        if ($status === 'published'): 
                                        ?>
                                            <span class="badge bg-success">Published</span>
                                        <?php elseif ($status === 'draft'): ?>
                                            <span class="badge bg-warning">Draft</span>
                                        <?php elseif ($status === 'archived'): ?>
                                            <span class="badge bg-warning">Draft</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">—</span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                
                                <td>
                                    <div class="views-count">
                                        <i class="bi bi-eye me-1"></i>
                                        <?= $galeri['views'] ?? 0 ?> views
                                    </div>
                                </td>

                                <td>
                                    <div class="upload-date">
                                        <i class="bi bi-calendar me-1"></i>
                                        <?= date('d M Y', strtotime($galeri['created_at'] ?? 'now')) ?>
                                    </div>
                                </td>

                                <td>
                                    <div class="action-buttons">
                                        <div class="btn-group me-2" role="group">
                                            <?php if ($status !== 'draft'): ?>
                                                <a href="/admin/galeri/status/<?= $galeri['id'] ?>/draft" 
                                                   class="btn btn-sm btn-outline-warning" 
                                                   onclick="return confirm('Ubah status ke Draft?')"
                                                   title="Set Draft">
                                                    <i class="bi bi-clock"></i>
                                                </a>
                                            <?php endif; ?>
                                            
                                            <?php if ($status !== 'published'): ?>
                                                <a href="/admin/galeri/status/<?= $galeri['id'] ?>/published" 
                                                   class="btn btn-sm btn-outline-success" 
                                                   onclick="return confirm('Publish galeri ini?')"
                                                   title="Publish">
                                                    <i class="bi bi-check-circle"></i>
                                                </a>
                                            <?php endif; ?>
                                            
                                            
                                        </div>
                                        
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-outline-warning" 
                                                    onclick="editGaleri(<?= $galeri['id'] ?>)" 
                                                    title="Edit Foto">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger" 
                                                    onclick="confirmDelete(<?= $galeri['id'] ?>, '<?= esc($galeri['judul']) ?>')" 
                                                    title="Hapus Foto">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
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
                            <span>Total: <strong><?= isset($stats['total_galeri']) ? $stats['total_galeri'] : count($galeri) ?></strong> foto</span>
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

<!-- JavaScript sudah dipindah ke file terpisah -->

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="delete-modal">
    <div class="delete-modal-content">
        <div class="delete-modal-header">
            <h5 class="delete-modal-title">Konfirmasi Hapus</h5>
            <button type="button" class="delete-modal-close" onclick="closeDeleteModal()">&times;</button>
        </div>
        <div class="delete-modal-body">
            <p class="delete-modal-text">Anda yakin ingin menghapus foto "<span id="deleteGaleriTitle"></span>"?</p>
            <p class="delete-modal-warning">Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="delete-modal-footer">
            <button type="button" class="delete-modal-btn delete-modal-btn-cancel" onclick="closeDeleteModal()">Batal</button>
            <a href="#" id="deleteGaleriBtn" class="delete-modal-btn delete-modal-btn-delete">Hapus</a>
        </div>
    </div>
</div>

<?= $this->endSection() ?> 