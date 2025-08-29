document.addEventListener('DOMContentLoaded', function() {
    fetchBerita();
});

function fetchBerita() {
    const beritaList = document.getElementById('beritaListFull');
    if (!beritaList) return;

    fetch('/api/berita')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (!Array.isArray(data) || data.length === 0) {
                beritaList.innerHTML = `
                    <div class="col-12 text-center py-5">
                        <div class="empty-state">
                            <i class="bi bi-newspaper display-1 text-muted mb-3"></i>
                            <h4 class="text-muted">Belum ada berita yang tersedia</h4>
                            <p class="text-muted">Berita akan ditampilkan di sini setelah dipublish.</p>
                        </div>
                    </div>`;
                return;
            }

            beritaList.innerHTML = data.map(berita => {
                const imageUrl = berita.gambar ? `/uploads/berita/${berita.gambar}` : '/assets/img/Picture2.png';
                const publishDate = new Date(berita.tanggal_publish).toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });
                
                return `
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm berita-card" style="border-radius: 15px; overflow: hidden; transition: all 0.3s ease;">
                            <div class="position-relative">
                                <img src="${imageUrl}" class="card-img-top" alt="${berita.judul}" 
                                     style="height: 200px; object-fit: cover;"
                                     onerror="this.src='/assets/img/Picture2.png'">
                            </div>
                            <div class="card-body" style="padding: 1.5rem;">
                                <h5 class="card-title fw-bold mb-3" style="color: #2c3e50; font-size: 1.25rem;">${berita.judul}</h5>
                                <p class="card-text text-muted mb-3" style="line-height: 1.6;">
                                    ${berita.isi.length > 100 ? berita.isi.substring(0, 100) + '...' : berita.isi}
                                </p>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <small class="text-muted">
                                        <i class="bi bi-calendar3 me-1"></i>${publishDate}
                                    </small>
                                    <small class="text-muted">
                                        <i class="bi bi-eye me-1"></i>${berita.views || 0} views
                                    </small>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-0" style="padding: 0 1.5rem 1.5rem;">
                                <a href="/informasi/berita/${berita.id}" class="btn btn-primary w-100" style="border-radius: 25px; font-weight: 600; padding: 12px 24px; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(13, 110, 253, 0.2); font-size: 0.95rem;">
                                    <i class="bi bi-arrow-right me-2"></i>Baca Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
            
            // Add hover effects for berita cards
            const beritaCards = document.querySelectorAll('.berita-card');
            beritaCards.forEach(card => {
                // Card hover effect
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                    this.style.boxShadow = '0 8px 25px rgba(0, 0, 0, 0.15)';
                    this.style.transition = 'all 0.3s ease';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
                });
                
                // Button hover effect
                const button = card.querySelector('.btn');
                if (button) {
                    button.addEventListener('mouseenter', function() {
                        this.style.transform = 'translateY(-2px)';
                        this.style.boxShadow = '0 4px 15px rgba(13, 110, 253, 0.3)';
                    });
                    
                    button.addEventListener('mouseleave', function() {
                        this.style.transform = 'translateY(0)';
                        this.style.boxShadow = '0 2px 8px rgba(13, 110, 253, 0.2)';
                    });
                }
            });
        })
        .catch(error => {
            console.error('Error fetching berita:', error);
            beritaList.innerHTML = `
                <div class="col-12 text-center py-5">
                    <div class="error-state">
                        <i class="bi bi-exclamation-triangle display-1 text-danger mb-3"></i>
                        <h4 class="text-danger">Terjadi kesalahan</h4>
                        <p class="text-muted">Gagal memuat data berita. Silakan coba lagi nanti.</p>
                        <button class="btn btn-primary" onclick="fetchBerita()">
                            <i class="bi bi-arrow-clockwise me-2"></i>Coba Lagi
                        </button>
                    </div>
                </div>`;
        });
}
