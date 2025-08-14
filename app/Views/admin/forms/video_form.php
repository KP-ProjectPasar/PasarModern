<?= $this->extend('admin/layout') ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="/assets/css/admin/form-styles.css">
<style>
    .video-preview {
        border: 2px dashed #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        background: #f8fafc;
        transition: all 0.3s ease;
        margin-bottom: 1rem;
    }
    
    .video-preview:hover {
        border-color: #1e40af;
        background: #eff6ff;
    }
    
    .video-preview video {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    .url-input-group {
        position: relative;
    }
    
    .url-input-group .form-control {
        padding-right: 120px;
    }
    
    .url-input-group .btn {
        position: absolute;
        right: 5px;
        top: 50%;
        transform: translateY(-50%);
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
    }
    
    .video-embed {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
</style>
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
        <div class="content-card">
            <div class="content-card-header">
                <h5 class="content-card-title">
                    <i class="bi bi-form me-2"></i>
                    Form Video
                </h5>
            </div>
            <div class="content-card-body">
                
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

                <form action="<?= isset($video) ? '/admin/video/update/' . $video['id'] : '/admin/video/store' ?>" 
                      method="POST" enctype="multipart/form-data" id="videoForm">
                    
                    <!-- Judul Input -->
                    <div class="mb-4">
                        <div class="form-floating">
                            <input type="text" 
                                   class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['judul']) ? 'border-danger' : '' ?>" 
                                   id="judul" 
                                   name="judul" 
                                   placeholder="Masukkan judul video"
                                   value="<?= old('judul', $video['judul'] ?? '') ?>" 
                                   required>
                            <label for="judul">Judul Video</label>
                        </div>
                        <?php 
                        $errors = session()->getFlashdata('errors');
                        if ($errors && isset($errors['judul'])): 
                        ?>
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>
                                <?= $errors['judul'] ?>
                            </div>
                        <?php endif; ?>
                        <div class="form-text">
                            <i class="bi bi-info-circle me-1"></i>
                            Judul yang menarik untuk menggambarkan video
                        </div>
                    </div>

                    <!-- Deskripsi Input -->
                    <div class="mb-4">
                        <div class="form-floating">
                            <textarea class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['deskripsi']) ? 'border-danger' : '' ?>" 
                                      id="deskripsi" 
                                      name="deskripsi" 
                                      placeholder="Masukkan deskripsi video"
                                      rows="3" 
                                      required><?= old('deskripsi', $video['deskripsi'] ?? '') ?></textarea>
                            <label for="deskripsi">Deskripsi Video</label>
                        </div>
                        <?php 
                        if ($errors && isset($errors['deskripsi'])): 
                        ?>
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>
                                <?= $errors['deskripsi'] ?>
                            </div>
                        <?php endif; ?>
                        <div class="form-text">
                            <i class="bi bi-info-circle me-1"></i>
                            Deskripsi singkat tentang isi video
                        </div>
                    </div>

                    <!-- URL Video Input -->
                    <div class="mb-4">
                        <div class="form-floating">
                            <input type="url" 
                                   class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['url_video']) ? 'border-danger' : '' ?>" 
                                   id="url_video" 
                                   name="url_video" 
                                   placeholder="https://www.youtube.com/watch?v=..."
                                   value="<?= old('url_video', $video['url_video'] ?? '') ?>" 
                                   required>
                            <label for="url_video">URL Video</label>
                        </div>
                        <?php 
                        if ($errors && isset($errors['url_video'])): 
                        ?>
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>
                                <?= $errors['url_video'] ?>
                            </div>
                        <?php endif; ?>
                        <div class="form-text">
                            <i class="bi bi-info-circle me-1"></i>
                            URL video dari YouTube, Vimeo, atau platform video lainnya
                        </div>
                    </div>

                    <!-- Thumbnail Upload Section -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold mb-3">
                            <i class="bi bi-image me-2"></i>
                            Thumbnail Video
                            <?php if (!isset($video)): ?>
                                <span class="text-danger">*</span>
                            <?php endif; ?>
                        </label>

                        <?php if (isset($video) && $video['thumbnail']): ?>
                            <!-- Current Thumbnail Preview -->
                            <div class="video-preview mb-3">
                                <h6 class="text-muted mb-3">
                                    <i class="bi bi-image me-2"></i>
                                    Thumbnail Saat Ini
                                </h6>
                                <img src="/uploads/video/<?= esc($video['thumbnail']) ?>" 
                                     alt="Current Thumbnail" 
                                     class="mb-3">
                                <p class="text-muted small mb-0">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Upload thumbnail baru untuk mengganti ini
                                </p>
                            </div>
                        <?php endif; ?>

                        <!-- File Upload Area -->
                        <div class="file-upload-area" id="uploadArea">
                            <input type="file" 
                                   name="thumbnail" 
                                   class="file-upload-input" 
                                   id="thumbnail" 
                                   accept="image/*" 
                                   <?= !isset($video) ? 'required' : '' ?>>
                            
                            <div class="upload-icon">
                                <i class="bi bi-cloud-upload"></i>
                            </div>
                            <h5 class="mb-2">Upload Thumbnail Video</h5>
                            <p class="text-muted mb-3">
                                Drag & drop gambar di sini atau klik untuk memilih file
                            </p>
                            <div class="btn btn-outline-primary">
                                <i class="bi bi-folder2-open me-2"></i>
                                Pilih File
                            </div>
                            <p class="text-muted small mt-3 mb-0">
                                Format: JPG, PNG, GIF • Maksimal: 5MB
                            </p>
                        </div>

                        <?php 
                        if ($errors && isset($errors['thumbnail'])): 
                        ?>
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>
                                <?= $errors['thumbnail'] ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Video Preview Section -->
                    <?php if (isset($video) && $video['url_video']): ?>
                    <div class="mb-4">
                        <label class="form-label fw-semibold mb-3">
                            <i class="bi bi-play-circle me-2"></i>
                            Preview Video
                        </label>
                        <div class="video-embed">
                            <?php 
                            $videoId = '';
                            if (strpos($video['url_video'], 'youtube.com/watch?v=') !== false) {
                                $videoId = substr($video['url_video'], strpos($video['url_video'], 'v=') + 2);
                            } elseif (strpos($video['url_video'], 'youtu.be/') !== false) {
                                $videoId = substr($video['url_video'], strpos($video['url_video'], 'youtu.be/') + 9);
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

                    <hr class="my-4">

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="/admin/video" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('thumbnail');
    const form = document.getElementById('videoForm');
    const submitBtn = document.getElementById('submitBtn');

    // Drag and drop functionality
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        uploadArea.classList.add('dragover');
    }

    function unhighlight(e) {
        uploadArea.classList.remove('dragover');
    }

    // Handle dropped files
    uploadArea.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        fileInput.files = files;
        
        if (files.length > 0) {
            const file = files[0];
            if (file.type.startsWith('image/')) {
                showImagePreview(file);
            }
        }
    }

    // Handle file selection
    fileInput.addEventListener('change', function(e) {
        if (this.files.length > 0) {
            const file = this.files[0];
            showImagePreview(file);
        }
    });

    function showImagePreview(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Remove existing preview
            const existingPreview = uploadArea.querySelector('.video-preview');
            if (existingPreview) {
                existingPreview.remove();
            }

            // Create new preview
            const preview = document.createElement('div');
            preview.className = 'video-preview mt-3';
            preview.innerHTML = `
                <h6 class="text-success mb-3">
                    <i class="bi bi-check-circle me-2"></i>
                    Thumbnail Dipilih
                </h6>
                <img src="${e.target.result}" alt="Preview" class="mb-3">
                <p class="text-muted small mb-0">
                    <strong>Nama:</strong> ${file.name}<br>
                    <strong>Ukuran:</strong> ${(file.size / 1024 / 1024).toFixed(2)} MB<br>
                    <strong>Tipe:</strong> ${file.type}
                </p>
            `;
            uploadArea.appendChild(preview);
        };
        reader.readAsDataURL(file);
    }

    // Form validation
    form.addEventListener('submit', function(e) {
        const judul = document.getElementById('judul').value.trim();
        const deskripsi = document.getElementById('deskripsi').value.trim();
        const urlVideo = document.getElementById('url_video').value.trim();
        const thumbnail = document.getElementById('thumbnail').files[0];
        
        if (!judul) {
            e.preventDefault();
            alert('Judul video harus diisi!');
            return;
        }
        
        if (!deskripsi) {
            e.preventDefault();
            alert('Deskripsi video harus diisi!');
            return;
        }
        
        if (!urlVideo) {
            e.preventDefault();
            alert('URL video harus diisi!');
            return;
        }
        
        if (!thumbnail && !<?= isset($video) ? 'true' : 'false' ?>) {
            e.preventDefault();
            alert('Thumbnail video harus dipilih!');
            return;
        }
        
        // Show loading state
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;
    });
});
</script>
<?= $this->endSection() ?> 