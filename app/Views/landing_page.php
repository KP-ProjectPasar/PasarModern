<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Pasar Tangerang - Pasar Modern Tangerang</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#beranda">
                <img src="/assets/img/Logorbg.png" alt="Logo" class="logo me-2">
                <span class="fw-bold text-primary">E-Pasar Tangerang</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#beranda">Beranda</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tentang Kami <i class="bi bi-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#ringkasan">Ringkasan</a></li>
                            <li><a class="dropdown-item" href="#visi-misi">Visi & Misi</a></li>
                            <li><a class="dropdown-item" href="#peraturan">Peraturan</a></li>
                            <li><a class="dropdown-item" href="#pesan-direksi">Pesan Direksi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Informasi <i class="bi bi-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#berita">Berita</a></li>
                            <li><a class="dropdown-item" href="#harga">Harga</a></li>
                            <li><a class="dropdown-item" href="#informasi-pasar">Informasi Pasar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#galeri">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link" href="#faq">FAQ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#feedback">Feedback</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="hero d-flex align-items-center" style="min-height: 80vh;">
        <div class="container position-relative z-2">
            <div class="row align-items-center">
                <div class="col-lg-6 text-center text-lg-start mb-4 mb-lg-0">
                    <h1 class="display-4 fw-bold mb-3">Belanja Mudah, Aman, dan Modern di <span class="text-primary">E-Pasar Tangerang</span></h1>
                    <p class="lead mb-4">Temukan kebutuhan harian, cek harga komoditas, dan nikmati layanan digital pasar modern Tangerang. Semua dalam satu klik!</p>
                    <a href="#layanan" class="btn btn-primary btn-lg me-2">Jelajahi Layanan</a>
                    <a href="#feedback" class="btn btn-outline-primary btn-lg">Kirim Feedback</a>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="/assets/img/bannerpasar.jpeg" alt="Banner E-Pasar" class="img-fluid rounded-4 shadow-lg hero-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan Publik Section -->
    <section id="layanan" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center">Layanan E-Pasar</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card h-100 text-center p-3 border-0 shadow-sm layanan-card">
                        <div class="mb-3"><i class="bi bi-basket2-fill text-primary" style="font-size:2.5rem;"></i></div>
                        <h6 class="fw-bold mb-2">Cek Harga Komoditas</h6>
                        <p class="small text-muted">Lihat harga terbaru bahan pokok di pasar modern Tangerang.</p>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card h-100 text-center p-3 border-0 shadow-sm layanan-card">
                        <div class="mb-3"><i class="bi bi-image text-success" style="font-size:2.5rem;"></i></div>
                        <h6 class="fw-bold mb-2">Galeri Pasar</h6>
                        <p class="small text-muted">Lihat suasana dan aktivitas pasar melalui galeri foto kami.</p>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card h-100 text-center p-3 border-0 shadow-sm layanan-card">
                        <div class="mb-3"><i class="bi bi-newspaper text-warning" style="font-size:2.5rem;"></i></div>
                        <h6 class="fw-bold mb-2">Berita & Info</h6>
                        <p class="small text-muted">Update berita, kegiatan, dan pengumuman pasar modern Tangerang.</p>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card h-100 text-center p-3 border-0 shadow-sm layanan-card">
                        <div class="mb-3"><i class="bi bi-geo-alt-fill text-info" style="font-size:2.5rem;"></i></div>
                        <h6 class="fw-bold mb-2">Peta Lokasi Pasar</h6>
                        <p class="small text-muted">Temukan lokasi pasar modern terdekat di Tangerang.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Berita Section -->
    <section id="berita" class="py-5">
        <div class="container">
            <h2 class="section-title text-center">Berita & Info Terkini</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="https://source.unsplash.com/400x250/?market,news" class="card-img-top" alt="Berita 1">
                        <div class="card-body">
                            <h6 class="fw-bold text-primary">Peresmian Fasilitas Baru</h6>
                            <p class="small text-muted mb-2">25 Mei 2024</p>
                            <p class="card-text">Pasar Modern kini memiliki area parkir baru dan fasilitas ramah difabel.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="https://source.unsplash.com/400x250/?market,activity" class="card-img-top" alt="Berita 2">
                        <div class="card-body">
                            <h6 class="fw-bold text-primary">Kegiatan Sosial Pasar</h6>
                            <p class="small text-muted mb-2">10 Mei 2024</p>
                            <p class="card-text">Santunan anak yatim dan bakti sosial di lingkungan pasar modern Tangerang.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="https://source.unsplash.com/400x250/?market,food" class="card-img-top" alt="Berita 3">
                        <div class="card-body">
                            <h6 class="fw-bold text-primary">Pemantauan Harga</h6>
                            <p class="small text-muted mb-2">7 Maret 2024</p>
                            <p class="card-text">Pemantauan harga dan pasokan bahan pangan di pasar modern Tangerang.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="#" class="btn btn-primary">Lihat Semua Berita</a>
            </div>
        </div>
    </section>

    <!-- Harga Komoditas Section -->
    <section id="harga" class="py-5 bg-gradient-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Harga Komoditas Hari Ini</h2>
                <p class="text-muted mb-4">Update terakhir: <span class="fw-semibold text-primary"><?= date('d F Y, H:i') ?> WIB</span></p>
                
                <!-- Filter dan Pencarian -->
                <div class="row justify-content-center mb-4">
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" id="searchKomoditas" placeholder="Cari komoditas...">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-3">
                        <select class="form-select" id="filterKategori">
                            <option value="">Semua Kategori</option>
                            <option value="beras">Beras</option>
                            <option value="daging">Daging</option>
                            <option value="gula">Gula</option>
                            <option value="telur">Telur</option>
                            <option value="kacang">Kacang</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-3">
                        <select class="form-select" id="filterPerubahan">
                            <option value="">Semua Perubahan</option>
                            <option value="naik">Harga Naik</option>
                            <option value="turun">Harga Turun</option>
                            <option value="stabil">Harga Stabil</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Statistik Ringkas -->
            <div class="row mb-5">
                <div class="col-md-3 mb-3">
                    <div class="stat-card bg-primary text-white text-center p-3 rounded-3">
                        <div class="stat-icon mb-2">
                            <i class="bi bi-arrow-up-circle fs-1"></i>
                        </div>
                        <h4 class="mb-1">3</h4>
                        <small>Komoditas Naik</small>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="stat-card bg-success text-white text-center p-3 rounded-3">
                        <div class="stat-icon mb-2">
                            <i class="bi bi-arrow-down-circle fs-1"></i>
                        </div>
                        <h4 class="mb-1">4</h4>
                        <small>Komoditas Turun</small>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="stat-card bg-info text-white text-center p-3 rounded-3">
                        <div class="stat-icon mb-2">
                            <i class="bi bi-currency-exchange fs-1"></i>
                        </div>
                        <h4 class="mb-1">7</h4>
                        <small>Total Komoditas</small>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="stat-card bg-warning text-white text-center p-3 rounded-3">
                        <div class="stat-icon mb-2">
                            <i class="bi bi-clock-history fs-1"></i>
                        </div>
                        <h4 class="mb-1">2x</h4>
                        <small>Update/Hari</small>
                    </div>
                </div>
            </div>

            <!-- Grid Komoditas -->
            <div class="row g-4" id="komoditasGrid">
                <!-- Beras IR I -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 komoditas-item" data-kategori="beras" data-perubahan="turun">
                    <div class="komoditas-card card border-0 shadow-sm h-100">
                        <div class="card-body p-4 text-center position-relative">
                            <!-- Badge Perubahan -->
                            <div class="change-badge change-down">
                                <i class="bi bi-arrow-down"></i>
                                <span>Rp 200</span>
                            </div>
                            
                            <!-- Gambar Produk -->
                            <div class="product-image-container mb-3">
                                <img src="/assets/fotopangan/beras.png" alt="Beras IR I" class="product-image">
                                <div class="image-overlay">
                                    <i class="bi bi-eye"></i>
                                </div>
                            </div>
                            
                            <!-- Informasi Produk -->
                            <h5 class="product-name mb-2">Beras IR I</h5>
                            <div class="price-container mb-3">
                                <div class="current-price">Rp 14,000</div>
                                <div class="price-unit text-muted">per kg</div>
                            </div>
                            
                            <!-- Detail Tambahan -->
                            <div class="product-details">
                                <div class="detail-item">
                                    <i class="bi bi-calendar3 text-muted"></i>
                                    <span class="text-muted">Update: 2 jam lalu</span>
                                </div>
                                <div class="detail-item">
                                    <i class="bi bi-graph-down text-success"></i>
                                    <span class="text-success">-1.4% dari kemarin</span>
                                </div>
                            </div>
                            
                            <!-- Tombol Aksi -->
                            <div class="action-buttons mt-3">
                                <button class="btn btn-outline-primary btn-sm me-2" onclick="showDetail('beras-ir-1')">
                                    <i class="bi bi-info-circle"></i> Detail
                                </button>
                                <button class="btn btn-primary btn-sm" onclick="sharePrice('Beras IR I', 'Rp 14,000')">
                                    <i class="bi bi-share"></i> Share
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Beras IR II -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 komoditas-item" data-kategori="beras" data-perubahan="naik">
                    <div class="komoditas-card card border-0 shadow-sm h-100">
                        <div class="card-body p-4 text-center position-relative">
                            <div class="change-badge change-up">
                                <i class="bi bi-arrow-up"></i>
                                <span>Rp 100</span>
                            </div>
                            
                            <div class="product-image-container mb-3">
                                <img src="/assets/fotopangan/beras.png" alt="Beras IR II" class="product-image">
                                <div class="image-overlay">
                                    <i class="bi bi-eye"></i>
                                </div>
                            </div>
                            
                            <h5 class="product-name mb-2">Beras IR II</h5>
                            <div class="price-container mb-3">
                                <div class="current-price">Rp 13,000</div>
                                <div class="price-unit text-muted">per kg</div>
                            </div>
                            
                            <div class="product-details">
                                <div class="detail-item">
                                    <i class="bi bi-calendar3 text-muted"></i>
                                    <span class="text-muted">Update: 2 jam lalu</span>
                                </div>
                                <div class="detail-item">
                                    <i class="bi bi-graph-up text-danger"></i>
                                    <span class="text-danger">+0.8% dari kemarin</span>
                                </div>
                            </div>
                            
                            <div class="action-buttons mt-3">
                                <button class="btn btn-outline-primary btn-sm me-2" onclick="showDetail('beras-ir-2')">
                                    <i class="bi bi-info-circle"></i> Detail
                                </button>
                                <button class="btn btn-primary btn-sm" onclick="sharePrice('Beras IR II', 'Rp 13,000')">
                                    <i class="bi bi-share"></i> Share
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gula Pasir Lokal -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 komoditas-item" data-kategori="gula" data-perubahan="turun">
                    <div class="komoditas-card card border-0 shadow-sm h-100">
                        <div class="card-body p-4 text-center position-relative">
                            <div class="change-badge change-down">
                                <i class="bi bi-arrow-down"></i>
                                <span>Rp 150</span>
                            </div>
                            
                            <div class="product-image-container mb-3">
                                <img src="/assets/fotopangan/gula1.png" alt="Gula Pasir Lokal" class="product-image">
                                <div class="image-overlay">
                                    <i class="bi bi-eye"></i>
                                </div>
                            </div>
                            
                            <h5 class="product-name mb-2">Gula Pasir Lokal</h5>
                            <div class="price-container mb-3">
                                <div class="current-price">Rp 19,000</div>
                                <div class="price-unit text-muted">per kg</div>
                            </div>
                            
                            <div class="product-details">
                                <div class="detail-item">
                                    <i class="bi bi-calendar3 text-muted"></i>
                                    <span class="text-muted">Update: 2 jam lalu</span>
                                </div>
                                <div class="detail-item">
                                    <i class="bi bi-graph-down text-success"></i>
                                    <span class="text-success">-0.8% dari kemarin</span>
                                </div>
                            </div>
                            
                            <div class="action-buttons mt-3">
                                <button class="btn btn-outline-primary btn-sm me-2" onclick="showDetail('gula-pasir')">
                                    <i class="bi bi-info-circle"></i> Detail
                                </button>
                                <button class="btn btn-primary btn-sm" onclick="sharePrice('Gula Pasir Lokal', 'Rp 19,000')">
                                    <i class="bi bi-share"></i> Share
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Daging Sapi -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 komoditas-item" data-kategori="daging" data-perubahan="naik">
                    <div class="komoditas-card card border-0 shadow-sm h-100">
                        <div class="card-body p-4 text-center position-relative">
                            <div class="change-badge change-up">
                                <i class="bi bi-arrow-up"></i>
                                <span>Rp 500</span>
                            </div>
                            
                            <div class="product-image-container mb-3">
                                <img src="/assets/fotopangan/dagingsapi.png" alt="Daging Sapi" class="product-image">
                                <div class="image-overlay">
                                    <i class="bi bi-eye"></i>
                                </div>
                            </div>
                            
                            <h5 class="product-name mb-2">Daging Sapi</h5>
                            <div class="price-container mb-3">
                                <div class="current-price">Rp 140,000</div>
                                <div class="price-unit text-muted">per kg</div>
                            </div>
                            
                            <div class="product-details">
                                <div class="detail-item">
                                    <i class="bi bi-calendar3 text-muted"></i>
                                    <span class="text-muted">Update: 2 jam lalu</span>
                                </div>
                                <div class="detail-item">
                                    <i class="bi bi-graph-up text-danger"></i>
                                    <span class="text-danger">+0.4% dari kemarin</span>
                                </div>
                            </div>
                            
                            <div class="action-buttons mt-3">
                                <button class="btn btn-outline-primary btn-sm me-2" onclick="showDetail('daging-sapi')">
                                    <i class="bi bi-info-circle"></i> Detail
                                </button>
                                <button class="btn btn-primary btn-sm" onclick="sharePrice('Daging Sapi', 'Rp 140,000')">
                                    <i class="bi bi-share"></i> Share
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Daging Ayam Broiler -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 komoditas-item" data-kategori="daging" data-perubahan="turun">
                    <div class="komoditas-card card border-0 shadow-sm h-100">
                        <div class="card-body p-4 text-center position-relative">
                            <div class="change-badge change-down">
                                <i class="bi bi-arrow-down"></i>
                                <span>Rp 250</span>
                            </div>
                            
                            <div class="product-image-container mb-3">
                                <img src="/assets/fotopangan/dagingayam.png" alt="Daging Ayam Broiler" class="product-image">
                                <div class="image-overlay">
                                    <i class="bi bi-eye"></i>
                                </div>
                            </div>
                            
                            <h5 class="product-name mb-2">Daging Ayam Broiler</h5>
                            <div class="price-container mb-3">
                                <div class="current-price">Rp 40,000</div>
                                <div class="price-unit text-muted">per kg</div>
                            </div>
                            
                            <div class="product-details">
                                <div class="detail-item">
                                    <i class="bi bi-calendar3 text-muted"></i>
                                    <span class="text-muted">Update: 2 jam lalu</span>
                                </div>
                                <div class="detail-item">
                                    <i class="bi bi-graph-down text-success"></i>
                                    <span class="text-success">-0.6% dari kemarin</span>
                                </div>
                            </div>
                            
                            <div class="action-buttons mt-3">
                                <button class="btn btn-outline-primary btn-sm me-2" onclick="showDetail('daging-ayam')">
                                    <i class="bi bi-info-circle"></i> Detail
                                </button>
                                <button class="btn btn-primary btn-sm" onclick="sharePrice('Daging Ayam Broiler', 'Rp 40,000')">
                                    <i class="bi bi-share"></i> Share
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Telur Ayam -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 komoditas-item" data-kategori="telur" data-perubahan="naik">
                    <div class="komoditas-card card border-0 shadow-sm h-100">
                        <div class="card-body p-4 text-center position-relative">
                            <div class="change-badge change-up">
                                <i class="bi bi-arrow-up"></i>
                                <span>Rp 50</span>
                            </div>
                            
                            <div class="product-image-container mb-3">
                                <img src="/assets/fotopangan/telurayam.png" alt="Telur Ayam" class="product-image">
                                <div class="image-overlay">
                                    <i class="bi bi-eye"></i>
                                </div>
                            </div>
                            
                            <h5 class="product-name mb-2">Telur Ayam</h5>
                            <div class="price-container mb-3">
                                <div class="current-price">Rp 3,000</div>
                                <div class="price-unit text-muted">per butir</div>
                            </div>
                            
                            <div class="product-details">
                                <div class="detail-item">
                                    <i class="bi bi-calendar3 text-muted"></i>
                                    <span class="text-muted">Update: 2 jam lalu</span>
                                </div>
                                <div class="detail-item">
                                    <i class="bi bi-graph-up text-danger"></i>
                                    <span class="text-danger">+1.7% dari kemarin</span>
                                </div>
                            </div>
                            
                            <div class="action-buttons mt-3">
                                <button class="btn btn-outline-primary btn-sm me-2" onclick="showDetail('telur-ayam')">
                                    <i class="bi bi-info-circle"></i> Detail
                                </button>
                                <button class="btn btn-primary btn-sm" onclick="sharePrice('Telur Ayam', 'Rp 3,000')">
                                    <i class="bi bi-share"></i> Share
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kacang Kedelai -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 komoditas-item" data-kategori="kacang" data-perubahan="turun">
                    <div class="komoditas-card card border-0 shadow-sm h-100">
                        <div class="card-body p-4 text-center position-relative">
                            <div class="change-badge change-down">
                                <i class="bi bi-arrow-down"></i>
                                <span>Rp 40</span>
                            </div>
                            
                            <div class="product-image-container mb-3">
                                <img src="/assets/fotopangan/kacangkedelai.png" alt="Kacang Kedelai" class="product-image">
                                <div class="image-overlay">
                                    <i class="bi bi-eye"></i>
                                </div>
                            </div>
                            
                            <h5 class="product-name mb-2">Kacang Kedelai</h5>
                            <div class="price-container mb-3">
                                <div class="current-price">Rp 16,000</div>
                                <div class="price-unit text-muted">per kg</div>
                            </div>
                            
                            <div class="product-details">
                                <div class="detail-item">
                                    <i class="bi bi-calendar3 text-muted"></i>
                                    <span class="text-muted">Update: 2 jam lalu</span>
                                </div>
                                <div class="detail-item">
                                    <i class="bi bi-graph-down text-success"></i>
                                    <span class="text-success">-0.2% dari kemarin</span>
                                </div>
                            </div>
                            
                            <div class="action-buttons mt-3">
                                <button class="btn btn-outline-primary btn-sm me-2" onclick="showDetail('kacang-kedelai')">
                                    <i class="bi bi-info-circle"></i> Detail
                                </button>
                                <button class="btn btn-primary btn-sm" onclick="sharePrice('Kacang Kedelai', 'Rp 16,000')">
                                    <i class="bi bi-share"></i> Share
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Lihat Semua -->
            <div class="text-center mt-5">
                <button class="btn btn-outline-primary btn-lg" onclick="showAllCommodities()">
                    <i class="bi bi-list-ul me-2"></i>Lihat Semua Komoditas
                </button>
            </div>
        </div>
    </section>

    <!-- Galeri Section -->
    <section id="galeri" class="py-5">
        <div class="container">
            <h2 class="section-title text-center">Galeri E-Pasar</h2>
            <div class="row g-3" id="galeri-list">
                <div class="col-6 col-md-3">
                    <img src="/assets/img/pasar1.jpeg" class="w-100 gallery-img" alt="Galeri Pasar 1">
                </div>
                <div class="col-6 col-md-3">
                    <img src="/assets/img/pasar2.jpeg" class="w-100 gallery-img" alt="Galeri Pasar 2">
                </div>
                <div class="col-6 col-md-3">
                    <img src="/assets/img/pasar3.jpeg" class="w-100 gallery-img" alt="Galeri Pasar 3">
                </div>
                <div class="col-6 col-md-3">
                    <img src="/assets/img/pasar4.jpeg" class="w-100 gallery-img" alt="Galeri Pasar 4">
                </div>
                <div class="col-6 col-md-3">
                    <img src="/assets/img/pasar5.jpeg" class="w-100 gallery-img" alt="Galeri Pasar 5">
                </div>
                <div class="col-6 col-md-3">
                    <img src="/assets/img/pasar6.jpeg" class="w-100 gallery-img" alt="Galeri Pasar 6">
                </div>
                <div class="col-6 col-md-3">
                    <img src="/assets/img/pasar7.jpeg" class="w-100 gallery-img" alt="Galeri Pasar 7">
                </div>
                <div class="col-6 col-md-3">
                    <img src="/assets/img/pasar8.jpeg" class="w-100 gallery-img" alt="Galeri Pasar 8">
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Kami Section -->
    <section id="tentang-kami" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center">Tentang Kami</h2>
            
            <!-- Ringkasan -->
            <div id="ringkasan" class="mb-5">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4">
                        <h3 class="text-primary mb-3">
                            <i class="bi bi-building me-2"></i>Ringkasan Perusahaan
                        </h3>
                        <p class="lead mb-3">E-Pasar Tangerang adalah platform digital resmi yang dikelola oleh Perumda Pasar Modern Tangerang.</p>
                        <p class="mb-3">Didirikan pada tahun 2020, kami berkomitmen untuk memberikan layanan terbaik kepada masyarakat Tangerang dalam hal informasi pasar, harga komoditas, dan layanan publik lainnya.</p>
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="border-end">
                                    <h4 class="text-primary mb-1">3+</h4>
                                    <small class="text-muted">Tahun Pengalaman</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border-end">
                                    <h4 class="text-primary mb-1">50K+</h4>
                                    <small class="text-muted">Pengguna Aktif</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <h4 class="text-primary mb-1">100%</h4>
                                <small class="text-muted">Pelayanan Publik</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img src="https://source.unsplash.com/600x400/?office,building" alt="Gedung Perumda" class="img-fluid rounded-3 shadow">
                    </div>
                </div>
            </div>

            <!-- Visi & Misi -->
            <div id="visi-misi" class="mb-5">
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-4">
                                <div class="text-center mb-3">
                                    <i class="bi bi-eye text-primary" style="font-size: 3rem;"></i>
                                </div>
                                <h4 class="text-center text-primary mb-3">Visi</h4>
                                <p class="text-center mb-0">Menjadi platform digital terdepan dalam pengelolaan informasi pasar modern yang terpercaya, transparan, dan bermanfaat bagi masyarakat Tangerang.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-4">
                                <div class="text-center mb-3">
                                    <i class="bi bi-target text-success" style="font-size: 3rem;"></i>
                                </div>
                                <h4 class="text-center text-success mb-3">Misi</h4>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Menyediakan informasi harga komoditas yang akurat dan real-time</li>
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Mengembangkan layanan digital yang user-friendly</li>
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Meningkatkan transparansi pengelolaan pasar modern</li>
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Mendorong partisipasi masyarakat dalam pengawasan pasar</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Peraturan -->
            <div id="peraturan" class="mb-5">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0">
                                    <i class="bi bi-file-earmark-text me-2"></i>Peraturan dan Kebijakan
                                </h4>
                            </div>
                            <div class="card-body p-4">
                                <div class="accordion" id="peraturanAccordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#peraturan1">
                                                Peraturan Pengelolaan Pasar Modern
                                            </button>
                                        </h2>
                                        <div id="peraturan1" class="accordion-collapse collapse show" data-bs-parent="#peraturanAccordion">
                                            <div class="accordion-body">
                                                <p>Peraturan ini mengatur tentang tata cara pengelolaan pasar modern yang meliputi:</p>
                                                <ul>
                                                    <li>Standar kebersihan dan sanitasi</li>
                                                    <li>Pengaturan jam operasional</li>
                                                    <li>Standar keamanan dan keselamatan</li>
                                                    <li>Pengelolaan sampah dan limbah</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#peraturan2">
                                                Kebijakan Harga Komoditas
                                            </button>
                                        </h2>
                                        <div id="peraturan2" class="accordion-collapse collapse" data-bs-parent="#peraturanAccordion">
                                            <div class="accordion-body">
                                                <p>Kebijakan yang mengatur tentang:</p>
                                                <ul>
                                                    <li>Penetapan harga maksimal komoditas</li>
                                                    <li>Monitoring harga harian</li>
                                                    <li>Intervensi pasar jika diperlukan</li>
                                                    <li>Koordinasi dengan pedagang</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#peraturan3">
                                                Standar Pelayanan Publik
                                            </button>
                                        </h2>
                                        <div id="peraturan3" class="accordion-collapse collapse" data-bs-parent="#peraturanAccordion">
                                            <div class="accordion-body">
                                                <p>Standar pelayanan yang wajib dipenuhi:</p>
                                                <ul>
                                                    <li>Ketersediaan informasi 24/7</li>
                                                    <li>Respon cepat terhadap keluhan</li>
                                                    <li>Transparansi pengelolaan</li>
                                                    <li>Akuntabilitas pelayanan</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pesan Direksi -->
            <div id="pesan-direksi">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-5 text-center">
                                <div class="mb-4">
                                    <img src="https://source.unsplash.com/200x200/?businessman" alt="Direktur" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                                    <h4 class="text-primary mb-1">Ahmad Suharto, S.E., M.M.</h4>
                                    <p class="text-muted">Direktur Utama Perumda Pasar Modern Tangerang</p>
                                </div>
                                <blockquote class="blockquote">
                                    <p class="mb-3 fs-5 fst-italic">
                                        "Kami berkomitmen untuk terus mengembangkan E-Pasar Tangerang menjadi platform digital yang terpercaya dan bermanfaat bagi masyarakat. Melalui teknologi modern, kami ingin memastikan bahwa informasi pasar dapat diakses dengan mudah, cepat, dan akurat oleh semua kalangan."
                                    </p>
                                    <footer class="blockquote-footer">
                                        <cite title="Source Title">Direktur Utama Perumda Pasar Modern Tangerang</cite>
                                    </footer>
                                </blockquote>
                                <div class="mt-4">
                                    <p class="text-muted mb-0">
                                        <i class="bi bi-envelope me-2"></i>Email: direktur@epasar-tangerang.go.id<br>
                                        <i class="bi bi-telephone me-2"></i>Telepon: (021) 12345678
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center">FAQ - Pertanyaan Umum</h2>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faq1">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                            Apa itu E-Pasar Tangerang?
                        </button>
                    </h2>
                    <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="faq1" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            E-Pasar Tangerang adalah platform digital resmi untuk pasar modern di Tangerang, menyediakan informasi harga, berita, galeri, dan layanan publik secara online.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faq2">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                            Bagaimana cara cek harga komoditas?
                        </button>
                    </h2>
                    <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Anda dapat melihat harga komoditas terbaru di section "Harga Komoditas" pada halaman utama E-Pasar.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faq3">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                            Bagaimana cara memberikan feedback atau saran?
                        </button>
                    </h2>
                    <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Silakan isi form pada section "Feedback" di bawah untuk mengirimkan saran, kritik, atau pertanyaan Anda.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faq4">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                            Apakah E-Pasar bisa diakses di mobile?
                        </button>
                    </h2>
                    <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="faq4" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Ya, E-Pasar Tangerang didesain responsif dan dapat diakses dengan baik di perangkat mobile maupun desktop.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feedback Section -->
    <section id="feedback" class="py-5">
        <div class="container">
            <h2 class="section-title text-center">Kirim Feedback & Saran</h2>
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <form id="feedbackForm" class="card border-0 shadow-sm p-4">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Pesan / Saran</label>
                            <textarea class="form-control" id="pesan" name="pesan" rows="4" required></textarea>
                    </div>
                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <div id="ratingStars" class="mb-2">
                                <i class="bi bi-star" data-value="1"></i>
                                <i class="bi bi-star" data-value="2"></i>
                                <i class="bi bi-star" data-value="3"></i>
                                <i class="bi bi-star" data-value="4"></i>
                                <i class="bi bi-star" data-value="5"></i>
                </div>
                            <input type="hidden" name="rating" id="rating" value="0">
                    </div>
                        <button type="submit" class="btn btn-primary w-100">Kirim Feedback</button>
                        <div id="feedbackMsg" class="mt-3"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center">Kontak & Lokasi</h2>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title text-primary"><i class="bi bi-geo-alt-fill me-2"></i>Kantor</h5>
                            <p class="card-text">Jl. Pasar Modern No. 1, Kota Tangerang, Banten, Indonesia</p>
                            <h5 class="card-title text-primary mt-4"><i class="bi bi-telephone-fill me-2"></i>Telepon</h5>
                            <p class="card-text">(021) 12345678</p>
                            <h5 class="card-title text-primary mt-4"><i class="bi bi-envelope-fill me-2"></i>Email</h5>
                            <p class="card-text">info@epasar-tangerang.go.id</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title text-primary"><i class="bi bi-map-fill me-2"></i>Lokasi</h5>
                    <div class="ratio ratio-16x9">
                                <iframe src="https://www.google.com/maps?q=pasar+modern+tangerang&output=embed" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer text-center bg-dark text-white">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h6>E-Pasar Tangerang</h6>
                    <p class="small">Platform digital pasar modern Tangerang untuk layanan publik, informasi harga, dan berita pasar.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h6>Link Penting</h6>
                    <ul class="list-unstyled small">
                        <li><a href="#layanan" class="text-white-50">Layanan</a></li>
                        <li><a href="#berita" class="text-white-50">Berita</a></li>
                        <li><a href="#harga" class="text-white-50">Harga</a></li>
                        <li><a href="#galeri" class="text-white-50">Galeri</a></li>
                        <li><a href="#faq" class="text-white-50">FAQ</a></li>
                        <li><a href="#feedback" class="text-white-50">Feedback</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h6>Kontak Kami</h6>
                    <p class="small">
                        <strong>Kantor:</strong><br>
                        Jl. Pasar Modern No. 1, Kota Tangerang<br>
                        <strong>Telepon:</strong> (021) 12345678<br>
                        <strong>Email:</strong> info@epasar-tangerang.go.id
                    </p>
                </div>
            </div>
            <hr class="my-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="small mb-0">&copy; 2024 E-Pasar Tangerang. All Rights Reserved.</p>
                </div>
                <div class="col-md-6">
                    <div class="social-links">
                <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/landing.js"></script>
    <script src="/assets/js/komoditas.js"></script>
    <script src="/assets/js/feedback.js"></script>
</body>
</html> 