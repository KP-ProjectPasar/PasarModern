// Galeri List JavaScript Functions
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const galeriRows = document.querySelectorAll('.galeri-row');
    
    if (searchInput) {
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
    }

    window.editGaleri = function(id) {
        window.location.href = `/admin/galeri/edit/${id}`;
    };
    
    // Pastikan modal tertutup saat halaman dimuat
    const modal = document.getElementById('deleteModal');
    if (modal && modal.classList.contains('show')) {
        modal.classList.remove('show');
    }
});

function confirmDelete(id, title) {
    document.getElementById('deleteGaleriTitle').textContent = title;
    document.getElementById('deleteGaleriBtn').href = '/admin/galeri/delete/' + id;
    
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

/**
 * Toggle featured status for galeri item
 */
function toggleFeatured(type, id, featured) {
    const url = `/admin/${type}/toggle-featured/${id}`;
    
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ featured: featured })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Reload the page to show updated status
            location.reload();
        } else {
            alert('Gagal mengubah status featured: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengubah status featured');
    });
} 