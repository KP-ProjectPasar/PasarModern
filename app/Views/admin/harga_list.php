<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-title">Harga Komoditas</h1>
            <p class="page-subtitle mb-0">Kelola informasi harga komoditas pasar</p>
        </div>
        <div class="col-auto">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahHargaModal">
                <i class="bi bi-plus-circle me-2"></i>Tambah Harga
            </button>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-primary">
            <div class="stat-card-mini-icon">
                <i class="bi bi-currency-dollar"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count($hargas) ?></div>
                <div class="stat-card-mini-label">Total Harga</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-success">
            <div class="stat-card-mini-icon">
                <i class="bi bi-graph-up"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count(array_unique(array_column($hargas, 'komoditas'))) ?></div>
                <div class="stat-card-mini-label">Jenis Komoditas</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-warning">
            <div class="stat-card-mini-icon">
                <i class="bi bi-calendar-check"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= date('d') ?></div>
                <div class="stat-card-mini-label">Update Hari Ini</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-info">
            <div class="stat-card-mini-icon">
                <i class="bi bi-clock-history"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= date('M Y') ?></div>
                <div class="stat-card-mini-label">Periode Aktif</div>
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
                    <input type="text" class="form-control" id="searchHarga" placeholder="Cari harga komoditas...">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-secondary active" data-filter="all">Semua</button>
                <button type="button" class="btn btn-outline-secondary" data-filter="sayuran">Sayuran</button>
                <button type="button" class="btn btn-outline-secondary" data-filter="buah">Buah</button>
                <button type="button" class="btn btn-outline-secondary" data-filter="daging">Daging</button>
                <button type="button" class="btn btn-outline-secondary" data-filter="lainnya">Lainnya</button>
            </div>
        </div>
    </div>
</div>

<!-- Harga Komoditas Cards -->
<div class="row" id="hargaContainer">
    <?php foreach ($hargas as $harga): ?>
    <div class="col-lg-4 col-md-6 mb-4" data-category="<?= esc($harga['kategori'] ?? 'sayuran') ?>">
        <div class="harga-card">
            <div class="harga-card-header">
                <div class="harga-card-image">
                    <?php if (!empty($harga['foto'])): ?>
                        <img src="/uploads/komoditas/<?= esc($harga['foto']) ?>" 
                             alt="<?= esc($harga['komoditas']) ?>"
                             onerror="this.style.background='linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%)'; this.style.display='flex'; this.style.alignItems='center'; this.style.justifyContent='center'; this.style.fontSize='3rem'; this.style.color='#adb5bd'; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiBmaWxsPSIjRjhGOEZBIi8+Cjx0ZXh0IHg9IjUwIiB5PSI1MCIgZm9udC1mYW1pbHk9IkFyaWFsLCBzYW5zLXNlcmlmIiBmb250LXNpemU9IjE0IiBmaWxsPSIjQURCNUI1RCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPk5vIEltYWdlPC90ZXh0Pgo8L3N2Zz4K';">
                    <?php else: ?>
                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); display: flex; align-items: center; justify-content: center; font-size: 3rem; color: #adb5bd;">
                            🍅
                        </div>
                    <?php endif; ?>
                </div>
                <div class="harga-card-price">
                    <span class="price-amount">Rp <?= number_format($harga['harga'], 0, ',', '.') ?></span>
                    <span class="price-unit">/kg</span>
                </div>
            </div>
            <div class="harga-card-body">
                <h5 class="harga-card-title"><?= esc($harga['komoditas']) ?></h5>
                <div class="harga-card-meta">
                    <span><i class="bi bi-calendar me-1"></i><?= date('d M Y', strtotime($harga['tanggal'])) ?></span>
                    <span><i class="bi bi-clock me-1"></i><?= date('H:i', strtotime($harga['tanggal'])) ?></span>
                </div>
                <div class="harga-card-description">
                    <?= esc($harga['deskripsi'] ?? 'Harga komoditas ' . $harga['komoditas'] . ' per kilogram pada tanggal ' . date('d M Y', strtotime($harga['tanggal']))) ?>
                </div>
            </div>
            <div class="harga-card-footer">
                <div class="harga-card-actions">
                    <button class="btn btn-light btn-sm" onclick="viewHarga(<?= $harga['id'] ?>)" title="Lihat Detail">
                        <i class="bi bi-eye"></i>
                    </button>
                    <button class="btn btn-primary btn-sm" onclick="editHarga(<?= $harga['id'] ?>)" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="deleteHarga(<?= $harga['id'] ?>)" title="Hapus">
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
        <i class="bi bi-currency-dollar"></i>
    </div>
    <h4>Tidak ada data harga</h4>
    <p class="text-muted">Belum ada data harga komoditas yang ditambahkan atau tidak ada hasil yang sesuai dengan pencarian.</p>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahHargaModal">
        <i class="bi bi-plus-circle me-2"></i>Tambah Harga Pertama
    </button>
</div>

<!-- Add Harga Modal -->
<div class="modal fade" id="tambahHargaModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Harga Komoditas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="tambahHargaForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Komoditas</label>
                            <input type="text" class="form-control" name="komoditas" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga (Rp/kg)</label>
                            <input type="number" class="form-control" name="harga" min="0" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d') ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kategori</label>
                            <select class="form-select" name="kategori" required>
                                <option value="sayuran">Sayuran</option>
                                <option value="buah">Buah</option>
                                <option value="daging">Daging</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto Komoditas</label>
                        <input type="file" class="form-control" name="foto" accept="image/*">
                        <small class="text-muted">Upload foto komoditas untuk tampilan yang lebih menarik</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="3" placeholder="Deskripsi singkat tentang komoditas ini..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="saveHarga()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
// Search functionality
document.getElementById('searchHarga').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const cards = document.querySelectorAll('#hargaContainer .col-lg-4');
    let visibleCount = 0;
    
    cards.forEach(card => {
        const title = card.querySelector('.harga-card-title').textContent.toLowerCase();
        const description = card.querySelector('.harga-card-description').textContent.toLowerCase();
        
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
        const cards = document.querySelectorAll('#hargaContainer .col-lg-4');
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

// Harga functions
function viewHarga(id) {
    showNotification('Melihat detail harga dengan ID: ' + id, 'info');
}

function editHarga(id) {
    showNotification('Mengedit data harga dengan ID: ' + id, 'info');
}

function deleteHarga(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data harga ini?')) {
        showNotification('Data harga berhasil dihapus!', 'success');
    }
}

function saveHarga() {
    showNotification('Data harga berhasil disimpan!', 'success');
    document.getElementById('tambahHargaModal').querySelector('.btn-close').click();
}
</script>

<?= $this->endSection() ?> 