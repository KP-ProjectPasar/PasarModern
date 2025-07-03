// Custom JavaScript untuk Landing Page Pasar Modern

document.addEventListener('DOMContentLoaded', function() {
    // Lightbox untuk galeri
    const galleryImages = document.querySelectorAll('.gallery-img');
    
    galleryImages.forEach(img => {
        img.addEventListener('click', function() {
            openLightbox(this.src, this.alt);
        });
    });
    
    function openLightbox(src, alt) {
        // Buat overlay
        const overlay = document.createElement('div');
        overlay.className = 'lightbox-overlay';
        overlay.innerHTML = `
            <div class="lightbox-content">
                <span class="lightbox-close">&times;</span>
                <img src="${src}" alt="${alt}" class="lightbox-image">
                <div class="lightbox-caption">${alt}</div>
            </div>
        `;
        
        // Tambahkan CSS inline untuk lightbox
        const style = document.createElement('style');
        style.textContent = `
            .lightbox-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.9);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9999;
                cursor: pointer;
            }
            .lightbox-content {
                position: relative;
                max-width: 90%;
                max-height: 90%;
            }
            .lightbox-image {
                max-width: 100%;
                max-height: 100%;
                border-radius: 8px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            }
            .lightbox-close {
                position: absolute;
                top: -40px;
                right: 0;
                color: white;
                font-size: 30px;
                cursor: pointer;
                background: rgba(0, 0, 0, 0.5);
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: background 0.3s;
            }
            .lightbox-close:hover {
                background: rgba(0, 0, 0, 0.8);
            }
            .lightbox-caption {
                position: absolute;
                bottom: -40px;
                left: 0;
                color: white;
                background: rgba(0, 0, 0, 0.7);
                padding: 8px 16px;
                border-radius: 4px;
                font-size: 14px;
            }
        `;
        
        document.head.appendChild(style);
        document.body.appendChild(overlay);
        
        // Tutup lightbox
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay || e.target.classList.contains('lightbox-close')) {
                document.body.removeChild(overlay);
                document.head.removeChild(style);
            }
        });
        
        // Tutup dengan ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                if (document.body.contains(overlay)) {
                    document.body.removeChild(overlay);
                    document.head.removeChild(style);
                }
            }
        });
    }
    
    // Smooth scrolling untuk navigasi
    const navLinks = document.querySelectorAll('a[href^="#"]');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                targetSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Active navigation berdasarkan scroll
    window.addEventListener('scroll', function() {
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
        
        let current = '';
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            
            if (pageYOffset >= sectionTop - 200) {
                current = section.getAttribute('id');
            }
        });
        
        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${current}`) {
                link.classList.add('active');
            }
        });
    });
}); 