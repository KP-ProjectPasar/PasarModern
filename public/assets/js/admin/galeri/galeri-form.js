/**
 * Galeri Form JavaScript
 * Handles form functionality for creating and editing gallery items
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize form elements
    const form = document.getElementById('galeriForm');
    const fileInput = document.getElementById('gambar');
    const selectFileBtn = document.getElementById('selectFileBtn');
    const imagePreviewArea = document.getElementById('imagePreviewArea');
    const imagePreviewGrid = document.getElementById('imagePreviewGrid');
    const hapusSemuaBtn = document.getElementById('hapusSemuaBtn');
    const uploadArea = document.getElementById('uploadArea');
    
    // Initialize form if elements exist
    if (form) {
        initializeForm();
    }
    
    function initializeForm() {
        // Initialize image handling
        if (fileInput && uploadArea) {
            initializeImageHandling();
        }
        
        // Initialize form validation
        initializeFormValidation();
    }
    
    function initializeImageHandling() {
        // File input change handler
        fileInput.addEventListener('change', handleFileSelection);
        
        // Drag and drop functionality
        uploadArea.addEventListener('dragover', handleDragOver);
        uploadArea.addEventListener('dragleave', handleDragLeave);
        uploadArea.addEventListener('drop', handleDrop);
        
        // Click to upload
        if (selectFileBtn) {
            selectFileBtn.addEventListener('click', () => fileInput.click());
        }
        
        // Remove all images
        if (hapusSemuaBtn) {
            hapusSemuaBtn.addEventListener('click', removeAllImages);
        }
    }
    
    function handleFileSelection(event) {
        const files = Array.from(event.target.files);
        if (files.length > 0) {
            processSelectedFiles(files);
        }
    }
    
    function handleDragOver(event) {
        event.preventDefault();
        uploadArea.classList.add('dragover');
    }
    
    function handleDragLeave(event) {
        event.preventDefault();
        uploadArea.classList.remove('dragover');
    }
    
    function handleDrop(event) {
        event.preventDefault();
        uploadArea.classList.remove('dragover');
        
        const files = Array.from(event.dataTransfer.files);
        if (files.length > 0) {
            processSelectedFiles(files);
        }
    }
    
    function processSelectedFiles(files) {
        // Filter only image files
        const imageFiles = files.filter(file => file.type.startsWith('image/'));
        
        if (imageFiles.length === 0) {
            showNotification('Tidak ada file gambar yang valid', 'warning');
            return;
        }
        
        // Show preview area
        showPreviewArea();
        
        // Process each image file
        imageFiles.forEach((file, index) => {
            createImagePreview(file, index);
        });
        
        // Update file input
        updateFileInput(imageFiles);
    }
    
    function createImagePreview(file, index) {
        const reader = new FileReader();
        reader.onload = function(event) {
            const imageUrl = event.target.result;
            
            // Create preview container
            const previewItem = createPreviewItem(file, imageUrl, index);
            
            // Add to grid
            if (imagePreviewGrid) {
                imagePreviewGrid.appendChild(previewItem);
            }
        };
        
        reader.readAsDataURL(file);
    }
    
    function createPreviewItem(file, imageUrl, index) {
        const col = document.createElement('div');
        col.className = 'col-md-4 mb-3';
        
        const previewItem = document.createElement('div');
        previewItem.className = 'preview-item';
        
        // Add main image badge for first image
        if (index === 0) {
            const badge = document.createElement('span');
            badge.className = 'badge bg-primary';
            badge.textContent = 'Gambar Utama';
            previewItem.appendChild(badge);
        }
        
        // Create image element
        const img = document.createElement('img');
        img.src = imageUrl;
        img.alt = file.name;
        img.className = 'img-fluid';
        previewItem.appendChild(img);
        
        // Create info container
        const infoContainer = document.createElement('div');
        infoContainer.className = 'preview-info';
        
        // File name
        const fileName = document.createElement('div');
        fileName.className = 'preview-filename';
        fileName.textContent = file.name;
        infoContainer.appendChild(fileName);
        
        // File size
        const fileSize = document.createElement('div');
        fileSize.className = 'preview-filesize';
        fileSize.textContent = formatFileSize(file.size);
        infoContainer.appendChild(fileSize);
        
        // Remove button
        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'btn-remove-image';
        removeBtn.textContent = 'Hapus';
        removeBtn.onclick = () => removeImage(col);
        infoContainer.appendChild(removeBtn);
        
        previewItem.appendChild(infoContainer);
        col.appendChild(previewItem);
        
        return col;
    }
    
    function removeImage(container) {
        if (container && container.parentNode) {
            container.parentNode.removeChild(container);
        }
        
        // Hide preview area if no images left
        if (imagePreviewGrid && imagePreviewGrid.children.length === 0) {
            hidePreviewArea();
        }
    }
    
    function removeAllImages() {
        if (imagePreviewGrid) {
            imagePreviewGrid.innerHTML = '';
        }
        
        if (fileInput) {
            fileInput.value = '';
        }
        
        hidePreviewArea();
        showNotification('Semua gambar telah dihapus', 'info');
    }
    
    function updateFileInput(files) {
        // Create a new DataTransfer object
        const dataTransfer = new DataTransfer();
        
        // Add all files
        files.forEach(file => dataTransfer.items.add(file));
        
        // Update file input
        fileInput.files = dataTransfer.files;
    }
    
    function showPreviewArea() {
        if (imagePreviewArea) {
            imagePreviewArea.style.display = 'block';
            imagePreviewArea.classList.add('show');
        }
    }
    
    function hidePreviewArea() {
        if (imagePreviewArea) {
            imagePreviewArea.style.display = 'none';
            imagePreviewArea.classList.remove('show');
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
        
        if (!judul || judul.length < 3) {
            showNotification('Judul galeri minimal 3 karakter', 'error');
            return false;
        }
        
        // kategori dihapus dari form/database
        
        // Check if at least one image is selected
        if (!fileInput.files || fileInput.files.length === 0) {
            showNotification('Minimal satu gambar harus dipilih', 'error');
            return false;
        }
        
        return true;
    }
    
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        
        return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
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
