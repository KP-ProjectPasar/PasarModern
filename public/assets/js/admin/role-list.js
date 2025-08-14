// Role List JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const roleRows = document.querySelectorAll('.role-row');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        roleRows.forEach(row => {
            const name = row.getAttribute('data-name');
            const status = row.getAttribute('data-status');
            
            const matches = name.includes(searchTerm) || 
                           status.includes(searchTerm);
            
            row.style.display = matches ? '' : 'none';
        });
    });
    
    window.editRole = function(id) {
        window.location.href = `/admin/role/edit/${id}`;
    };
    
    window.deleteRole = function(id, name) {
        if (confirm(`Apakah Anda yakin ingin menghapus role "${name}"?\n\nTindakan ini tidak dapat dibatalkan.`)) {
            window.location.href = `/admin/role/delete/${id}`;
        }
    };
}); 