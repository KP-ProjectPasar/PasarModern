<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-title">Kelola Grup</h1>
            <p class="text-muted mb-0">Kelola grup dan kategori untuk organisasi data</p>
        </div>
        <div class="col-auto">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahGrupModal">
                <i class="bi bi-plus-circle me-2"></i>Tambah Grup
            </button>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-primary">
            <div class="stat-card-mini-icon">
                <i class="bi bi-collection"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number">8</div>
                <div class="stat-card-mini-label">Total Grup</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-success">
            <div class="stat-card-mini-icon">
                <i class="bi bi-check-circle"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number">6</div>
                <div class="stat-card-mini-label">Grup Aktif</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-warning">
            <div class="stat-card-mini-icon">
                <i class="bi bi-pause-circle"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number">2</div>
                <div class="stat-card-mini-label">Grup Nonaktif</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-info">
            <div class="stat-card-mini-icon">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number">45</div>
                <div class="stat-card-mini-label">Total Member</div>
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
                    <input type="text" class="form-control" id="searchGrup" placeholder="Cari grup...">
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

<!-- Grup Cards -->
<div class="row" id="grupContainer">
    <!-- Grup Card 1 -->
    <div class="col-lg-4 col-md-6 mb-4" data-category="aktif">
        <div class="grup-card">
            <div class="grup-card-header">
                <div class="grup-card-icon">
                    <i class="bi bi-shield-check"></i>
                </div>
                <div class="grup-card-status aktif">Aktif</div>
            </div>
            <div class="grup-card-body">
                <h5 class="grup-card-title">Administrator</h5>
                <p class="grup-card-description">
                    Grup untuk administrator sistem dengan akses penuh ke semua fitur.
                </p>
                <div class="grup-card-meta">
                    <span><i class="bi bi-people me-1"></i>5 Member</span>
                    <span><i class="bi bi-calendar me-1"></i>Dibuat: 15 Jan 2024</span>
                </div>
                <div class="grup-card-permissions">
                    <span class="permission-badge">Dashboard</span>
                    <span class="permission-badge">User Management</span>
                    <span class="permission-badge">Content Management</span>
                    <span class="permission-badge">System Settings</span>
                </div>
            </div>
            <div class="grup-card-footer">
                <div class="grup-card-actions">
                    <button class="btn btn-light btn-sm" onclick="viewGrup(1)" title="Lihat Detail">
                        <i class="bi bi-eye"></i>
                    </button>
                    <button class="btn btn-primary btn-sm" onclick="editGrup(1)" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="deleteGrup(1)" title="Hapus">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Grup Card 2 -->
    <div class="col-lg-4 col-md-6 mb-4" data-category="aktif">
        <div class="grup-card">
            <div class="grup-card-header">
                <div class="grup-card-icon">
                    <i class="bi bi-newspaper"></i>
                </div>
                <div class="grup-card-status aktif">Aktif</div>
            </div>
            <div class="grup-card-body">
                <h5 class="grup-card-title">Content Manager</h5>
                <p class="grup-card-description">
                    Grup untuk mengelola konten website seperti berita, galeri, dan video.
                </p>
                <div class="grup-card-meta">
                    <span><i class="bi bi-people me-1"></i>8 Member</span>
                    <span><i class="bi bi-calendar me-1"></i>Dibuat: 20 Jan 2024</span>
                </div>
                <div class="grup-card-permissions">
                    <span class="permission-badge">Berita</span>
                    <span class="permission-badge">Galeri</span>
                    <span class="permission-badge">Video</span>
                    <span class="permission-badge">Data Pasar</span>
                </div>
            </div>
            <div class="grup-card-footer">
                <div class="grup-card-actions">
                    <button class="btn btn-light btn-sm" onclick="viewGrup(2)" title="Lihat Detail">
                        <i class="bi bi-eye"></i>
                    </button>
                    <button class="btn btn-primary btn-sm" onclick="editGrup(2)" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="deleteGrup(2)" title="Hapus">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Grup Card 3 -->
    <div class="col-lg-4 col-md-6 mb-4" data-category="nonaktif">
        <div class="grup-card">
            <div class="grup-card-header">
                <div class="grup-card-icon">
                    <i class="bi bi-cash-coin"></i>
                </div>
                <div class="grup-card-status nonaktif">Nonaktif</div>
            </div>
            <div class="grup-card-body">
                <h5 class="grup-card-title">Harga Manager</h5>
                <p class="grup-card-description">
                    Grup untuk mengelola data harga komoditas dan informasi pasar.
                </p>
                <div class="grup-card-meta">
                    <span><i class="bi bi-people me-1"></i>3 Member</span>
                    <span><i class="bi bi-calendar me-1"></i>Dibuat: 10 Jan 2024</span>
                </div>
                <div class="grup-card-permissions">
                    <span class="permission-badge">Harga Komoditas</span>
                    <span class="permission-badge">Data Pasar</span>
                </div>
            </div>
            <div class="grup-card-footer">
                <div class="grup-card-actions">
                    <button class="btn btn-light btn-sm" onclick="viewGrup(3)" title="Lihat Detail">
                        <i class="bi bi-eye"></i>
                    </button>
                    <button class="btn btn-primary btn-sm" onclick="editGrup(3)" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="deleteGrup(3)" title="Hapus">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Empty State -->
<div class="empty-state" id="emptyState" style="display: none;">
    <div class="empty-state-icon">
        <i class="bi bi-collection"></i>
    </div>
    <h4>Tidak ada grup</h4>
    <p class="text-muted">Belum ada grup yang ditambahkan atau tidak ada hasil yang sesuai dengan pencarian.</p>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahGrupModal">
        <i class="bi bi-plus-circle me-2"></i>Tambah Grup Pertama
    </button>
</div>

<!-- Add Grup Modal -->
<div class="modal fade" id="tambahGrupModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Grup</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="tambahGrupForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Grup</label>
                            <input type="text" class="form-control" name="nama_grup" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" required>
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Izin Akses</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="dashboard" id="perm_dashboard">
                                    <label class="form-check-label" for="perm_dashboard">Dashboard</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="user" id="perm_user">
                                    <label class="form-check-label" for="perm_user">User Management</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="berita" id="perm_berita">
                                    <label class="form-check-label" for="perm_berita">Berita</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="galeri" id="perm_galeri">
                                    <label class="form-check-label" for="perm_galeri">Galeri</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="video" id="perm_video">
                                    <label class="form-check-label" for="perm_video">Video</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="pasar" id="perm_pasar">
                                    <label class="form-check-label" for="perm_pasar">Data Pasar</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="harga" id="perm_harga">
                                    <label class="form-check-label" for="perm_harga">Harga Komoditas</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="settings" id="perm_settings">
                                    <label class="form-check-label" for="perm_settings">System Settings</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="saveGrup()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
// Search functionality
document.getElementById('searchGrup').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const cards = document.querySelectorAll('#grupContainer .col-lg-4');
    let visibleCount = 0;
    
    cards.forEach(card => {
        const title = card.querySelector('.grup-card-title').textContent.toLowerCase();
        const description = card.querySelector('.grup-card-description').textContent.toLowerCase();
        
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
        const cards = document.querySelectorAll('#grupContainer .col-lg-4');
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

// Grup functions
function viewGrup(id) {
    showNotification('Melihat detail grup dengan ID: ' + id, 'info');
}

function editGrup(id) {
    showNotification('Mengedit data grup dengan ID: ' + id, 'info');
}

function deleteGrup(id) {
    if (confirm('Apakah Anda yakin ingin menghapus grup ini?')) {
        showNotification('Grup berhasil dihapus!', 'success');
    }
}

function saveGrup() {
    showNotification('Data grup berhasil disimpan!', 'success');
    document.getElementById('tambahGrupModal').querySelector('.btn-close').click();
}
</script>

<?= $this->endSection() ?> 