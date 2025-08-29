// Pasar Form JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('pasarForm');
    const fileInput = document.getElementById('foto');
    const imagePreview = document.getElementById('imagePreview');
    const previewImage = document.getElementById('previewImage');
    const progressBar = document.getElementById('progressBar');
    const progressText = document.getElementById('progressText');
    
    if (!form) return;
    
    // File upload handling
    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            // Validate file size (50MB limit)
            if (file.size > 50 * 1024 * 1024) {
                alert('File terlalu besar. Maksimal 50MB.');
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
    
    // Remove image function
    window.removeImage = function() {
        fileInput.value = '';
        imagePreview.style.display = 'none';
        previewImage.src = '';
    };
    
    // Form progress tracking
    const requiredFields = form.querySelectorAll('[required]');
    const totalFields = requiredFields.length;
    
    function updateProgress() {
        let filledFields = 0;
        requiredFields.forEach(field => {
            if (field.value.trim() !== '') {
                filledFields++;
            }
        });
        
        const progress = (filledFields / totalFields) * 100;
        progressBar.style.width = progress + '%';
        
        if (progress === 100) {
            progressText.textContent = 'Form siap untuk disimpan!';
            progressText.style.color = '#0d6efd';
        } else {
            progressText.textContent = `${filledFields} dari ${totalFields} field wajib telah diisi`;
            progressText.style.color = '#6c757d';
        }
    }
    
    // Add event listeners to required fields
    requiredFields.forEach(field => {
        field.addEventListener('input', updateProgress);
        field.addEventListener('change', updateProgress);
    });
    
    // Initial progress update
    updateProgress();
    
    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
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
        const formData = new FormData(this);
        
        fetch(this.action, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert('Data pasar berhasil disimpan!');
                window.location.href = '/admin/pasar';
            } else {
                alert('Gagal menyimpan data: ' + (data.message || 'Terjadi kesalahan'));
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
}); 