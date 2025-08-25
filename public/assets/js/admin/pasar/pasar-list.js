// Pasar List JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const pasarRows = document.querySelectorAll('.pasar-row');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        pasarRows.forEach(row => {
            const name = row.getAttribute('data-name');
            const status = row.getAttribute('data-status');
            
            const matches = name.includes(searchTerm) || 
                           status.includes(searchTerm);
            
            row.style.display = matches ? '' : 'none';
        });
    });
    
    window.editPasar = function(id) {
        window.location.href = `/admin/pasar/edit/${id}`;
    };
    
    window.deletePasar = function(id, name) {
        if (confirm(`Apakah Anda yakin ingin menghapus data pasar "${name}"?\n\nTindakan ini tidak dapat dibatalkan.`)) {
            window.location.href = `/admin/pasar/delete/${id}`;
        }
    };
}); 