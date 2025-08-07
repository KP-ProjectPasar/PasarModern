<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<!-- Government Style Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-title">
                <i class="bi bi-images me-2"></i>Kelola Galeri Foto
            </h1>
            <p class="page-subtitle mb-0">Manajemen koleksi foto dan gambar dalam galeri sistem</p>
        </div>
        <div class="col-auto">
            <a href="/admin/galeri/create" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Upload Foto
            </a>
        </div>
    </div>
</div>

<!-- Government Statistics -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-primary">
            <div class="stat-card-mini-icon">
                <i class="bi bi-images"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count($galeris ?? []) ?></div>
                <div class="stat-card-mini-label">Total Foto</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-success">
            <div class="stat-card-mini-icon">
                <i class="bi bi-folder"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count(array_unique(array_column($galeris ?? [], 'kategori'))) ?></div>
                <div class="stat-card-mini-label">Kategori</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-warning">
            <div class="stat-card-mini-icon">
                <i class="bi bi-eye"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= array_sum(array_column($galeris ?? [], 'views')) ?></div>
                <div class="stat-card-mini-label">Total Views</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-info">
            <div class="stat-card-mini-icon">
                <i class="bi bi-calendar"></i>
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
            <h3><i class="bi bi-table me-2"></i>Daftar Foto Galeri</h3>
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
        <?php if (empty($galeris ?? [])): ?>
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-images"></i>
                </div>
                <h4>Belum ada data foto</h4>
                <p>Mulai dengan menambahkan foto pertama untuk galeri</p>
                <a href="/admin/galeri/create" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Upload Foto Pertama
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
                                <i class="bi bi-image me-2"></i>Informasi Foto
                            </th>
                            <th scope="col">
                                <i class="bi bi-folder me-2"></i>Kategori
                            </th>
                            <th scope="col">
                                <i class="bi bi-eye me-2"></i>Views
                            </th>
                            <th scope="col">
                                <i class="bi bi-calendar me-2"></i>Tanggal Upload
                            </th>
                            <th scope="col">
                                <i class="bi bi-file-earmark me-2"></i>Ukuran File
                            </th>
                            <th scope="col" class="text-center" style="width: 150px;">
                                <i class="bi bi-gear me-2"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (($galeris ?? []) as $index => $galeri): ?>
                            <tr class="galeri-row" data-title="<?= strtolower($galeri['judul']) ?>" 
                                data-kategori="<?= strtolower($galeri['kategori']) ?>">
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
                                            <div class="galeri-description">
                                                <?= esc(substr($galeri['deskripsi'] ?? '', 0, 80)) ?>...
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="galeri-category">
                                        <span class="category-badge"><?= esc($galeri['kategori']) ?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="galeri-views">
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
                                    <div class="file-size">
                                        <i class="bi bi-file-earmark me-1"></i>
                                        <?= $galeri['ukuran_file'] ?? 'N/A' ?>
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
            
            <!-- Government Style Summary -->
            <div class="table-summary mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="summary-item">
                            <i class="bi bi-info-circle me-2"></i>
                            <span>Total: <strong><?= count($galeris ?? []) ?></strong> foto</span>
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
    
    // Galeri action functions
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

<style>
/* Government Table Styles for Galeri */
.galeri-info-cell {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.galeri-thumbnail {
    width: 50px;
    height: 50px;
    border-radius: 8px;
    overflow: hidden;
    flex-shrink: 0;
}

.galeri-thumb {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.galeri-placeholder {
    width: 100%;
    height: 100%;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #64748b;
    font-size: 1.2rem;
}

.galeri-details {
    flex: 1;
}

.galeri-title {
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.25rem;
}

.galeri-description {
    font-size: 0.875rem;
    color: #64748b;
}

.galeri-category {
    font-size: 0.875rem;
}

.category-badge {
    display: inline-block;
    padding: 0.25rem 0.5rem;
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    font-size: 0.75rem;
    color: #475569;
    font-weight: 500;
}

.galeri-views {
    font-size: 0.875rem;
    color: #64748b;
}

.upload-date {
    font-size: 0.875rem;
    color: #64748b;
}

.file-size {
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
    
    .galeri-info-cell {
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