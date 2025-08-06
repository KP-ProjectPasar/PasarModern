<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-title">Data Pasar</h1>
            <p class="page-subtitle mb-0">Kelola informasi dan data pasar yang tersedia</p>
        </div>
        <div class="col-auto">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPasarModal">
                <i class="bi bi-plus-circle me-2"></i>Tambah Data Pasar
            </button>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-primary">
            <div class="stat-card-mini-icon">
                <i class="bi bi-building"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number">12</div>
                <div class="stat-card-mini-label">Total Pasar</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-success">
            <div class="stat-card-mini-icon">
                <i class="bi bi-check-circle"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number">10</div>
                <div class="stat-card-mini-label">Pasar Aktif</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-warning">
            <div class="stat-card-mini-icon">
                <i class="bi bi-clock"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number">2</div>
                <div class="stat-card-mini-label">Dalam Perbaikan</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card-mini stat-card-info">
            <div class="stat-card-mini-icon">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-card-mini-content">
                <div class="stat-card-mini-number">1,250</div>
                <div class="stat-card-mini-label">Total Pedagang</div>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter Section -->
<div class="search-filter-section mb-4">
    <div class="row align-items-center">
        <div class="col-md-12">
            <div class="search-box">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control" id="searchPasar" placeholder="Cari data pasar...">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Data Pasar Cards -->
<div class="row" id="pasarContainer">
    <!-- Pasar Card 1 -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="pasar-card">
            <div class="pasar-card-image">
                <img src="/assets/img/pasar/pasar1.jpeg" alt="Pasar Modern Tangerang">
                <div class="pasar-card-overlay">
                    <div class="pasar-card-actions">
                        <button class="btn btn-light btn-sm" onclick="viewPasar(1)" title="Lihat Detail">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-primary btn-sm" onclick="editPasar(1)" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="deletePasar(1)" title="Hapus">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="pasar-card-body">
                <h5 class="pasar-card-title">Pasar Modern Tangerang</h5>
                <div class="pasar-card-meta">
                    <span><i class="bi bi-geo-alt me-1"></i>Jl. Raya Tangerang No. 123</span>
                    <span><i class="bi bi-telephone me-1"></i>021-1234567</span>
                </div>
                <p class="pasar-card-description">
                    Pasar modern dengan fasilitas lengkap, menjual berbagai jenis komoditas segar dan kebutuhan sehari-hari.
                </p>
                <div class="pasar-card-footer">
                    <div class="pasar-card-stats">
                        <span><i class="bi bi-people me-1"></i>150 Pedagang</span>
                        <span><i class="bi bi-clock me-1"></i>06:00 - 18:00</span>
                        <span><i class="bi bi-star me-1"></i>4.5/5</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pasar Card 2 -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="pasar-card">
            <div class="pasar-card-image">
                <img src="/assets/img/pasar/pasar2.jpeg" alt="Pasar Tradisional Serpong">
                <div class="pasar-card-overlay">
                    <div class="pasar-card-actions">
                        <button class="btn btn-light btn-sm" onclick="viewPasar(2)" title="Lihat Detail">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-primary btn-sm" onclick="editPasar(2)" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="deletePasar(2)" title="Hapus">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="pasar-card-body">
                <h5 class="pasar-card-title">Pasar Tradisional Serpong</h5>
                <div class="pasar-card-meta">
                    <span><i class="bi bi-geo-alt me-1"></i>Jl. Serpong Raya No. 45</span>
                    <span><i class="bi bi-telephone me-1"></i>021-9876543</span>
                </div>
                <p class="pasar-card-description">
                    Pasar tradisional yang ramai dengan berbagai pedagang lokal, menjual produk segar dan murah.
                </p>
                <div class="pasar-card-footer">
                    <div class="pasar-card-stats">
                        <span><i class="bi bi-people me-1"></i>200 Pedagang</span>
                        <span><i class="bi bi-clock me-1"></i>05:00 - 17:00</span>
                        <span><i class="bi bi-star me-1"></i>4.2/5</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pasar Card 3 -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="pasar-card">
            <div class="pasar-card-image">
                <img src="/assets/img/pasar/pasar3.jpeg" alt="Pasar Ciputat">
                <div class="pasar-card-overlay">
                    <div class="pasar-card-actions">
                        <button class="btn btn-light btn-sm" onclick="viewPasar(3)" title="Lihat Detail">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-primary btn-sm" onclick="editPasar(3)" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="deletePasar(3)" title="Hapus">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="pasar-card-body">
                <h5 class="pasar-card-title">Pasar Ciputat</h5>
                <div class="pasar-card-meta">
                    <span><i class="bi bi-geo-alt me-1"></i>Jl. Ciputat Raya No. 78</span>
                    <span><i class="bi bi-telephone me-1"></i>021-5551234</span>
                </div>
                <p class="pasar-card-description">
                    Pasar yang sedang dalam proses renovasi untuk meningkatkan kualitas layanan dan fasilitas.
                </p>
                <div class="pasar-card-footer">
                    <div class="pasar-card-stats">
                        <span><i class="bi bi-people me-1"></i>120 Pedagang</span>
                        <span><i class="bi bi-clock me-1"></i>07:00 - 16:00</span>
                        <span><i class="bi bi-star me-1"></i>4.0/5</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Empty State -->
<div class="empty-state" id="emptyState" style="display: none;">
    <div class="empty-state-icon">
        <i class="bi bi-building"></i>
    </div>
    <h4>Tidak ada data pasar</h4>
    <p class="text-muted">Belum ada data pasar yang ditambahkan atau tidak ada hasil yang sesuai dengan pencarian.</p>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPasarModal">
        <i class="bi bi-plus-circle me-2"></i>Tambah Data Pasar Pertama
    </button>
</div>

<!-- Add Pasar Modal -->
<div class="modal fade" id="tambahPasarModal" tabindex="-1" aria-labelledby="tambahPasarModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPasarModalLabel">Tambah Data Pasar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/admin/pasar/store" method="POST" enctype="multipart/form-data" id="tambahPasarForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama_pasar" class="form-label">Nama Pasar <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_pasar" name="nama_pasar" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="aktif">Aktif</option>
                                <option value="perbaikan">Perbaikan</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="tel" class="form-control" id="telepon" name="telepon">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="jam_operasional" class="form-label">Jam Operasional</label>
                            <input type="text" class="form-control" id="jam_operasional" name="jam_operasional" placeholder="06:00 - 18:00">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jumlah_pedagang" class="form-label">Jumlah Pedagang</label>
                            <input type="number" class="form-control" id="jumlah_pedagang" name="jumlah_pedagang" min="0">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto Pasar</label>
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                        <div class="form-text">Format: JPG, PNG, GIF. Maksimal 2MB.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Initialize Bootstrap modal functionality
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing modals...');
    
    // Check if Bootstrap is available
    if (typeof bootstrap === 'undefined') {
        console.error('Bootstrap is not loaded!');
        return;
    }
    
    // Initialize modal
    const modal = document.getElementById('tambahPasarModal');
    if (modal) {
        console.log('Initializing modal:', modal.id);
        
        // Create modal instance
        const modalInstance = new bootstrap.Modal(modal, {
            backdrop: true,
            keyboard: true,
            focus: true
        });
        
        // When modal is shown, ensure all form elements are enabled
        modal.addEventListener('shown.bs.modal', function() {
            console.log('Modal shown, enabling form elements...');
            
            // Get all form elements INSIDE the modal only
            const inputs = modal.querySelectorAll('input, select, textarea, button');
            console.log('Found', inputs.length, 'form elements in modal');
            
            // Enable each element with balanced approach
            inputs.forEach(function(element, index) {
                // Remove problematic attributes
                element.removeAttribute('disabled');
                element.removeAttribute('readonly');
                
                // Set element properties
                element.disabled = false;
                element.readOnly = false;
                
                // Set basic styles (no !important to avoid conflicts)
                element.style.pointerEvents = 'auto';
                element.style.opacity = '1';
                element.style.color = '#212529';
                element.style.backgroundColor = '#ffffff';
                element.style.cursor = 'text';
                element.style.position = 'relative';
                element.style.zIndex = '1';
                
                // For buttons, set cursor to pointer
                if (element.tagName === 'BUTTON') {
                    element.style.cursor = 'pointer';
                }
                
                // For file inputs, set cursor to pointer
                if (element.type === 'file') {
                    element.style.cursor = 'pointer';
                }
                
                console.log('Enabled element', index + 1, ':', element.id || element.tagName);
            });
            
            // Focus on first input after a short delay
            setTimeout(function() {
                const firstInput = modal.querySelector('input, select, textarea');
                if (firstInput) {
                    firstInput.focus();
                    console.log('Focused on:', firstInput.id);
                }
            }, 100);
            
            // Specifically test jam_operasional field
            const jamOperasionalField = modal.querySelector('#jam_operasional');
            if (jamOperasionalField) {
                console.log('Testing jam_operasional field specifically');
                jamOperasionalField.style.backgroundColor = '#ffffff';
                jamOperasionalField.style.color = '#212529';
                jamOperasionalField.style.opacity = '1';
                jamOperasionalField.style.pointerEvents = 'auto';
                jamOperasionalField.style.cursor = 'text';
                jamOperasionalField.removeAttribute('disabled');
                jamOperasionalField.removeAttribute('readonly');
                jamOperasionalField.disabled = false;
                jamOperasionalField.readOnly = false;
                
                console.log('jam_operasional field enabled');
            }
        });
        
        // When modal is hidden, reset form
        modal.addEventListener('hidden.bs.modal', function() {
            console.log('Modal hidden, resetting form...');
            const form = modal.querySelector('form');
            if (form) {
                form.reset();
            }
        });
        
        // When modal is about to show, prepare form elements
        modal.addEventListener('show.bs.modal', function() {
            console.log('Modal about to show, preparing form elements...');
            
            // Remove aria-hidden from modal
            modal.removeAttribute('aria-hidden');
            
            // Ensure modal is properly configured
            modal.setAttribute('tabindex', '-1');
            modal.setAttribute('aria-labelledby', 'tambahPasarModalLabel');
        });
    }
    
    // Form submission handling - SIMPLIFIED
    const form = document.getElementById('tambahPasarForm');
    if (form) {
        console.log('Setting up form submission handler');
        
        // Remove any existing event listeners
        const newForm = form.cloneNode(true);
        form.parentNode.replaceChild(newForm, form);
        
        // Add new event listener
        newForm.addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Form submitted');
            
            // Get form data
            const formData = new FormData(this);
            
            // Log form data for debugging
            for (let [key, value] of formData.entries()) {
                console.log('Form data:', key, '=', value);
            }
            
            // Validate form
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;
            let errorMessage = '';
            
            requiredFields.forEach(function(field) {
                if (!field.value.trim()) {
                    field.classList.add('border-danger');
                    isValid = false;
                    errorMessage += field.name + ' wajib diisi. ';
                } else {
                    field.classList.remove('border-danger');
                }
            });
            
            if (!isValid) {
                alert('Validasi gagal: ' + errorMessage);
                return;
            }
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Menyimpan...';
            submitBtn.disabled = true;
            
            // Submit form
            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                console.log('Response received:', response);
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                console.log('Data received:', data);
                if (data.success) {
                    alert('Data pasar berhasil ditambahkan!');
                    // Close modal
                    const modalInstance = bootstrap.Modal.getInstance(modal);
                    if (modalInstance) {
                        modalInstance.hide();
                    }
                    // Reset form
                    this.reset();
                    // Reload page
                    location.reload();
                } else {
                    alert('Gagal menambahkan data: ' + (data.message || 'Terjadi kesalahan'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan data: ' + error.message);
            })
            .finally(() => {
                // Reset button state
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });
    }
    
    // File input handling
    const fileInput = document.getElementById('foto');
    if (fileInput) {
        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                // Check file size (2MB limit)
                if (file.size > 2 * 1024 * 1024) {
                    alert('File terlalu besar. Maksimal 2MB.');
                    this.value = '';
                    return;
                }
                
                // Check file type
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Format file tidak didukung. Gunakan JPG, PNG, atau GIF.');
                    this.value = '';
                    return;
                }
                
                console.log('File selected:', file.name, file.size, file.type);
            }
        });
    }
    
    // Modal trigger handling - BALANCED
    const modalTrigger = document.querySelector('[data-bs-target="#tambahPasarModal"]');
    if (modalTrigger) {
        modalTrigger.addEventListener('click', function() {
            console.log('Modal trigger clicked');
            
            // Simple enable after modal opens
            setTimeout(function() {
                if (modal) {
                    const inputs = modal.querySelectorAll('input, select, textarea, button');
                    inputs.forEach(function(element) {
                        element.removeAttribute('disabled');
                        element.disabled = false;
                        element.style.pointerEvents = 'auto';
                        element.style.opacity = '1';
                        element.style.color = '#212529';
                        element.style.backgroundColor = '#ffffff';
                        element.style.cursor = 'text';
                        
                        if (element.tagName === 'BUTTON') {
                            element.style.cursor = 'pointer';
                        }
                        
                        if (element.type === 'file') {
                            element.style.cursor = 'pointer';
                        }
                        
                        console.log('Enabled:', element.id || element.tagName);
                    });
                    
                    // Test jam_operasional specifically
                    const jamOperasionalField = modal.querySelector('#jam_operasional');
                    if (jamOperasionalField) {
                        jamOperasionalField.style.backgroundColor = '#ffffff';
                        jamOperasionalField.style.color = '#212529';
                        jamOperasionalField.style.opacity = '1';
                        jamOperasionalField.style.pointerEvents = 'auto';
                        jamOperasionalField.style.cursor = 'text';
                        jamOperasionalField.removeAttribute('disabled');
                        jamOperasionalField.disabled = false;
                        console.log('jam_operasional field enabled');
                    }
                }
            }, 100);
        });
    }
    
    // Image error handling
    const images = document.querySelectorAll('img');
    images.forEach(function(img) {
        img.addEventListener('error', function() {
            console.error('Image failed to load:', this.src);
            this.style.display = 'none';
            const placeholder = document.createElement('div');
            placeholder.style.cssText = 'width: 100%; height: 200px; background: #e9ecef; display: flex; align-items: center; justify-content: center; color: #6c757d; font-size: 1.5rem;';
            placeholder.innerHTML = '<i class="bi bi-image"></i>';
            this.parentNode.insertBefore(placeholder, this);
        });
    });
    
    // Test modal functionality
    setTimeout(function() {
        console.log('Testing modal functionality...');
        if (modal) {
            const inputs = modal.querySelectorAll('input, select, textarea');
            console.log('Found', inputs.length, 'form elements in modal');
            inputs.forEach(function(input, index) {
                console.log('Input', index + 1, ':', input.id, 'disabled:', input.disabled, 'pointer-events:', input.style.pointerEvents);
            });
        }
    }, 2000);
});

// Search functionality
document.getElementById('searchPasar').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const cards = document.querySelectorAll('#pasarContainer .col-lg-4');
    let visibleCount = 0;
    
    cards.forEach(card => {
        const title = card.querySelector('.pasar-card-title').textContent.toLowerCase();
        const description = card.querySelector('.pasar-card-description').textContent.toLowerCase();
        const address = card.querySelector('.pasar-card-meta span:first-child').textContent.toLowerCase();
        
        if (title.includes(searchTerm) || description.includes(searchTerm) || address.includes(searchTerm)) {
            card.style.display = 'block';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });
    
    // Show/hide empty state
    const emptyState = document.getElementById('emptyState');
    if (visibleCount === 0) {
        emptyState.style.display = 'block';
    } else {
        emptyState.style.display = 'none';
    }
});

// Pasar functions
function viewPasar(id) {
    alert('Fitur lihat detail akan segera hadir!');
}

function editPasar(id) {
    alert('Fitur edit akan segera hadir!');
}

function deletePasar(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data pasar ini?')) {
        alert('Fitur hapus akan segera hadir!');
    }
}
</script>

<?= $this->endSection() ?> 