// Video Form JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const urlRadio = document.getElementById('tipe_url');
    const fileRadio = document.getElementById('tipe_file');
    const urlSection = document.getElementById('url_section');
    const fileSection = document.getElementById('file_section');
    
    if (!urlRadio || !fileRadio) return;
    
    function toggleSections() {
        if (urlRadio.checked) {
            urlSection.style.display = 'block';
            fileSection.style.display = 'none';
        } else {
            urlSection.style.display = 'none';
            fileSection.style.display = 'block';
        }
    }
    
    urlRadio.addEventListener('change', toggleSections);
    fileRadio.addEventListener('change', toggleSections);
    
    // Initial state
    toggleSections();
}); 