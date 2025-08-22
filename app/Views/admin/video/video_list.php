<?= $this->extend('admin/layout') ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="/assets/css/admin/video/video-list-styles.css">
<script src="/assets/js/admin/video/video-list.js" defer></script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-title">
                <i class="bi bi-camera-video-fill me-2"></i>Kelola Video
            </h1>
            <p class="page-subtitle mb-0">Manajemen video untuk sistem informasi pasar modern</p>
        </div>
        <div class="col-auto">
            <a href="/admin/video/create" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Tambah Video
            </a>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-primary">
            <div class="stat-card-mini-icon">
                <i class="bi bi-camera-video"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count($videos) ?></div>
                <div class="stat-card-mini-label">Total Video</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-success">
            <div class="stat-card-mini-icon">
                <i class="bi bi-play-circle"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count(array_filter($videos, function($video) { return isset($video['status']) && $video['status'] == 'published'; })) ?></div>
                <div class="stat-card-mini-label">Dipublikasikan</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-warning">
            <div class="stat-card-mini-icon">
                <i class="bi bi-clock"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count(array_filter($videos, function($video) { return isset($video['status']) && $video['status'] == 'draft'; })) ?></div>
                <div class="stat-card-mini-label">Draft</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-info">
            <div class="stat-card-mini-icon">
                <i class="bi bi-eye"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= array_sum(array_column($videos, 'views') ?? []) ?></div>
                <div class="stat-card-mini-label">Total Views</div>
            </div>
        </div>
    </div>
</div>

<div class="content-card">
    <div class="content-card-header">
        <div class="content-card-title">
            <h3><i class="bi bi-table me-2"></i>Daftar Video</h3>
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
        <?php if (empty($videos)): ?>
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-camera-video"></i>
                </div>
                <h4>Belum ada data video</h4>
                <p>Mulai dengan menambahkan video pertama untuk sistem</p>
                <a href="/admin/video/create" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Video Pertama
                </a>
            </div>
        <?php else: ?>
                        <div class="table-responsive">
                                <table class="table table-hover admin-table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center" style="width: 50px;">
                                <i class="bi bi-hash"></i>
                            </th>
                            <th scope="col">
                                <i class="bi bi-camera-video me-2"></i>Informasi Video
                            </th>
                            <th scope="col">
                                <i class="bi bi-play-circle me-2"></i>Tipe
                            </th>
                            <th scope="col">
                                <i class="bi bi-eye me-2"></i>Views
                            </th>
                            <th scope="col">
                                <i class="bi bi-circle me-2"></i>Status
                            </th>
                            <th scope="col">
                                <i class="bi bi-calendar me-2"></i>Tanggal Upload
                            </th>
                            <th scope="col" class="text-center" style="width: 150px;">
                                <i class="bi bi-gear me-2"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($videos as $index => $video): ?>
                        <?php 
                            // Tentukan tipe dengan fallback jika kolom 'tipe' belum ada atau nilainya tidak konsisten
                            $rawType = strtolower(trim((string)($video['tipe'] ?? '')));
                            $computedType = null;
                            if ($rawType === 'url' || $rawType === 'file') {
                                $computedType = $rawType;
                            } elseif (!empty($video['file_video'] ?? null)) {
                                $computedType = 'file';
                            } elseif (!empty($video['url'] ?? null)) {
                                $urlVal = (string) $video['url'];
                                $lowerUrl = strtolower($urlVal);
                                $isHttp = (strpos($lowerUrl, 'http://') === 0 || strpos($lowerUrl, 'https://') === 0);
                                $looksLocalUpload = (strpos($lowerUrl, '/uploads/video/') !== false || strpos($lowerUrl, '/public/uploads/video/') !== false);
                                // Jika URL absolut tapi mengarah ke folder uploads video lokal, tetap dianggap file
                                if ($looksLocalUpload) {
                                    $computedType = 'file';
                                } else {
                                    $computedType = $isHttp ? 'url' : 'file';
                                }
                            } else {
                                $computedType = 'url';
                            }
                        ?>
                        <tr class="video-row" data-title="<?= strtolower(esc($video['judul'])) ?>" data-tipe="<?= esc($computedType) ?>">
                            <td class="text-center"><span class="badge bg-secondary"><?= $index + 1 ?></span></td>
                            <td>
                                <div class="video-info-cell">
                                    <div class="video-icon-mini"><i class="bi bi-camera-video"></i></div>
                                    <div class="video-details">
                                        <div class="video-title"><?= esc($video['judul']) ?></div>
                                        <div class="video-description text-muted small"><?= esc(substr($video['deskripsi'] ?? '', 0, 100)) . (strlen($video['deskripsi'] ?? '') > 100 ? '...' : '') ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="video-type">
                                <?php if ($computedType === 'url'): ?>
                                    <span class="type-badge youtube-badge">URL</span>
                                <?php else: ?>
                                    <span class="type-badge file-badge">File</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="video-views"><i class="bi bi-eye me-1"></i><?= number_format($video['views'] ?? 0) ?></div>
                            </td>
                            <td>
                                <div class="status-indicator">
                                    <?php 
                                    $statusRaw = $video['status'] ?? null;
                                    $status = is_string($statusRaw) ? strtolower($statusRaw) : $statusRaw; 
                                    if ($status === 'published'): 
                                    ?>
                                        <span class="badge bg-success">Published</span>
                                    <?php elseif ($status === 'draft'): ?>
                                        <span class="badge bg-warning">Draft</span>
                                    <?php elseif ($status === 'archived'): ?>
                                        <span class="badge bg-warning">Draft</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">—</span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td><div class="upload-date"><i class="bi bi-calendar me-1"></i><?= date('d M Y H:i', strtotime($video['created_at'])) ?></div></td>
                            <td>
                                <div class="action-buttons">
                                    <div class="btn-group me-2" role="group">
                                        <?php if (($status ?? 'draft') !== 'draft'): ?>
                                            <a href="/admin/video/status/<?= $video['id'] ?>/draft" 
                                               class="btn btn-sm btn-outline-warning" 
                                               onclick="return confirm('Ubah status ke Draft?')"
                                               title="Set Draft">
                                                <i class="bi bi-clock"></i>
                                            </a>
                                        <?php endif; ?>

                                        <?php if (($status ?? '') !== 'published'): ?>
                                            <a href="/admin/video/status/<?= $video['id'] ?>/published" 
                                               class="btn btn-sm btn-outline-success" 
                                               onclick="return confirm('Publish video ini?')"
                                               title="Publish">
                                                <i class="bi bi-check-circle"></i>
                                            </a>
                                        <?php endif; ?>

                                        
                                    </div>

                                    <a href="/admin/video/edit/<?= $video['id'] ?>" class="btn btn-sm btn-outline-primary" title="Edit Video">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                            onclick="confirmDelete(<?= $video['id'] ?>, '<?= esc($video['judul']) ?>')" title="Hapus Video">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="delete-modal">
    <div class="delete-modal-content">
        <div class="delete-modal-header">
            <h5 class="delete-modal-title">Konfirmasi Hapus</h5>
            <button type="button" class="delete-modal-close" onclick="closeDeleteModal()">&times;</button>
        </div>
        <div class="delete-modal-body">
            <p class="delete-modal-text">Anda yakin ingin menghapus video "<span id="deleteVideoTitle"></span>"?</p>
            <p class="delete-modal-warning">Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="delete-modal-footer">
            <button type="button" class="delete-modal-btn delete-modal-btn-cancel" onclick="closeDeleteModal()">Batal</button>
            <a href="#" id="deleteVideoBtn" class="delete-modal-btn delete-modal-btn-delete">Hapus</a>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, title) {
    document.getElementById('deleteVideoTitle').textContent = title;
    document.getElementById('deleteVideoBtn').href = '/admin/video/delete/' + id;
    
    const modal = document.getElementById('deleteModal');
    modal.classList.add('show');
    
    // Tambahkan event listener untuk menutup modal saat klik di luar
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeDeleteModal();
        }
    });
    
    // Tambahkan event listener untuk escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    modal.classList.remove('show');
}

// Pastikan modal tertutup saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('deleteModal');
    if (modal.classList.contains('show')) {
        modal.classList.remove('show');
    }
});
</script>

<?= $this->endSection() ?>