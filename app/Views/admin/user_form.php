<?= $this->extend('admin/layout') ?>
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

<!-- Form Card -->
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-person-plus me-2"></i>
                    <?= isset($user) ? 'Edit User Admin' : 'Form Tambah User Admin' ?>
                </h5>
            </div>
            <div class="card-body">
                <form action="<?= isset($user) ? '/admin/user/update/' . $user['id'] : '/admin/user/store' ?>" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="username" name="username" 
                                   value="<?= isset($user) ? esc($user['username']) : '' ?>" required>
                            <div class="form-text">Username unik untuk login ke sistem</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="">Pilih Role</option>
                                <?php if (isset($roles)): ?>
                                    <?php foreach ($roles as $role): ?>
                                        <?php if ($role['is_active']): ?>
                                        <option value="<?= esc($role['nama']) ?>" 
                                                <?= (isset($user) && $user['role'] === $role['nama']) ? 'selected' : '' ?>>
                                            <?= esc(ucfirst($role['nama'])) ?> - <?= esc($role['deskripsi']) ?>
                                        </option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="admin" <?= (isset($user) && $user['role'] === 'admin') ? 'selected' : '' ?>>Admin</option>
                                    <option value="superadmin" <?= (isset($user) && $user['role'] === 'superadmin') ? 'selected' : '' ?>>Super Admin</option>
                                    <option value="berita" <?= (isset($user) && $user['role'] === 'berita') ? 'selected' : '' ?>>Berita</option>
                                    <option value="harga" <?= (isset($user) && $user['role'] === 'harga') ? 'selected' : '' ?>>Harga</option>
                                    <option value="galeri" <?= (isset($user) && $user['role'] === 'galeri') ? 'selected' : '' ?>>Galeri</option>
                                <?php endif; ?>
                            </select>
                            <div class="form-text">Role akses user dalam sistem</div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">
                                <?= isset($user) ? 'Password Baru' : 'Password' ?> 
                                <?= isset($user) ? '' : '<span class="text-danger">*</span>' ?>
                            </label>
                            <input type="password" class="form-control" id="password" name="password" 
                                   <?= isset($user) ? '' : 'required' ?>>
                            <div class="form-text">
                                <?= isset($user) ? 'Kosongkan jika tidak ingin mengubah password' : 'Password minimal 6 karakter' ?>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="<?= isset($user) ? esc($user['email'] ?? '') : '' ?>">
                            <div class="form-text">Email untuk notifikasi sistem</div>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <div class="d-flex justify-content-between">
                        <a href="/admin/user" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i>
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
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const username = document.getElementById('username').value.trim();
        const role = document.getElementById('role').value;
        const password = document.getElementById('password').value;
        
        let isValid = true;
        let errorMessage = '';
        
        if (!username) {
            errorMessage += 'Username wajib diisi\n';
            isValid = false;
        }
        
        if (!role) {
            errorMessage += 'Role wajib dipilih\n';
            isValid = false;
        }
        
        <?php if (!isset($user)): ?>
        if (!password) {
            errorMessage += 'Password wajib diisi\n';
            isValid = false;
        } else if (password.length < 6) {
            errorMessage += 'Password minimal 6 karakter\n';
            isValid = false;
        }
        <?php endif; ?>
        
        if (!isValid) {
            e.preventDefault();
            // TODO: Implement proper validation feedback
        }
    });
    
    // Password strength indicator
    const passwordInput = document.getElementById('password');
    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            
            if (password.length >= 6) strength++;
            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;
            
            // Remove existing strength classes
            this.classList.remove('border-danger', 'border-warning', 'border-success');
            
            // Add appropriate strength class
            if (strength < 2) {
                this.classList.add('border-danger');
            } else if (strength < 4) {
                this.classList.add('border-warning');
            } else {
                this.classList.add('border-success');
            }
        });
    }
});
</script>

<?= $this->endSection() ?> 