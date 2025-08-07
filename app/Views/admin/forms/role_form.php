<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<!-- Header Section -->
<div class="page-header mb-4">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2 class="page-title">
                <i class="bi bi-shield-check me-2"></i>
                <?= isset($role) ? 'Edit Role' : 'Tambah Role Baru' ?>
            </h2>
            <p class="page-subtitle mb-0"><?= isset($role) ? 'Perbarui informasi role' : 'Buat role baru untuk sistem' ?></p>
        </div>
        <div class="col-md-4 text-end">
            <a href="/admin/role" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>
                Kembali ke Daftar Role
            </a>
        </div>
    </div>
</div>

<!-- Role Form -->
<div class="content-card">
    <div class="content-card-header">
        <h5 class="content-card-title">
            <i class="bi bi-form me-2"></i>
            Form Role
        </h5>
    </div>
    <div class="content-card-body">
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
            <!-- Basic Information -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Role <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['nama']) ? 'border-danger' : '' ?>" 
                               id="nama" name="nama" value="<?= old('nama', $role['nama'] ?? '') ?>" 
                               placeholder="Contoh: admin, berita, harga" required>
                        <?php 
                        $errors = session()->getFlashdata('errors');
                        if ($errors && isset($errors['nama'])): 
                        ?>
                            <div class="text-danger small mt-1"><?= $errors['nama'] ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="is_active" class="form-label">Status</label>
                        <select class="form-select" id="is_active" name="is_active">
                            <option value="1" <?= (old('is_active', $role['is_active'] ?? 1) == 1) ? 'selected' : '' ?>>Aktif</option>
                            <option value="0" <?= (old('is_active', $role['is_active'] ?? 1) == 0) ? 'selected' : '' ?>>Tidak Aktif</option>
                        </select>
                        <small class="text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            Jika role dinonaktifkan, user dengan role ini tidak akan bisa login lagi sampai role diaktifkan kembali.
                        </small>
                        
                        <?php if (isset($role)): ?>
                            <?php 
                            $adminModel = new \App\Models\AdminModel();
                            $userCount = $adminModel->where('role', $role['nama'])->countAllResults();
                            if ($userCount > 0):
                            ?>
                            <div class="alert alert-warning mt-2" role="alert">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                <strong>Peringatan:</strong> Role ini sedang digunakan oleh <?= $userCount ?> user.
                                <?php if ($role['is_active'] == 0): ?>
                                    <br><small>Role dinonaktifkan - user tidak bisa login.</small>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                <textarea class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['deskripsi']) ? 'border-danger' : '' ?>" 
                          id="deskripsi" name="deskripsi" rows="3" 
                          placeholder="Jelaskan fungsi dan tanggung jawab role ini" required><?= old('deskripsi', $role['deskripsi'] ?? '') ?></textarea>
                <?php 
                $errors = session()->getFlashdata('errors');
                if ($errors && isset($errors['deskripsi'])): 
                ?>
                    <div class="text-danger small mt-1"><?= $errors['deskripsi'] ?></div>
                <?php endif; ?>
            </div>

            <!-- Permissions Section -->
            <div class="mb-4">
                <label class="form-label fw-bold">Permissions <span class="text-danger">*</span></label>
                <p class="text-muted small">Pilih permission yang akan diberikan kepada role ini</p>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="permission-group mb-3">
                            <h6 class="text-primary mb-2">
                                <i class="bi bi-people me-1"></i>
                                User Management
                            </h6>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="user_management" 
                                       id="perm_user" <?php 
                                       $permissions = json_decode($role['permissions'] ?? '[]', true);
                                       echo (is_array($permissions) && isset($permissions['user_management']) && $permissions['user_management'] === true) ? 'checked' : '';
                                       ?>>
                                <label class="form-check-label" for="perm_user">
                                    Kelola User
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="role_management" 
                                       id="perm_role" <?php 
                                       $permissions = json_decode($role['permissions'] ?? '[]', true);
                                       echo (is_array($permissions) && isset($permissions['role_management']) && $permissions['role_management'] === true) ? 'checked' : '';
                                       ?>>
                                <label class="form-check-label" for="perm_role">
                                    Kelola Role
                                </label>
                            </div>
                        </div>

                        <div class="permission-group mb-3">
                            <h6 class="text-success mb-2">
                                <i class="bi bi-newspaper me-1"></i>
                                Content Management
                            </h6>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="berita_management" 
                                       id="perm_berita" <?php 
                                       $permissions = json_decode($role['permissions'] ?? '[]', true);
                                       echo (is_array($permissions) && isset($permissions['berita_management']) && $permissions['berita_management'] === true) ? 'checked' : '';
                                       ?>>
                                <label class="form-check-label" for="perm_berita">
                                    Kelola Berita
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="galeri_management" 
                                       id="perm_galeri" <?php 
                                       $permissions = json_decode($role['permissions'] ?? '[]', true);
                                       echo (is_array($permissions) && isset($permissions['galeri_management']) && $permissions['galeri_management'] === true) ? 'checked' : '';
                                       ?>>
                                <label class="form-check-label" for="perm_galeri">
                                    Kelola Galeri
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="video_management" 
                                       id="perm_video" <?php 
                                       $permissions = json_decode($role['permissions'] ?? '[]', true);
                                       echo (is_array($permissions) && isset($permissions['video_management']) && $permissions['video_management'] === true) ? 'checked' : '';
                                       ?>>
                                <label class="form-check-label" for="perm_video">
                                    Kelola Video
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="permission-group mb-3">
                            <h6 class="text-warning mb-2">
                                <i class="bi bi-cash-coin me-1"></i>
                                Data Management
                            </h6>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="harga_management" 
                                       id="perm_harga" <?php 
                                       $permissions = json_decode($role['permissions'] ?? '[]', true);
                                       echo (is_array($permissions) && isset($permissions['harga_management']) && $permissions['harga_management'] === true) ? 'checked' : '';
                                       ?>>
                                <label class="form-check-label" for="perm_harga">
                                    Kelola Harga Komoditas
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="pasar_management" 
                                       id="perm_pasar" <?php 
                                       $permissions = json_decode($role['permissions'] ?? '[]', true);
                                       echo (is_array($permissions) && isset($permissions['pasar_management']) && $permissions['pasar_management'] === true) ? 'checked' : '';
                                       ?>>
                                <label class="form-check-label" for="perm_pasar">
                                    Kelola Data Pasar
                                </label>
                            </div>
                        </div>

                        <div class="permission-group mb-3">
                            <h6 class="text-info mb-2">
                                <i class="bi bi-chat-dots me-1"></i>
                                Feedback Management
                            </h6>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="feedback_management" 
                                       id="perm_feedback" <?php 
                                       $permissions = json_decode($role['permissions'] ?? '[]', true);
                                       echo (is_array($permissions) && isset($permissions['feedback_management']) && $permissions['feedback_management'] === true) ? 'checked' : '';
                                       ?>>
                                <label class="form-check-label" for="perm_feedback">
                                    Kelola Feedback
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="d-flex justify-content-between">
                <a href="/admin/role" class="btn btn-outline-secondary">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('roleForm');
    
    form.addEventListener('submit', function(e) {
        // Validate at least one permission is selected
        const permissions = document.querySelectorAll('input[name="permissions[]"]:checked');
        if (permissions.length === 0) {
            e.preventDefault();
            alert('Pilih minimal satu permission untuk role ini!');
            return false;
        }
        
        // Validate role name
        const roleName = document.getElementById('nama').value.trim();
        if (roleName.length < 3) {
            e.preventDefault();
            alert('Nama role minimal 3 karakter!');
            return false;
        }
        
        // Validate description
        const description = document.getElementById('deskripsi').value.trim();
        if (description.length < 10) {
            e.preventDefault();
            alert('Deskripsi role minimal 10 karakter!');
            return false;
        }
        
        // Confirm if role is being deactivated
        const isActive = document.getElementById('is_active').value;
        const originalStatus = <?= isset($role) ? $role['is_active'] : 1 ?>;
        
        if (originalStatus == 1 && isActive == 0) {
            if (!confirm('Anda akan menonaktifkan role ini. User dengan role ini tidak akan bisa login lagi. Lanjutkan?')) {
                e.preventDefault();
                return false;
            }
        }
    });
    
    // Auto-save draft functionality
    let autoSaveTimer;
    const inputs = form.querySelectorAll('input, textarea, select');
    
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            clearTimeout(autoSaveTimer);
            autoSaveTimer = setTimeout(() => {
                // Save form data to localStorage
                const formData = new FormData(form);
                const data = {};
                for (let [key, value] of formData.entries()) {
                    if (data[key]) {
                        if (Array.isArray(data[key])) {
                            data[key].push(value);
                        } else {
                            data[key] = [data[key], value];
                        }
                    } else {
                        data[key] = value;
                    }
                }
                localStorage.setItem('roleFormDraft', JSON.stringify(data));
            }, 2000);
        });
    });
    
    // Load draft on page load
    const draft = localStorage.getItem('roleFormDraft');
    if (draft && !<?= isset($role) ? 'true' : 'false' ?>) {
        const data = JSON.parse(draft);
        Object.keys(data).forEach(key => {
            const input = form.querySelector(`[name="${key}"]`);
            if (input) {
                if (input.type === 'checkbox') {
                    input.checked = Array.isArray(data[key]) ? data[key].includes(input.value) : data[key] === input.value;
                } else {
                    input.value = Array.isArray(data[key]) ? data[key][0] : data[key];
                }
            }
        });
    }
    
    // Clear draft on successful submit
    form.addEventListener('submit', function() {
        localStorage.removeItem('roleFormDraft');
    });
});
</script>

<?= $this->endSection() ?> 