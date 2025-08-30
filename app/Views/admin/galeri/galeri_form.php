<?= $this->extend('admin/layout') ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="/assets/css/admin/common.css">
<link rel="stylesheet" href="/assets/css/admin/galeri/galeri-form-styles.css">
<script src="/assets/js/admin/galeri/galeri-form.js" defer></script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h4 mb-1">
                <i class="bi bi-images me-2"></i>
                <?= isset($galeri) ? 'Edit Galeri' : 'Tambah Galeri Baru' ?>
            </h2>
            <p class="text-muted mb-0">
                <?= isset($galeri) ? 'Perbarui informasi galeri' : 'Buat galeri baru untuk website' ?>
            </p>
        </div>
    </div>

    <!-- Form Section -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="modern-form-container">
                <div class="modern-form-header">
                    <h3 class="modern-form-title"><i class="bi bi-images"></i> Form Galeri</h3>
                    <p class="modern-form-subtitle">Lengkapi informasi galeri dengan ringkas dan rapi</p>
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

                <form action="<?= isset($galeri) ? '/admin/galeri/update/' . $galeri['id'] : '/admin/galeri/store' ?>" 
                      method="POST" enctype="multipart/form-data" id="galeriForm" novalidate>
                    
                    <!-- Judul Input -->
                    <div class="modern-form-group">
                        <label for="judul" class="required">
                            <i class="bi bi-pencil me-2"></i>
                            Judul Galeri
                        </label>
                        <input type="text" 
                               class="form-control" 
                               id="judul" 
                               name="judul" 
                               placeholder="Masukkan judul galeri yang menarik"
                               value="<?= old('judul', $galeri['judul'] ?? '') ?>" 
                               required>
                        <div class="modern-form-help">
                            <i class="bi bi-info-circle me-1"></i>
                            Judul yang menarik dan informatif akan membuat galeri lebih mudah ditemukan
                        </div>
                    </div>

                    

                    <!-- Deskripsi dihapus: tidak ada kolom di tabel galeri -->

                    <!-- Image Upload Section -->
                    <div class="modern-form-group">
                        <label>
                            <i class="bi bi-images me-2"></i>
                            Gambar Galeri
                        </label>
                        
                        <!-- File Input (Hidden) -->
                        <input type="file" 
                               class="d-none" 
                               id="gambar" 
                               name="gambar[]" 
                               accept="image/*" 
                               multiple>
                        
                        <!-- Upload Area -->
                        <div class="file-upload-area" id="uploadArea">
                            <div class="upload-icon">
                                <i class="bi bi-cloud-upload"></i>
                            </div>
                            <div class="upload-text">Drag & Drop gambar di sini</div>
                            <div class="upload-subtext">atau klik tombol di bawah</div>
                            <button type="button" class="btn btn-primary mt-3" id="selectFileBtn">
                                <i class="bi bi-folder2-open me-2"></i>
                                Pilih Gambar
                            </button>
                        </div>
                        
                        <!-- Image Preview Area -->
                        <div class="preview-container" id="imagePreviewArea" style="display: none;">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0">Preview Gambar</h6>
                                <button type="button" class="btn btn-outline-danger btn-sm" id="hapusSemuaBtn">
                                    <i class="bi bi-trash me-1"></i>
                                    Hapus Semua
                                </button>
                            </div>
                            <div class="row" id="imagePreviewGrid"></div>
                        </div>

                        <?php if (isset($galeri) && !empty($galeri['gambar'])): ?>
                            <div class="mt-3">
                                <label class="form-label">Gambar Saat Ini:</label>
                                <img src="/uploads/galeri/<?= esc($galeri['gambar']) ?>"
                                     alt="Gambar Galeri"
                                     class="img-thumbnail"
                                     style="max-width: 200px; max-height: 150px;">
                                <!-- Hidden input to track existing image -->
                                <input type="hidden" id="existingImage" name="existingImage" value="<?= esc($galeri['gambar']) ?>">
                            </div>
                        <?php endif; ?>
                        
                        <div class="modern-form-help">
                            <i class="bi bi-info-circle me-1"></i>
                            Format yang didukung: JPG, PNG, GIF. Maksimal 10 gambar, ukuran total maksimal 20MB.
                        </div>
                    </div>

                    <!-- Status Selection -->
                    <div class="modern-form-group">
                        <label for="status">
                            <i class="bi bi-toggle-on me-2"></i>
                            Status Galeri
                        </label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="draft" <?= old('status', $galeri['status'] ?? 'draft') === 'draft' ? 'selected' : '' ?>>Draft</option>
                            <option value="published" <?= old('status', $galeri['status'] ?? '') === 'published' ? 'selected' : '' ?>>Published</option>
                        </select>
                        <div class="modern-form-help">
                            <i class="bi bi-info-circle me-1"></i>
                            Pilih status: Draft (belum dipublikasi) atau Published (sudah dipublikasi)
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="modern-form-actions">
                        <a href="/admin/galeri" class="btn btn-secondary">
                            <i class="bi bi-x-circle me-2"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-2"></i>
                            <?= isset($galeri) ? 'Update Galeri' : 'Simpan Galeri' ?>
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="/assets/js/admin/galeri-form.js"></script>
<?= $this->endSection() ?>
