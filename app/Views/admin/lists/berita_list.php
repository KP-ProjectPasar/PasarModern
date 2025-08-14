<?= $this->extend('admin/layout') ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="/assets/css/admin/berita-list-styles.css">
<script src="/assets/js/admin/berita-list.js" defer></script>
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
                <div class="stat-card-mini-number"><?= count($berita) ?></div>
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
                <div class="stat-card-mini-number"><?= count(array_filter($berita, function($b) { return isset($b['status']) && $b['status'] == 'published'; })) ?></div>
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
                <div class="stat-card-mini-number"><?= count(array_filter($berita, function($b) { return isset($b['status']) && $b['status'] == 'draft'; })) ?></div>
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
                <div class="stat-card-mini-number"><?= array_sum(array_column($berita, 'views') ?? []) ?></div>
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
                    <thead class="table-dark">
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
                        <?php foreach (($berita ?? []) as $index => $berita): ?>
                            <tr class="berita-row" data-title="<?= strtolower($berita['judul']) ?>" 
                                data-status="<?= strtolower($berita['status']) ?>">
                                <td class="text-center">
                                    <span class="badge bg-secondary"><?= $index + 1 ?></span>
                                </td>
                                <td>
                                    <div class="berita-info-cell">
                                        <div class="berita-thumbnail">
                                            <?php if ($berita['gambar']): ?>
                                                <img src="/uploads/berita/<?= esc($berita['gambar']) ?>" 
                                                     alt="<?= esc($berita['judul']) ?>" 
                                                     class="berita-thumb">
                                            <?php else: ?>
                                                <div class="berita-placeholder">
                                                    <i class="bi bi-newspaper"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="berita-details">
                                            <div class="berita-title"><?= esc($berita['judul']) ?></div>
                                            <div class="berita-excerpt">
                                                <?= esc(substr($berita['isi'] ?? '', 0, 100)) ?>...
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="berita-author">
                                        <i class="bi bi-person me-1"></i>
                                        <?= esc($berita['penulis'] ?? 'Admin') ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="status-indicator <?= $berita['status'] ?>">
                                        <i class="bi bi-circle-fill me-1"></i>
                                        <?= ucfirst($berita['status']) ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="berita-views">
                                        <i class="bi bi-eye me-1"></i>
                                        <?= $berita['views'] ?? 0 ?> views
                                    </div>
                                </td>
                                <td>
                                    <div class="publish-date">
                                        <i class="bi bi-calendar me-1"></i>
                                        <?= date('d M Y', strtotime($berita['created_at'] ?? 'now')) ?>
                        </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button type="button" class="btn btn-sm btn-outline-warning" 
                                                onclick="editBerita(<?= $berita['id'] ?>)" 
                                                title="Edit Berita">
                                <i class="bi bi-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                onclick="deleteBerita(<?= $berita['id'] ?>, '<?= esc($berita['judul']) ?>')" 
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
    const searchInput = document.getElementById('searchInput');
    const beritaRows = document.querySelectorAll('.berita-row');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        beritaRows.forEach(row => {
            const title = row.getAttribute('data-title');
            const status = row.getAttribute('data-status');
            
            const matches = title.includes(searchTerm) || 
                           status.includes(searchTerm);
            
            row.style.display = matches ? '' : 'none';
        });
    });

    window.editBerita = function(id) {
        window.location.href = `/admin/berita/edit/${id}`;
    };
    
    window.deleteBerita = function(id, title) {
        if (confirm(`Apakah Anda yakin ingin menghapus berita "${title}"?\n\nTindakan ini tidak dapat dibatalkan.`)) {
            window.location.href = `/admin/berita/delete/${id}`;
        }
    };
});
</script>

<?= $this->endSection() ?> 