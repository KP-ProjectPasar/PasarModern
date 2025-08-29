// Harga Form JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('hargaForm');
    const fileInput = document.getElementById('foto');
    const imagePreview = document.getElementById('imagePreview');
    const previewImage = document.getElementById('previewImage');
    
    if (!form) return;
    
    // File upload handling
    if (fileInput) {
        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                // Validate file size (5MB limit)
                if (file.size > 5 * 1024 * 1024) {
                    alert('File terlalu besar. Maksimal 5MB.');
                    this.value = '';
                    return;
                }
                
                // Validate file type
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Format file tidak didukung. Gunakan JPG, PNG, atau GIF.');
                    this.value = '';
                    return;
                }
                
                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    }
    
    // Remove image function
    window.removeImage = function() {
        if (fileInput) {
            fileInput.value = '';
        }
        if (imagePreview) {
            imagePreview.style.display = 'none';
        }
        if (previewImage) {
            previewImage.src = '';
        }
    };
    
    // Form submission
    form.addEventListener('submit', function(e) {
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
            e.preventDefault();
            alert('Validasi gagal: ' + errorMessage);
            return;
        }
        
        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Menyimpan...';
        submitBtn.disabled = true;
        
        // Allow form to submit normally
        // Form will redirect after successful submission
    });
}); 