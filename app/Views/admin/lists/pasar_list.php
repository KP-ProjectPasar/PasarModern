<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<!-- Government Style Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-title">
                <i class="bi bi-building me-2"></i>Kelola Data Pasar
            </h1>
            <p class="page-subtitle mb-0">Manajemen informasi dan data pasar yang tersedia dalam sistem</p>
        </div>
        <div class="col-auto">
            <a href="/admin/pasar/create" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Tambah Data Pasar
            </a>
        </div>
    </div>
</div>

<!-- Government Statistics -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-primary">
            <div class="stat-card-mini-icon">
                <i class="bi bi-building"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count($pasar ?? []) ?></div>
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
                <div class="stat-card-mini-number"><?= count(array_filter($pasar ?? [], function($p) { return $p['status'] == 'aktif'; })) ?></div>
                <div class="stat-card-mini-label">Pasar Aktif</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-warning">
            <div class="stat-card-mini-icon">
                <i class="bi bi-clock"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count(array_filter($pasar ?? [], function($p) { return $p['status'] == 'perbaikan'; })) ?></div>
                <div class="stat-card-mini-label">Dalam Perbaikan</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-info">
            <div class="stat-card-mini-icon">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= array_sum(array_column($pasar ?? [], 'jumlah_pedagang')) ?></div>
                <div class="stat-card-mini-label">Total Pedagang</div>
            </div>
        </div>
    </div>
</div>

<!-- Government Style Table -->
<div class="content-card">
    <div class="content-card-header">
        <div class="content-card-title">
            <h3><i class="bi bi-table me-2"></i>Daftar Data Pasar</h3>
        </div>
        <div class="content-card-actions">
            <div class="input-group" style="max-width: 300px;">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control" id="searchInput" placeholder="Cari data pasar...">
            </div>
        </div>
    </div>
    
    <div class="content-card-body">
        <?php if (empty($pasar ?? [])): ?>
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-building"></i>
                </div>
                <h4>Belum ada data pasar</h4>
                <p>Mulai dengan menambahkan data pasar pertama untuk sistem</p>
                <a href="/admin/pasar/create" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Data Pasar Pertama
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
            
            <!-- Government Style Summary -->
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
    // Search functionality
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
    
    // Pasar action functions
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

<style>
/* Government Table Styles for Pasar */
.pasar-info-cell {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.pasar-icon-mini {
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

.pasar-details {
    flex: 1;
}

.pasar-name {
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.25rem;
}

.pasar-phone {
    font-size: 0.875rem;
    color: #64748b;
}

.pasar-location {
    font-size: 0.875rem;
    color: #64748b;
}

.status-indicator.aktif {
    color: #059669;
}

.status-indicator.perbaikan {
    color: #f59e0b;
}

.status-indicator.nonaktif {
    color: #dc2626;
}

.status-indicator i {
    font-size: 0.75rem;
}

.pedagang-count {
    font-size: 0.875rem;
    color: #64748b;
}

.operational-hours {
    font-size: 0.875rem;
    color: #64748b;
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

/* Responsive */
@media (max-width: 768px) {
    .government-table {
        font-size: 0.875rem;
    }
    
    .government-table thead th,
    .government-table tbody td {
        padding: 0.75rem 0.5rem;
    }
    
    .pasar-info-cell {
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