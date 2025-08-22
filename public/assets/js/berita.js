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
                    <div class="col-12 text-center">
                        <p>Belum ada berita yang tersedia.</p>
                    </div>`;
                return;
            }

            beritaList.innerHTML = data.map(berita => `
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        ${berita.gambar ? `
                            <img src="/uploads/berita/${berita.gambar}" 
                                class="card-img-top" 
                                alt="${berita.judul}"
                                onerror="this.src='/assets/img/default-berita.jpg'">
                        ` : ''}
                        <div class="card-body">
                            <h5 class="card-title">${berita.judul}</h5>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <small class="text-muted">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    ${new Date(berita.tanggal_publish).toLocaleDateString('id-ID', {
                                        day: 'numeric',
                                        month: 'long',
                                        year: 'numeric'
                                    })}
                                </small>
                                <small class="text-muted">
                                    <i class="bi bi-eye me-1"></i>
                                    ${berita.views || 0} views
                                </small>
                            </div>
                            <p class="card-text">
                                ${berita.isi.substring(0, 150)}...
                            </p>
                            <a href="/informasi/berita/${berita.id}" class="btn btn-primary">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            `).join('');
        })
        .catch(error => {
            console.error('Error fetching berita:', error);
            beritaList.innerHTML = `
                <div class="col-12 text-center">
                    <p class="text-danger">Terjadi kesalahan saat memuat data berita.</p>
                </div>`;
        });
}
