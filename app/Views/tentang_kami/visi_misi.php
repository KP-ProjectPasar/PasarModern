<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visi & Misi - Pasar Modern Tangerang</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f8f9fa; }
        .main-section { background: #fff; border-radius: 24px; box-shadow: 0 8px 32px rgba(37,99,235,0.08); padding: 2.5rem 2rem; margin-top: 2.5rem; }
        .title-main { font-weight: 700; font-size: 2.5rem; color: #1a237e; }
        .subtitle-main { color: #3949ab; font-size: 1.15rem; margin-bottom: 2rem; }
        .nav-btns { margin-bottom: 2rem; }
        .nav-btns .btn { font-weight: 600; font-size: 1rem; border-radius: 10px; margin-right: 0.5rem; }
        .stats-row { margin-bottom: 2rem; }
        .stat-card { background: #f5f7fa; border-radius: 14px; padding: 1.2rem 1.5rem; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.04); }
        .stat-value { font-size: 2rem; font-weight: 700; color: #1a237e; }
        .stat-label { font-size: 1rem; color: #3949ab; }
        .illustration-box { background: #e3f2fd; border-radius: 16px; min-height: 180px; display: flex; align-items: center; justify-content: center; margin-bottom: 2rem; }
        .section-title { font-weight: 700; font-size: 1.5rem; color: #1a237e; margin-bottom: 1rem; }
        .visi-misi-box { background: #f8fafc; border-radius: 14px; padding: 1.5rem; margin-bottom: 2rem; }
        .visi-misi-flex { display: flex; gap: 2rem; flex-wrap: wrap; }
        .visi-card, .misi-card { flex: 1 1 300px; background: #fff; border-radius: 12px; box-shadow: 0 2px 8px rgba(37,99,235,0.07); padding: 1.2rem; }
        .visi-card h4, .misi-card h4 { font-weight: 700; color: #1976d2; margin-bottom: 1rem; }
        .misi-list { padding-left: 1.2rem; }
        .misi-list li { margin-bottom: 0.7rem; font-size: 1.05rem; }
        @media (max-width: 768px) {
            .main-section { padding: 1rem; }
            .title-main { font-size: 1.5rem; }
            .visi-misi-flex { flex-direction: column; gap: 1rem; }
        }
    </style>
</head>
<body>
    <?php include(APPPATH.'Views/landing_page.php'); ?>
    <main class="container">
        <section class="main-section">
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="title-main mb-2">Visi & Misi</h1>
                    <div class="subtitle-main">Menjaga transparansi dan keberlanjutan pasar lokal melalui data, teknologi, dan kolaborasi.</div>
                    <div class="nav-btns mb-4">
                        <button class="btn btn-dark">Lihat Visi & Misi</button>
                        <button class="btn btn-outline-dark">Lihat Statistik Pasar</button>
                    </div>
                    <div class="row stats-row">
                        <div class="col-6 col-md-3 mb-3">
                            <div class="stat-card">
                                <div class="stat-value">120+</div>
                                <div class="stat-label">Pasar terdata</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 mb-3">
                            <div class="stat-card">
                                <div class="stat-value">15K</div>
                                <div class="stat-label">Transaksi / bulan</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 mb-3">
                            <div class="stat-card">
                                <div class="stat-value">98%</div>
                                <div class="stat-label">Akurasi data</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 mb-3">
                            <div class="stat-card">
                                <div class="stat-value">5</div>
                                <div class="stat-label">Kota cakupan</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-flex align-items-center">
                    <div class="illustration-box w-100">
                        <span class="text-secondary">Ilustrasi pasar (foto/vektor)</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-title">Visi & Misi</div>
                    <div class="visi-misi-box">
                        <div class="mb-2">Visi dan misi dirancang untuk mendukung pertumbuhan pasar yang adil, transparan, serta memberikan manfaat ekonomi kepada pelaku usaha dan konsumen.</div>
                        <div class="visi-misi-flex">
                            <div class="visi-card">
                                <h4>Visi</h4>
                                <div>Menjadi pusat informasi pasar terdepan di Indonesia yang mendukung pertumbuhan ekonomi daerah dan nasional.</div>
                            </div>
                            <div class="misi-card">
                                <h4>Misi</h4>
                                <ol class="misi-list">
                                    <li>Menyediakan data pasar yang akurat & terpercaya, teknologi ramah pengguna, dan layanan responsif.</li>
                                    <li>Mengembangkan platform mudah digunakan.</li>
                                    <li>Mempromosikan perdagangan adil & ramah lingkungan.</li>
                                    <li>Mendukung pelatihan bagi pelaku usaha.</li>
                                    <li>Membangun kemitraan strategis.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="section-title">Integrasi Data & Visualisasi</div>
                    <div class="visi-misi-box">
                        <div>Menggabungkan data lapangan dengan visualisasi interaktif agar pengambilan keputusan lebih efektif dan transparan.</div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="footer text-center bg-dark text-white mt-5">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h6>Pasar Modern Tangerang</h6>
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
                    <p class="small mb-0">&copy; 2024 Pasar Modern Tangerang. All Rights Reserved.</p>
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
</body>
</html>
