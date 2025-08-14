<?= $this->extend('admin/layout') ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="/assets/css/admin/form-styles.css">
<style>
    .editor-toolbar {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px 8px 0 0;
        padding: 0.5rem;
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    
    .editor-btn {
        background: white;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        padding: 0.5rem;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 0.875rem;
    }
    
    .editor-btn:hover {
        background: #f3f4f6;
        border-color: #9ca3af;
    }
    
    .editor-btn.active {
        background: #1e40af;
        color: white;
        border-color: #1e40af;
    }
    
    .content-editor {
        border: 1px solid #e2e8f0;
        border-radius: 0 0 8px 8px;
        min-height: 300px;
        padding: 1rem;
        background: white;
        font-family: inherit;
        line-height: 1.6;
    }
    
    .content-editor:focus {
        outline: none;
        border-color: #1e40af;
        box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
    }
    
    .word-count {
        text-align: right;
        color: #6b7280;
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }
    
    .word-count.warning {
        color: #f59e0b;
    }
    
    .word-count.danger {
        color: #ef4444;
    }
</style>
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
            <a href="/admin/berita" class="btn btn-secondary btn-lg">
                <i class="bi bi-arrow-left me-2"></i>
                Kembali
            </a>
        </div>
    </div>
</div>

<!-- Form Card -->
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="content-card">
            <div class="content-card-header">
                <h5 class="content-card-title">
                    <i class="bi bi-form me-2"></i>
                    Form Berita
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

                <form action="<?= isset($berita) ? '/admin/berita/update/' . $berita['id'] : '/admin/berita/store' ?>" 
                      method="POST" enctype="multipart/form-data" id="beritaForm" novalidate>
                    
                    <!-- Judul Input -->
                    <div class="mb-4">
                        <div class="form-floating">
                            <input type="text" 
                                   class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['judul']) ? 'border-danger' : '' ?>" 
                                   id="judul" 
                                   name="judul" 
                                   placeholder="Masukkan judul berita"
                                   value="<?= old('judul', $berita['judul'] ?? '') ?>" 
                                   required>
                            <label for="judul">Judul Berita</label>
                        </div>
                        <?php 
                        $errors = session()->getFlashdata('errors');
                        if ($errors && isset($errors['judul'])): 
                        ?>
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>
                                <?= $errors['judul'] ?>
                            </div>
                        <?php endif; ?>
                        <div class="form-text">
                            <i class="bi bi-info-circle me-1"></i>
                            Judul yang menarik dan informatif untuk berita
                        </div>
                    </div>

                    <!-- Image Upload Section -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold mb-3">
                            <i class="bi bi-image me-2"></i>
                            Gambar Berita
                            <?php if (!isset($berita)): ?>
                                <span class="text-danger">*</span>
                            <?php endif; ?>
                        </label>

            <?php if (isset($berita) && $berita['gambar']): ?>
                            <!-- Current Image Preview -->
                            <div class="image-preview mb-3">
                                <h6 class="text-muted mb-3">
                                    <i class="bi bi-image me-2"></i>
                                    Gambar Saat Ini
                                </h6>
                                <img src="/uploads/berita/<?= esc($berita['gambar']) ?>" 
                                     alt="Current Image" 
                                     class="mb-3">
                                <p class="text-muted small mb-0">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Upload gambar baru untuk mengganti gambar ini
                                </p>
                            </div>
                        <?php endif; ?>

                        <!-- File Upload Area -->
                        <div class="file-upload-area" id="uploadArea">
                            <input type="file" 
                                   name="gambar" 
                                   class="file-upload-input" 
                                   id="gambar" 
                                   accept="image/*,.jpg,.jpeg,.png,.gif,.webp" 
                                   <?= !isset($berita) ? 'required' : '' ?>>
                            
                            <div class="upload-icon">
                                <i class="bi bi-cloud-upload"></i>
                            </div>
                            <h5 class="mb-2">Upload Gambar Berita</h5>
                            <p class="text-muted mb-3">
                                Drag & drop gambar di sini atau klik untuk memilih file
                            </p>
                            <button type="button" class="btn btn-outline-primary" id="selectFileBtn">
                                <i class="bi bi-folder2-open me-2"></i>
                                Pilih File
                            </button>
                            <p class="text-muted small mt-3 mb-0">
                                Format: JPG, JPEG, PNG, GIF, WebP • Maksimal: 5MB
                            </p>
                            <div id="fileStatus" class="mt-2"></div>
                            <div id="uploadDebug" class="mt-2 small text-muted"></div>
                        </div>
                        
                        <!-- Hidden input untuk debugging -->
                        <input type="hidden" id="fileSelected" value="false">

                        <?php 
                        if ($errors && isset($errors['gambar'])): 
                        ?>
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>
                                <?= $errors['gambar'] ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Tanggal Publish -->
                    <div class="mb-4">
                        <div class="form-floating">
                            <input type="date" 
                                   class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['tanggal_publish']) ? 'border-danger' : '' ?>" 
                                   id="tanggal_publish" 
                                   name="tanggal_publish" 
                                   value="<?= old('tanggal_publish', $berita['tanggal_publish'] ?? date('Y-m-d')) ?>" 
                                   required>
                            <label for="tanggal_publish">Tanggal Publish</label>
                        </div>
                        <?php 
                        $errors = session()->getFlashdata('errors');
                        if ($errors && isset($errors['tanggal_publish'])): 
                        ?>
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>
                                <?= $errors['tanggal_publish'] ?>
                            </div>
                        <?php endif; ?>
                        <div class="form-text">
                            <i class="bi bi-info-circle me-1"></i>
                            Tanggal kapan berita akan dipublish
                        </div>
                    </div>

                    <!-- Content Editor -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold mb-3">
                            <i class="bi bi-pencil-square me-2"></i>
                            Isi Berita <span class="text-danger">*</span>
                        </label>
                        
                        <!-- Editor Toolbar -->
                        <div class="editor-toolbar">
                            <button type="button" class="editor-btn" data-command="bold" title="Bold">
                                <i class="bi bi-type-bold"></i>
                            </button>
                            <button type="button" class="editor-btn" data-command="italic" title="Italic">
                                <i class="bi bi-type-italic"></i>
                            </button>
                            <button type="button" class="editor-btn" data-command="underline" title="Underline">
                                <i class="bi bi-type-underline"></i>
                            </button>
                            <div class="vr mx-2"></div>
                            <button type="button" class="editor-btn" data-command="insertUnorderedList" title="Bullet List">
                                <i class="bi bi-list-ul"></i>
                            </button>
                            <button type="button" class="editor-btn" data-command="insertOrderedList" title="Numbered List">
                                <i class="bi bi-list-ol"></i>
                            </button>
                            <div class="vr mx-2"></div>
                            <button type="button" class="editor-btn" data-command="createLink" title="Insert Link">
                                <i class="bi bi-link-45deg"></i>
                            </button>
                            <button type="button" class="editor-btn" data-command="justifyLeft" title="Align Left">
                                <i class="bi bi-text-left"></i>
                            </button>
                            <button type="button" class="editor-btn" data-command="justifyCenter" title="Align Center">
                                <i class="bi bi-text-center"></i>
                            </button>
                            <button type="button" class="editor-btn" data-command="justifyRight" title="Align Right">
                                <i class="bi bi-text-right"></i>
                            </button>
                        </div>
                        
                        <!-- Content Editor -->
                        <div class="content-editor" 
                             id="contentEditor" 
                             contenteditable="true" 
                             data-placeholder="Tulis isi berita di sini...">
                            <?= old('isi', $berita['isi'] ?? '') ?>
                        </div>
                        
                        <!-- Hidden input for form submission -->
                        <input type="hidden" name="isi" id="isiInput" value="<?= old('isi', $berita['isi'] ?? '') ?>">
                        
                        <!-- Word Count -->
                        <div class="word-count" id="wordCount">
                            <i class="bi bi-text-paragraph me-1"></i>
                            <span id="wordCountText">0</span> kata
                        </div>

                        <?php 
                        if ($errors && isset($errors['isi'])): 
                        ?>
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>
                                <?= $errors['isi'] ?>
                </div>
            <?php endif; ?>
                        
                        <div class="form-text">
                            <i class="bi bi-info-circle me-1"></i>
                            Gunakan toolbar di atas untuk memformat teks. Minimal 50 kata.
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="/admin/berita" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                            <i class="bi bi-check-circle me-2"></i>
                            <?= isset($berita) ? 'Update Berita' : 'Simpan Berita' ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('gambar');
    const selectFileBtn = document.getElementById('selectFileBtn');
    const form = document.getElementById('beritaForm');
    const contentEditor = document.getElementById('contentEditor');
    const isiInput = document.getElementById('isiInput');
    const wordCount = document.getElementById('wordCount');
    const wordCountText = document.getElementById('wordCountText');
    const submitBtn = document.getElementById('submitBtn');
    const fileStatus = document.getElementById('fileStatus');
    const uploadDebug = document.getElementById('uploadDebug');

    // Drag and drop functionality
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        uploadArea.classList.add('dragover');
    }

    function unhighlight(e) {
        uploadArea.classList.remove('dragover');
    }

    // Handle dropped files
    uploadArea.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        fileInput.files = files;
        
        if (files.length > 0) {
            const file = files[0];
            if (file.type.startsWith('image/')) {
                showImagePreview(file);
            }
        }
    }

    // Handle file selection
    fileInput.addEventListener('change', function(e) {
        console.log('=== FILE INPUT CHANGE EVENT ===');
        console.log('File input changed:', this.files);
        console.log('File input value:', this.value);
        console.log('Event target:', e.target);
        
        if (this.files.length > 0) {
            const file = this.files[0];
            console.log('Selected file:', file);
            console.log('File name:', file.name);
            console.log('File size:', file.size);
            console.log('File type:', file.type);
            console.log('File lastModified:', file.lastModified);
            
            // Update hidden input
            document.getElementById('fileSelected').value = 'true';
            
            // Check if file is an image
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
            if (!allowedTypes.includes(file.type)) {
                fileStatus.innerHTML = `
                    <div class="alert alert-danger alert-sm">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        Format file tidak didukung. Gunakan JPG, JPEG, PNG, GIF, atau WebP.
                    </div>
                `;
                fileInput.value = '';
                document.getElementById('fileSelected').value = 'false';
                return;
            }
            
            // Check file size (5MB = 5 * 1024 * 1024 bytes)
            const maxSize = 5 * 1024 * 1024;
            if (file.size > maxSize) {
                fileStatus.innerHTML = `
                    <div class="alert alert-danger alert-sm">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        Ukuran file terlalu besar. Maksimal 5MB.
                    </div>
                `;
                fileInput.value = '';
                document.getElementById('fileSelected').value = 'false';
                return;
            }
            
            // Update file status
            fileStatus.innerHTML = `
                <div class="alert alert-success alert-sm">
                    <i class="bi bi-check-circle me-2"></i>
                    File dipilih: ${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)
                </div>
            `;
            
            // Update debug info
            uploadDebug.innerHTML = `
                <div class="small">
                    <strong>Debug Info:</strong><br>
                    Name: ${file.name}<br>
                    Size: ${file.size} bytes<br>
                    Type: ${file.type}<br>
                    Last Modified: ${new Date(file.lastModified).toLocaleString()}<br>
                    File Selected: true
                </div>
            `;
            
            showImagePreview(file);
        } else {
            console.log('No file selected');
            fileStatus.innerHTML = '';
            uploadDebug.innerHTML = '';
            document.getElementById('fileSelected').value = 'false';
        }
    });

    // Handle select file button click
    selectFileBtn.addEventListener('click', function(e) {
                        e.preventDefault();
        fileInput.click();
    });

    function showImagePreview(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Remove existing preview
            const existingPreview = uploadArea.querySelector('.image-preview');
            if (existingPreview) {
                existingPreview.remove();
            }

            // Create new preview
            const preview = document.createElement('div');
            preview.className = 'image-preview mt-3';
            preview.innerHTML = `
                <h6 class="text-success mb-3">
                    <i class="bi bi-check-circle me-2"></i>
                    Gambar Dipilih
                </h6>
                <img src="${e.target.result}" alt="Preview" class="mb-3">
                <p class="text-muted small mb-0">
                    <strong>Nama:</strong> ${file.name}<br>
                    <strong>Ukuran:</strong> ${(file.size / 1024 / 1024).toFixed(2)} MB<br>
                    <strong>Tipe:</strong> ${file.type}
                </p>
            `;
            uploadArea.appendChild(preview);
        };
        reader.readAsDataURL(file);
    }

    // Editor functionality
    const editorBtns = document.querySelectorAll('.editor-btn');
    editorBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
                        e.preventDefault();
            const command = this.dataset.command;
            
            if (command === 'createLink') {
                const url = prompt('Masukkan URL:');
                if (url) {
                    document.execCommand(command, false, url);
                }
            } else {
                document.execCommand(command, false, null);
            }
            
            // Toggle active state for formatting buttons
            if (['bold', 'italic', 'underline'].includes(command)) {
                this.classList.toggle('active');
            }
        });
    });

    // Content editor events
    contentEditor.addEventListener('input', function() {
        const content = this.innerHTML;
        isiInput.value = content;
        updateWordCount(content);
    });

    contentEditor.addEventListener('paste', function(e) {
        e.preventDefault();
        const text = e.clipboardData.getData('text/plain');
        document.execCommand('insertText', false, text);
    });

    function updateWordCount(content) {
        const text = content.replace(/<[^>]*>/g, '').trim();
        const words = text.split(/\s+/).filter(word => word.length > 0);
        const wordCount = words.length;
        
        wordCountText.textContent = wordCount;
        
        // Update word count styling
        wordCount.className = 'word-count';
        if (wordCount < 50) {
            wordCount.classList.add('danger');
        } else if (wordCount < 100) {
            wordCount.classList.add('warning');
        }
    }

    // Initial word count
    updateWordCount(contentEditor.innerHTML);

    // Form validation
    form.addEventListener('submit', function(e) {
        const judul = document.getElementById('judul').value.trim();
        const tanggalPublish = document.getElementById('tanggal_publish').value;
        const gambar = document.getElementById('gambar').files[0];
        const isi = contentEditor.innerHTML.trim();
        
        console.log('=== FORM SUBMISSION DEBUG ===');
        console.log('Form submission - Judul:', judul);
        console.log('Form submission - Tanggal Publish:', tanggalPublish);
        console.log('Form submission - Gambar:', gambar);
        console.log('Form submission - Isi length:', isi.length);
        console.log('Form action:', form.action);
        console.log('Form method:', form.method);
        console.log('Form enctype:', form.enctype);
        
        // Debug form data
        const formData = new FormData(form);
        console.log('FormData entries:');
        for (let [key, value] of formData.entries()) {
            console.log(key + ':', value);
        }
        
        if (!judul) {
            e.preventDefault();
            alert('Judul berita harus diisi!');
            return;
        }
        
        if (!tanggalPublish) {
            e.preventDefault();
            alert('Tanggal publish harus diisi!');
            return;
        }
        
        const fileSelected = document.getElementById('fileSelected').value === 'true';
        console.log('Form validation - File selected:', fileSelected);
        console.log('Form validation - Gambar object:', gambar);
        
        if (!fileSelected && !gambar && !<?= isset($berita) ? 'true' : 'false' ?>) {
            e.preventDefault();
            alert('Gambar berita harus dipilih!');
            return;
        }
        
        // Check file type if file is selected
        if (gambar) {
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
            if (!allowedTypes.includes(gambar.type)) {
                e.preventDefault();
                alert('Format file tidak didukung. Gunakan JPG, JPEG, PNG, GIF, atau WebP.');
                return;
            }
            
            // Check file size
            const maxSize = 5 * 1024 * 1024; // 5MB
            if (gambar.size > maxSize) {
                e.preventDefault();
                alert('Ukuran file terlalu besar. Maksimal 5MB.');
                return;
            }
        }
        
        if (isi.length < 50) {
            e.preventDefault();
            alert('Isi berita minimal 50 kata!');
            return;
        }
        
        // Show loading state
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;
        
        console.log('Form submitted successfully');
    });
});
</script>
<?= $this->endSection() ?> 