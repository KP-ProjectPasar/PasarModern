// Feedback Form JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('feedbackForm');
    const fileInput = document.getElementById('file_lampiran');
    const filePreview = document.getElementById('filePreview');
    const imagePreview = document.getElementById('imagePreview');
    const videoPreview = document.getElementById('videoPreview');
    const fileInfo = document.getElementById('fileInfo');
    const submitBtn = document.getElementById('submitBtn');

    console.log('Feedback form initialized');

    // File upload handling (keep existing behaviour)
    if (fileInput) {
        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (!file) return;

            // 50MB limit
            if (file.size > 50 * 1024 * 1024) {
                alert('File terlalu besar. Maksimal 50MB.');
                this.value = '';
                return;
            }

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

            fileInfo.innerHTML = `<strong>File:</strong> ${file.name}<br><strong>Ukuran:</strong> ${(file.size/1024/1024).toFixed(2)} MB<br><strong>Tipe:</strong> ${file.type}`;

            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = e => {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                    videoPreview.style.display = 'none';
                };
                reader.readAsDataURL(file);
            } else if (file.type.startsWith('video/')) {
                const reader = new FileReader();
                reader.onload = e => {
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
        });
    }

    window.removeFile = function() {
        if (fileInput) fileInput.value = '';
        if (filePreview) filePreview.style.display = 'none';
        if (imagePreview) imagePreview.style.display = 'none';
        if (videoPreview) videoPreview.style.display = 'none';
        if (fileInfo) fileInfo.innerHTML = '';
    };

    // Helper to show alert above the form
    function showAlert(type, message) {
        // Remove existing alerts first
        const existingAlerts = form.parentNode.querySelectorAll('.alert');
        existingAlerts.forEach(alert => alert.remove());

        const el = document.createElement('div');
        el.className = `alert alert-${type} alert-dismissible fade show`;
        el.innerHTML = `${type === 'success' ? '<i class="bi bi-check-circle me-2"></i>' : '<i class="bi bi-exclamation-triangle me-2"></i>'}${message}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>`;
        form.parentNode.insertBefore(el, form);
        el.scrollIntoView({ behavior: 'smooth', block: 'center' });
        return el;
    }

    // Submit handler (improved with better error handling)
    if (form) {
        console.log('Form found, adding submit listener');
        let submitting = false;
        
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            console.log('Form submitted');
            
            if (submitting) {
                console.log('Already submitting, ignoring');
                return; // guard double submit
            }
            
            submitting = true;
            console.log('Starting form submission');

            const original = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Mengirim...';
            submitBtn.disabled = true;

            try {
                // Validate form before submission
                console.log('Validating form...');
                if (!form.checkValidity()) {
                    console.log('Form validation failed');
                    form.reportValidity();
                    throw new Error('Mohon lengkapi semua field yang wajib diisi');
                }
                console.log('Form validation passed');

                const formData = new FormData(form);
                
                // Log form data for debugging
                console.log('Form data being sent:');
                for (let [key, value] of formData.entries()) {
                    console.log(key + ': ' + value);
                }

                const actionUrl = form.getAttribute('action') || '/feedback/submit';
                console.log('Submitting to:', actionUrl);
                
                // Add timeout to fetch
                const controller = new AbortController();
                const timeoutId = setTimeout(() => controller.abort(), 30000); // 30 second timeout
                
                const res = await fetch(actionUrl, { 
                    method: 'POST', 
                    body: formData,
                    signal: controller.signal
                });
                
                clearTimeout(timeoutId);
                
                console.log('Response status:', res.status);
                console.log('Response headers:', res.headers);
                
                let data;
                try {
                    const responseText = await res.text();
                    console.log('Raw response:', responseText);
                    
                    data = JSON.parse(responseText);
                    console.log('Parsed response data:', data);
                } catch (parseError) {
                    console.error('Failed to parse JSON response:', parseError);
                    throw new Error('Response tidak valid dari server: ' + parseError.message);
                }

                if (!res.ok) {
                    throw new Error(data.message || `HTTP ${res.status}: ${res.statusText}`);
                }

                if (data && data.success) {
                    console.log('Success! Showing success message');
                    showAlert('success', data.message || 'Feedback terkirim. Terima kasih!');
                    form.reset();
                    if (filePreview) filePreview.style.display = 'none';
                    if (imagePreview) imagePreview.style.display = 'none';
                    if (videoPreview) videoPreview.style.display = 'none';
                    if (fileInfo) fileInfo.innerHTML = '';
                    submitBtn.innerHTML = '<i class="bi bi-check2-circle me-2"></i>Terkirim';
                    
                    // Reset button text after 2 seconds
                    setTimeout(() => { 
                        submitBtn.innerHTML = original; 
                    }, 2000);
                } else {
                    console.log('Server returned error');
                    const msg = (data && (data.message || (data.errors && Object.values(data.errors).join(', ')))) || 'Gagal mengirim feedback';
                    showAlert('danger', msg);
                }
            } catch (err) {
                console.error('Error submitting feedback:', err);
                let errorMessage = err.message;
                
                if (err.name === 'AbortError') {
                    errorMessage = 'Request timeout. Silakan coba lagi.';
                } else if (err.name === 'TypeError' && err.message.includes('fetch')) {
                    errorMessage = 'Tidak dapat terhubung ke server. Silakan cek koneksi internet Anda.';
                }
                
                showAlert('danger', `Terjadi kesalahan saat mengirim feedback: ${errorMessage}`);
            } finally {
                console.log('Form submission completed');
                submitBtn.disabled = false;
                submitting = false;
                
                // Always reset button to original state if not success
                if (!data || !data.success) {
                    submitBtn.innerHTML = original;
                }
            }
        });
    } else {
        console.error('Feedback form not found!');
    }
}); 