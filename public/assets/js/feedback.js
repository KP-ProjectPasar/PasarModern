// Feedback Form JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('feedbackForm');
    const fileInput = document.getElementById('file_lampiran');
    const filePreview = document.getElementById('filePreview');
    const imagePreview = document.getElementById('imagePreview');
    const videoPreview = document.getElementById('videoPreview');
    const fileInfo = document.getElementById('fileInfo');
    const submitBtn = document.getElementById('submitBtn');

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
        const el = document.createElement('div');
        el.className = `alert alert-${type} alert-dismissible fade show`;
        el.innerHTML = `${type === 'success' ? '<i class="bi bi-check-circle me-2"></i>' : '<i class="bi bi-exclamation-triangle me-2"></i>'}${message}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>`;
        form.parentNode.insertBefore(el, form);
        el.scrollIntoView({ behavior: 'smooth', block: 'center' });
        return el;
    }

    // Submit handler (simplified, guaranteed reset)
    if (form) {
        let submitting = false;
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            if (submitting) return; // guard double submit
            submitting = true;

            const original = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Mengirim...';
            submitBtn.disabled = true;

            try {
                const formData = new FormData(form);
                const actionUrl = form.getAttribute('action') || '/feedback/submit';
                const res = await fetch(actionUrl, { method: 'POST', body: formData });
                let data;
                try {
                    data = await res.json();
                } catch (_) {
                    const text = await res.text();
                    throw new Error(text || 'Response tidak valid');
                }

                if (!res.ok) {
                    throw new Error(data.message || `HTTP ${res.status}`);
                }

                if (data && data.success) {
                    showAlert('success', data.message || 'Feedback terkirim. Terima kasih!');
                    form.reset();
                    if (filePreview) filePreview.style.display = 'none';
                    if (imagePreview) imagePreview.style.display = 'none';
                    if (videoPreview) videoPreview.style.display = 'none';
                    if (fileInfo) fileInfo.innerHTML = '';
                    submitBtn.innerHTML = '<i class="bi bi-check2-circle me-2"></i>Terkirim';
                } else {
                    const msg = (data && (data.message || (data.errors && Object.values(data.errors).join(', ')))) || 'Gagal mengirim feedback';
                    showAlert('danger', msg);
                    // Fallback to native submit to ensure data reaches server
                    form.removeEventListener('submit', arguments.callee);
                    form.submit();
                }
            } catch (err) {
                showAlert('danger', `Terjadi kesalahan saat mengirim feedback: ${err.message}`);
                // Fallback to native submit
                form.removeEventListener('submit', arguments.callee);
                form.submit();
            } finally {
                submitBtn.disabled = false;
                submitting = false;
                // kembalikan teks tombol setelah 2 detik jika sukses
                if (submitBtn.innerHTML.includes('Terkirim')) {
                    setTimeout(() => { submitBtn.innerHTML = original; }, 2000);
                }
            }
        });
    }
}); 