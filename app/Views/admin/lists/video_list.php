<?= $this->extend('admin/layout') ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="/assets/css/admin/video-list-styles.css">
<script src="/assets/js/admin/video-list.js" defer></script>
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
            
            <div class="table-summary mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="summary-item">
                            <i class="bi bi-info-circle me-2"></i>
                            <span>Total: <strong><?= count($videos) ?></strong> video</span>
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

<?= $this->endSection() ?> 