<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<!-- Government Style Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-title">
                <i class="bi bi-camera-video me-2"></i>Kelola Galeri Video
            </h1>
            <p class="page-subtitle mb-0">Manajemen koleksi video dan konten multimedia sistem</p>
        </div>
        <div class="col-auto">
            <a href="/admin/video/create" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Tambah Video
            </a>
        </div>
    </div>
</div>

<!-- Government Statistics -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-primary">
            <div class="stat-card-mini-icon">
                <i class="bi bi-camera-video"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count($videos ?? []) ?></div>
                <div class="stat-card-mini-label">Total Video</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-success">
            <div class="stat-card-mini-icon">
                <i class="bi bi-youtube"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count(array_filter($videos ?? [], function($v) { return $v['tipe'] === 'url'; })) ?></div>
                <div class="stat-card-mini-label">YouTube</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-warning">
            <div class="stat-card-mini-icon">
                <i class="bi bi-file-earmark-play"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count(array_filter($videos ?? [], function($v) { return $v['tipe'] === 'file'; })) ?></div>
                <div class="stat-card-mini-label">File Video</div>
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
            <h3><i class="bi bi-table me-2"></i>Daftar Video Galeri</h3>
        </div>
        <div class="content-card-actions">
            <div class="input-group" style="max-width: 300px;">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control" id="searchInput" placeholder="Cari video...">
            </div>
        </div>
    </div>
    
    <div class="content-card-body">
        <?php if (empty($videos ?? [])): ?>
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-camera-video"></i>
                </div>
                <h4>Belum ada data video</h4>
                <p>Mulai dengan menambahkan video pertama untuk galeri</p>
                <a href="/admin/video/create" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Video Pertama
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
                                <i class="bi bi-camera-video me-2"></i>Informasi Video
                            </th>
                            <th scope="col">
                                <i class="bi bi-play-circle me-2"></i>Tipe Video
                            </th>
                            <th scope="col">
                                <i class="bi bi-eye me-2"></i>Views
                            </th>
                            <th scope="col">
                                <i class="bi bi-calendar me-2"></i>Tanggal Upload
                            </th>
                            <th scope="col">
                                <i class="bi bi-clock me-2"></i>Durasi
                            </th>
                            <th scope="col" class="text-center" style="width: 150px;">
                                <i class="bi bi-gear me-2"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (($videos ?? []) as $index => $video): ?>
                            <tr class="video-row" data-title="<?= strtolower($video['judul']) ?>" 
                                data-tipe="<?= strtolower($video['tipe']) ?>">
                                <td class="text-center">
                                    <span class="badge bg-secondary"><?= $index + 1 ?></span>
                                </td>
                                <td>
                                    <div class="video-info-cell">
                                        <div class="video-icon-mini">
                                            <i class="bi bi-camera-video"></i>
                                        </div>
                                        <div class="video-details">
                                            <div class="video-title"><?= esc($video['judul']) ?></div>
                                            <div class="video-description">
                                                <?= esc(substr($video['deskripsi'] ?? '', 0, 80)) ?>...
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="video-type">
                                        <?php if ($video['tipe'] === 'url'): ?>
                                            <span class="type-badge youtube-badge">
                                                <i class="bi bi-youtube me-1"></i>YouTube
                                            </span>
                                        <?php else: ?>
                                            <span class="type-badge file-badge">
                                                <i class="bi bi-file-earmark-play me-1"></i>File Video
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="video-views">
                                        <i class="bi bi-eye me-1"></i>
                                        <?= $video['views'] ?? 0 ?> views
                                    </div>
                                </td>
                                <td>
                                    <div class="upload-date">
                                        <i class="bi bi-calendar me-1"></i>
                                        <?= date('d M Y', strtotime($video['created_at'] ?? 'now')) ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="video-duration">
                                        <i class="bi bi-clock me-1"></i>
                                        <?= $video['durasi'] ?? 'N/A' ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button type="button" class="btn btn-sm btn-outline-warning" 
                                                onclick="editVideo(<?= $video['id'] ?>)" 
                                                title="Edit Video">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                onclick="deleteVideo(<?= $video['id'] ?>, '<?= esc($video['judul']) ?>')" 
                                                title="Hapus Video">
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
                            <span>Total: <strong><?= count($videos ?? []) ?></strong> video</span>
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
    const videoRows = document.querySelectorAll('.video-row');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        videoRows.forEach(row => {
            const title = row.getAttribute('data-title');
            const tipe = row.getAttribute('data-tipe');
            
            const matches = title.includes(searchTerm) || 
                           tipe.includes(searchTerm);
            
            row.style.display = matches ? '' : 'none';
        });
    });
    
    // Video action functions
    window.editVideo = function(id) {
        window.location.href = `/admin/video/edit/${id}`;
    };
    
    window.deleteVideo = function(id, title) {
        if (confirm(`Apakah Anda yakin ingin menghapus video "${title}"?\n\nTindakan ini tidak dapat dibatalkan.`)) {
            window.location.href = `/admin/video/delete/${id}`;
        }
    };
});
</script>

<style>
/* Government Table Styles for Video */
.video-info-cell {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.video-icon-mini {
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

.video-details {
    flex: 1;
}

.video-title {
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.25rem;
}

.video-description {
    font-size: 0.875rem;
    color: #64748b;
}

.video-type {
    font-size: 0.875rem;
}

.type-badge {
    display: inline-block;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: 500;
}

.youtube-badge {
    background: #fef2f2;
    border: 1px solid #fecaca;
    color: #dc2626;
}

.file-badge {
    background: #f0f9ff;
    border: 1px solid #bae6fd;
    color: #0369a1;
}

.video-views {
    font-size: 0.875rem;
    color: #64748b;
}

.upload-date {
    font-size: 0.875rem;
    color: #64748b;
}

.video-duration {
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
    
    .video-info-cell {
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