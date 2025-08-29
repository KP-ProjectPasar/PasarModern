<?= $this->extend('admin/layout') ?>

<?= $this->section('head') ?>
<script src="/assets/js/admin/harga/harga-form.js" defer></script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Header Section -->
<div class="page-header mb-4">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-title">
                <i class="bi bi-currency-dollar me-2"></i><?= isset($harga) ? 'Edit Harga Komoditas' : 'Tambah Harga Komoditas Baru' ?>
            </h1>
            <p class="page-subtitle mb-0">Kelola informasi harga komoditas dengan mudah dan akurat</p>
        </div>
        <div class="col-auto">
            <a href="/admin/harga" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
            </a>
        </div>
    </div>
</div>

<!-- Modern Form Container -->
<div class="modern-form-container">
    <div class="modern-form-header">
        <h3 class="modern-form-title">
            <i class="bi bi-currency-dollar"></i>
            Form Data Harga Komoditas
        </h3>
        <p class="modern-form-subtitle">Lengkapi informasi harga komoditas dengan data yang akurat dan lengkap</p>
    </div>
                    
    <div class="modern-form-body">
        <form action="<?= isset($harga) ? '/admin/harga/update/' . $harga['id'] : '/admin/harga/store' ?>" 
              method="POST" 
              enctype="multipart/form-data" 
              id="hargaForm">
            
            <?= csrf_field() ?>
            
            <!-- Informasi Dasar Section -->
            <div class="modern-form-section">
                <div class="modern-form-section-header">
                    <h4 class="modern-form-section-title">
                        <i class="bi bi-info-circle"></i>
                        Informasi Dasar
                    </h4>
                    <p class="modern-form-section-subtitle">Data utama komoditas dan harga</p>
                </div>
                
                <div class="modern-form-grid cols-2">
                    <div class="modern-form-group">
                        <label for="komoditas" class="required">Nama Komoditas</label>
                        <input type="text" 
                               class="form-control" 
                               id="komoditas" 
                               name="komoditas" 
                               value="<?= isset($harga) ? esc($harga['komoditas']) : '' ?>"
                               placeholder="Contoh: Tomat, Jeruk, Daging Sapi"
                               required>
                        <div class="modern-form-help">
                            <i class="bi bi-lightbulb"></i>
                            Masukkan nama komoditas yang jelas
                        </div>
                    </div>
                    
                    <div class="modern-form-group">
                        <label for="harga" class="required">Harga (Rp/kg)</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" 
                                   class="form-control" 
                                   id="harga" 
                                   name="harga"
                                   value="<?= isset($harga) ? $harga['harga'] : '' ?>"
                                   min="0" 
                                   placeholder="15000"
                                   required>
                        </div>
                        <div class="modern-form-help">
                            <i class="bi bi-calculator"></i>
                            Harga per kilogram dalam Rupiah
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kategori dan Tanggal Section -->
            <div class="modern-form-section">
                <div class="modern-form-section-header">
                    <h4 class="modern-form-section-title">
                        <i class="bi bi-tags"></i>
                        Kategori dan Tanggal
                    </h4>
                    <p class="modern-form-section-subtitle">Pengelompokan dan waktu update harga</p>
                </div>
                
                <div class="modern-form-grid cols-2">
                    <div class="modern-form-group">
                        <label for="kategori" class="required">Kategori</label>
                        <select class="form-select" id="kategori" name="kategori" required>
                            <option value="">Pilih Kategori</option>
                            <option value="sayuran" <?= (isset($harga) && $harga['kategori'] == 'sayuran') ? 'selected' : '' ?>>Sayuran</option>
                            <option value="buah" <?= (isset($harga) && $harga['kategori'] == 'buah') ? 'selected' : '' ?>>Buah</option>
                            <option value="daging" <?= (isset($harga) && $harga['kategori'] == 'daging') ? 'selected' : '' ?>>Daging</option>
                            <option value="lainnya" <?= (isset($harga) && $harga['kategori'] == 'lainnya') ? 'selected' : '' ?>>Lainnya</option>
                        </select>
                        <div class="modern-form-help">
                            <i class="bi bi-grid"></i>
                            Pilih kategori yang sesuai
                        </div>
                    </div>
                    
                    <div class="modern-form-group">
                        <label for="tanggal" class="required">Tanggal Update</label>
                        <input type="date" 
                               class="form-control" 
                               id="tanggal" 
                               name="tanggal"
                               value="<?= isset($harga) ? $harga['tanggal'] : date('Y-m-d') ?>"
                               required>
                        <div class="modern-form-help">
                            <i class="bi bi-clock"></i>
                            Tanggal update harga komoditas
                        </div>
                    </div>
                </div>
            </div>

            <!-- Foto Komoditas Section -->
            <div class="modern-form-section">
                <div class="modern-form-section-header">
                    <h4 class="modern-form-section-title">
                        <i class="bi bi-camera"></i>
                        Foto Komoditas
                    </h4>
                    <p class="modern-form-section-subtitle">Upload foto untuk tampilan yang menarik</p>
                </div>
                
                <div class="modern-form-group">
                    <label for="foto">Foto Komoditas</label>
                    <input type="file" 
                           class="form-control" 
                           id="foto" 
                           name="foto" 
                           accept="image/*">
                    <div class="modern-form-help">
                        <i class="bi bi-image"></i>
                        Format: JPG, PNG, GIF. Maksimal 5MB.
                    </div>
                    
                    <!-- Preview Area -->
                    <div id="imagePreview" style="display: none;" class="mt-3">
                        <img id="previewImage" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
                        <button type="button" class="btn btn-sm btn-outline-danger mt-2" onclick="removeImage()">
                            <i class="bi bi-x-circle me-1"></i>Hapus Gambar
                        </button>
                    </div>
                    
                    <!-- Current Image Display (for edit mode) -->
                    <?php if (isset($harga) && $harga['foto']): ?>
                        <div class="mt-3">
                            <p class="text-muted small mb-2">Foto saat ini:</p>
                            <img src="/uploads/harga/<?= esc($harga['foto']) ?>" 
                                 alt="Foto saat ini" 
                                 class="img-thumbnail" 
                                 style="max-width: 200px;">
                        </div>
                    <?php endif; ?>
                </div>
            </div>



            <!-- Form Actions -->
            <div class="modern-form-actions">
                <a href="/admin/harga" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-2"></i>
                    Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-2"></i>
                    <?= isset($harga) ? 'Update Harga' : 'Simpan Harga' ?>
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?> 