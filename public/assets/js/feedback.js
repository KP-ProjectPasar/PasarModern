// Feedback Form JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('feedbackForm');
    const fileInput = document.getElementById('file_lampiran');
    const filePreview = document.getElementById('filePreview');
    const imagePreview = document.getElementById('imagePreview');
    const videoPreview = document.getElementById('videoPreview');
    const fileInfo = document.getElementById('fileInfo');
    const submitBtn = document.getElementById('submitBtn');
    
    // File upload handling
    if (fileInput) {
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
                const allowedTypes = [
                    'image/jpeg', 'image/jpg', 'image/png', 'image/gif',
                    'video/mp4', 'video/avi', 'video/mov', 'video/wmv',
                    'application/pdf', 'application/msword', 
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ];
                
                if (!allowedTypes.includes(file.type)) {
                    alert('Format file tidak didukung. Gunakan JPG, PNG, GIF, MP4, AVI, MOV, WMV, PDF, atau DOC.');
                    this.value = '';
                    return;
                }
                
                // Show file info
                fileInfo.innerHTML = `
                    <strong>File:</strong> ${file.name}<br>
                    <strong>Ukuran:</strong> ${(file.size / 1024 / 1024).toFixed(2)} MB<br>
                    <strong>Tipe:</strong> ${file.type}
                `;
                
                // Show preview for images and videos
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block';
                        videoPreview.style.display = 'none';
                    };
                    reader.readAsDataURL(file);
                } else if (file.type.startsWith('video/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        videoPreview.src = e.target.result;
                        videoPreview.style.display = 'block';
                        imagePreview.style.display = 'none';
                    };
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.style.display = 'none';
                    videoPreview.style.display = 'none';
                }
                
                filePreview.style.display = 'block';
            }
        });
    }
    
    // Remove file function
    window.removeFile = function() {
        if (fileInput) {
            fileInput.value = '';
        }
        if (filePreview) {
            filePreview.style.display = 'none';
        }
        if (imagePreview) {
            imagePreview.style.display = 'none';
        }
        if (videoPreview) {
            videoPreview.style.display = 'none';
        }
        if (fileInfo) {
            fileInfo.innerHTML = '';
        }
    };
    
    // Form submission
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
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
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Mengirim...';
            submitBtn.disabled = true;
            
            // Submit form
            const formData = new FormData(this);
            
            fetch('/feedback/submit', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    form.reset();
                    if (filePreview) {
                        filePreview.style.display = 'none';
                    }
                    if (imagePreview) {
                        imagePreview.style.display = 'none';
                    }
                    if (videoPreview) {
                        videoPreview.style.display = 'none';
                    }
                    if (fileInfo) {
                        fileInfo.innerHTML = '';
                    }
                } else {
                    alert('Gagal mengirim feedback: ' + (data.message || 'Terjadi kesalahan'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengirim feedback. Silakan coba lagi.');
            })
            .finally(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });
    }
    
    // Character counter for message
    const messageTextarea = document.getElementById('pesan');
    if (messageTextarea) {
        messageTextarea.addEventListener('input', function() {
            const length = this.value.length;
            const maxLength = 1000;
            
            if (length > maxLength) {
                this.value = this.value.substring(0, maxLength);
            }
            
            // Update character count if there's a counter element
            const counter = this.parentNode.querySelector('.char-counter');
            if (counter) {
                counter.textContent = `${length}/${maxLength}`;
            }
        });
    }
}); 