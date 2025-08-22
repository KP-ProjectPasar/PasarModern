<?= $this->extend('admin/layout') ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="/assets/css/admin/common.css">
<link rel="stylesheet" href="/assets/css/admin/video/video-form-styles.css">
<script src="/assets/js/admin/video/video-form.js" defer></script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Header Section -->
<div class="page-header mb-4">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2 class="page-title">
                <i class="bi bi-camera-video me-2"></i>
                <?= isset($video) ? 'Edit Video' : 'Tambah Video Baru' ?>
            </h2>
            <p class="page-subtitle mb-0">
                <?= isset($video) ? 'Perbarui informasi video' : 'Tambahkan video baru ke website' ?>
            </p>
        </div>
        <div class="col-md-4 text-end">
            <a href="/admin/video" class="btn btn-secondary btn-lg">
                <i class="bi bi-arrow-left me-2"></i>
                Kembali
            </a>
        </div>
    </div>
</div>

<!-- Form Card -->
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="modern-form-container">
            <div class="modern-form-header">
                <h3 class="modern-form-title"><i class="bi bi-camera-video"></i> Form Video</h3>
                <p class="modern-form-subtitle">Lengkapi informasi video dengan ringkas dan rapi</p>
            </div>
            <div class="modern-form-body">
                
                <!-- Flash Messages -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Validation Errors -->
                <?php 
                $errors = session()->getFlashdata('errors');
                if ($errors && is_array($errors)): 
                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0 mt-2">
                            <?php foreach ($errors as $field => $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <form action="<?= isset($video) ? '/admin/video/update/' . $video['id'] : '/admin/video/store' ?>" 
                      method="POST" enctype="multipart/form-data" id="videoForm">
                    
                    <!-- Judul Input -->
                    <div class="modern-form-group">
                        <label for="judul" class="required">Judul Video</label>
                        <input type="text" 
                               class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['judul']) ? 'is-invalid' : '' ?>" 
                               id="judul" 
                               name="judul" 
                               placeholder="Masukkan judul video"
                               value="<?= old('judul', $video['judul'] ?? '') ?>" 
                               required>
                        <?php 
                        $errors = session()->getFlashdata('errors');
                        if ($errors && isset($errors['judul'])): 
                        ?>
                            <div class="invalid-feedback d-block"><?= $errors['judul'] ?></div>
                        <?php endif; ?>
                        <div class="modern-form-help">
                            <i class="bi bi-info-circle me-1"></i>
                            Judul yang menarik untuk menggambarkan video
                        </div>
                    </div>

                    <!-- Status Input -->
                    <div class="modern-form-group">
                        <label class="d-flex align-items-center">
                            <i class="bi bi-toggle-on me-2"></i>
                            Status Video
                        </label>
                        <select class="form-select" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="draft" <?= old('status', $video['status'] ?? 'draft') === 'draft' ? 'selected' : '' ?>>Draft</option>
                            <option value="published" <?= old('status', $video['status'] ?? '') === 'published' ? 'selected' : '' ?>>Published</option>
                        </select>
                        <div class="modern-form-help">
                            <i class="bi bi-info-circle me-1"></i>
                            Pilih status video: Draft (belum dipublikasi) atau Published (sudah dipublikasi)
                        </div>
                    </div>
                    <!-- Tipe Video -->
                    <div class="mb-4">
                        <label class="form-label d-flex align-items-center">
                            <i class="bi bi-collection-play me-2"></i>
                            Tipe Video
                        </label>
                        <?php $selectedType = old('tipe', $video['tipe'] ?? 'url'); ?>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipe" id="tipe_url" value="url" <?= $selectedType === 'url' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="tipe_url">URL (YouTube, Vimeo, dll.)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipe" id="tipe_file" value="file" <?= $selectedType === 'file' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="tipe_file">Upload File Video</label>
                            </div>
                        </div>
                    </div>

                    <!-- URL Video Input -->
                    <div class="modern-form-group" id="url_section" style="display: <?= ($selectedType === 'url') ? 'block' : 'none' ?>;">
                        <label for="url_video">URL Video</label>
                        <input type="url" 
                               class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['url_video']) ? 'is-invalid' : '' ?>" 
                               id="url_video" 
                               name="url_video" 
                               placeholder="https://www.youtube.com/watch?v=..."
                               value="<?= old('url_video', $video['url'] ?? '') ?>">
                        <?php 
                        if ($errors && isset($errors['url_video'])): 
                        ?>
                            <div class="invalid-feedback d-block"><?= $errors['url_video'] ?></div>
                        <?php endif; ?>
                        <div class="modern-form-help">
                            <i class="bi bi-info-circle me-1"></i>
                            Masukkan URL video (YouTube, Vimeo, dll.).
                        </div>
                    </div>

                    <!-- File Video Input -->
                    <div class="modern-form-group" id="file_section" style="display: <?= ($selectedType === 'file') ? 'block' : 'none' ?>;">
                        <label class="fw-semibold mb-2">
                            <i class="bi bi-file-earmark-play me-2"></i>
                            Upload File Video
                        </label>
                        <input class="form-control" type="file" name="video_file" id="video_file" accept="video/*">
                        <div class="modern-form-help">
                            <i class="bi bi-info-circle me-1"></i>
                            Format umum: MP4, MOV, AVI, WMV, FLV, WEBM, MKV • Maksimal: 100MB
                        </div>
                        <?php if (isset($video) && !empty($video['file_video'])): ?>
                            <div class="modern-form-help">File saat ini: <?= esc($video['file_video']) ?></div>
                            <input type="hidden" name="existing_file" id="existing_file" value="1">
                        <?php endif; ?>
                    </div>

                    <!-- Video Preview Section -->
                    <?php if (isset($video) && isset($video['url']) && $video['url']): ?>
                    <div class="mb-4">
                        <label class="form-label fw-semibold mb-3">
                            <i class="bi bi-play-circle me-2"></i>
                            Preview Video
                        </label>
                        <div class="video-embed">
                            <?php 
                            $videoId = '';
                            if (strpos($video['url'], 'youtube.com/watch?v=') !== false) {
                                $videoId = substr($video['url'], strpos($video['url'], 'v=') + 2);
                            } elseif (strpos($video['url'], 'youtu.be/') !== false) {
                                $videoId = substr($video['url'], strpos($video['url'], 'youtu.be/') + 9);
                            }
                            ?>
                            <?php if ($videoId): ?>
                                <iframe src="https://www.youtube.com/embed/<?= $videoId ?>" 
                                        title="<?= esc($video['judul']) ?>" 
                                        frameborder="0" 
                                        width="100%"
                                        height="400"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                        allowfullscreen></iframe>
                            <?php else: ?>
                                <div class="bg-light d-flex align-items-center justify-content-center p-5">
                                    <p class="text-muted mb-0">
                                        <i class="bi bi-exclamation-triangle me-2"></i>
                                        URL video tidak valid atau tidak didukung
                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Action Buttons -->
                    <div class="modern-form-actions">
                        <a href="/admin/video" class="btn btn-secondary">
                            <i class="bi bi-x-circle me-2"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="bi bi-check-circle me-2"></i>
                            <?= isset($video) ? 'Update Video' : 'Simpan Video' ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="/assets/js/admin/video-form.js"></script>
<?= $this->endSection() ?> 