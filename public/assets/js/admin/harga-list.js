// Harga List JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const hargaRows = document.querySelectorAll('.harga-row');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        hargaRows.forEach(row => {
            const komoditas = row.getAttribute('data-komoditas');
            const kategori = row.getAttribute('data-kategori');
            
            const matches = komoditas.includes(searchTerm) || 
                           kategori.includes(searchTerm);
            
            row.style.display = matches ? '' : 'none';
        });
    });
    
    window.editHarga = function(id) {
        window.location.href = `/admin/harga/edit/${id}`;
    };
    
    window.deleteHarga = function(id, komoditas) {
        if (confirm(`Apakah Anda yakin ingin menghapus harga komoditas "${komoditas}"?\n\nTindakan ini tidak dapat dibatalkan.`)) {
            window.location.href = `/admin/harga/delete/${id}`;
        }
    };
}); 