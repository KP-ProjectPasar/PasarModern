// Galeri List JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const galeriRows = document.querySelectorAll('.galeri-row');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        galeriRows.forEach(row => {
            const title = row.getAttribute('data-title');
            const kategori = row.getAttribute('data-kategori');
            
            const matches = title.includes(searchTerm) || 
                           kategori.includes(searchTerm);
            
            row.style.display = matches ? '' : 'none';
        });
    });

    window.editGaleri = function(id) {
        window.location.href = `/admin/galeri/edit/${id}`;
    };
    
    window.deleteGaleri = function(id, title) {
        if (confirm(`Apakah Anda yakin ingin menghapus foto "${title}"?\n\nTindakan ini tidak dapat dibatalkan.`)) {
            window.location.href = `/admin/galeri/delete/${id}`;
        }
    };
}); 