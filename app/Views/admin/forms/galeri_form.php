<?= $this->extend('admin/layout') ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="/assets/css/admin/form-styles.css">
<style>
    .image-preview {
        border: 2px dashed #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        background: #f8fafc;
        transition: all 0.3s ease;
    }
    
    .image-preview:hover {
        border-color: #3b82f6;
        background: #eff6ff;
    }
    
    .image-preview img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    .file-upload-area {
        position: relative;
        border: 2px dashed #d1d5db;
        border-radius: 12px;
        padding: 40px 20px;
        text-align: center;
        background: #f9fafb;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .file-upload-area:hover {
        border-color: #3b82f6;
        background: #eff6ff;
    }
    
    .file-upload-area.dragover {
        border-color: #3b82f6;
        background: #dbeafe;
    }
    
    .file-upload-input {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }
    
    .upload-icon {
        font-size: 3rem;
        color: #6b7280;
        margin-bottom: 1rem;
    }
    
    .form-floating {
        position: relative;
    }
    
    .form-floating > .form-control {
        height: 60px;
        padding: 1rem 0.75rem;
    }
    
    .form-floating > label {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        padding: 1rem 0.75rem;
        pointer-events: none;
        border: 1px solid transparent;
        transform-origin: 0 0;
        transition: opacity .1s ease-in-out,transform .1s ease-in-out;
    }
    
    .form-floating > .form-control:focus,
    .form-floating > .form-control:not(:placeholder-shown) {
        padding-top: 1.625rem;
        padding-bottom: 0.625rem;
    }
    
    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label {
        opacity: .65;
        transform: scale(.85) translateY(-0.5rem) translateX(0.15rem);
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Header Section -->
<div class="page-header mb-4">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2 class="page-title">
                <i class="bi bi-images me-2"></i>
                <?= isset($galeri) ? 'Edit Galeri' : 'Tambah Galeri Baru' ?>
            </h2>
            <p class="page-subtitle mb-0">
                <?= isset($galeri) ? 'Perbarui informasi galeri' : 'Tambahkan gambar baru ke galeri' ?>
            </p>
        </div>
        <div class="col-md-4 text-end">
            <a href="/admin/galeri" class="btn btn-outline-secondary btn-lg">
                <i class="bi bi-arrow-left me-2"></i>
                Kembali ke Daftar Galeri
            </a>
        </div>
    </div>
</div>

<!-- Form Card -->
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="content-card">
            <div class="content-card-header">
                <h5 class="content-card-title">
                    <i class="bi bi-form me-2"></i>
                    Form Galeri
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

                <form action="<?= isset($galeri) ? '/admin/galeri/update/' . $galeri['id'] : '/admin/galeri/store' ?>" 
                      method="POST" enctype="multipart/form-data" id="galeriForm">
                    
                    <!-- Judul Input -->
                    <div class="mb-4">
                        <div class="form-floating">
                            <input type="text" 
                                   class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['judul']) ? 'border-danger' : '' ?>" 
                                   id="judul" 
                                   name="judul" 
                                   placeholder="Masukkan judul galeri"
                                   value="<?= old('judul', $galeri['judul'] ?? '') ?>" 
                                   required>
                            <label for="judul">Judul Galeri</label>
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
                            Judul yang menarik untuk menggambarkan gambar galeri
                        </div>
                    </div>

                    <!-- Image Upload Section -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold mb-3">
                            <i class="bi bi-image me-2"></i>
                            Gambar Galeri
                            <?php if (!isset($galeri)): ?>
                                <span class="text-danger">*</span>
                            <?php endif; ?>
                        </label>

                        <?php if (isset($galeri) && $galeri['gambar']): ?>
                            <!-- Current Image Preview -->
                            <div class="image-preview mb-3">
                                <h6 class="text-muted mb-3">
                                    <i class="bi bi-image me-2"></i>
                                    Gambar Saat Ini
                                </h6>
                                <img src="/uploads/galeri/<?= esc($galeri['gambar']) ?>" 
                                     alt="Current Image" 
                                     class="mb-3">
                                <p class="text-muted small mb-0">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Upload gambar baru untuk mengganti gambar ini
                                </p>
                            </div>
                        <?php endif; ?>

                        <!-- File Upload Area -->
                        <div class="file-upload-area" id="uploadArea">
                            <input type="file" 
                                   name="gambar" 
                                   class="file-upload-input" 
                                   id="gambar" 
                                   accept="image/*" 
                                   <?= !isset($galeri) ? 'required' : '' ?>>
                            
                            <div class="upload-icon">
                                <i class="bi bi-cloud-upload"></i>
                            </div>
                            <h5 class="mb-2">Upload Gambar</h5>
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
                        if ($errors && isset($errors['gambar'])): 
                        ?>
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>
                                <?= $errors['gambar'] ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <hr class="my-4">

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="/admin/galeri" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-check-circle me-2"></i>
                            <?= isset($galeri) ? 'Update Galeri' : 'Simpan Galeri' ?>
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
    const fileInput = document.getElementById('gambar');
    const form = document.getElementById('galeriForm');

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
                // Show preview
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
            const existingPreview = uploadArea.querySelector('.image-preview');
            if (existingPreview) {
                existingPreview.remove();
            }

            // Create new preview
            const preview = document.createElement('div');
            preview.className = 'image-preview mt-3';
            preview.innerHTML = `
                <h6 class="text-success mb-3">
                    <i class="bi bi-check-circle me-2"></i>
                    Gambar Dipilih
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
        const gambar = document.getElementById('gambar').files[0];
        
        if (!judul) {
            e.preventDefault();
            alert('Judul galeri harus diisi!');
            return;
        }
        
        if (!gambar && !<?= isset($galeri) ? 'true' : 'false' ?>) {
            e.preventDefault();
            alert('Gambar harus dipilih!');
            return;
        }
    });
});
</script>
<?= $this->endSection() ?> 