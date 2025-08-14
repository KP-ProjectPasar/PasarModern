<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<!-- Modern Form Header -->
<div class="form-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col">
                <div class="form-header-content">
                    <div class="form-header-icon">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="form-header-text">
                        <h1 class="form-title"><?= isset($harga) ? 'Edit Harga Komoditas' : 'Tambah Harga Komoditas Baru' ?></h1>
                        <p class="form-subtitle">Kelola informasi harga komoditas dengan mudah dan akurat</p>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <a href="/admin/harga" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modern Form Container -->
<div class="form-container">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="modern-form-card">
                    <div class="form-card-header">
                        <div class="form-card-icon">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div class="form-card-title">
                            <h3>Informasi Harga Komoditas</h3>
                            <p>Lengkapi data harga komoditas dengan informasi yang akurat</p>
                        </div>
                    </div>
                    
                    <form action="<?= isset($harga) ? '/admin/harga/update/' . $harga['id'] : '/admin/harga/store' ?>" 
                          method="POST" 
                          enctype="multipart/form-data" 
                          id="hargaForm"
                          class="modern-form">
                        
                        <!-- Basic Information Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <i class="bi bi-info-circle"></i>
                                </div>
                                <h4>Informasi Dasar</h4>
                                <p>Data utama komoditas dan harga</p>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label for="komoditas" class="form-label">
                                            <i class="bi bi-basket me-2"></i>Nama Komoditas
                                            <span class="required">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control modern-input" 
                                               id="komoditas" 
                                               name="komoditas" 
                                               value="<?= isset($harga) ? esc($harga['komoditas']) : '' ?>"
                                               placeholder="Contoh: Tomat, Jeruk, Daging Sapi"
                                               required>
                                        <div class="form-help">
                                            <i class="bi bi-lightbulb me-1"></i>
                                            Masukkan nama komoditas yang jelas
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label for="harga" class="form-label">
                                            <i class="bi bi-currency-dollar me-2"></i>Harga (Rp/kg)
                                            <span class="required">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" 
                                                   class="form-control modern-input" 
                                                   id="harga" 
                                                   name="harga"
                                                   value="<?= isset($harga) ? $harga['harga'] : '' ?>"
                                                   min="0" 
                                                   placeholder="15000"
                                                   required>
                                        </div>
                                        <div class="form-help">
                                            <i class="bi bi-calculator me-1"></i>
                                            Harga per kilogram dalam Rupiah
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Category and Date Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <i class="bi bi-tags"></i>
                                </div>
                                <h4>Kategori dan Tanggal</h4>
                                <p>Pengelompokan dan waktu update harga</p>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label for="kategori" class="form-label">
                                            <i class="bi bi-tag me-2"></i>Kategori
                                            <span class="required">*</span>
                                        </label>
                                        <select class="form-select modern-select" id="kategori" name="kategori" required>
                                            <option value="">Pilih Kategori</option>
                                            <option value="sayuran" <?= (isset($harga) && $harga['kategori'] == 'sayuran') ? 'selected' : '' ?>>Sayuran</option>
                                            <option value="buah" <?= (isset($harga) && $harga['kategori'] == 'buah') ? 'selected' : '' ?>>Buah</option>
                                            <option value="daging" <?= (isset($harga) && $harga['kategori'] == 'daging') ? 'selected' : '' ?>>Daging</option>
                                            <option value="lainnya" <?= (isset($harga) && $harga['kategori'] == 'lainnya') ? 'selected' : '' ?>>Lainnya</option>
                                        </select>
                                        <div class="form-help">
                                            <i class="bi bi-grid me-1"></i>
                                            Pilih kategori yang sesuai
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label for="tanggal" class="form-label">
                                            <i class="bi bi-calendar me-2"></i>Tanggal Update
                                            <span class="required">*</span>
                                        </label>
                                        <input type="date" 
                                               class="form-control modern-input" 
                                               id="tanggal" 
                                               name="tanggal"
                                               value="<?= isset($harga) ? $harga['tanggal'] : date('Y-m-d') ?>"
                                               required>
                                        <div class="form-help">
                                            <i class="bi bi-clock me-1"></i>
                                            Tanggal update harga komoditas
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Photo Upload Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <i class="bi bi-camera"></i>
                                </div>
                                <h4>Foto Komoditas</h4>
                                <p>Upload foto untuk tampilan yang menarik</p>
                            </div>
                            
                            <div class="form-group">
                                <label for="foto" class="form-label">
                                    <i class="bi bi-camera me-2"></i>Foto Komoditas
                                </label>
                                <div class="file-upload-container">
                                    <input type="file" 
                                           class="form-control modern-file-input" 
                                           id="foto" 
                                           name="foto" 
                                           accept="image/*">
                                    <div class="file-upload-info">
                                        <i class="bi bi-cloud-upload me-2"></i>
                                        <span>Klik untuk memilih file atau drag & drop</span>
                                    </div>
                                    <div class="file-upload-help">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Format: JPG, PNG, GIF. Maksimal 50MB.
                                    </div>
                                </div>
                                
                                <!-- Preview Area -->
                                <div class="image-preview-container" id="imagePreview" style="display: none;">
                                    <div class="image-preview">
                                        <img id="previewImage" src="" alt="Preview">
                                        <button type="button" class="remove-image" onclick="removeImage()">
                                            <i class="bi bi-x-circle"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="form-progress">
                                        <div class="progress-bar">
                                            <div class="progress-fill" id="formProgress"></div>
                                        </div>
                                        <span class="progress-text">Lengkapi form untuk melanjutkan</span>
                                    </div>
                                </div>
                                <div class="col-md-6 text-end">
                                    <button type="button" class="btn btn-secondary me-2" onclick="history.back()">
                                        <i class="bi bi-arrow-left me-2"></i>Batal
                                    </button>
                                    <button type="submit" class="btn btn-primary modern-submit-btn">
                                        <i class="bi bi-check-circle me-2"></i>
                                        <?= isset($harga) ? 'Update Data' : 'Simpan Data' ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?> 