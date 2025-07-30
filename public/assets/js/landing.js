// Custom JavaScript untuk Website Perumda Pasar Modern

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
                animation: fadeIn 0.3s ease;
            }
            .lightbox-content {
                position: relative;
                max-width: 90%;
                max-height: 90%;
                animation: zoomIn 0.3s ease;
            }
            .lightbox-image {
                width: 400px;
                height: 300px;
                max-width: 90vw;
                max-height: 70vh;
                object-fit: cover;
                border-radius: 8px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
                display: block;
                margin: 0 auto;
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
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            @keyframes zoomIn {
                from { transform: scale(0.8); }
                to { transform: scale(1); }
            }
        `;
        
        document.head.appendChild(style);
        document.body.appendChild(overlay);
        
        // Tutup lightbox
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay || e.target.classList.contains('lightbox-close')) {
                closeLightbox();
            }
        });
        
        // Tutup dengan ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLightbox();
            }
        });
        
        function closeLightbox() {
            if (document.body.contains(overlay)) {
                overlay.style.animation = 'fadeOut 0.3s ease';
                setTimeout(() => {
                    document.body.removeChild(overlay);
                    document.head.removeChild(style);
                }, 300);
            }
        }
    }
    
    // Smooth scrolling untuk navigasi
    const navLinks = document.querySelectorAll('a[href^="#"]');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                // Khusus untuk beranda, scroll ke atas halaman
                if (targetId === '#beranda') {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                } else {
                const offsetTop = targetSection.offsetTop - 80; // Offset untuk navbar
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
                }
                
                // Tutup mobile menu jika terbuka
                const navbarCollapse = document.querySelector('.navbar-collapse');
                if (navbarCollapse.classList.contains('show')) {
                    const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                    bsCollapse.hide();
                }
            }
        });
    });
    
    // Khusus untuk logo navbar
    const navbarBrand = document.querySelector('.navbar-brand');
    if (navbarBrand) {
        navbarBrand.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
            
            // Tutup mobile menu jika terbuka
            const navbarCollapse = document.querySelector('.navbar-collapse');
            if (navbarCollapse.classList.contains('show')) {
                const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                bsCollapse.hide();
            }
        });
    }
    
    // Active navigation berdasarkan scroll
    window.addEventListener('scroll', function() {
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
        const navbar = document.querySelector('.navbar');
        
        let current = '';
        
        // Efek visual navbar saat scroll
        if (window.scrollY > 50) {
            navbar.style.backgroundColor = 'rgba(255, 255, 255, 0.98)';
            navbar.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.1)';
        } else {
            navbar.style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
            navbar.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.05)';
        }
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop - 100;
            const sectionHeight = section.clientHeight;
            
            if (pageYOffset >= sectionTop && pageYOffset < sectionTop + sectionHeight) {
                current = section.getAttribute('id');
            }
        });
        
        // Jika di bagian atas halaman, aktifkan link beranda
        if (window.scrollY < 100) {
            current = 'beranda';
        }
        
        navLinks.forEach(link => {
            link.classList.remove('active');
            
            // Khusus untuk dropdown, cek apakah ada submenu yang aktif
            if (link.classList.contains('dropdown-toggle')) {
                const dropdownItems = link.parentElement.querySelectorAll('.dropdown-item');
                let hasActiveChild = false;
                
                dropdownItems.forEach(item => {
                    const itemHref = item.getAttribute('href');
                    if (itemHref === `#${current}`) {
                        hasActiveChild = true;
                    }
                });
                
                if (hasActiveChild) {
                    link.classList.add('active');
                }
            } else if (link.getAttribute('href') === `#${current}`) {
                link.classList.add('active');
            }
        });
    });
    
    // Animate elements on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                
                // Khusus untuk statistik counter
                if (entry.target.classList.contains('stats-counter')) {
                    const target = parseInt(entry.target.textContent.replace(/[^\d]/g, ''));
                    animateCounter(entry.target, target);
                }
            }
        });
    }, observerOptions);
    
    // Observe cards and sections
    document.querySelectorAll('.card, .section-title, #tentang-kami .card, #tentang-kami h3, #tentang-kami .blockquote').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
    
    // Observe statistik counter
    document.querySelectorAll('#ringkasan h4').forEach(el => {
        el.classList.add('stats-counter');
        // Jangan observe lagi karena sudah di observe di tentangKamiObserver
    });
    
    // Counter animation for statistics (if any)
    function animateCounter(element, target, duration = 2000) {
        // Cek apakah sudah di-animate
        if (element.dataset.animated === 'true') return;
        element.dataset.animated = 'true';
        
        let start = 0;
        const increment = target / (duration / 16);
        const originalText = element.textContent;
        const suffix = originalText.replace(/[\d,]/g, ''); // Ambil suffix (+, %, dll)
        
        function updateCounter() {
            start += increment;
            if (start < target) {
                element.textContent = Math.floor(start).toLocaleString() + suffix;
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target.toLocaleString() + suffix;
            }
        }
        updateCounter();
    }
    
    // Add loading animation for images
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        img.style.transition = 'opacity 0.3s ease';
        if (img.complete) {
            img.style.opacity = '1';
        } else {
            img.style.opacity = '0';
            img.addEventListener('load', function() {
                this.style.opacity = '1';
            });
        }
    });
    
    // Khusus untuk gambar di section Tentang Kami
    const tentangKamiImages = document.querySelectorAll('#tentang-kami img');
    tentangKamiImages.forEach(img => {
        img.addEventListener('load', function() {
            this.style.opacity = '1';
            this.style.transform = 'scale(1)';
        });
        
        img.style.opacity = '0';
        img.style.transform = 'scale(0.9)';
        img.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
    });
    
    // Animasi khusus untuk section Tentang Kami
    const tentangKamiObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target;
                
                // Animasi untuk statistik
                if (target.classList.contains('stats-counter')) {
                    // Cek apakah sudah di-animate
                    if (target.dataset.animated === 'true') return;
                    target.dataset.animated = 'true';
                    
                    const originalText = target.textContent;
                    const number = parseInt(originalText.replace(/[^\d]/g, ''));
                    const suffix = originalText.replace(/[\d,]/g, '');
                    
                    let current = 0;
                    const increment = number / 50;
                    
                    const counter = setInterval(() => {
                        current += increment;
                        if (current >= number) {
                            target.textContent = number.toLocaleString() + suffix;
                            clearInterval(counter);
                        } else {
                            target.textContent = Math.floor(current).toLocaleString() + suffix;
                        }
                    }, 50);
                }
                
                // Animasi untuk cards
                if (target.classList.contains('card')) {
                    target.style.opacity = '1';
                    target.style.transform = 'translateY(0)';
                }
                
                // Animasi untuk blockquote
                if (target.classList.contains('blockquote')) {
                    target.style.opacity = '1';
                    target.style.transform = 'translateX(0)';
                }
            }
        });
    }, { threshold: 0.2 });
    
    // Observe elements di section Tentang Kami
    document.querySelectorAll('#tentang-kami .card, #tentang-kami .blockquote, #tentang-kami .stats-counter').forEach(el => {
        if (el.classList.contains('card')) {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        } else if (el.classList.contains('blockquote')) {
            el.style.opacity = '0';
            el.style.transform = 'translateX(-30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        } else if (el.classList.contains('stats-counter')) {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        }
        tentangKamiObserver.observe(el);
    });
    
    // Tambahkan efek loading untuk section Tentang Kami
    const tentangKamiSection = document.getElementById('tentang-kami');
    if (tentangKamiSection) {
        const loadingObserver = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Tambahkan class untuk animasi
                    entry.target.classList.add('section-loaded');
                    
                    // Animate elements dengan delay
                    const elements = entry.target.querySelectorAll('.card, .blockquote, .stats-counter');
                    elements.forEach((el, index) => {
                        setTimeout(() => {
                            if (el.classList.contains('card')) {
                                el.style.opacity = '1';
                                el.style.transform = 'translateY(0)';
                            } else if (el.classList.contains('blockquote')) {
                                el.style.opacity = '1';
                                el.style.transform = 'translateX(0)';
                            } else if (el.classList.contains('stats-counter')) {
                                el.style.opacity = '1';
                                el.style.transform = 'translateY(0)';
                            }
                        }, index * 200);
                    });
                }
            });
        }, { threshold: 0.1 });
        
        loadingObserver.observe(tentangKamiSection);
    }
    
    // Add hover effect for table rows
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#f8f9fa';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '';
        });
    });
    
    // Add tooltip for social media links
    const socialLinks = document.querySelectorAll('.social-links a');
    socialLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px) scale(1.1)';
        });
        
        link.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
    
    // Add back to top button
    const backToTopBtn = document.createElement('button');
    backToTopBtn.innerHTML = '<i class="bi bi-arrow-up"></i>';
    backToTopBtn.className = 'back-to-top';
    backToTopBtn.style.cssText = `
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 50px;
        height: 50px;
        background: linear-gradient(90deg, #0d6efd, #198754);
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        z-index: 1000;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    `;
    
    document.body.appendChild(backToTopBtn);
    
    // Show/hide back to top button
    window.addEventListener('scroll', function() {
        if (pageYOffset > 300) {
            backToTopBtn.style.opacity = '1';
            backToTopBtn.style.visibility = 'visible';
        } else {
            backToTopBtn.style.opacity = '0';
            backToTopBtn.style.visibility = 'hidden';
        }
    });
    
    // Back to top functionality
    backToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // Add hover effect for back to top button
    backToTopBtn.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-2px) scale(1.1)';
    });
    
    backToTopBtn.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0) scale(1)';
    });
    
    // Initialize tooltips if Bootstrap tooltips are available
    if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
    
    // Add loading state for buttons
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            if (!this.classList.contains('btn-outline-primary')) {
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="bi bi-hourglass-split"></i> Loading...';
                this.disabled = true;
                
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.disabled = false;
                }, 2000);
            }
        });
    });
    
    // Add hover effect for dropdown items
    const dropdownItems = document.querySelectorAll('.dropdown-item');
    dropdownItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(5px)';
            this.style.backgroundColor = '#f8f9fa';
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
            this.style.backgroundColor = '';
        });
    });
    
    // Add tooltip for dropdown items
    dropdownItems.forEach(item => {
        const text = item.textContent;
        item.setAttribute('title', `Klik untuk melihat ${text}`);
    });
    
    // Add click effect for dropdown items
    dropdownItems.forEach(item => {
        item.addEventListener('click', function() {
            // Add ripple effect
            const ripple = document.createElement('span');
            ripple.style.cssText = `
                position: absolute;
                border-radius: 50%;
                background: rgba(13, 110, 253, 0.3);
                transform: scale(0);
                animation: ripple 0.6s linear;
                pointer-events: none;
            `;
            
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = (rect.width / 2 - size / 2) + 'px';
            ripple.style.top = (rect.height / 2 - size / 2) + 'px';
            
            this.style.position = 'relative';
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
    
    // Add CSS for ripple animation
    const rippleStyle = document.createElement('style');
    rippleStyle.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(rippleStyle);
});

// Komoditas Filter dan Pencarian
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchKomoditas');
    const kategoriFilter = document.getElementById('filterKategori');
    const perubahanFilter = document.getElementById('filterPerubahan');
    const komoditasItems = document.querySelectorAll('.komoditas-item');

    // Fungsi filter komoditas
    function filterKomoditas() {
        const searchTerm = searchInput.value.toLowerCase();
        const kategoriValue = kategoriFilter.value;
        const perubahanValue = perubahanFilter.value;

        komoditasItems.forEach(item => {
            const productName = item.querySelector('.product-name').textContent.toLowerCase();
            const kategori = item.getAttribute('data-kategori');
            const perubahan = item.getAttribute('data-perubahan');

            const matchesSearch = productName.includes(searchTerm);
            const matchesKategori = !kategoriValue || kategori === kategoriValue;
            const matchesPerubahan = !perubahanValue || perubahan === perubahanValue;

            if (matchesSearch && matchesKategori && matchesPerubahan) {
                item.style.display = 'block';
                item.style.animation = 'fadeInUp 0.5s ease-out';
            } else {
                item.style.display = 'none';
            }
        });

        // Update statistik berdasarkan filter
        updateStatistics();
    }

    // Update statistik berdasarkan filter yang aktif
    function updateStatistics() {
        const visibleItems = document.querySelectorAll('.komoditas-item[style*="block"], .komoditas-item:not([style*="none"])');
        let naikCount = 0;
        let turunCount = 0;

        visibleItems.forEach(item => {
            const perubahan = item.getAttribute('data-perubahan');
            if (perubahan === 'naik') naikCount++;
            if (perubahan === 'turun') turunCount++;
        });

        // Update statistik cards jika ada
        const statCards = document.querySelectorAll('.stat-card h4');
        if (statCards.length >= 2) {
            statCards[0].textContent = naikCount;
            statCards[1].textContent = turunCount;
        }
    }

    // Event listeners
    if (searchInput) {
        searchInput.addEventListener('input', filterKomoditas);
    }
    if (kategoriFilter) {
        kategoriFilter.addEventListener('change', filterKomoditas);
    }
    if (perubahanFilter) {
        perubahanFilter.addEventListener('change', filterKomoditas);
    }

    // Animasi loading untuk cards
    function animateCards() {
        const cards = document.querySelectorAll('.komoditas-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                card.style.transition = 'all 0.6s ease-out';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    }

    // Jalankan animasi saat halaman dimuat
    setTimeout(animateCards, 500);
});

// Fungsi untuk menampilkan detail komoditas
function showDetail(commodityId) {
    // TODO: Ambil data detail dari API berdasarkan commodityId
    // fetch(`/api/komoditas/${commodityId}`)
    //     .then(res => res.json())
    //     .then(detail => {
    //         // Tampilkan modal dengan data dari database
    //     });
    
    // Untuk sementara, tampilkan pesan
    showNotification('Fitur detail komoditas akan segera tersedia', 'info');
}

// Fungsi untuk berbagi harga
function sharePrice(commodityName, price) {
    const shareText = `Harga ${commodityName} saat ini: ${price} - Update dari E-Pasar Tangerang`;
    const shareUrl = window.location.href;

    if (navigator.share) {
        navigator.share({
            title: 'Harga Komoditas E-Pasar Tangerang',
            text: shareText,
            url: shareUrl
        });
    } else {
        // Fallback untuk browser yang tidak mendukung Web Share API
        const textArea = document.createElement('textarea');
        textArea.value = `${shareText}\n${shareUrl}`;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        
        // Tampilkan notifikasi
        showNotification('Link berhasil disalin ke clipboard!', 'success');
    }
}

// Fungsi untuk menampilkan semua komoditas
function showAllCommodities() {
    // Reset semua filter
    document.getElementById('searchKomoditas').value = '';
    document.getElementById('filterKategori').value = '';
    document.getElementById('filterPerubahan').value = '';
    
    // Tampilkan semua item
    document.querySelectorAll('.komoditas-item').forEach(item => {
        item.style.display = 'block';
    });
    
    // Update statistik
    updateStatistics();
    
    // Scroll ke section komoditas
    document.getElementById('harga').scrollIntoView({ behavior: 'smooth' });
}

// Fungsi untuk menampilkan notifikasi
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove setelah 3 detik
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 3000);
}

// --- AJAX Komoditas ---
function fetchKomoditas() {
    const grid = document.getElementById('komoditasGrid');
    if (!grid) return;
    grid.innerHTML = '<div class="text-center w-100 py-5">Loading data komoditas...</div>';
    
    // TODO: Implementasi API call yang sebenarnya
    // fetch('/api/komoditas')
    //     .then(res => res.json())
    //     .then(data => {
    //         if (!data.length) {
    //             grid.innerHTML = '<div class="text-center w-100 py-5">Tidak ada data komoditas.</div>';
    //             return;
    //         }
    //         // Render data dari database
    //     });
    
    // Untuk sementara, tampilkan pesan
    setTimeout(() => {
        grid.innerHTML = '<div class="text-center w-100 py-5">Data komoditas akan tersedia setelah implementasi database.</div>';
    }, 1000);
}

// --- AJAX Berita ---
function fetchBerita() {
    const list = document.getElementById('beritaList');
    if (!list) return;
    list.innerHTML = '<div class="text-center w-100 py-5">Loading berita...</div>';
    
    // TODO: Implementasi API call yang sebenarnya
    // fetch('/api/berita')
    //     .then(res => res.json())
    //     .then(data => {
    //         if (!data.length) {
    //             list.innerHTML = '<div class="text-center w-100 py-5">Tidak ada berita.</div>';
    //             return;
    //         }
    //         // Render data dari database
    //     });
    
    // Untuk sementara, tampilkan pesan
    setTimeout(() => {
        list.innerHTML = '<div class="text-center w-100 py-5">Data berita akan tersedia setelah implementasi database.</div>';
    }, 1000);
}

// Panggil saat halaman siap
window.addEventListener('DOMContentLoaded', function() {
    fetchKomoditas();
    fetchBerita();
}); 