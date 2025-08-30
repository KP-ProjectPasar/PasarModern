// Pasar List JavaScript Functions
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const pasarRows = document.querySelectorAll('.pasar-row');
    
    if (searchInput) {
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
    }

    window.editPasar = function(id) {
        window.location.href = `/admin/pasar/edit/${id}`;
    };
    
    window.deletePasar = function(id, name) {
        confirmDelete(id, name);
    };
});

function confirmDelete(id, name) {
    document.getElementById('deletePasarName').textContent = name;
    document.getElementById('deletePasarBtn').href = '/admin/pasar/delete/' + id;
    
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