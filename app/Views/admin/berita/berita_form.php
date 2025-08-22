<?= $this->extend('admin/layout') ?>

<?= $this->section('head') ?>
<script src="/assets/js/admin/berita/berita-form.js" defer></script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Header Section -->
<div class="page-header mb-4">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2 class="page-title">
                <i class="bi bi-newspaper me-2"></i>
                <?= isset($berita) ? 'Edit Berita' : 'Tambah Berita Baru' ?>
            </h2>
            <p class="page-subtitle mb-0">
                <?= isset($berita) ? 'Perbarui informasi berita' : 'Buat berita baru untuk website' ?>
            </p>
        </div>
        <div class="col-md-4 text-end">
            <a href="/admin/berita" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>
                Kembali ke Daftar
            </a>
        </div>
    </div>
</div>

<!-- Modern Form Container -->
<div class="modern-form-container">
    <div class="modern-form-header">
        <h3 class="modern-form-title">
            <i class="bi bi-newspaper"></i>
            Form Berita
        </h3>
        <p class="modern-form-subtitle">Lengkapi informasi berita dengan konten yang menarik dan informatif</p>
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

        <?php if (session()->getFlashdata('errors')): ?>
            <?php $errors = session()->getFlashdata('errors'); ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                Terjadi kesalahan validasi:
                <ul class="mb-0 mt-2">
                    <?php foreach ($errors as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <form action="<?= isset($berita) ? '/admin/berita/update/' . $berita['id'] : '/admin/berita/store' ?>" 
              method="POST" 
              enctype="multipart/form-data" 
              id="beritaForm" 
              novalidate>
            
            <?= csrf_field() ?>
            
            <!-- Judul -->
            <div class="modern-form-grid cols-1">
                <div class="modern-form-group">
                    <label for="judul" class="required">Judul Berita</label>
                    <input type="text" 
                           class="form-control" 
                           id="judul" 
                           name="judul" 
                           value="<?= isset($berita) ? esc($berita['judul']) : '' ?>"
                           placeholder="Masukkan judul berita yang menarik"
                           required>
                    <div class="modern-form-help">
                        <i class="bi bi-lightbulb"></i>
                        Judul yang menarik akan meningkatkan minat pembaca
                    </div>
                </div>
            </div>
            
            <!-- Ringkasan dihapus: tidak ada kolom di tabel berita -->
            
            <!-- Konten Utama -->
            <div class="modern-form-group">
                <label for="konten" class="required">Konten Berita</label>
                <textarea class="form-control form-textarea" 
                          id="konten" 
                          name="isi" 
                          rows="8"
                          placeholder="Tulis konten berita lengkap di sini..."
                          required><?= isset($berita) ? esc($berita['isi'] ?? $berita['konten'] ?? '') : '' ?></textarea>
                <div class="character-counter">
                    <span id="charCount">0</span> / <span id="minChars">50</span> karakter
                </div>
                <div class="modern-form-help">
                    <i class="bi bi-pencil-square"></i>
                    Konten lengkap berita dengan format yang rapi
                </div>
            </div>
            
            <!-- Gambar dan Status -->
            <div class="modern-form-grid cols-2">
                <div class="modern-form-group">
                    <label for="gambar">Gambar Berita</label>
                    <div class="modern-file-upload">
                        <input type="file" id="gambar" name="gambar[]" accept="image/*" multiple>
                        <label for="gambar" class="file-upload-label">
                            <i class="bi bi-cloud-upload"></i>
                            <span>Pilih Gambar</span>
                        </label>
                    </div>
                    <div class="modern-form-help">
                        <i class="bi bi-image"></i>
                        Upload gambar yang relevan dengan berita (JPG, PNG)
                    </div>
                    
                    <?php if (isset($berita) && !empty($berita['gambar'])): ?>
                        <div class="mt-3">
                            <label class="form-label">Gambar Saat Ini:</label>
                            <img src="/uploads/berita/<?= esc($berita['gambar']) ?>" 
                                 alt="Gambar Berita" 
                                 class="img-thumbnail" 
                                 style="max-width: 200px; max-height: 150px;">
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="modern-form-group">
                    <label for="status">Status Publikasi</label>
                    <?php $currentStatus = old('status') ?? ($berita['status'] ?? 'draft'); ?>
                    <select class="form-select" id="status" name="status" required>
                        <option value="draft" <?= $currentStatus === 'draft' ? 'selected' : '' ?>>Draft</option>
                        <option value="published" <?= $currentStatus === 'published' ? 'selected' : '' ?>>Published</option>
                    </select>
                    <div class="modern-form-help">
                        <i class="bi bi-eye"></i>
                        Pilih status publikasi berita
                    </div>
                </div>
            </div>
            
            <!-- Form Actions -->
            <div class="modern-form-actions">
                <a href="/admin/berita" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-2"></i>
                    Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-2"></i>
                    <?= isset($berita) ? 'Update Berita' : 'Simpan Berita' ?>
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
