<?= $this->extend('admin/layout') ?>

<?= $this->section('head') ?>
<script src="/assets/js/admin/user/user-form.js" defer></script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Header Section -->
<div class="page-header mb-4">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2 class="page-title">
                <?= isset($user) ? 'Edit User Admin' : 'Tambah User Admin' ?>
            </h2>
            <p class="page-subtitle mb-0"><?= isset($user) ? 'Edit data user admin' : 'Tambah user admin baru ke sistem' ?></p>
        </div>
        <div class="col-md-4 text-end">
            <a href="/admin/user" class="btn btn-secondary btn-lg">
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
            <i class="bi bi-person-plus"></i>
            <?= isset($user) ? 'Edit User Admin' : 'Form Tambah User Admin' ?>
        </h3>
        <p class="modern-form-subtitle">Lengkapi informasi user admin dengan data yang akurat</p>
    </div>
    
    <div class="modern-form-body">
        <form action="<?= isset($user) ? '/admin/user/update/' . $user['id'] : '/admin/user/store' ?>" method="POST">
            <?= csrf_field() ?>
            
            <div class="modern-form-grid cols-2">
                <div class="modern-form-group">
                    <label for="username" class="required">Username</label>
                    <input type="text" class="form-control" id="username" name="username" 
                           value="<?= isset($user) ? esc($user['username']) : '' ?>" 
                           placeholder="Masukkan username unik"
                           required>
                    <div class="modern-form-help">
                        <i class="bi bi-lightbulb"></i>
                        Username unik untuk login ke sistem
                    </div>
                </div>
                
                <div class="modern-form-group">
                    <label for="email" class="required">Email</label>
                    <input type="email" class="form-control" id="email" name="email" 
                           value="<?= isset($user) ? esc($user['email']) : '' ?>" 
                           placeholder="contoh@email.com"
                           required>
                    <div class="modern-form-help">
                        <i class="bi bi-envelope"></i>
                        Email aktif untuk notifikasi
                    </div>
                </div>
            </div>
            
            <div class="modern-form-grid cols-2">
                <div class="modern-form-group">
                    <label for="password" class="<?= !isset($user) ? 'required' : '' ?>">Password</label>
                    <input type="password" class="form-control" id="password" name="password" 
                           placeholder="<?= isset($user) ? 'Kosongkan jika tidak ingin mengubah' : 'Minimal 6 karakter' ?>"
                           <?= !isset($user) ? 'required' : '' ?>>
                    <div class="modern-form-help">
                        <i class="bi bi-shield-lock"></i>
                        <?= isset($user) ? 'Kosongkan jika tidak ingin mengubah password' : 'Password minimal 6 karakter' ?>
                    </div>
                </div>
                
                <div class="modern-form-group">
                    <label for="role" class="required">Role</label>
                    <?php $roles = $roles ?? []; $currentRole = isset($user) ? ($user['role'] ?? '') : ''; ?>
                    <select class="form-select" id="role" name="role" required>
                        <option value="">Pilih Role</option>
                        <?php foreach ($roles as $r): ?>
                            <?php if (($r['is_active'] ?? 1) != 1) continue; ?>
                            <option value="<?= esc($r['nama']) ?>" <?= ($currentRole === ($r['nama'] ?? '')) ? 'selected' : '' ?>>
                                <?= ucwords(str_replace('_', ' ', esc($r['nama']))) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="modern-form-help">
                        <i class="bi bi-person-badge"></i>
                        Pilih role aktif sesuai hak akses
                    </div>
                </div>
            </div>
            
            <div class="modern-form-actions">
                <a href="/admin/user" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-2"></i>
                    Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-2"></i>
                    <?= isset($user) ? 'Update User' : 'Simpan User' ?>
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?> 