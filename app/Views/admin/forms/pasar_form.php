<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">
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

<div class="content-card">
    <div class="content-card-header">
        <div class="content-card-title">
            <h3><i class="bi bi-form me-2"></i>Form Data Pasar</h3>
        </div>
    </div>
                    
    <div class="content-card-body">
        <form action="<?= isset($pasar) ? '/admin/pasar/update/' . $pasar['id'] : '/admin/pasar/store' ?>" 
              method="POST" 
              enctype="multipart/form-data" 
              id="pasarForm">
                        
            <div class="form-section mb-4">
                <div class="section-header mb-3">
                    <h4><i class="bi bi-info-circle me-2"></i>Informasi Dasar</h4>
                    <p class="text-muted mb-0">Data utama pasar yang akan ditampilkan</p>
                </div>
                            
                            <div class="row">
                    <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="nama_pasar" class="form-label">
                                <i class="bi bi-building me-1"></i>Nama Pasar
                                <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                   class="form-control" 
                                               id="nama_pasar" 
                                               name="nama_pasar" 
                                               value="<?= isset($pasar) ? esc($pasar['nama_pasar']) : '' ?>"
                                               placeholder="Contoh: Pasar Modern Tangerang"
                                               required>
                            <div class="form-text">
                                            <i class="bi bi-lightbulb me-1"></i>
                                            Masukkan nama resmi pasar
                                        </div>
                                    </div>
                                </div>
                                
                    <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="status" class="form-label">
                                <i class="bi bi-toggle-on me-1"></i>Status Pasar
                                <span class="text-danger">*</span>
                                        </label>
                            <select class="form-select" id="status" name="status" required>
                                            <option value="">Pilih Status</option>
                                            <option value="aktif" <?= (isset($pasar) && $pasar['status'] == 'aktif') ? 'selected' : '' ?>>Aktif</option>
                                            <option value="perbaikan" <?= (isset($pasar) && $pasar['status'] == 'perbaikan') ? 'selected' : '' ?>>Dalam Perbaikan</option>
                                            <option value="nonaktif" <?= (isset($pasar) && $pasar['status'] == 'nonaktif') ? 'selected' : '' ?>>Nonaktif</option>
                                        </select>
                            <div class="form-text">
                                            <i class="bi bi-info-circle me-1"></i>
                                            Status operasional pasar saat ini
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Location Information Section -->
            <div class="form-section mb-4">
                <div class="section-header mb-3">
                    <h4><i class="bi bi-geo-alt me-2"></i>Informasi Lokasi</h4>
                    <p class="text-muted mb-0">Data lokasi dan kontak pasar</p>
                            </div>
                            
                            <div class="row">
                    <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="alamat" class="form-label">
                                <i class="bi bi-geo-alt me-1"></i>Alamat Lengkap
                                <span class="text-danger">*</span>
                                        </label>
                            <textarea class="form-control" 
                                                  id="alamat" 
                                                  name="alamat" 
                                                  rows="3"
                                                  placeholder="Masukkan alamat lengkap pasar"
                                                  required><?= isset($pasar) ? esc($pasar['alamat']) : '' ?></textarea>
                            <div class="form-text">
                                <i class="bi bi-info-circle me-1"></i>
                                Alamat lengkap pasar untuk navigasi
                                        </div>
                                    </div>
                                </div>
                                
                    <div class="col-md-12 mb-3">
                                    <div class="form-group">
                            <label for="jam_operasional" class="form-label">
                                <i class="bi bi-clock me-1"></i>Jam Operasional
                                        </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="jam_operasional" 
                                   name="jam_operasional" 
                                   value="<?= isset($pasar) ? esc($pasar['jam_operasional']) : '' ?>"
                                   placeholder="Contoh: 06:00 - 18:00">
                            <div class="form-text">
                                <i class="bi bi-info-circle me-1"></i>
                                Jam buka dan tutup pasar
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

            <!-- Additional Information Section -->
            <div class="form-section mb-4">
                <div class="section-header mb-3">
                    <h4><i class="bi bi-list-ul me-2"></i>Informasi Tambahan</h4>
                    <p class="text-muted mb-0">Data pendukung untuk informasi pasar</p>
                            </div>
                            
                            <div class="row">
                    <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="jumlah_pedagang" class="form-label">
                                <i class="bi bi-people me-1"></i>Jumlah Pedagang
                                        </label>
                                        <input type="number" 
                                   class="form-control" 
                                               id="jumlah_pedagang" 
                                               name="jumlah_pedagang"
                                               value="<?= isset($pasar) ? esc($pasar['jumlah_pedagang']) : '' ?>"
                                   placeholder="Contoh: 150"
                                   min="0">
                            <div class="form-text">
                                <i class="bi bi-info-circle me-1"></i>
                                Perkiraan jumlah pedagang di pasar
                            </div>
                        </div>
                            </div>
                            
                    <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="deskripsi" class="form-label">
                                <i class="bi bi-text-paragraph me-1"></i>Deskripsi
                                </label>
                            <textarea class="form-control" 
                                          id="deskripsi" 
                                          name="deskripsi" 
                                      rows="3"
                                      placeholder="Deskripsi singkat tentang pasar"><?= isset($pasar) ? esc($pasar['deskripsi']) : '' ?></textarea>
                            <div class="form-text">
                                <i class="bi bi-info-circle me-1"></i>
                                Deskripsi singkat tentang pasar
                            </div>
                        </div>
                                </div>
                            </div>
                        </div>

            <!-- File Upload Section -->
            <div class="form-section mb-4">
                <div class="section-header mb-3">
                    <h4><i class="bi bi-image me-2"></i>Foto Pasar</h4>
                    <p class="text-muted mb-0">Upload foto pasar untuk dokumentasi</p>
                            </div>
                            
                <div class="row">
                    <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="foto" class="form-label">
                                <i class="bi bi-camera me-1"></i>Foto Pasar
                                </label>
                                    <input type="file" 
                                   class="form-control" 
                                           id="foto" 
                                           name="foto" 
                                           accept="image/*">
                            <div class="form-text">
                                        <i class="bi bi-info-circle me-1"></i>
                                Upload foto pasar (JPG, PNG, maksimal 50MB)
                                    </div>
                                </div>
                                
                        <?php if (isset($pasar) && !empty($pasar['foto'])): ?>
                            <div class="current-image mt-2">
                                <label class="form-label">Foto Saat Ini:</label>
                                    <div class="image-preview">
                                    <img src="/uploads/pasar/<?= esc($pasar['foto']) ?>" 
                                         alt="Foto Pasar" 
                                         class="img-thumbnail" 
                                         style="max-width: 200px; max-height: 150px;">
                                </div>
                                    </div>
                        <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions">
                <div class="row">
                                <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-2"></i>
                            <?= isset($pasar) ? 'Update Data Pasar' : 'Simpan Data Pasar' ?>
                        </button>
                        <a href="/admin/pasar" class="btn btn-outline-secondary ms-2">
                            <i class="bi bi-x-circle me-2"></i>Batal
                        </a>
                                </div>
                                <div class="col-md-6 text-end">
                        <div class="form-progress">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                            </div>
                            <small class="text-muted">Progress pengisian form</small>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?> 