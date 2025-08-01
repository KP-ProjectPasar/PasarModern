<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-title">Kelola Level</h1>
            <p class="page-subtitle mb-0">Kelola level dan hierarki akses admin</p>
        </div>
        <div class="col-auto">
            <a href="/admin/level/create" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Tambah Level
            </a>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-primary">
            <div class="stat-card-mini-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number">5</div>
                <div class="stat-card-mini-label">Total Level</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-success">
            <div class="stat-card-mini-icon">
                <i class="bi bi-check-circle"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number">4</div>
                <div class="stat-card-mini-label">Level Aktif</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-warning">
            <div class="stat-card-mini-icon">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number">12</div>
                <div class="stat-card-mini-label">Total User</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-info">
            <div class="stat-card-mini-icon">
                <i class="bi bi-gear"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number">8</div>
                <div class="stat-card-mini-label">Permissions</div>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter Section -->
<div class="search-filter-section mb-4">
    <div class="row align-items-center">
        <div class="col-md-6 mb-3 mb-md-0">
            <div class="search-box">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control" id="searchLevel" placeholder="Cari level...">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-secondary active" data-filter="all">Semua</button>
                <button type="button" class="btn btn-outline-secondary" data-filter="aktif">Aktif</button>
                <button type="button" class="btn btn-outline-secondary" data-filter="nonaktif">Nonaktif</button>
            </div>
        </div>
    </div>
</div>

<!-- Level Cards -->
<div class="row" id="levelContainer">
    <?php foreach ($levels as $level): ?>
    <div class="col-lg-4 col-md-6 mb-4" data-category="aktif">
        <div class="level-card">
            <div class="level-card-header">
                <div class="level-card-icon">
                    <i class="bi bi-shield-check"></i>
                </div>
                <div class="level-card-status aktif">Aktif</div>
            </div>
            <div class="level-card-body">
                <h5 class="level-card-title"><?= esc($level['nama']) ?></h5>
                <p class="level-card-description">
                    <?= esc($level['keterangan']) ?>
                </p>
                <div class="level-card-meta">
                    <span><i class="bi bi-people me-1"></i>3 User</span>
                    <span><i class="bi bi-calendar me-1"></i>Dibuat: 15 Jan 2024</span>
                </div>
                <div class="level-card-permissions">
                    <span class="permission-badge">Dashboard</span>
                    <span class="permission-badge">User Management</span>
                    <span class="permission-badge">Content Management</span>
                </div>
            </div>
            <div class="level-card-footer">
                <div class="level-card-actions">
                    <button class="btn btn-light btn-sm" onclick="viewLevel(<?= $level['id'] ?>)" title="Lihat Detail">
                        <i class="bi bi-eye"></i>
                    </button>
                    <a href="/admin/level/edit/<?= $level['id'] ?>" class="btn btn-primary btn-sm" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <button class="btn btn-danger btn-sm" onclick="deleteLevel(<?= $level['id'] ?>)" title="Hapus">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<!-- Empty State -->
<div class="empty-state" id="emptyState" style="display: none;">
    <div class="empty-state-icon">
        <i class="bi bi-shield-lock"></i>
    </div>
    <h4>Tidak ada level</h4>
    <p class="text-muted">Belum ada level yang ditambahkan atau tidak ada hasil yang sesuai dengan pencarian.</p>
    <a href="/admin/level/create" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Tambah Level Pertama
    </a>
</div>

<script>
// Search functionality
document.getElementById('searchLevel').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const cards = document.querySelectorAll('#levelContainer .col-lg-4');
    let visibleCount = 0;
    
    cards.forEach(card => {
        const title = card.querySelector('.level-card-title').textContent.toLowerCase();
        const description = card.querySelector('.level-card-description').textContent.toLowerCase();
        
        if (title.includes(searchTerm) || description.includes(searchTerm)) {
            card.style.display = 'block';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });
    
    // Show/hide empty state
    const emptyState = document.getElementById('emptyState');
    if (visibleCount === 0) {
        emptyState.style.display = 'block';
    } else {
        emptyState.style.display = 'none';
    }
});

// Filter functionality
document.querySelectorAll('[data-filter]').forEach(button => {
    button.addEventListener('click', function() {
        const filter = this.getAttribute('data-filter');
        
        // Update active button
        document.querySelectorAll('[data-filter]').forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');
        
        // Filter cards
        const cards = document.querySelectorAll('#levelContainer .col-lg-4');
        let visibleCount = 0;
        
        cards.forEach(card => {
            const category = card.getAttribute('data-category');
            if (filter === 'all' || category === filter) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
        
        // Show/hide empty state
        const emptyState = document.getElementById('emptyState');
        if (visibleCount === 0) {
            emptyState.style.display = 'block';
        } else {
            emptyState.style.display = 'none';
        }
    });
});

// Level functions
function viewLevel(id) {
    // TODO: Implement view functionality
}

function deleteLevel(id) {
    if (confirm('Apakah Anda yakin ingin menghapus level ini?')) {
        window.location.href = '/admin/level/delete/' + id;
    }
}
</script>

<?= $this->endSection() ?> 