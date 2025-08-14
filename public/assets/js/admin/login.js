// Login Page JavaScript
function togglePassword() {
    const pwd = document.getElementById('password');
    const icon = document.getElementById('toggleIcon');
    if (pwd.type === 'password') {
        pwd.type = 'text';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    } else {
        pwd.type = 'password';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        var btn = document.getElementById('loginBtn');
        var text = document.getElementById('loginBtnText');
        var spinner = document.getElementById('loginSpinner');
        btn.disabled = true;
        text.classList.add('d-none');
        spinner.classList.remove('d-none');
    });
}); 