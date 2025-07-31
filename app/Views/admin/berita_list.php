<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<!-- Header Section -->
<div class="page-header mb-4">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2 class="page-title">
                Daftar Berita
            </h2>
            <p class="page-subtitle mb-0">Kelola semua berita yang telah dipublikasikan</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="/admin/berita/create" class="btn btn-primary btn-lg">
                <i class="bi bi-plus-circle me-2"></i>
                Tambah Berita
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
                    <input type="text" class="form-control border-start-0" id="searchBerita" placeholder="Cari berita...">
                </div>
            </div>
        </div>
        <div class="col-md-6 text-end">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-secondary active" data-filter="all">
                    <i class="bi bi-grid me-1"></i> Semua
                </button>
                <button type="button" class="btn btn-outline-secondary" data-filter="published">
                    <i class="bi bi-check-circle me-1"></i> Dipublikasikan
                </button>
                <button type="button" class="btn btn-outline-secondary" data-filter="draft">
                    <i class="bi bi-file-earmark me-1"></i> Draft
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
                <i class="bi bi-newspaper"></i>
            </div>
            <div class="stat-card-mini-content">
                <h4 class="stat-card-mini-number"><?= count($beritas) ?></h4>
                <p class="stat-card-mini-label">Total Berita</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-success">
            <div class="stat-card-mini-icon">
                <i class="bi bi-check-circle"></i>
            </div>
            <div class="stat-card-mini-content">
                <h4 class="stat-card-mini-number"><?= count(array_filter($beritas, function($b) { return $b['status'] == 'published'; })) ?></h4>
                <p class="stat-card-mini-label">Dipublikasikan</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-warning">
            <div class="stat-card-mini-icon">
                <i class="bi bi-file-earmark"></i>
            </div>
            <div class="stat-card-mini-content">
                <h4 class="stat-card-mini-number"><?= count(array_filter($beritas, function($b) { return $b['status'] == 'draft'; })) ?></h4>
                <p class="stat-card-mini-label">Draft</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-info">
            <div class="stat-card-mini-icon">
                <i class="bi bi-eye"></i>
            </div>
            <div class="stat-card-mini-content">
                <h4 class="stat-card-mini-number">1.2k</h4>
                <p class="stat-card-mini-label">Total Views</p>
            </div>
        </div>
    </div>
</div>

<!-- Berita Grid -->
<div class="berita-grid" id="beritaGrid">
    <div class="row">
        <?php foreach ($beritas as $berita): ?>
        <div class="col-lg-4 col-md-6 mb-4 berita-item" data-status="<?= $berita['status'] ?? 'published' ?>">
            <div class="berita-card">
                <div class="berita-card-image">
                    <?php if ($berita['gambar']): ?>
                        <img src="/uploads/berita/<?= esc($berita['gambar']) ?>" alt="<?= esc($berita['judul']) ?>">
                    <?php else: ?>
                        <div class="berita-card-placeholder">
                            <i class="bi bi-image"></i>
                        </div>
                    <?php endif; ?>
                    <div class="berita-card-overlay">
                        <div class="berita-card-actions">
                            <a href="/admin/berita/edit/<?= $berita['id'] ?>" class="btn btn-sm btn-light" data-bs-toggle="tooltip" title="Edit Berita">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="/admin/berita/delete/<?= $berita['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirmDelete('<?= esc($berita['judul']) ?>')" data-bs-toggle="tooltip" title="Hapus Berita">
                                <i class="bi bi-trash"></i>
                            </a>
                            <a href="/berita/<?= $berita['id'] ?>" class="btn btn-sm btn-primary" target="_blank" data-bs-toggle="tooltip" title="Lihat Berita">
                                <i class="bi bi-eye"></i>
                            </a>
                        </div>
                    </div>
                    <div class="berita-card-status <?= ($berita['status'] ?? 'published') == 'published' ? 'published' : 'draft' ?>">
                        <?= ($berita['status'] ?? 'published') == 'published' ? 'Dipublikasikan' : 'Draft' ?>
                    </div>
                </div>
                <div class="berita-card-body">
                    <h5 class="berita-card-title"><?= esc($berita['judul']) ?></h5>
                    <div class="berita-card-meta">
                        <span class="berita-card-date">
                            <i class="bi bi-calendar3 me-1"></i>
                            <?= date('d M Y', strtotime($berita['created_at'])) ?>
                        </span>
                        <span class="berita-card-time">
                            <i class="bi bi-clock me-1"></i>
                            <?= date('H:i', strtotime($berita['created_at'])) ?>
                        </span>
                    </div>
                    <p class="berita-card-excerpt">
                        <?= substr(strip_tags($berita['isi']), 0, 120) ?>...
                    </p>
                    <div class="berita-card-footer">
                        <div class="berita-card-stats">
                            <span class="stat-item">
                                <i class="bi bi-eye me-1"></i>
                                1.2k views
                            </span>
                            <span class="stat-item">
                                <i class="bi bi-heart me-1"></i>
                                45 likes
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
        <i class="bi bi-newspaper"></i>
    </div>
    <h4>Tidak ada berita ditemukan</h4>
    <p class="text-muted">Coba ubah filter atau kata kunci pencarian Anda</p>
    <a href="/admin/berita/create" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>
        Tambah Berita Pertama
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
    const searchInput = document.getElementById('searchBerita');
    const beritaItems = document.querySelectorAll('.berita-item');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        beritaItems.forEach(item => {
            const title = item.querySelector('.berita-card-title').textContent.toLowerCase();
            const excerpt = item.querySelector('.berita-card-excerpt').textContent.toLowerCase();
            
            if (title.includes(searchTerm) || excerpt.includes(searchTerm)) {
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
            beritaItems.forEach(item => {
                const status = item.getAttribute('data-status');
                
                if (filter === 'all' || status === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
            
            updateEmptyState();
        });
    });

    function updateEmptyState() {
        const visibleItems = document.querySelectorAll('.berita-item[style*="block"], .berita-item:not([style*="none"])');
        const emptyState = document.getElementById('emptyState');
        
        if (visibleItems.length === 0) {
            emptyState.style.display = 'block';
        } else {
            emptyState.style.display = 'none';
        }
    }
});

function confirmDelete(judul) {
    return confirm(`Yakin ingin menghapus berita "${judul}"? Tindakan ini tidak dapat dibatalkan.`);
}
</script>

<?= $this->endSection() ?> 