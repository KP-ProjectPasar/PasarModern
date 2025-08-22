<?= $this->extend('admin/layout') ?>

<?= $this->section('head') ?>
<script src="/assets/js/admin/pasar/pasar-form.js" defer></script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Header Section -->
<div class="page-header mb-4">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-title">
                <i class="bi bi-building me-2"></i><?= isset($pasar) ? 'Edit Data Pasar' : 'Tambah Data Pasar Baru' ?>
            </h1>
            <p class="page-subtitle mb-0">Kelola informasi pasar dengan mudah dan efisien</p>
        </div>
        <div class="col-auto">
            <a href="/admin/pasar" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
            </a>
        </div>
    </div>
</div>

<!-- Modern Form Container -->
<div class="modern-form-container">
    <div class="modern-form-header">
        <h3 class="modern-form-title">
            <i class="bi bi-building"></i>
            Form Data Pasar
        </h3>
        <p class="modern-form-subtitle">Lengkapi informasi pasar dengan data yang akurat dan lengkap</p>
    </div>
    
    <div class="modern-form-body">
        <form action="<?= isset($pasar) ? '/admin/pasar/update/' . $pasar['id'] : '/admin/pasar/store' ?>" 
              method="POST" 
              enctype="multipart/form-data" 
              id="pasarForm">
            
            <?= csrf_field() ?>
            
            <!-- Informasi Dasar Section -->
            <div class="modern-form-section">
                <div class="modern-form-section-header">
                    <h4 class="modern-form-section-title">
                        <i class="bi bi-info-circle"></i>
                        Informasi Dasar
                    </h4>
                    <p class="modern-form-section-subtitle">Data utama pasar yang akan ditampilkan</p>
                </div>
                
                <div class="modern-form-grid cols-2">
                    <div class="modern-form-group">
                        <label for="nama_pasar" class="required">Nama Pasar</label>
                        <input type="text" 
                               class="form-control" 
                               id="nama_pasar" 
                               name="nama_pasar" 
                               value="<?= isset($pasar) ? esc($pasar['nama_pasar']) : '' ?>"
                               placeholder="Contoh: Pasar Modern Tangerang"
                               required>
                        <div class="modern-form-help">
                            <i class="bi bi-lightbulb"></i>
                            Masukkan nama resmi pasar
                        </div>
                    </div>
                    
                    <div class="modern-form-group">
                        <label for="alamat" class="required">Alamat</label>
                        <input type="text" 
                               class="form-control" 
                               id="alamat" 
                               name="alamat" 
                               value="<?= isset($pasar) ? esc($pasar['alamat']) : '' ?>"
                               placeholder="Alamat lengkap pasar"
                               required>
                        <div class="modern-form-help">
                            <i class="bi bi-geo-alt"></i>
                            Alamat lengkap lokasi pasar
                        </div>
                    </div>
                </div>
                
                <div class="modern-form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control form-textarea" 
                              id="deskripsi" 
                              name="deskripsi" 
                              rows="3"
                              placeholder="Deskripsi singkat tentang pasar"><?= isset($pasar) ? esc($pasar['deskripsi']) : '' ?></textarea>
                    <div class="modern-form-help">
                        <i class="bi bi-file-text"></i>
                        Deskripsi singkat tentang pasar (opsional)
                    </div>
                </div>
            </div>
            
            <!-- Kontak Section -->
            <div class="modern-form-section">
                <div class="modern-form-section-header">
                    <h4 class="modern-form-section-title">
                        <i class="bi bi-telephone"></i>
                        Informasi Kontak
                    </h4>
                    <p class="modern-form-section-subtitle">Data kontak untuk komunikasi</p>
                </div>
                
                <div class="modern-form-grid cols-2">
                    <div class="modern-form-group">
                        <label for="telepon">Nomor Telepon</label>
                        <input type="tel" 
                               class="form-control" 
                               id="telepon" 
                               name="telepon" 
                               value="<?= isset($pasar) ? esc($pasar['telepon']) : '' ?>"
                               placeholder="021-1234567">
                        <div class="modern-form-help">
                            <i class="bi bi-phone"></i>
                            Nomor telepon pasar (opsional)
                        </div>
                    </div>
                    
                    <div class="modern-form-group">
                        <label for="email">Email</label>
                        <input type="email" 
                               class="form-control" 
                               id="email" 
                               name="email" 
                               value="<?= isset($pasar) ? esc($pasar['email']) : '' ?>"
                               placeholder="pasar@example.com">
                        <div class="modern-form-help">
                            <i class="bi bi-envelope"></i>
                            Email resmi pasar (opsional)
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Jam Operasional Section -->
            <div class="modern-form-section">
                <div class="modern-form-section-header">
                    <h4 class="modern-form-section-title">
                        <i class="bi bi-clock"></i>
                        Jam Operasional
                    </h4>
                    <p class="modern-form-section-subtitle">Informasi waktu buka dan tutup pasar</p>
                </div>
                
                <div class="modern-form-grid cols-2">
                    <div class="modern-form-group">
                        <label for="jam_buka">Jam Buka</label>
                        <input type="time" 
                               class="form-control" 
                               id="jam_buka" 
                               name="jam_buka" 
                               value="<?= isset($pasar) ? $pasar['jam_buka'] : '06:00' ?>">
                        <div class="modern-form-help">
                            <i class="bi bi-sunrise"></i>
                            Waktu buka pasar
                        </div>
                    </div>
                    
                    <div class="modern-form-group">
                        <label for="jam_tutup">Jam Tutup</label>
                        <input type="time" 
                               class="form-control" 
                               id="jam_tutup" 
                               name="jam_tutup" 
                               value="<?= isset($pasar) ? $pasar['jam_tutup'] : '18:00' ?>">
                        <div class="modern-form-help">
                            <i class="bi bi-sunset"></i>
                            Waktu tutup pasar
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Status Section -->
            <div class="modern-form-section">
                <div class="modern-form-section-header">
                    <h4 class="modern-form-section-title">
                        <i class="bi bi-toggle-on"></i>
                        Status Pasar
                    </h4>
                    <p class="modern-form-section-subtitle">Pengaturan status aktifitas pasar</p>
                </div>
                
                <div class="modern-form-group">
                    <label for="status">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="aktif" <?= (isset($pasar) && $pasar['status'] == 'aktif') ? 'selected' : '' ?>>Aktif</option>
                        <option value="nonaktif" <?= (isset($pasar) && $pasar['status'] == 'nonaktif') ? 'selected' : '' ?>>Nonaktif</option>
                        <option value="maintenance" <?= (isset($pasar) && $pasar['status'] == 'maintenance') ? 'selected' : '' ?>>Maintenance</option>
                    </select>
                    <div class="modern-form-help">
                        <i class="bi bi-info-circle"></i>
                        Pilih status aktifitas pasar
                    </div>
                </div>
            </div>
            
            <!-- Form Actions -->
            <div class="modern-form-actions">
                <a href="/admin/pasar" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-2"></i>
                    Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-2"></i>
                    <?= isset($pasar) ? 'Update Pasar' : 'Simpan Pasar' ?>
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?> 