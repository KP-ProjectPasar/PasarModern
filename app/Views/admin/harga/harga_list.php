<?= $this->extend('admin/layout') ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="/assets/css/admin/harga/harga-list-styles.css">
<script src="/assets/js/admin/harga/harga-list.js" defer></script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-title">
                <i class="bi bi-currency-dollar me-2"></i>Kelola Harga
            </h1>
            <p class="page-subtitle mb-0">Manajemen data harga komoditas pasar modern</p>
        </div>
        <div class="col-auto">
            <a href="/admin/harga/create" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Tambah Harga
            </a>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="stat-card-mini stat-card-primary">
            <div class="stat-card-mini-icon">
                <i class="bi bi-currency-dollar"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= $stats['total_harga'] ?? 0 ?></div>
                <div class="stat-card-mini-label">Total Harga</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stat-card-mini stat-card-success">
            <div class="stat-card-mini-icon">
                <i class="bi bi-image"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= $stats['with_foto'] ?? 0 ?></div>
                <div class="stat-card-mini-label">Dengan Foto</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stat-card-mini stat-card-warning">
            <div class="stat-card-mini-icon">
                <i class="bi bi-tags"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count(array_unique(array_column($harga, 'komoditas'))) ?></div>
                <div class="stat-card-mini-label">Komoditas</div>
            </div>
        </div>
    </div>
</div>

<div class="content-card">
    <div class="content-card-header">
        <div class="content-card-title">
            <h3><i class="bi bi-table me-2"></i>Daftar Harga</h3>
        </div>
        <div class="content-card-actions">
            <div class="input-group" style="max-width: 300px;">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control" id="searchInput" placeholder="Cari harga...">
            </div>
        </div>
    </div>
                
    <div class="content-card-body">
        <?php if (empty($harga)): ?>
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <h4>Belum ada data harga</h4>
                <p>Mulai dengan menambahkan harga pertama untuk sistem</p>
                <a href="/admin/harga/create" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Harga Pertama
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
                                <i class="bi bi-image me-2"></i>Foto
                            </th>
                            <th scope="col">
                                <i class="bi bi-box me-2"></i>Informasi Komoditas
                            </th>
                            <th scope="col">
                                <i class="bi bi-tags me-2"></i>Kategori
                            </th>
                            <th scope="col">
                                <i class="bi bi-currency-dollar me-2"></i>Harga
                            </th>
                            <th scope="col">
                                <i class="bi bi-calendar me-2"></i>Tanggal Update
                            </th>
                            <th scope="col" class="text-center" style="width: 150px;">
                                <i class="bi bi-gear me-2"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (($harga ?? []) as $index => $harga): ?>
                            <tr class="harga-row" data-komoditas="<?= strtolower($harga['komoditas']) ?>">
                                <td class="text-center">
                                    <span class="badge bg-secondary"><?= $index + 1 ?></span>
                                </td>
                                <td>
                                    <div class="harga-foto-cell">
                                        <?php if ($harga['foto']): ?>
                                            <img src="/uploads/harga/<?= esc($harga['foto']) ?>" 
                                                 alt="<?= esc($harga['komoditas']) ?>" 
                                                 class="harga-foto-thumbnail"
                                                 onerror="this.src='/assets/img/Picture2.png'">
                                        <?php else: ?>
                                            <div class="harga-foto-placeholder">
                                                <i class="bi bi-image text-muted"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="harga-info-cell">
                                        <div class="harga-icon-mini">
                                            <i class="bi bi-box"></i>
                                        </div>
                                        <div class="harga-details">
                                            <div class="harga-komoditas"><?= esc($harga['komoditas']) ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="harga-category">
                                        <span class="category-badge category-<?= strtolower($harga['kategori'] ?? 'sayuran') ?>">
                                            <?= esc(ucfirst($harga['kategori'] ?? 'Sayuran')) ?>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="harga-price">
                                        <span class="price-amount">Rp <?= number_format($harga['harga'], 0, ',', '.') ?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="update-date">
                                        <i class="bi bi-calendar me-1"></i>
                                        <?= date('d M Y', strtotime($harga['tanggal'] ?? 'now')) ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button type="button" class="btn btn-sm btn-outline-warning" 
                                                onclick="editHarga(<?= $harga['id'] ?>)" 
                                                title="Edit Harga Komoditas">
                        <i class="bi bi-pencil"></i>
                    </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                onclick="deleteHarga(<?= $harga['id'] ?>, '<?= esc($harga['komoditas']) ?>')" 
                                                title="Hapus Harga Komoditas">
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
                            <span>Total: <strong><?= $stats['total_harga'] ?? 0 ?></strong> harga</span>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="summary-item">
                            <i class="bi bi-clock me-2"></i>
                            <span>Update terakhir: <strong>
                                <?php 
                                $latestDate = $stats['latest_update'] ?? null;
                                if ($latestDate) {
                                    echo date('d M Y H:i', strtotime($latestDate));
                                } else {
                                    echo 'Belum ada data';
                                }
                                ?>
                            </strong></span>
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
    const hargaRows = document.querySelectorAll('.harga-row');
    

    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        hargaRows.forEach(row => {
            const komoditas = row.getAttribute('data-komoditas');
            
            const matches = komoditas.includes(searchTerm);
            
            row.style.display = matches ? '' : 'none';
        });
    });
    
    window.editHarga = function(id) {
        window.location.href = `/admin/harga/edit/${id}`;
    };
    
    window.deleteHarga = function(id, komoditas) {
        if (confirm(`Apakah Anda yakin ingin menghapus harga komoditas "${komoditas}"?\n\nTindakan ini tidak dapat dibatalkan.`)) {
            window.location.href = `/admin/harga/delete/${id}`;
        }
    };
});
</script>

<?= $this->endSection() ?> 