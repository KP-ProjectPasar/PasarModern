// Berita List JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const beritaRows = document.querySelectorAll('.berita-row');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        beritaRows.forEach(row => {
            const title = row.getAttribute('data-title');
            const status = row.getAttribute('data-status');
            
            const matches = title.includes(searchTerm) || 
                           status.includes(searchTerm);
            
            row.style.display = matches ? '' : 'none';
        });
    });

    window.editBerita = function(id) {
        window.location.href = `/admin/berita/edit/${id}`;
    };
    
    window.deleteBerita = function(id, title) {
        if (confirm(`Apakah Anda yakin ingin menghapus berita "${title}"?\n\nTindakan ini tidak dapat dibatalkan.`)) {
            window.location.href = `/admin/berita/delete/${id}`;
        }
    };
}); 