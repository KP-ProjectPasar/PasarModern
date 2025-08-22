<?= $this->extend('admin/layout') ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="/assets/css/admin/berita/berita-list-styles.css">
<script src="/assets/js/admin/berita/berita-list.js" defer></script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-title">
                <i class="bi bi-newspaper me-2"></i>Kelola Berita
            </h1>
            <p class="page-subtitle mb-0">Manajemen berita dan informasi pasar modern</p>
        </div>
        <div class="col-auto">
            <a href="/admin/berita/create" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Tambah Berita
            </a>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-primary">
            <div class="stat-card-mini-icon">
                <i class="bi bi-newspaper"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= $stats['total_berita'] ?? 0 ?></div>
                <div class="stat-card-mini-label">Total Berita</div>
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
            <h3><i class="bi bi-table me-2"></i>Daftar Berita</h3>
        </div>
        <div class="content-card-actions">
            <div class="input-group" style="max-width: 300px;">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control" id="searchInput" placeholder="Cari berita...">
            </div>
        </div>
    </div>
                
    <div class="content-card-body">
        <?php if (empty($berita)): ?>
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-newspaper"></i>
                </div>
                <h4>Belum ada data berita</h4>
                <p>Mulai dengan menambahkan berita pertama untuk sistem</p>
                <a href="/admin/berita/create" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Berita Pertama
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
                                <i class="bi bi-newspaper me-2"></i>Informasi Berita
                            </th>
                            <th scope="col">
                                <i class="bi bi-person me-2"></i>Penulis
                            </th>
                            <th scope="col">
                                <i class="bi bi-circle me-2"></i>Status
                            </th>
                            <th scope="col">
                                <i class="bi bi-eye me-2"></i>Views
                            </th>
                            <th scope="col">
                                <i class="bi bi-calendar me-2"></i>Tanggal Publikasi
                            </th>
                            <th scope="col" class="text-center" style="width: 150px;">
                                <i class="bi bi-gear me-2"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (($berita ?? []) as $index => $item): ?>
                            <tr class="berita-row" data-title="<?= strtolower($item['judul']) ?>" 
                                data-status="<?= strtolower($item['status']) ?>">
                                <td class="text-center">
                                    <span class="badge bg-secondary"><?= $index + 1 ?></span>
                                </td>
                                <td>
                                    <div class="berita-info-cell">
                                        <div class="berita-thumbnail">
                                            <?php if ($item['gambar']): ?>
                                                <img src="/uploads/berita/<?= esc($item['gambar']) ?>" 
                                                     alt="<?= esc($item['judul']) ?>" 
                                                     class="berita-thumb">
                                            <?php else: ?>
                                                <div class="berita-placeholder">
                                                    <i class="bi bi-newspaper"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="berita-details">
                                            <div class="berita-title"><?= esc($item['judul']) ?></div>
                                            <div class="berita-excerpt">
                                                <?= esc(substr($item['isi'] ?? '', 0, 100)) ?>...
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="berita-author">
                                        <i class="bi bi-person me-1"></i>
                                        <?= esc($item['penulis'] ?? 'Admin') ?>
                                    </div>
                                </td>
                                <td>
                                    <?php 
                                        // Normalisasi status, dan fallback tegas ke 'draft' bila kosong/tidak dikenal
                                        $rawStatus = strtolower(trim((string)($item['status'] ?? '')));
                                        $statusAliases = [
                                            'draft' => 'draft',
                                            'drft' => 'draft',
                                            'published' => 'published',
                                            'publish' => 'published',
                                            'pub' => 'published',
                                            // Map berbagai bentuk "arsip" ke draft agar tetap tampil
                                            'archived' => 'draft',
                                            'archive' => 'draft',
                                            'arsip' => 'draft',
                                            'arsipkan' => 'draft'
                                        ];
                                        $mappedStatus = $statusAliases[$rawStatus] ?? null;
                                        $allowedStatuses = ['draft', 'published'];
                                        $normalizedStatus = in_array($mappedStatus, $allowedStatuses, true)
                                            ? $mappedStatus
                                            : 'draft';
                                        $statusLabels = [
                                            'draft' => 'Draft',
                                            'published' => 'Published'
                                        ];
                                        $label = $statusLabels[$normalizedStatus];
                                    ?>
                                    <div class="status-indicator <?= esc($normalizedStatus) ?>" aria-label="Status: <?= esc($label) ?>">
                                        <i class="bi bi-circle-fill me-1"></i>
                                        <span class="status-text"><?= esc($label) ?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="berita-views">
                                        <i class="bi bi-eye me-1"></i>
                                        <?= $item['views'] ?? 0 ?> views
                                    </div>
                                </td>
                                <td>
                                    <div class="publish-date">
                                        <i class="bi bi-calendar me-1"></i>
                                        <?= date('d M Y', strtotime($item['created_at'] ?? 'now')) ?>
                        </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <!-- Quick Status Change -->
                                        <div class="btn-group me-2" role="group">
                                            <?php if ($item['status'] !== 'draft'): ?>
                                                <a href="/admin/berita/status/<?= $item['id'] ?>/draft" 
                                                   class="btn btn-sm btn-outline-secondary" 
                                                   title="Ubah ke Draft"
                                                   onclick="return confirm('Ubah status berita ke Draft?')">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                            <?php endif; ?>
                                            
                                            <?php if ($item['status'] !== 'published'): ?>
                                                <a href="/admin/berita/status/<?= $item['id'] ?>/published" 
                                                   class="btn btn-sm btn-outline-success" 
                                                   title="Publish Berita"
                                                   onclick="return confirm('Publish berita ini?')">
                                                    <i class="bi bi-globe"></i>
                                                </a>
                                            <?php endif; ?>
                                            
                                            
                                        </div>
                                        
                                        <!-- Edit & Delete -->
                                        <button type="button" class="btn btn-sm btn-outline-primary" 
                                                onclick="editBerita(<?= $item['id'] ?>)" 
                                                title="Edit Berita">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                onclick="confirmDelete(<?= $item['id'] ?>, '<?= esc($item['judul']) ?>')" 
                                                title="Hapus Berita">
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
                <?php 
                    $lastUpdated = null; 
                    foreach (($berita ?? []) as $b) {
                        $ts = $b['updated_at'] ?? ($b['created_at'] ?? null);
                        if ($ts && (!$lastUpdated || strtotime($ts) > strtotime($lastUpdated))) {
                            $lastUpdated = $ts;
                        }
                    }
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="summary-item">
                            <i class="bi bi-info-circle me-2"></i>
                            <span>Total: <strong><?= count($berita) ?></strong> berita</span>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="summary-item">
                            <i class="bi bi-clock me-2"></i>
                            <span>Update terakhir: <strong><?= $lastUpdated ? date('d M Y H:i', strtotime($lastUpdated)) : '-' ?></strong></span>
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
            <p class="delete-modal-text">Anda yakin ingin menghapus berita "<span id="deleteBeritaTitle"></span>"?</p>
            <p class="delete-modal-warning">Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="delete-modal-footer">
            <button type="button" class="delete-modal-btn delete-modal-btn-cancel" onclick="closeDeleteModal()">Batal</button>
            <a href="#" id="deleteBeritaBtn" class="delete-modal-btn delete-modal-btn-delete">Hapus</a>
        </div>
    </div>
</div>

<?= $this->endSection() ?> 