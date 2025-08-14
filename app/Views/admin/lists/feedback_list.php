<?= $this->extend('admin/layout') ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="/assets/css/admin/feedback-list-styles.css">
<script src="/assets/js/admin/feedback-list.js" defer></script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

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

<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-primary">
            <div class="stat-card-mini-icon">
                <i class="bi bi-chat-dots"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count($feedbacks) ?></div>
                <div class="stat-card-mini-label">Total Feedback</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-warning">
            <div class="stat-card-mini-icon">
                <i class="bi bi-clock"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count(array_filter($feedbacks, function($f) { return $f['status'] == 'pending'; })) ?></div>
                <div class="stat-card-mini-label">Menunggu</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-info">
            <div class="stat-card-mini-icon">
                <i class="bi bi-eye"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count(array_filter($feedbacks, function($f) { return $f['status'] == 'dibaca'; })) ?></div>
                <div class="stat-card-mini-label">Dibaca</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-success">
            <div class="stat-card-mini-icon">
                <i class="bi bi-check-circle"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number"><?= count(array_filter($feedbacks, function($f) { return $f['status'] == 'selesai'; })) ?></div>
                <div class="stat-card-mini-label">Selesai</div>
            </div>
        </div>
    </div>
</div>

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
                <button type="button" class="btn btn-outline-secondary" data-filter="dibaca">
                    <i class="bi bi-eye me-1"></i> Dibaca
                </button>
                <button type="button" class="btn btn-outline-secondary" data-filter="selesai">
                    <i class="bi bi-check-circle me-1"></i> Selesai
                </button>
            </div>
        </div>
    </div>
</div>

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
        <?php if (empty($feedbacks)): ?>
        <div class="empty-state">
            <div class="empty-state-icon">
                <i class="bi bi-chat-dots"></i>
            </div>
            <h4>Belum ada feedback</h4>
            <p class="text-muted">Feedback dari pengguna akan muncul di sini</p>
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
                                <i class="bi bi-person me-2"></i>Informasi Pengirim
                            </th>
                            <th scope="col">
                                <i class="bi bi-chat me-2"></i>Feedback
                            </th>
                            <th scope="col">
                                <i class="bi bi-tag me-2"></i>Jenis
                            </th>
                            <th scope="col">
                                <i class="bi bi-circle me-2"></i>Status
                            </th>
                            <th scope="col">
                                <i class="bi bi-calendar me-2"></i>Tanggal
                            </th>
                            <th scope="col" class="text-center" style="width: 150px;">
                                <i class="bi bi-gear me-2"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($feedbacks as $index => $feedback): ?>
                            <tr class="feedback-row" data-status="<?= $feedback['status'] ?>">
                                <td class="text-center">
                                    <span class="badge bg-secondary"><?= $index + 1 ?></span>
                                </td>
                                <td>
                                    <div class="feedback-info-cell">
                                        <div class="feedback-icon-mini">
                                            <i class="bi bi-person"></i>
                                        </div>
                                        <div class="feedback-details">
                                            <div class="feedback-name"><?= esc($feedback['nama']) ?></div>
                                            <div class="feedback-contact">
                                                <i class="bi bi-envelope me-1"></i><?= esc($feedback['email']) ?>
                                                <?php if ($feedback['telepon']): ?>
                                                    <br><i class="bi bi-telephone me-1"></i><?= esc($feedback['telepon']) ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="feedback-content">
                                        <div class="feedback-subject"><?= esc($feedback['subjek']) ?></div>
                                        <div class="feedback-message">
                                            <?= esc(substr($feedback['pesan'], 0, 100)) ?>...
                                        </div>
                                        <?php if ($feedback['file_lampiran']): ?>
                                            <div class="feedback-attachment">
                                                <i class="bi bi-paperclip me-1"></i>
                                                <small>Lampiran tersedia</small>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="feedback-type">
                                        <span class="type-badge type-<?= $feedback['jenis_feedback'] ?>">
                                            <?= ucfirst($feedback['jenis_feedback']) ?>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="status-indicator <?= $feedback['status'] ?>">
                                        <i class="bi bi-circle-fill me-1"></i>
                                        <?= ucfirst($feedback['status']) ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="feedback-date">
                                        <i class="bi bi-calendar me-1"></i>
                                        <?= date('d M Y H:i', strtotime($feedback['created_at'])) ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button type="button" class="btn btn-sm btn-outline-primary" 
                                                onclick="viewFeedback(<?= $feedback['id'] ?>)" 
                                                title="Lihat Detail">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                onclick="deleteFeedback(<?= $feedback['id'] ?>, '<?= esc($feedback['nama']) ?>')" 
                                                title="Hapus Feedback">
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
                            <span>Total: <strong><?= count($feedbacks) ?></strong> feedback</span>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchFeedback');
    const feedbackRows = document.querySelectorAll('.feedback-row');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        feedbackRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    const filterButtons = document.querySelectorAll('[data-filter]');
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            feedbackRows.forEach(row => {
                const status = row.getAttribute('data-status');
                if (filter === 'all' || status === filter) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
});

function viewFeedback(id) {
    window.location.href = `/admin/feedback/view/${id}`;
}

function deleteFeedback(id, name) {
    if (confirm(`Apakah Anda yakin ingin menghapus feedback dari "${name}"?\n\nTindakan ini tidak dapat dibatalkan.`)) {
        window.location.href = `/admin/feedback/delete/${id}`;
    }
}

function exportFeedback() {
    alert('Fitur export feedback akan segera tersedia!');
}

function refreshFeedback() {
    location.reload();
}
</script>

<?= $this->endSection() ?> 