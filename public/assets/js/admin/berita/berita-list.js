// Berita List JavaScript Functions
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const beritaRows = document.querySelectorAll('.berita-row');
    
    if (searchInput) {
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
    }

    window.editBerita = function(id) {
        window.location.href = `/admin/berita/edit/${id}`;
    };
    
    // Pastikan modal tertutup saat halaman dimuat
    const modal = document.getElementById('deleteModal');
    if (modal && modal.classList.contains('show')) {
        modal.classList.remove('show');
    }
});

function confirmDelete(id, title) {
    document.getElementById('deleteBeritaTitle').textContent = title;
    document.getElementById('deleteBeritaBtn').href = '/admin/berita/delete/' + id;
    
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