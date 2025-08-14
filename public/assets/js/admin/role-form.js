// Role Form JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('roleForm');
    
    if (!form) return;
    
    // Form validation
    form.addEventListener('submit', function(e) {
        const permissions = document.querySelectorAll('input[name="permissions[]"]:checked');
        if (permissions.length === 0) {
            e.preventDefault();
            alert('Pilih minimal satu permission untuk role ini!');
            return false;
        }
        
        const roleName = document.getElementById('nama').value.trim();
        if (roleName.length < 3) {
            e.preventDefault();
            alert('Nama role minimal 3 karakter!');
            return false;
        }
        
        const description = document.getElementById('deskripsi').value.trim();
        if (description.length < 10) {
            e.preventDefault();
            alert('Deskripsi role minimal 10 karakter!');
            return false;
        }
        
        const isActive = document.getElementById('is_active').value;
        const originalStatus = document.querySelector('input[name="original_status"]')?.value || 1;
        
        if (originalStatus == 1 && isActive == 0) {
            if (!confirm('Anda akan menonaktifkan role ini. User dengan role ini tidak akan bisa login lagi. Lanjutkan?')) {
                e.preventDefault();
                return false;
            }
        }
    });
    
    // Auto-save draft functionality
    let autoSaveTimer;
    const inputs = form.querySelectorAll('input, textarea, select');
    
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            clearTimeout(autoSaveTimer);
            autoSaveTimer = setTimeout(() => {
                const formData = new FormData(form);
                const data = {};
                for (let [key, value] of formData.entries()) {
                    if (data[key]) {
                        if (Array.isArray(data[key])) {
                            data[key].push(value);
                        } else {
                            data[key] = [data[key], value];
                        }
                    } else {
                        data[key] = value;
                    }
                }
                localStorage.setItem('roleFormDraft', JSON.stringify(data));
            }, 2000);
        });
    });
    
    // Load draft on page load
    const draft = localStorage.getItem('roleFormDraft');
    const isEditMode = document.querySelector('input[name="id"]');
    
    if (draft && !isEditMode) {
        const data = JSON.parse(draft);
        Object.keys(data).forEach(key => {
            const input = form.querySelector(`[name="${key}"]`);
            if (input) {
                if (input.type === 'checkbox') {
                    input.checked = Array.isArray(data[key]) ? data[key].includes(input.value) : data[key] === input.value;
                } else {
                    input.value = Array.isArray(data[key]) ? data[key][0] : data[key];
                }
            }
        });
    }
    
    // Clear draft on successful submit
    form.addEventListener('submit', function() {
        localStorage.removeItem('roleFormDraft');
    });
}); 