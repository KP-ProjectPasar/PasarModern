<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-title"><?= isset($harga) ? 'Edit Harga Komoditas' : 'Tambah Harga Komoditas' ?></h1>
            <p class="text-muted mb-0"><?= isset($harga) ? 'Edit informasi harga komoditas' : 'Tambah informasi harga komoditas baru' ?></p>
        </div>
        <div class="col-auto">
            <a href="/admin/harga" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>

<!-- Form Card -->
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-currency-dollar me-2"></i>
                    <?= isset($harga) ? 'Edit Data Harga' : 'Form Tambah Harga' ?>
                </h5>
            </div>
            <div class="card-body">
                <form action="<?= isset($harga) ? '/admin/harga/update/' . $harga['id'] : '/admin/harga/store' ?>" 
                      method="post" 
                      enctype="multipart/form-data"
                      id="hargaForm">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Komoditas <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control" 
                                   name="komoditas" 
                                   value="<?= isset($harga) ? esc($harga['komoditas']) : '' ?>" 
                                   required>
                            <div class="form-text">Masukkan nama komoditas (contoh: Tomat, Jeruk, Daging Sapi)</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga (Rp/kg) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" 
                                       class="form-control" 
                                       name="harga" 
                                       value="<?= isset($harga) ? $harga['harga'] : '' ?>" 
                                       min="0" 
                                       required>
                            </div>
                            <div class="form-text">Masukkan harga per kilogram</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" 
                                   class="form-control" 
                                   name="tanggal" 
                                   value="<?= isset($harga) ? $harga['tanggal'] : date('Y-m-d') ?>" 
                                   required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select" name="kategori" required>
                                <option value="">Pilih Kategori</option>
                                <option value="sayuran" <?= (isset($harga) && $harga['kategori'] == 'sayuran') ? 'selected' : '' ?>>Sayuran</option>
                                <option value="buah" <?= (isset($harga) && $harga['kategori'] == 'buah') ? 'selected' : '' ?>>Buah</option>
                                <option value="daging" <?= (isset($harga) && $harga['kategori'] == 'daging') ? 'selected' : '' ?>>Daging</option>
                                <option value="lainnya" <?= (isset($harga) && $harga['kategori'] == 'lainnya') ? 'selected' : '' ?>>Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto Komoditas</label>
                        <div class="row">
                            <div class="col-md-8">
                                <input type="file" 
                                       class="form-control" 
                                       name="foto" 
                                       accept="image/*"
                                       id="fotoInput">
                                <div class="form-text">Upload foto komoditas untuk tampilan yang lebih menarik (JPG, PNG, max 2MB)</div>
                            </div>
                            <div class="col-md-4">
                                <div id="previewContainer" class="text-center" style="display: none;">
                                    <img id="imagePreview" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                                </div>
                                <?php if (isset($harga) && !empty($harga['foto'])): ?>
                                <div class="text-center">
                                    <p class="text-muted small">Foto Saat Ini:</p>
                                    <img src="/uploads/komoditas/<?= esc($harga['foto']) ?>" 
                                         class="img-thumbnail" 
                                         style="max-width: 150px; max-height: 150px;">
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" 
                                  name="deskripsi" 
                                  rows="3" 
                                  placeholder="Deskripsi singkat tentang komoditas ini..."><?= isset($harga) ? esc($harga['deskripsi']) : '' ?></textarea>
                        <div class="form-text">Deskripsi singkat tentang komoditas (opsional)</div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="/admin/harga" class="btn btn-secondary">
                            <i class="bi bi-x-circle me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-2"></i>
                            <?= isset($harga) ? 'Update Harga' : 'Simpan Harga' ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Image preview functionality
document.getElementById('fotoInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const previewContainer = document.getElementById('previewContainer');
    const imagePreview = document.getElementById('imagePreview');
    
    if (file) {
        // Check file size (max 2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file terlalu besar. Maksimal 2MB.');
            this.value = '';
            return;
        }
        
        // Check file type
        if (!file.type.startsWith('image/')) {
            alert('File harus berupa gambar.');
            this.value = '';
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            previewContainer.style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        previewContainer.style.display = 'none';
    }
});

// Form validation
document.getElementById('hargaForm').addEventListener('submit', function(e) {
    const komoditas = document.querySelector('input[name="komoditas"]').value.trim();
    const harga = document.querySelector('input[name="harga"]').value;
    const tanggal = document.querySelector('input[name="tanggal"]').value;
    const kategori = document.querySelector('select[name="kategori"]').value;
    
    if (!komoditas) {
        e.preventDefault();
        alert('Nama komoditas harus diisi!');
        return;
    }
    
    if (!harga || harga <= 0) {
        e.preventDefault();
        alert('Harga harus diisi dan lebih dari 0!');
        return;
    }
    
    if (!tanggal) {
        e.preventDefault();
        alert('Tanggal harus diisi!');
        return;
    }
    
    if (!kategori) {
        e.preventDefault();
        alert('Kategori harus dipilih!');
        return;
    }
});
</script>

<?= $this->endSection() ?> 