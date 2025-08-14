<?= $this->extend('admin/layout') ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="/assets/css/admin/galeri-list-styles.css">
<script src="/assets/js/admin/galeri-list.js" defer></script>
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
                <div class="stat-card-mini-number"><?= count($galeri) ?></div>
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
                <div class="stat-card-mini-number"><?= count(array_filter($galeri, function($g) { return isset($g['status']) && $g['status'] == 'published'; })) ?></div>
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
                <div class="stat-card-mini-number"><?= count(array_filter($galeri, function($g) { return isset($g['status']) && $g['status'] == 'draft'; })) ?></div>
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
                <div class="stat-card-mini-number"><?= array_sum(array_column($galeri, 'views') ?? []) ?></div>
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
                                    <div class="upload-date">
                                        <i class="bi bi-calendar me-1"></i>
                                        <?= date('d M Y', strtotime($galeri['created_at'] ?? 'now')) ?>
                                    </div>
                                </td>

                                <td>
                                    <div class="action-buttons">
                                        <button type="button" class="btn btn-sm btn-outline-warning" 
                                                onclick="editGaleri(<?= $galeri['id'] ?>)" 
                                                title="Edit Foto">
                                <i class="bi bi-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                onclick="deleteGaleri(<?= $galeri['id'] ?>, '<?= esc($galeri['judul']) ?>')" 
                                                title="Hapus Foto">
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
                            <span>Total: <strong><?= count($galeri) ?></strong> foto</span>
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
    const galeriRows = document.querySelectorAll('.galeri-row');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        galeriRows.forEach(row => {
            const title = row.getAttribute('data-title');
            const kategori = row.getAttribute('data-kategori');
            
            const matches = title.includes(searchTerm) || 
                           kategori.includes(searchTerm);
            
            row.style.display = matches ? '' : 'none';
        });
    });

    window.editGaleri = function(id) {
        window.location.href = `/admin/galeri/edit/${id}`;
    };
    
    window.deleteGaleri = function(id, title) {
        if (confirm(`Apakah Anda yakin ingin menghapus foto "${title}"?\n\nTindakan ini tidak dapat dibatalkan.`)) {
            window.location.href = `/admin/galeri/delete/${id}`;
        }
    };
});
</script>

<?= $this->endSection() ?> 