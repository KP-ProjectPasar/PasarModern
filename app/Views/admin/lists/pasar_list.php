<?= $this->extend('admin/layout') ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="/assets/css/admin/pasar-list-styles.css">
<script src="/assets/js/admin/pasar-list.js" defer></script>
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
                <div class="stat-card-mini-number"><?= count(array_filter($pasar, function($p) { return isset($p['status']) && $p['status'] == 'active'; })) ?></div>
                <div class="stat-card-mini-label">Aktif</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-warning">
            <div class="stat-card-mini-icon">
                <i class="bi bi-geo-alt"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count(array_unique(array_column($pasar, 'kecamatan'))) ?></div>
                <div class="stat-card-mini-label">Kecamatan</div>
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
                                <i class="bi bi-people me-2"></i>Jumlah Pedagang
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
                                    <div class="pedagang-count">
                                        <i class="bi bi-people me-1"></i>
                                        <?= $pasar_item['jumlah_pedagang'] ?? 0 ?> pedagang
        </div>
                                </td>
                                <td>
                                    <div class="operational-hours">
                                        <i class="bi bi-clock me-1"></i>
                                        <?= esc($pasar_item['jam_operasional'] ?? 'N/A') ?>
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
                    <div class="col-md-6">
                        <div class="summary-item">
                            <i class="bi bi-info-circle me-2"></i>
                            <span>Total: <strong><?= count($pasar ?? []) ?></strong> pasar</span>
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
    const pasarRows = document.querySelectorAll('.pasar-row');
    
    searchInput.addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
        
        pasarRows.forEach(row => {
            const name = row.getAttribute('data-name');
            const status = row.getAttribute('data-status');
            
            const matches = name.includes(searchTerm) || 
                           status.includes(searchTerm);
            
            row.style.display = matches ? '' : 'none';
        });
    });
    
    window.editPasar = function(id) {
        window.location.href = `/admin/pasar/edit/${id}`;
    };
    
    window.deletePasar = function(id, name) {
        if (confirm(`Apakah Anda yakin ingin menghapus data pasar "${name}"?\n\nTindakan ini tidak dapat dibatalkan.`)) {
            window.location.href = `/admin/pasar/delete/${id}`;
        }
    };
});
</script>

<?= $this->endSection() ?> 