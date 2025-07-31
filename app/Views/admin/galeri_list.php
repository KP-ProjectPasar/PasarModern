<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<!-- Header Section -->
<div class="page-header mb-4">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2 class="page-title">
                Galeri Foto
            </h2>
            <p class="page-subtitle mb-0">Kelola koleksi foto dan gambar dalam galeri</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="/admin/galeri/create" class="btn btn-primary btn-lg">
                <i class="bi bi-plus-circle me-2"></i>
                Upload Foto
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
                    <input type="text" class="form-control border-start-0" id="searchGaleri" placeholder="Cari foto...">
                </div>
            </div>
        </div>
        <div class="col-md-6 text-end">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-secondary active" data-filter="all">
                    <i class="bi bi-grid me-1"></i> Semua
                </button>
                <button type="button" class="btn btn-outline-secondary" data-filter="recent">
                    <i class="bi bi-clock me-1"></i> Terbaru
                </button>
                <button type="button" class="btn btn-outline-secondary" data-filter="popular">
                    <i class="bi bi-star me-1"></i> Populer
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
                <i class="bi bi-images"></i>
            </div>
            <div class="stat-card-mini-content">
                <h4 class="stat-card-mini-number"><?= count($galeris) ?></h4>
                <p class="stat-card-mini-label">Total Foto</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-success">
            <div class="stat-card-mini-icon">
                <i class="bi bi-folder"></i>
            </div>
            <div class="stat-card-mini-content">
                <h4 class="stat-card-mini-number"><?= count(array_unique(array_column($galeris, 'kategori'))) ?></h4>
                <p class="stat-card-mini-label">Kategori</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-warning">
            <div class="stat-card-mini-icon">
                <i class="bi bi-eye"></i>
            </div>
            <div class="stat-card-mini-content">
                <h4 class="stat-card-mini-number">2.5k</h4>
                <p class="stat-card-mini-label">Total Views</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-info">
            <div class="stat-card-mini-icon">
                <i class="bi bi-download"></i>
            </div>
            <div class="stat-card-mini-content">
                <h4 class="stat-card-mini-number">156</h4>
                <p class="stat-card-mini-label">Downloads</p>
            </div>
        </div>
    </div>
</div>

<!-- Gallery Grid -->
<div class="gallery-grid" id="galleryGrid">
    <div class="row">
        <?php foreach ($galeris as $galeri): ?>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 galeri-item" data-category="<?= $galeri['kategori'] ?? 'umum' ?>">
            <div class="gallery-card">
                <div class="gallery-card-image">
                    <?php if ($galeri['gambar']): ?>
                        <img src="/uploads/galeri/<?= esc($galeri['gambar']) ?>" alt="<?= esc($galeri['judul']) ?>" loading="lazy">
                    <?php else: ?>
                        <div class="gallery-card-placeholder">
                            <i class="bi bi-image"></i>
                        </div>
                    <?php endif; ?>
                    <div class="gallery-card-overlay">
                        <div class="gallery-card-actions">
                            <a href="/uploads/galeri/<?= esc($galeri['gambar']) ?>" class="btn btn-sm btn-light" target="_blank" data-bs-toggle="tooltip" title="Lihat Foto">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="/admin/galeri/edit/<?= $galeri['id'] ?>" class="btn btn-sm btn-light" data-bs-toggle="tooltip" title="Edit Foto">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="/admin/galeri/delete/<?= $galeri['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirmDelete('<?= esc($galeri['judul']) ?>')" data-bs-toggle="tooltip" title="Hapus Foto">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </div>
                    <div class="gallery-card-category">
                        <?= esc($galeri['kategori'] ?? 'Umum') ?>
                    </div>
                </div>
                <div class="gallery-card-body">
                    <h6 class="gallery-card-title"><?= esc($galeri['judul']) ?></h6>
                    <div class="gallery-card-meta">
                        <span class="gallery-card-date">
                            <i class="bi bi-calendar3 me-1"></i>
                            <?= date('d M Y', strtotime($galeri['created_at'])) ?>
                        </span>
                    </div>
                    <div class="gallery-card-footer">
                        <div class="gallery-card-stats">
                            <span class="stat-item">
                                <i class="bi bi-eye me-1"></i>
                                245 views
                            </span>
                            <span class="stat-item">
                                <i class="bi bi-heart me-1"></i>
                                12 likes
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
        <i class="bi bi-images"></i>
    </div>
    <h4>Tidak ada foto ditemukan</h4>
    <p class="text-muted">Coba ubah filter atau kata kunci pencarian Anda</p>
    <a href="/admin/galeri/create" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>
        Upload Foto Pertama
    </a>
</div>

<!-- Lightbox Modal -->
<div class="modal fade" id="lightboxModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lightboxTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="lightboxImage" src="" alt="" class="img-fluid">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="" class="btn btn-primary" id="lightboxDownload" download>
                    <i class="bi bi-download me-2"></i>Download
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Search functionality
    const searchInput = document.getElementById('searchGaleri');
    const galeriItems = document.querySelectorAll('.galeri-item');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        galeriItems.forEach(item => {
            const title = item.querySelector('.gallery-card-title').textContent.toLowerCase();
            const category = item.querySelector('.gallery-card-category').textContent.toLowerCase();
            
            if (title.includes(searchTerm) || category.includes(searchTerm)) {
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
            galeriItems.forEach(item => {
                const category = item.getAttribute('data-category');
                
                if (filter === 'all' || 
                    (filter === 'recent' && category === 'terbaru') ||
                    (filter === 'popular' && category === 'populer')) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
            
            updateEmptyState();
        });
    });

    // Lightbox functionality
    const galleryImages = document.querySelectorAll('.gallery-card-image img');
    const lightboxModal = new bootstrap.Modal(document.getElementById('lightboxModal'));
    const lightboxImage = document.getElementById('lightboxImage');
    const lightboxTitle = document.getElementById('lightboxTitle');
    const lightboxDownload = document.getElementById('lightboxDownload');
    
    galleryImages.forEach(img => {
        img.addEventListener('click', function() {
            const card = this.closest('.gallery-card');
            const title = card.querySelector('.gallery-card-title').textContent;
            
            lightboxImage.src = this.src;
            lightboxImage.alt = title;
            lightboxTitle.textContent = title;
            lightboxDownload.href = this.src;
            
            lightboxModal.show();
        });
    });

    function updateEmptyState() {
        const visibleItems = document.querySelectorAll('.galeri-item[style*="block"], .galeri-item:not([style*="none"])');
        const emptyState = document.getElementById('emptyState');
        
        if (visibleItems.length === 0) {
            emptyState.style.display = 'block';
        } else {
            emptyState.style.display = 'none';
        }
    }
});

function confirmDelete(judul) {
    return confirm(`Yakin ingin menghapus foto "${judul}"? Tindakan ini tidak dapat dibatalkan.`);
}
</script>

<?= $this->endSection() ?> 