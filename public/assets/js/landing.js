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
    // Data detail komoditas (bisa diambil dari database)
    const commodityDetails = {
        'beras-ir-1': {
            name: 'Beras IR I',
            price: 'Rp 14,000',
            unit: 'per kg',
            change: '-Rp 200',
            changePercent: '-1.4%',
            description: 'Beras putih premium dengan kualitas terbaik',
            supplier: 'PT Beras Sejahtera',
            location: 'Pasar Modern Tangerang',
            lastUpdate: '2 jam lalu'
        },
        'beras-ir-2': {
            name: 'Beras IR II',
            price: 'Rp 13,000',
            unit: 'per kg',
            change: '+Rp 100',
            changePercent: '+0.8%',
            description: 'Beras putih berkualitas baik',
            supplier: 'PT Beras Sejahtera',
            location: 'Pasar Modern Tangerang',
            lastUpdate: '2 jam lalu'
        },
        'gula-pasir': {
            name: 'Gula Pasir Lokal',
            price: 'Rp 19,000',
            unit: 'per kg',
            change: '-Rp 150',
            changePercent: '-0.8%',
            description: 'Gula pasir putih berkualitas tinggi',
            supplier: 'PT Gula Nusantara',
            location: 'Pasar Modern Tangerang',
            lastUpdate: '2 jam lalu'
        },
        'daging-sapi': {
            name: 'Daging Sapi',
            price: 'Rp 140,000',
            unit: 'per kg',
            change: '+Rp 500',
            changePercent: '+0.4%',
            description: 'Daging sapi segar berkualitas premium',
            supplier: 'PT Daging Segar',
            location: 'Pasar Modern Tangerang',
            lastUpdate: '2 jam lalu'
        },
        'daging-ayam': {
            name: 'Daging Ayam Broiler',
            price: 'Rp 40,000',
            unit: 'per kg',
            change: '-Rp 250',
            changePercent: '-0.6%',
            description: 'Daging ayam broiler segar',
            supplier: 'PT Unggas Sejahtera',
            location: 'Pasar Modern Tangerang',
            lastUpdate: '2 jam lalu'
        },
        'telur-ayam': {
            name: 'Telur Ayam',
            price: 'Rp 3,000',
            unit: 'per butir',
            change: '+Rp 50',
            changePercent: '+1.7%',
            description: 'Telur ayam segar berkualitas tinggi',
            supplier: 'PT Unggas Sejahtera',
            location: 'Pasar Modern Tangerang',
            lastUpdate: '2 jam lalu'
        },
        'kacang-kedelai': {
            name: 'Kacang Kedelai',
            price: 'Rp 16,000',
            unit: 'per kg',
            change: '-Rp 40',
            changePercent: '-0.2%',
            description: 'Kacang kedelai berkualitas tinggi',
            supplier: 'PT Kacang Nusantara',
            location: 'Pasar Modern Tangerang',
            lastUpdate: '2 jam lalu'
        }
    };

    const detail = commodityDetails[commodityId];
    if (!detail) return;

    // Buat modal detail
    const modalHtml = `
        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Detail ${detail.name}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-primary">Informasi Harga</h6>
                                <div class="mb-3">
                                    <strong>Harga Saat Ini:</strong> ${detail.price} ${detail.unit}
                                </div>
                                <div class="mb-3">
                                    <strong>Perubahan:</strong> 
                                    <span class="badge ${detail.change.startsWith('+') ? 'bg-danger' : 'bg-success'}">
                                        ${detail.change} (${detail.changePercent})
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <strong>Update Terakhir:</strong> ${detail.lastUpdate}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-primary">Informasi Produk</h6>
                                <div class="mb-3">
                                    <strong>Deskripsi:</strong> ${detail.description}
                                </div>
                                <div class="mb-3">
                                    <strong>Supplier:</strong> ${detail.supplier}
                                </div>
                                <div class="mb-3">
                                    <strong>Lokasi:</strong> ${detail.location}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" onclick="sharePrice('${detail.name}', '${detail.price}')">
                            <i class="bi bi-share"></i> Bagikan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;

    // Hapus modal lama jika ada
    const existingModal = document.getElementById('detailModal');
    if (existingModal) {
        existingModal.remove();
    }

    // Tambahkan modal baru
    document.body.insertAdjacentHTML('beforeend', modalHtml);
    
    // Tampilkan modal
    const modal = new bootstrap.Modal(document.getElementById('detailModal'));
    modal.show();
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
    fetch('/api/komoditas')
        .then(res => res.json())
        .then(data => {
            if (!data.length) {
                grid.innerHTML = '<div class="text-center w-100 py-5">Tidak ada data komoditas.</div>';
                return;
            }
            grid.innerHTML = data.map(item => `
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 komoditas-item" data-kategori="${item.kategori}" data-perubahan="${item.perubahan}">
                    <div class="komoditas-card card border-0 shadow-sm h-100">
                        <div class="card-body p-4 text-center position-relative">
                            <h5 class="product-name mb-2">${item.nama}</h5>
                            <div class="price-container mb-3">
                                <div class="current-price">Rp ${item.harga.toLocaleString()}</div>
                                <div class="price-unit text-muted">per ${item.satuan}</div>
                            </div>
                            <div class="product-details">
                                <div class="detail-item">
                                    <i class="bi bi-calendar3 text-muted"></i>
                                    <span class="text-muted">Update: ${item.last_update}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="bi bi-graph-${item.perubahan === 'naik' ? 'up text-danger' : 'down text-success'}"></i>
                                    <span class="${item.perubahan === 'naik' ? 'text-danger' : 'text-success'}">${item.perubahan}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `).join('');
        })
        .catch(() => {
            grid.innerHTML = '<div class="text-center w-100 py-5 text-danger">Gagal memuat data komoditas.</div>';
        });
}

// --- AJAX Berita ---
function fetchBerita() {
    const list = document.getElementById('beritaList');
    if (!list) return;
    list.innerHTML = '<div class="text-center w-100 py-5">Loading berita...</div>';
    fetch('/api/berita')
        .then(res => res.json())
        .then(data => {
            if (!data.length) {
                list.innerHTML = '<div class="text-center w-100 py-5">Tidak ada berita.</div>';
                return;
            }
            list.innerHTML = data.map(item => `
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="fw-bold text-primary">${item.judul}</h6>
                            <p class="small text-muted mb-2">${item.tanggal}</p>
                            <p class="card-text">${item.isi.substring(0, 80)}...</p>
                        </div>
                    </div>
                </div>
            `).join('');
        })
        .catch(() => {
            list.innerHTML = '<div class="text-center w-100 py-5 text-danger">Gagal memuat berita.</div>';
        });
}

// Panggil saat halaman siap
window.addEventListener('DOMContentLoaded', function() {
    fetchKomoditas();
    fetchBerita();
}); 