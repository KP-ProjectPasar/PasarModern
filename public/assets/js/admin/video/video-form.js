/**
 * Video Form JavaScript
 * Handles form functionality for creating and editing video entries
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize form elements
    const form = document.getElementById('videoForm');
    // Match actual DOM in video_form.php
    const radioUrl = document.getElementById('tipe_url');
    const radioFile = document.getElementById('tipe_file');
    const urlSection = document.getElementById('url_section');
    const fileSection = document.getElementById('file_section');
    const urlInput = document.getElementById('url_video');
    const fileInput = document.getElementById('video_file');
    const urlValidation = document.getElementById('urlValidation');
    
    // Initialize form if elements exist
    if (form) {
        initializeForm();
    }
    
    function initializeForm() {
        // Initialize type selection based on radios
        initializeTypeSelection();
        
        // Initialize URL validation
        if (urlInput) {
            initializeUrlValidation();
        }
        
        // Initialize file handling
        if (fileInput) {
            initializeFileHandling();
        }
        
        // Initialize form validation
        initializeFormValidation();
    }
    
    function initializeTypeSelection() {
        const updateView = () => {
            const type = radioFile && radioFile.checked ? 'file' : 'url';
            if (type === 'url') {
                if (urlSection) urlSection.style.display = 'block';
                if (fileSection) fileSection.style.display = 'none';
                clearFileInput();
            } else {
                if (fileSection) fileSection.style.display = 'block';
                if (urlSection) urlSection.style.display = 'none';
                clearUrlInput();
            }
        };
        if (radioUrl) radioUrl.addEventListener('change', updateView);
        if (radioFile) radioFile.addEventListener('change', updateView);
        // Initialize on load
        updateView();
    }
    
    function initializeUrlValidation() {
        urlInput.addEventListener('input', function() {
            const url = this.value.trim();
            
            if (url === '') {
                clearUrlValidation();
                return;
            }
            
            if (isValidUrl(url)) {
                showUrlValidation(true);
                this.classList.remove('border-danger');
                this.classList.add('border-success');
            } else {
                showUrlValidation(false);
                this.classList.remove('border-success');
                this.classList.add('border-danger');
            }
        });
        
        urlInput.addEventListener('blur', function() {
            if (this.value.trim() === '') {
                this.classList.remove('border-danger', 'border-success');
            }
        });
    }
    
    function initializeFileHandling() {
        // Basic binding for standard file input
        if (fileInput) {
            fileInput.addEventListener('change', handleFileSelection);
        }
    }
    
    function handleDragOver(event) {
        event.preventDefault();
        event.currentTarget.classList.add('dragover');
    }
    
    function handleDragLeave(event) {
        event.preventDefault();
        event.currentTarget.classList.remove('dragover');
    }
    
    function handleDrop(event) {
        event.preventDefault();
        event.currentTarget.classList.remove('dragover');
        
        const files = event.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            handleFileSelection({ target: fileInput });
        }
    }
    
    function handleFileSelection(event) {
        const file = event.target.files[0];
        if (file) {
            // Validate file
            if (!validateFile(file)) {
                return;
            }
            
            // Show file preview
            showFilePreview(file);
        }
    }
    
    function validateFile(file) {
        // Check file size (100MB limit)
        const maxSize = 100 * 1024 * 1024;
        if (file.size > maxSize) {
            showNotification('File terlalu besar. Maksimal 100MB.', 'error');
            clearFileInput();
            return false;
        }
        
        // Check file type
        const allowedTypes = ['video/mp4','video/quicktime','video/x-msvideo','video/x-ms-wmv','video/x-flv','video/webm','video/x-matroska'];
        if (!allowedTypes.includes(file.type)) {
            showNotification('Format file tidak didukung. Gunakan MP4, AVI, MOV, WMV, atau FLV.', 'error');
            clearFileInput();
            return false;
        }
        
        return true;
    }
    
    function showFilePreview(file) {
        const filePreview = document.getElementById('filePreview');
        if (!filePreview) return;
        
        const fileIcon = filePreview.querySelector('.file-icon');
        const fileName = filePreview.querySelector('.file-name');
        const fileSize = filePreview.querySelector('.file-size');
        const fileDuration = filePreview.querySelector('.file-duration');
        
        if (fileIcon) fileIcon.innerHTML = '<i class="bi bi-file-earmark-play"></i>';
        if (fileName) fileName.textContent = file.name;
        if (fileSize) fileSize.textContent = formatFileSize(file.size);
        
        // Try to get video duration
        if (fileDuration) {
            const video = document.createElement('video');
            video.preload = 'metadata';
            video.onloadedmetadata = function() {
                fileDuration.textContent = formatDuration(video.duration);
            };
            video.src = URL.createObjectURL(file);
        }
        
        filePreview.classList.add('show');
    }
    
    function clearFileInput() {
        if (fileInput) {
            fileInput.value = '';
        }
        
        const filePreview = document.getElementById('filePreview');
        if (filePreview) {
            filePreview.classList.remove('show');
        }
    }
    
    function clearUrlInput() {
        if (urlInput) {
            urlInput.value = '';
            clearUrlValidation();
        }
    }
    
    function clearUrlValidation() {
        if (urlValidation) {
            urlValidation.innerHTML = '';
            urlValidation.className = 'url-validation';
        }
        
        if (urlInput) {
            urlInput.classList.remove('border-danger', 'border-success');
        }
    }
    
    function showUrlValidation(isValid) {
        if (!urlValidation) return;
        
        if (isValid) {
            urlValidation.innerHTML = '<i class="bi bi-check-circle-fill"></i>';
            urlValidation.className = 'url-validation valid';
        } else {
            urlValidation.innerHTML = '<i class="bi bi-x-circle-fill"></i>';
            urlValidation.className = 'url-validation invalid';
        }
    }
    
    function isValidUrl(string) {
        try {
            new URL(string);
            return true;
        } catch (_) {
            return false;
        }
    }
    
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        
        return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
    }
    
    function formatDuration(seconds) {
        const hours = Math.floor(seconds / 3600);
        const minutes = Math.floor((seconds % 3600) / 60);
        const secs = Math.floor(seconds % 60);
        
        if (hours > 0) {
            return `${hours}:${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
        } else {
            return `${minutes}:${secs.toString().padStart(2, '0')}`;
        }
    }
    
    function initializeFormValidation() {
        if (!form) return;
        
        form.addEventListener('submit', function(event) {
            if (!validateForm()) {
                event.preventDefault();
                showNotification('Mohon lengkapi semua field yang diperlukan', 'error');
            }
        });
    }
    
    function validateForm() {
        const judul = document.getElementById('judul')?.value.trim();
        const tipe = (radioFile && radioFile.checked) ? 'file' : 'url';
        
        if (!judul || judul.length < 3) {
            showNotification('Judul video minimal 3 karakter', 'error');
            return false;
        }
        
        if (!tipe) {
            showNotification('Pilih tipe video', 'error');
            return false;
        }
        
        if (tipe === 'url') {
            const url = urlInput?.value.trim();
            if (!url || !isValidUrl(url)) {
                showNotification('Masukkan URL video yang valid', 'error');
                return false;
            }
        } else if (tipe === 'file') {
            if (!fileInput?.files || fileInput.files.length === 0) {
                showNotification('Pilih file video', 'error');
                return false;
            }
        }
        
        return true;
    }
    
    function showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `alert alert-${type === 'error' ? 'danger' : type} alert-dismissible fade show position-fixed`;
        notification.style.cssText = `
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
        `;
        
        notification.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        // Add to body
        document.body.appendChild(notification);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 5000);
    }
}); 