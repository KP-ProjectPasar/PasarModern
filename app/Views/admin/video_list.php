<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<!-- Header Section -->
<div class="page-header mb-4">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2 class="page-title">
                <i class="bi bi-camera-video text-primary me-2"></i>
                Galeri Video
            </h2>
            <p class="text-muted mb-0">Kelola koleksi video dan konten multimedia</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="/admin/video/create" class="btn btn-primary btn-lg">
                <i class="bi bi-plus-circle me-2"></i>
                Tambah Video
            </a>
        </div>
    </div>
</div>

<!-- Search and Filter Section -->
<div class="search-filter-section mb-4">
    <div class="row">
        <div class="col-md-6">
            <div class="search-box">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" id="searchVideo" placeholder="Cari video...">
                </div>
            </div>
        </div>
        <div class="col-md-6 text-end">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-secondary active" data-filter="all">
                    <i class="bi bi-grid me-1"></i> Semua
                </button>
                <button type="button" class="btn btn-outline-secondary" data-filter="youtube">
                    <i class="bi bi-youtube me-1"></i> YouTube
                </button>
                <button type="button" class="btn btn-outline-secondary" data-filter="file">
                    <i class="bi bi-file-earmark-play me-1"></i> File Video
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-primary">
            <div class="stat-card-mini-icon">
                <i class="bi bi-camera-video"></i>
            </div>
            <div class="stat-card-mini-content">
                <h4 class="stat-card-mini-number"><?= count($videos) ?></h4>
                <p class="stat-card-mini-label">Total Video</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-success">
            <div class="stat-card-mini-icon">
                <i class="bi bi-youtube"></i>
            </div>
            <div class="stat-card-mini-content">
                <h4 class="stat-card-mini-number"><?= count(array_filter($videos, function($v) { return $v['tipe'] === 'url'; })) ?></h4>
                <p class="stat-card-mini-label">YouTube</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-warning">
            <div class="stat-card-mini-icon">
                <i class="bi bi-file-earmark-play"></i>
            </div>
            <div class="stat-card-mini-content">
                <h4 class="stat-card-mini-number"><?= count(array_filter($videos, function($v) { return $v['tipe'] === 'file'; })) ?></h4>
                <p class="stat-card-mini-label">File Video</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-info">
            <div class="stat-card-mini-icon">
                <i class="bi bi-eye"></i>
            </div>
            <div class="stat-card-mini-content">
                <h4 class="stat-card-mini-number">3.2k</h4>
                <p class="stat-card-mini-label">Total Views</p>
            </div>
        </div>
    </div>
</div>

<!-- Video Grid -->
<div class="video-grid" id="videoGrid">
    <div class="row">
        <?php foreach ($videos as $video): ?>
        <div class="col-lg-4 col-md-6 mb-4 video-item" data-type="<?= $video['tipe'] ?>">
            <div class="video-card">
                <div class="video-card-header">
                    <div class="video-card-type <?= $video['tipe'] === 'url' ? 'youtube' : 'file' ?>">
                        <i class="bi <?= $video['tipe'] === 'url' ? 'bi-youtube' : 'bi-file-earmark-play' ?>"></i>
                        <?= $video['tipe'] === 'url' ? 'YouTube' : 'File Video' ?>
                    </div>
                    <div class="video-card-actions">
                        <a href="/admin/video/edit/<?= $video['id'] ?>" class="btn btn-sm btn-light" data-bs-toggle="tooltip" title="Edit Video">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a href="/admin/video/delete/<?= $video['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirmDelete('<?= esc($video['judul']) ?>')" data-bs-toggle="tooltip" title="Hapus Video">
                            <i class="bi bi-trash"></i>
                        </a>
                    </div>
                </div>
                
                <div class="video-card-player">
                    <?php if ($video['tipe'] === 'url' && $video['url']): ?>
                        <?php 
                        $videoId = '';
                        if (strpos($video['url'], 'youtube.com/watch?v=') !== false) {
                            $videoId = substr($video['url'], strpos($video['url'], 'v=') + 2);
                        } elseif (strpos($video['url'], 'youtu.be/') !== false) {
                            $videoId = substr($video['url'], strpos($video['url'], 'youtu.be/') + 9);
                        }
                        ?>
                        <?php if ($videoId): ?>
                            <div class="video-embed">
                                <iframe src="https://www.youtube.com/embed/<?= $videoId ?>" 
                                        title="<?= esc($video['judul']) ?>" 
                                        frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                        allowfullscreen></iframe>
                            </div>
                        <?php else: ?>
                            <div class="video-placeholder">
                                <i class="bi bi-play-circle"></i>
                                <p>URL tidak valid</p>
                            </div>
                        <?php endif; ?>
                    <?php elseif ($video['tipe'] === 'file' && $video['file_video']): ?>
                        <div class="video-file">
                            <video controls>
                                <source src="/uploads/video/<?= esc($video['file_video']) ?>" type="video/mp4">
                                Browser Anda tidak mendukung tag video.
                            </video>
                        </div>
                    <?php else: ?>
                        <div class="video-placeholder">
                            <i class="bi bi-play-circle"></i>
                            <p>Video tidak tersedia</p>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="video-card-body">
                    <h5 class="video-card-title"><?= esc($video['judul']) ?></h5>
                    <div class="video-card-meta">
                        <span class="video-card-date">
                            <i class="bi bi-calendar3 me-1"></i>
                            <?= date('d M Y', strtotime($video['created_at'])) ?>
                        </span>
                        <span class="video-card-time">
                            <i class="bi bi-clock me-1"></i>
                            <?= date('H:i', strtotime($video['created_at'])) ?>
                        </span>
                    </div>
                    <div class="video-card-footer">
                        <div class="video-card-stats">
                            <span class="stat-item">
                                <i class="bi bi-eye me-1"></i>
                                456 views
                            </span>
                            <span class="stat-item">
                                <i class="bi bi-play-circle me-1"></i>
                                23 plays
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Empty State -->
<div class="empty-state" id="emptyState" style="display: none;">
    <div class="empty-state-icon">
        <i class="bi bi-camera-video"></i>
    </div>
    <h4>Tidak ada video ditemukan</h4>
    <p class="text-muted">Coba ubah filter atau kata kunci pencarian Anda</p>
    <a href="/admin/video/create" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>
        Tambah Video Pertama
    </a>
</div>

<script>
// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Search functionality
    const searchInput = document.getElementById('searchVideo');
    const videoItems = document.querySelectorAll('.video-item');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        videoItems.forEach(item => {
            const title = item.querySelector('.video-card-title').textContent.toLowerCase();
            
            if (title.includes(searchTerm)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
        
        updateEmptyState();
    });

    // Filter functionality
    const filterButtons = document.querySelectorAll('[data-filter]');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Filter items
            videoItems.forEach(item => {
                const type = item.getAttribute('data-type');
                
                if (filter === 'all' || type === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
            
            updateEmptyState();
        });
    });

    function updateEmptyState() {
        const visibleItems = document.querySelectorAll('.video-item[style*="block"], .video-item:not([style*="none"])');
        const emptyState = document.getElementById('emptyState');
        
        if (visibleItems.length === 0) {
            emptyState.style.display = 'block';
        } else {
            emptyState.style.display = 'none';
        }
    }
});

function confirmDelete(judul) {
    return confirm(`Yakin ingin menghapus video "${judul}"? Tindakan ini tidak dapat dibatalkan.`);
}
</script>

<?= $this->endSection() ?> 