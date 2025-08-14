<?= $this->extend('admin/layout') ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="/assets/css/admin/feedback-detail-styles.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-header mb-4">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2 class="page-title">
                <i class="bi bi-chat-dots me-2"></i>
                Detail Feedback
            </h2>
            <p class="page-subtitle mb-0">Lihat dan kelola feedback dari pengguna</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="/admin/feedback" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>
                Kembali ke Daftar
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="content-card">
            <div class="content-card-header">
                <h5 class="content-card-title">
                    <i class="bi bi-chat-text me-2"></i>
                    Informasi Feedback
                </h5>
                <div class="content-card-actions">
                    <select class="form-select form-select-sm" id="statusSelect" onchange="updateStatus(<?= $feedback['id'] ?>)">
                        <option value="pending" <?= $feedback['status'] == 'pending' ? 'selected' : '' ?>>Menunggu</option>
                        <option value="dibaca" <?= $feedback['status'] == 'dibaca' ? 'selected' : '' ?>>Dibaca</option>
                        <option value="dibalas" <?= $feedback['status'] == 'dibalas' ? 'selected' : '' ?>>Dibalas</option>
                        <option value="selesai" <?= $feedback['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                    </select>
                </div>
            </div>
            <div class="content-card-body">
                <div class="feedback-detail-content">
                    <div class="feedback-header mb-4">
                        <div class="feedback-subject">
                            <h4><?= esc($feedback['subjek']) ?></h4>
                        </div>
                        <div class="feedback-meta">
                            <span class="badge bg-primary me-2"><?= ucfirst($feedback['jenis_feedback']) ?></span>
                            <span class="badge bg-<?= $feedback['status'] == 'pending' ? 'warning' : ($feedback['status'] == 'dibaca' ? 'info' : ($feedback['status'] == 'dibalas' ? 'success' : 'success')) ?>">
                                <?= ucfirst($feedback['status']) ?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="feedback-message mb-4">
                        <h6>Pesan:</h6>
                        <div class="message-content">
                            <?= nl2br(esc($feedback['pesan'])) ?>
                        </div>
                    </div>
                    
                    <?php if ($feedback['file_lampiran']): ?>
                        <div class="feedback-attachment mb-4">
                            <h6>Lampiran:</h6>
                            <div class="attachment-content">
                                <?php
                                $filePath = '/uploads/feedback/' . $feedback['file_lampiran'];
                                $fileExtension = pathinfo($feedback['file_lampiran'], PATHINFO_EXTENSION);
                                $isImage = in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif']);
                                $isVideo = in_array(strtolower($fileExtension), ['mp4', 'avi', 'mov', 'wmv']);
                                ?>
                                
                                <?php if ($isImage): ?>
                                    <div class="attachment-preview">
                                        <img src="<?= $filePath ?>" alt="Lampiran" class="img-fluid rounded" style="max-width: 300px;">
                                    </div>
                                <?php elseif ($isVideo): ?>
                                    <div class="attachment-preview">
                                        <video controls class="img-fluid rounded" style="max-width: 300px;">
                                            <source src="<?= $filePath ?>" type="video/<?= $fileExtension ?>">
                                            Browser Anda tidak mendukung tag video.
                                        </video>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="attachment-info mt-2">
                                    <a href="<?= $filePath ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-download me-1"></i>
                                        Download Lampiran
                                    </a>
                                    <small class="text-muted ms-2"><?= $feedback['file_lampiran'] ?></small>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="content-card">
            <div class="content-card-header">
                <h5 class="content-card-title">
                    <i class="bi bi-person me-2"></i>
                    Informasi Pengirim
                </h5>
            </div>
            <div class="content-card-body">
                <div class="sender-info">
                    <div class="info-item mb-3">
                        <label class="form-label fw-bold">Nama:</label>
                        <div class="info-value"><?= esc($feedback['nama']) ?></div>
                    </div>
                    
                    <div class="info-item mb-3">
                        <label class="form-label fw-bold">Email:</label>
                        <div class="info-value">
                            <a href="mailto:<?= esc($feedback['email']) ?>"><?= esc($feedback['email']) ?></a>
                        </div>
                    </div>
                    
                    <?php if ($feedback['telepon']): ?>
                        <div class="info-item mb-3">
                            <label class="form-label fw-bold">Telepon:</label>
                            <div class="info-value">
                                <a href="tel:<?= esc($feedback['telepon']) ?>"><?= esc($feedback['telepon']) ?></a>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <div class="info-item mb-3">
                        <label class="form-label fw-bold">Tanggal Kirim:</label>
                        <div class="info-value"><?= date('d M Y H:i', strtotime($feedback['created_at'])) ?></div>
                    </div>
                    
                    <div class="info-item mb-3">
                        <label class="form-label fw-bold">IP Address:</label>
                        <div class="info-value"><?= esc($feedback['ip_address']) ?></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="content-card mt-4">
            <div class="content-card-header">
                <h5 class="content-card-title">
                    <i class="bi bi-gear me-2"></i>
                    Aksi
                </h5>
            </div>
            <div class="content-card-body">
                <div class="action-buttons">
                    <button type="button" class="btn btn-primary w-100 mb-2" onclick="replyFeedback(<?= $feedback['id'] ?>)">
                        <i class="bi bi-reply me-2"></i>
                        Balas Feedback
                    </button>
                    
                    <button type="button" class="btn btn-success w-100 mb-2" onclick="markAsComplete(<?= $feedback['id'] ?>)">
                        <i class="bi bi-check-circle me-2"></i>
                        Tandai Selesai
                    </button>
                    
                    <button type="button" class="btn btn-danger w-100" onclick="deleteFeedback(<?= $feedback['id'] ?>, '<?= esc($feedback['nama']) ?>')">
                        <i class="bi bi-trash me-2"></i>
                        Hapus Feedback
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updateStatus(feedbackId) {
    const status = document.getElementById('statusSelect').value;
    
    fetch(`/admin/feedback/update-status/${feedbackId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `status=${status}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update badge color
            const badge = document.querySelector('.feedback-meta .badge:last-child');
            const statusColors = {
                'pending': 'warning',
                'dibaca': 'info',
                'dibalas': 'success',
                'selesai': 'success'
            };
            
            badge.className = `badge bg-${statusColors[status]}`;
            badge.textContent = status.charAt(0).toUpperCase() + status.slice(1);
            
            // Show success message
            alert('Status berhasil diperbarui!');
        } else {
            alert('Gagal memperbarui status: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memperbarui status');
    });
}

function replyFeedback(feedbackId) {
    const email = '<?= esc($feedback['email']) ?>';
    const subject = 'Re: <?= esc($feedback['subjek']) ?>';
    
    // Open default email client
    window.open(`mailto:${email}?subject=${encodeURIComponent(subject)}`);
}

function markAsComplete(feedbackId) {
    if (confirm('Tandai feedback ini sebagai selesai?')) {
        document.getElementById('statusSelect').value = 'selesai';
        updateStatus(feedbackId);
    }
}

function deleteFeedback(feedbackId, name) {
    if (confirm(`Apakah Anda yakin ingin menghapus feedback dari "${name}"?\n\nTindakan ini tidak dapat dibatalkan.`)) {
        window.location.href = `/admin/feedback/delete/${feedbackId}`;
    }
}
</script>

<?= $this->endSection() ?> 