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
        if (confirm(`Apakah Anda yakin ingin menghapus user "${username}"?\n\nTindakan ini tidak dapat dibatalkan.`)) {
            window.location.href = `/admin/user/delete/${id}`;
        }
    };
}); 