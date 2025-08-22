// Berita Detail JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Increment view count when page loads
    const beritaId = window.beritaId; // Will be set from PHP
    
    if (beritaId) {
        fetch(`/api/berita/${beritaId}/view`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update views display
                const currentViews = parseInt(document.getElementById('viewsCount').textContent) + 1;
                document.getElementById('viewsCount').textContent = currentViews;
                document.getElementById('viewsDisplay').textContent = currentViews + ' views';
            }
        })
        .catch(error => {
            console.error('Error incrementing view:', error);
        });
    }
});
