// Harga List JavaScript Functions
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const hargaRows = document.querySelectorAll('.harga-row');
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            hargaRows.forEach(row => {
                const komoditas = row.getAttribute('data-komoditas');
                
                const matches = komoditas.includes(searchTerm);
                
                row.style.display = matches ? '' : 'none';
            });
        });
    }
    
    window.editHarga = function(id) {
        window.location.href = `/admin/harga/edit/${id}`;
    };
    
    window.deleteHarga = function(id, komoditas) {
        confirmDelete(id, komoditas);
    };
});

function confirmDelete(id, komoditas) {
    document.getElementById('deleteHargaKomoditas').textContent = komoditas;
    document.getElementById('deleteHargaBtn').href = '/admin/harga/delete/' + id;
    
    const modal = document.getElementById('deleteModal');
    modal.classList.add('show');
    
    // Tambahkan event listener untuk menutup modal saat klik di luar
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeDeleteModal();
        }
    });
    
    // Tambahkan event listener untuk escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    modal.classList.remove('show');
} 