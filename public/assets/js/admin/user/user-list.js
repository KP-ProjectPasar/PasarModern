// User List JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const userRows = document.querySelectorAll('.user-row');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        userRows.forEach(row => {
            const username = row.getAttribute('data-username');
            const role = row.getAttribute('data-role');
            const status = row.getAttribute('data-status');
            
            const matches = username.includes(searchTerm) || 
                           role.includes(searchTerm) || 
                           status.includes(searchTerm);
            
            row.style.display = matches ? '' : 'none';
        });
    });
    
    window.editUser = function(id) {
        window.location.href = `/admin/user/edit/${id}`;
    };
    
    window.deleteUser = function(id, username) {
        const titleEl = document.getElementById('deleteUserTitle');
        const btnEl = document.getElementById('deleteUserBtn');
        const modal = document.getElementById('deleteModal');
        if (titleEl && btnEl && modal) {
            titleEl.textContent = username;
            btnEl.href = `/admin/user/delete/${id}`;
            modal.classList.add('show');

            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeDeleteModal();
                }
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeDeleteModal();
                }
            });
        } else {
            if (confirm(`Apakah Anda yakin ingin menghapus user "${username}"?\n\nTindakan ini tidak dapat dibatalkan.`)) {
                window.location.href = `/admin/user/delete/${id}`;
            }
        }
    };

    window.closeDeleteModal = function() {
        const modal = document.getElementById('deleteModal');
        if (modal) modal.classList.remove('show');
    }
}); 