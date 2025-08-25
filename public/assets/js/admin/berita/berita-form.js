/**
 * Berita Form JavaScript
 * Handles form functionality for creating and editing news articles
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize form elements
    const form = document.getElementById('beritaForm');
    const fileInput = document.getElementById('gambar');
    const ringkasanTextarea = document.getElementById('ringkasan');
    const kontenTextarea = document.getElementById('konten');
    const charCount = document.getElementById('charCount');
    const ringkasanCharCount = document.getElementById('ringkasanCharCount');
    
    // Initialize form if elements exist
    if (form) {
        initializeForm();
    }
    
    function initializeForm() {
        // Initialize image handling
        if (fileInput) {
            initializeImageHandling();
        }
        
        // Initialize textarea placeholders
        // Ringkasan dihapus dari form/database
        
        if (kontenTextarea) {
            initializeTextareaPlaceholder(kontenTextarea);
            initializeCharacterCounter(kontenTextarea);
        }
        
        // Initialize form validation
        initializeFormValidation();
    }
    
    function initializeImageHandling() {
        // File input change handler
        fileInput.addEventListener('change', handleFileSelection);
        
        // Show selected file name
        fileInput.addEventListener('change', function() {
            const fileName = this.files[0]?.name;
            if (fileName) {
                const fileLabel = this.nextElementSibling.querySelector('span');
                if (fileLabel) {
                    fileLabel.textContent = fileName;
                }
            }
        });
    }
    
    function initializeTextareaPlaceholder(textarea) {
        // Hide placeholder when there's content
        if (textarea.value.trim()) {
            textarea.classList.add('has-content');
        }
        
        // Add event listeners for placeholder behavior
        textarea.addEventListener('input', function() {
            if (this.value.trim()) {
                this.classList.add('has-content');
            } else {
                this.classList.remove('has-content');
            }
        });
        
        textarea.addEventListener('focus', function() {
            if (this.value.trim()) {
                this.classList.add('has-content');
            }
        });
        
        textarea.addEventListener('blur', function() {
            if (!this.value.trim()) {
                this.classList.remove('has-content');
            }
        });
    }
    
    function initializeRingkasanCharacterCounter(textarea) { /* removed */ }
    
    function updateRingkasanCharacterCount(text) { /* removed */ }
    
    function initializeCharacterCounter(textarea) {
        // Initial character count
        updateCharacterCount(textarea.value);
        
        // Add event listener for character counting
        textarea.addEventListener('input', function() {
            updateCharacterCount(this.value);
        });
        
        // Add event listener for paste events
        textarea.addEventListener('paste', function() {
            setTimeout(() => updateCharacterCount(this.value), 100);
        });
    }
    
    function updateCharacterCount(text) {
        if (!charCount) return;
        
        const count = text.length;
        charCount.textContent = count;
    }
    
    function handleFileSelection(event) {
        const file = event.target.files[0];
        if (file) {
            // Validate file type
            if (!file.type.startsWith('image/')) {
                alert('Silakan pilih file gambar (JPG, PNG, GIF)');
                event.target.value = '';
                return;
            }
            
            // Validate file size (max 5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 5MB');
                event.target.value = '';
                return;
            }
            
            // Show preview if needed
            showImagePreview(file);
        }
    }
    
    function showImagePreview(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // You can add image preview functionality here if needed
            console.log('Image selected:', file.name);
        };
        reader.readAsDataURL(file);
    }
    
    function initializeFormValidation() {
        form.addEventListener('submit', function(e) {
            if (!validateForm()) {
                e.preventDefault();
            }
        });
    }
    
    function validateForm() {
        let isValid = true;
        const requiredFields = form.querySelectorAll('[required]');
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        // Ringkasan validation removed
        
        // Special validation for konten content
        if (kontenTextarea && kontenTextarea.value.trim().length < 50) {
            kontenTextarea.classList.add('is-invalid');
            alert('Konten berita minimal 50 karakter');
            isValid = false;
        }
        
        return isValid;
    }
    
    // Auto-resize textarea
    function autoResizeTextarea(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = textarea.scrollHeight + 'px';
    }
    
    // Apply auto-resize to textareas
    // Ringkasan auto-resize removed
    
    if (kontenTextarea) {
        kontenTextarea.addEventListener('input', () => autoResizeTextarea(kontenTextarea));
    }
});
