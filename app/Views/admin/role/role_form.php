<?= $this->extend('admin/layout') ?>

<?= $this->section('head') ?>
<script src="/assets/js/admin/role/role-form.js" defer></script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Header Section -->
<div class="page-header mb-4">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2 class="page-title">
                <?= isset($role) ? 'Edit Role' : 'Tambah Role Baru' ?>
            </h2>
            <p class="page-subtitle mb-0"><?= isset($role) ? 'Edit data role' : 'Tambah role baru ke sistem' ?></p>
        </div>
        <div class="col-md-4 text-end">
            <a href="/admin/role" class="btn btn-secondary btn-lg">
                <i class="bi bi-arrow-left me-2"></i>
                Kembali
            </a>
        </div>
    </div>
</div>

<!-- Modern Form Container -->
<div class="modern-form-container">
    <div class="modern-form-header">
        <h3 class="modern-form-title">
            <i class="bi bi-shield"></i>
            <?= isset($role) ? 'Edit Role' : 'Form Tambah Role' ?>
        </h3>
        <p class="modern-form-subtitle">Kelola role dan hak akses dalam sistem</p>
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

        <form action="<?= isset($role) ? '/admin/role/update/' . $role['id'] : '/admin/role/store' ?>" method="POST" id="roleForm">
            <?= csrf_field() ?>
            
            <div class="modern-form-grid cols-2">
                <div class="modern-form-group">
                    <label for="nama" class="required">Nama Role</label>
                    <input type="text" class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['nama']) ? 'is-invalid' : '' ?>" 
                           id="nama" name="nama" 
                           value="<?= old('nama', $role['nama'] ?? '') ?>" 
                           placeholder="Contoh: admin, berita, harga"
                           required>
                    <?php 
                    $errors = session()->getFlashdata('errors');
                    if ($errors && isset($errors['nama'])): 
                    ?>
                        <div class="invalid-feedback"><?= $errors['nama'] ?></div>
                    <?php endif; ?>
                    <div class="modern-form-help">
                        <i class="bi bi-lightbulb"></i>
                        Nama role yang akan digunakan dalam sistem
                    </div>
                </div>
                
                <div class="modern-form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <input type="text" class="form-control" 
                           id="deskripsi" name="deskripsi" 
                           value="<?= old('deskripsi', $role['deskripsi'] ?? '') ?>" 
                           placeholder="Penjelasan singkat tentang role">
                    <div class="modern-form-help">
                        <i class="bi bi-info-circle"></i>
                        Deskripsi singkat tentang fungsi role
                    </div>
                </div>
            </div>
            
            <div class="modern-form-group">
                <label for="is_active">Status Aktif</label>
                <select class="form-select" id="is_active" name="is_active">
                    <option value="1" <?= (isset($role) && $role['is_active'] == 1) ? 'selected' : '' ?>>Aktif</option>
                    <option value="0" <?= (isset($role) && $role['is_active'] == 0) ? 'selected' : '' ?>>Tidak Aktif</option>
                </select>
                <div class="modern-form-help">
                    <i class="bi bi-toggle-on"></i>
                    Pilih status aktifitas role dalam sistem
                </div>
            </div>
            
            <div class="modern-form-section">
                <div class="modern-form-section-header">
                    <h4 class="modern-form-section-title"><i class="bi bi-key"></i> Permissions</h4>
                    <p class="modern-form-section-subtitle">Pilih hak akses untuk role ini</p>
                </div>
                <?php 
                    $existingPerms = [];
                    if (isset($role) && !empty($role['permissions'])) {
                        $decoded = json_decode($role['permissions'], true);
                        if (is_array($decoded)) { $existingPerms = array_keys(array_filter($decoded)); }
                    }
                    $allPermissions = [
                        'user_management' => 'Kelola User',
                        'role_management' => 'Kelola Role',
                        'berita_management' => 'Kelola Berita',
                        'galeri_management' => 'Kelola Galeri',
                        'video_management' => 'Kelola Video',
                        'pasar_management' => 'Kelola Pasar',
                        'harga_management' => 'Kelola Harga',
                        'feedback_management' => 'Kelola Feedback',
                    ];
                ?>
                <div class="modern-form-grid cols-3">
                    <?php foreach ($allPermissions as $key => $label): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="perm_<?= $key ?>" name="permissions[]" value="<?= $key ?>" <?= in_array($key, $existingPerms, true) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="perm_<?= $key ?>">
                            <?= esc($label) ?>
                        </label>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="modern-form-actions">
                <a href="/admin/role" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-2"></i>
                    Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-2"></i>
                    <?= isset($role) ? 'Update Role' : 'Simpan Role' ?>
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?> 