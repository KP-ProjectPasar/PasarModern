// User Form JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const passwordInput = document.getElementById('password');
    
    if (!form) return;
    
    // Form validation
    form.addEventListener('submit', function(e) {
        const username = document.getElementById('username').value.trim();
        const role = document.getElementById('role').value;
        const password = document.getElementById('password').value;
        
        let isValid = true;
        let errorMessage = '';
        
        if (!username) {
            errorMessage += 'Username wajib diisi\n';
            isValid = false;
        }
        
        if (!role) {
            errorMessage += 'Role wajib dipilih\n';
            isValid = false;
        }
        
        // Check if this is a new user (server sets hidden id on edit). If form doesn't provide id,
        // fall back to URL pattern '/admin/user/update/{id}' to detect edit mode as well.
        const hasIdField = !!document.querySelector('input[name="id"]');
        const urlPath = window.location.pathname || '';
        const isEditUrl = /\/admin\/user\/update\//.test(urlPath) || /\/admin\/user\/edit\//.test(urlPath);
        const isNewUser = !(hasIdField || isEditUrl);
        
        if (isNewUser && !password) {
            errorMessage += 'Password wajib diisi\n';
            isValid = false;
        } else if (password && password.length < 6) {
            errorMessage += 'Password minimal 6 karakter\n';
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
            alert('Validasi gagal:\n' + errorMessage);
        }
    });
    
    // Password strength indicator
    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            
            if (password.length >= 6) strength++;
            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;
            
            // Remove existing strength classes
            this.classList.remove('border-danger', 'border-warning', 'border-success');
            
            // Add appropriate strength class
            if (strength < 2) {
                this.classList.add('border-danger');
            } else if (strength < 4) {
                this.classList.add('border-warning');
            } else {
                this.classList.add('border-success');
            }
        });
    }
}); 