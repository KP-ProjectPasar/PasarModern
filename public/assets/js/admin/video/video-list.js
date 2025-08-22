// Video List JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const videoRows = document.querySelectorAll('.video-row');
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            videoRows.forEach(row => {
                const title = row.getAttribute('data-title');
                const tipe = row.getAttribute('data-tipe');
                
                const matches = title.includes(searchTerm) || 
                               tipe.includes(searchTerm);
                
                row.style.display = matches ? '' : 'none';
            });
        });
    }

    window.editVideo = function(id) {
        window.location.href = `/admin/video/edit/${id}`;
    };
    
    // Fungsi deleteVideo lama dihapus karena sudah diganti dengan modal custom
    // window.deleteVideo = function(id, title) {
    //     if (confirm(`Apakah Anda yakin ingin menghapus video "${title}"?\n\nTindakan ini tidak dapat dibatalkan.`)) {
    //         window.location.href = `/admin/video/delete/${id}`;
    //     }
    // };
}); 