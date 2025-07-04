/**
 * Komoditas Management JavaScript
 * E-Pasar Tangerang
 */

class KomoditasManager {
    constructor() {
        this.searchInput = document.getElementById('searchKomoditas');
        this.kategoriFilter = document.getElementById('filterKategori');
        this.perubahanFilter = document.getElementById('filterPerubahan');
        this.komoditasItems = document.querySelectorAll('.komoditas-item');
        
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.animateCards();
        this.updateStatistics();
    }

    setupEventListeners() {
        if (this.searchInput) {
            this.searchInput.addEventListener('input', () => this.filterKomoditas());
        }
        if (this.kategoriFilter) {
            this.kategoriFilter.addEventListener('change', () => this.filterKomoditas());
        }
        if (this.perubahanFilter) {
            this.perubahanFilter.addEventListener('change', () => this.filterKomoditas());
        }
    }

    filterKomoditas() {
        const searchTerm = this.searchInput.value.toLowerCase();
        const kategoriValue = this.kategoriFilter.value;
        const perubahanValue = this.perubahanFilter.value;

        this.komoditasItems.forEach(item => {
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

        this.updateStatistics();
    }

    updateStatistics() {
        const visibleItems = document.querySelectorAll('.komoditas-item[style*="block"], .komoditas-item:not([style*="none"])');
        let naikCount = 0;
        let turunCount = 0;
        let totalCount = visibleItems.length;

        visibleItems.forEach(item => {
            const perubahan = item.getAttribute('data-perubahan');
            if (perubahan === 'naik') naikCount++;
            if (perubahan === 'turun') turunCount++;
        });

        // Update statistik cards
        const statCards = document.querySelectorAll('.stat-card h4');
        if (statCards.length >= 4) {
            statCards[0].textContent = naikCount;
            statCards[1].textContent = turunCount;
            statCards[2].textContent = totalCount;
        }
    }

    animateCards() {
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

    showDetail(commodityId) {
        const commodityDetails = this.getCommodityDetails();
        const detail = commodityDetails[commodityId];
        
        if (!detail) {
            this.showNotification('Detail komoditas tidak ditemukan', 'warning');
            return;
        }

        this.createDetailModal(detail);
    }

    getCommodityDetails() {
        return {
            'beras-ir-1': {
                name: 'Beras IR I',
                price: 'Rp 14,000',
                unit: 'per kg',
                change: '-Rp 200',
                changePercent: '-1.4%',
                description: 'Beras putih premium dengan kualitas terbaik',
                supplier: 'PT Beras Sejahtera',
                location: 'Pasar Modern Tangerang',
                lastUpdate: '2 jam lalu',
                image: '/assets/fotopangan/beras.png'
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
                lastUpdate: '2 jam lalu',
                image: '/assets/fotopangan/beras.png'
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
                lastUpdate: '2 jam lalu',
                image: '/assets/fotopangan/gula1.png'
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
                lastUpdate: '2 jam lalu',
                image: '/assets/fotopangan/dagingsapi.png'
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
                lastUpdate: '2 jam lalu',
                image: '/assets/fotopangan/dagingayam.png'
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
                lastUpdate: '2 jam lalu',
                image: '/assets/fotopangan/telurayam.png'
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
                lastUpdate: '2 jam lalu',
                image: '/assets/fotopangan/kacangkedelai.png'
            }
        };
    }

    createDetailModal(detail) {
        const modalHtml = `
            <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="detailModalLabel">
                                <i class="bi bi-info-circle me-2"></i>Detail ${detail.name}
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <img src="${detail.image}" alt="${detail.name}" class="img-fluid rounded mb-3" style="max-width: 150px;">
                                    <div class="price-highlight">
                                        <h4 class="text-primary mb-1">${detail.price}</h4>
                                        <small class="text-muted">${detail.unit}</small>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="text-primary mb-3">
                                                <i class="bi bi-currency-exchange me-2"></i>Informasi Harga
                                            </h6>
                                            <div class="mb-3">
                                                <strong>Perubahan:</strong> 
                                                <span class="badge ${detail.change.startsWith('+') ? 'bg-danger' : 'bg-success'} fs-6">
                                                    ${detail.change} (${detail.changePercent})
                                                </span>
                                            </div>
                                            <div class="mb-3">
                                                <strong>Update Terakhir:</strong><br>
                                                <span class="text-muted">${detail.lastUpdate}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-primary mb-3">
                                                <i class="bi bi-box-seam me-2"></i>Informasi Produk
                                            </h6>
                                            <div class="mb-3">
                                                <strong>Deskripsi:</strong><br>
                                                <span class="text-muted">${detail.description}</span>
                                            </div>
                                            <div class="mb-3">
                                                <strong>Supplier:</strong><br>
                                                <span class="text-muted">${detail.supplier}</span>
                                            </div>
                                            <div class="mb-3">
                                                <strong>Lokasi:</strong><br>
                                                <span class="text-muted">${detail.location}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-2"></i>Tutup
                            </button>
                            <button type="button" class="btn btn-primary" onclick="komoditasManager.sharePrice('${detail.name}', '${detail.price}')">
                                <i class="bi bi-share me-2"></i>Bagikan
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

    sharePrice(commodityName, price) {
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
            
            this.showNotification('Link berhasil disalin ke clipboard!', 'success');
        }
    }

    showAllCommodities() {
        // Reset semua filter
        this.searchInput.value = '';
        this.kategoriFilter.value = '';
        this.perubahanFilter.value = '';
        
        // Tampilkan semua item
        this.komoditasItems.forEach(item => {
            item.style.display = 'block';
        });
        
        // Update statistik
        this.updateStatistics();
        
        // Scroll ke section komoditas
        document.getElementById('harga').scrollIntoView({ behavior: 'smooth' });
    }

    showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        notification.innerHTML = `
            <i class="bi bi-${type === 'success' ? 'check-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'} me-2"></i>
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
}

// Global functions untuk kompatibilitas
function showDetail(commodityId) {
    if (window.komoditasManager) {
        window.komoditasManager.showDetail(commodityId);
    }
}

function sharePrice(commodityName, price) {
    if (window.komoditasManager) {
        window.komoditasManager.sharePrice(commodityName, price);
    }
}

function showAllCommodities() {
    if (window.komoditasManager) {
        window.komoditasManager.showAllCommodities();
    }
}

// Initialize ketika DOM ready
document.addEventListener('DOMContentLoaded', function() {
    window.komoditasManager = new KomoditasManager();
}); 