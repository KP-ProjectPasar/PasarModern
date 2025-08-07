<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<!-- Government Style Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-title">
                <i class="bi bi-newspaper me-2"></i>Kelola Berita Pasar
            </h1>
            <p class="page-subtitle mb-0">Manajemen berita dan informasi pasar yang dipublikasikan</p>
        </div>
        <div class="col-auto">
            <a href="/admin/berita/create" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Tambah Berita
            </a>
        </div>
    </div>
</div>

<!-- Government Statistics -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-primary">
            <div class="stat-card-mini-icon">
                <i class="bi bi-newspaper"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count($beritas ?? []) ?></div>
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
                <div class="stat-card-mini-number"><?= count(array_filter($beritas ?? [], function($b) { return $b['status'] == 'published'; })) ?></div>
                <div class="stat-card-mini-label">Dipublikasikan</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-warning">
            <div class="stat-card-mini-icon">
                <i class="bi bi-file-earmark"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count(array_filter($beritas ?? [], function($b) { return $b['status'] == 'draft'; })) ?></div>
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
            <h3><i class="bi bi-table me-2"></i>Daftar Berita Pasar</h3>
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
        <?php if (empty($beritas ?? [])): ?>
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
                <table class="table table-hover government-table">
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
                        <?php foreach (($beritas ?? []) as $index => $berita): ?>
                            <tr class="berita-row" data-title="<?= strtolower($berita['judul']) ?>" 
                                data-status="<?= strtolower($berita['status']) ?>">
                                <td class="text-center">
                                    <span class="badge bg-secondary"><?= $index + 1 ?></span>
                                </td>
                                <td>
                                    <div class="berita-info-cell">
                                        <div class="berita-icon-mini">
                                            <i class="bi bi-newspaper"></i>
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
            
            <!-- Government Style Summary -->
            <div class="table-summary mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="summary-item">
                            <i class="bi bi-info-circle me-2"></i>
                            <span>Total: <strong><?= count($beritas ?? []) ?></strong> berita</span>
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
    
    // Berita action functions
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

<style>
/* Government Table Styles for Berita */
.berita-info-cell {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.berita-icon-mini {
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

.berita-details {
    flex: 1;
}

.berita-title {
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.25rem;
}

.berita-excerpt {
    font-size: 0.875rem;
    color: #64748b;
}

.berita-author {
    font-size: 0.875rem;
    color: #64748b;
}

.status-indicator.published {
    color: #059669;
}

.status-indicator.draft {
    color: #f59e0b;
}

.status-indicator.archived {
    color: #6b7280;
}

.status-indicator i {
    font-size: 0.75rem;
}

.berita-views {
    font-size: 0.875rem;
    color: #64748b;
}

.publish-date {
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
    
    .berita-info-cell {
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