<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<!-- Header Section -->
<div class="page-header mb-4">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2 class="page-title">
                <i class="bi bi-chat-dots me-2"></i>
                Kelola Feedback
            </h2>
            <p class="page-subtitle mb-0">Kelola semua feedback dari pengguna</p>
        </div>
        <div class="col-md-4 text-end">
            <button class="btn btn-primary btn-lg" onclick="exportFeedback()">
                <i class="bi bi-download me-2"></i>
                Export Data
            </button>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-primary">
            <div class="stat-card-mini-icon">
                <i class="bi bi-chat-dots"></i>
            </div>
            <div class="stat-card-mini-content">
                <h4 class="stat-card-mini-number">0</h4>
                <p class="stat-card-mini-label">Total Feedback</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-success">
            <div class="stat-card-mini-icon">
                <i class="bi bi-check-circle"></i>
            </div>
            <div class="stat-card-mini-content">
                <h4 class="stat-card-mini-number">0</h4>
                <p class="stat-card-mini-label">Sudah Dibalas</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-warning">
            <div class="stat-card-mini-icon">
                <i class="bi bi-clock"></i>
            </div>
            <div class="stat-card-mini-content">
                <h4 class="stat-card-mini-number">0</h4>
                <p class="stat-card-mini-label">Menunggu Balasan</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-info">
            <div class="stat-card-mini-icon">
                <i class="bi bi-star"></i>
            </div>
            <div class="stat-card-mini-content">
                <h4 class="stat-card-mini-number">0</h4>
                <p class="stat-card-mini-label">Rating Rata-rata</p>
            </div>
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
                    <input type="text" class="form-control border-start-0" id="searchFeedback" placeholder="Cari feedback...">
                </div>
            </div>
        </div>
        <div class="col-md-6 text-end">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-secondary active" data-filter="all">
                    <i class="bi bi-grid me-1"></i> Semua
                </button>
                <button type="button" class="btn btn-outline-secondary" data-filter="pending">
                    <i class="bi bi-clock me-1"></i> Menunggu
                </button>
                <button type="button" class="btn btn-outline-secondary" data-filter="replied">
                    <i class="bi bi-check-circle me-1"></i> Sudah Dibalas
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Feedback List -->
<div class="content-card">
    <div class="content-card-header">
        <h5 class="content-card-title">
            <i class="bi bi-list-ul me-2"></i>
            Daftar Feedback
        </h5>
        <div class="content-card-actions">
            <button class="btn btn-sm btn-outline-primary" onclick="refreshFeedback()">
                <i class="bi bi-arrow-clockwise"></i> Refresh
            </button>
        </div>
    </div>
    <div class="content-card-body">
        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-state-icon">
                <i class="bi bi-chat-dots"></i>
            </div>
            <h4>Belum ada feedback</h4>
            <p class="text-muted">Feedback dari pengguna akan muncul di sini</p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchFeedback');
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        // Add search logic here when feedback data is available
    });

    // Filter functionality
    const filterButtons = document.querySelectorAll('[data-filter]');
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Add filter logic here when feedback data is available
        });
    });
});

function exportFeedback() {
    alert('Fitur export feedback akan segera tersedia!');
}

function refreshFeedback() {
    location.reload();
}
</script>

<?= $this->endSection() ?> 