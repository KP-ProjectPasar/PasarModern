<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-title">Data Pasar</h1>
            <p class="page-subtitle mb-0">Kelola informasi dan data pasar yang tersedia</p>
        </div>
        <div class="col-auto">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPasarModal">
                <i class="bi bi-plus-circle me-2"></i>Tambah Data Pasar
            </button>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-primary">
            <div class="stat-card-mini-icon">
                <i class="bi bi-building"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number">12</div>
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
                <div class="stat-card-mini-number">10</div>
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
                <div class="stat-card-mini-number">2</div>
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
                <div class="stat-card-mini-number">1,250</div>
                <div class="stat-card-mini-label">Total Pedagang</div>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter Section -->
<div class="search-filter-section mb-4">
    <div class="row align-items-center">
        <div class="col-md-12">
            <div class="search-box">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control" id="searchPasar" placeholder="Cari data pasar...">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Data Pasar Cards -->
<div class="row" id="pasarContainer">
    <!-- Pasar Card 1 -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="pasar-card">
            <div class="pasar-card-image">
                <img src="/assets/img/pasar1.jpeg" alt="Pasar Modern Tangerang">
                <div class="pasar-card-overlay">
                    <div class="pasar-card-actions">
                        <button class="btn btn-light btn-sm" onclick="viewPasar(1)" title="Lihat Detail">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-primary btn-sm" onclick="editPasar(1)" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="deletePasar(1)" title="Hapus">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="pasar-card-body">
                <h5 class="pasar-card-title">Pasar Modern Tangerang</h5>
                <div class="pasar-card-meta">
                    <span><i class="bi bi-geo-alt me-1"></i>Jl. Raya Tangerang No. 123</span>
                    <span><i class="bi bi-telephone me-1"></i>021-1234567</span>
                </div>
                <p class="pasar-card-description">
                    Pasar modern dengan fasilitas lengkap, menjual berbagai jenis komoditas segar dan kebutuhan sehari-hari.
                </p>
                <div class="pasar-card-footer">
                    <div class="pasar-card-stats">
                        <span><i class="bi bi-people me-1"></i>150 Pedagang</span>
                        <span><i class="bi bi-clock me-1"></i>06:00 - 18:00</span>
                        <span><i class="bi bi-star me-1"></i>4.5/5</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pasar Card 2 -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="pasar-card">
            <div class="pasar-card-image">
                <img src="/assets/img/pasar2.jpeg" alt="Pasar Tradisional Serpong">
                <div class="pasar-card-overlay">
                    <div class="pasar-card-actions">
                        <button class="btn btn-light btn-sm" onclick="viewPasar(2)" title="Lihat Detail">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-primary btn-sm" onclick="editPasar(2)" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="deletePasar(2)" title="Hapus">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="pasar-card-body">
                <h5 class="pasar-card-title">Pasar Tradisional Serpong</h5>
                <div class="pasar-card-meta">
                    <span><i class="bi bi-geo-alt me-1"></i>Jl. Serpong Raya No. 45</span>
                    <span><i class="bi bi-telephone me-1"></i>021-9876543</span>
                </div>
                <p class="pasar-card-description">
                    Pasar tradisional yang ramai dengan berbagai pedagang lokal, menjual produk segar dan murah.
                </p>
                <div class="pasar-card-footer">
                    <div class="pasar-card-stats">
                        <span><i class="bi bi-people me-1"></i>200 Pedagang</span>
                        <span><i class="bi bi-clock me-1"></i>05:00 - 17:00</span>
                        <span><i class="bi bi-star me-1"></i>4.2/5</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pasar Card 3 -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="pasar-card">
            <div class="pasar-card-image">
                <img src="/assets/img/pasar3.jpeg" alt="Pasar Ciputat">
                <div class="pasar-card-overlay">
                    <div class="pasar-card-actions">
                        <button class="btn btn-light btn-sm" onclick="viewPasar(3)" title="Lihat Detail">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-primary btn-sm" onclick="editPasar(3)" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="deletePasar(3)" title="Hapus">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="pasar-card-body">
                <h5 class="pasar-card-title">Pasar Ciputat</h5>
                <div class="pasar-card-meta">
                    <span><i class="bi bi-geo-alt me-1"></i>Jl. Ciputat Raya No. 78</span>
                    <span><i class="bi bi-telephone me-1"></i>021-5551234</span>
                </div>
                <p class="pasar-card-description">
                    Pasar yang sedang dalam proses renovasi untuk meningkatkan kualitas layanan dan fasilitas.
                </p>
                <div class="pasar-card-footer">
                    <div class="pasar-card-stats">
                        <span><i class="bi bi-people me-1"></i>120 Pedagang</span>
                        <span><i class="bi bi-clock me-1"></i>07:00 - 16:00</span>
                        <span><i class="bi bi-star me-1"></i>4.0/5</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Empty State -->
<div class="empty-state" id="emptyState" style="display: none;">
    <div class="empty-state-icon">
        <i class="bi bi-building"></i>
    </div>
    <h4>Tidak ada data pasar</h4>
    <p class="text-muted">Belum ada data pasar yang ditambahkan atau tidak ada hasil yang sesuai dengan pencarian.</p>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPasarModal">
        <i class="bi bi-plus-circle me-2"></i>Tambah Data Pasar Pertama
    </button>
</div>

<!-- Add Pasar Modal -->
<div class="modal fade" id="tambahPasarModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Pasar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="tambahPasarForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Pasar</label>
                            <input type="text" class="form-control" name="nama_pasar" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" required>
                                <option value="aktif">Aktif</option>
                                <option value="perbaikan">Perbaikan</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" rows="3" required></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Telepon</label>
                            <input type="tel" class="form-control" name="telepon">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jam Operasional</label>
                            <input type="text" class="form-control" name="jam_operasional" placeholder="06:00 - 18:00">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jumlah Pedagang</label>
                            <input type="number" class="form-control" name="jumlah_pedagang" min="0">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto Pasar</label>
                        <input type="file" class="form-control" name="foto" accept="image/*">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="savePasar()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
// Search functionality
document.getElementById('searchPasar').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const cards = document.querySelectorAll('#pasarContainer .col-lg-4');
    let visibleCount = 0;
    
    cards.forEach(card => {
        const title = card.querySelector('.pasar-card-title').textContent.toLowerCase();
        const description = card.querySelector('.pasar-card-description').textContent.toLowerCase();
        const address = card.querySelector('.pasar-card-meta span:first-child').textContent.toLowerCase();
        
        if (title.includes(searchTerm) || description.includes(searchTerm) || address.includes(searchTerm)) {
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

// Pasar functions
function viewPasar(id) {
    // TODO: Implement view functionality
}

function editPasar(id) {
    // TODO: Implement edit functionality
}

function deletePasar(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data pasar ini?')) {
        // TODO: Implement delete functionality
    }
}

function savePasar() {
    // TODO: Implement save functionality
    document.getElementById('tambahPasarModal').querySelector('.btn-close').click();
}
</script>

<?= $this->endSection() ?> 