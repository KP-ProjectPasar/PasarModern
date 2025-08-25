<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Harga Komoditas - Pasar Modern Tangerang</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f8f9fa; }
        .harga-section { background: #fff; border-radius: 16px; box-shadow: 0 4px 24px rgba(0,0,0,0.07); padding: 2rem; margin-top: 2rem; }
        .harga-title { font-weight: 700; color: #1a237e; }
        .harga-table th { background: #1a237e; color: #fff; }
        .harga-table td { vertical-align: middle; }
        .badge-komoditas { font-size: 1rem; background: #3949ab; color: #fff; }
        .badge-satuan { background: #e8eaf6; color: #1a237e; }
        .harga-update { font-size: 0.95rem; color: #616161; }
        .filter-bar { margin-bottom: 1.5rem; }
        @media (max-width: 768px) {
            .harga-section { padding: 1rem; }
            .harga-title { font-size: 1.5rem; }
        }
    </style>
</head>
<body>
    <?php include(APPPATH.'Views/landing_page.php'); ?>
    <main class="container">
        <section class="harga-section">
            <div class="row mb-4">
                <div class="col text-center">
                    <h2 class="harga-title mb-2"><i class="bi bi-currency-dollar me-2"></i>Informasi Harga Komoditas</h2>
                    <p class="lead">Update harga komoditas pasar modern Tangerang secara real-time, transparan, dan akurat.</p>
                    <div class="harga-update mt-2"><i class="bi bi-clock-history me-1"></i>Update terakhir: <?= esc($lastUpdate) ?></div>
                </div>
            </div>
            <form method="get" class="filter-bar row g-2 align-items-center justify-content-center">
                <div class="col-md-4">
                    <input type="text" name="q" class="form-control" placeholder="Cari komoditas..." value="<?= esc($q) ?>">
                </div>
                <div class="col-md-3">
                    <select name="kategori" class="form-select">
                        <option value="">Semua Kategori</option>
                        <?php foreach ($kategoriList as $kat): ?>
                            <option value="<?= esc($kat) ?>" <?= $kategori == $kat ? 'selected' : '' ?>><?= esc(ucfirst($kat)) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> Cari</button>
                </div>
            </form>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-hover harga-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Komoditas</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Satuan</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Gambar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($komoditasList)): ?>
                                    <?php foreach ($komoditasList as $i => $h): ?>
                                        <tr>
                                            <td><?= $i+1 ?></td>
                                            <td><span class="badge badge-komoditas"><?= esc($h['nama_komoditas'] ?? $h['komoditas'] ?? '-') ?></span></td>
                                            <td><?= esc(ucfirst($h['kategori'] ?? '-')) ?></td>
                                            <td><strong>Rp <?= number_format($h['harga'], 0, ',', '.') ?></strong></td>
                                            <td><span class="badge badge-satuan"><?= esc($h['satuan'] ?? '-') ?></span></td>
                                            <td><?= esc(date('d M Y', strtotime($h['tanggal'] ?? $h['created_at'] ?? ''))) ?></td>
                                            <td><?= esc($h['keterangan'] ?? '-') ?></td>
                                            <td>
                                                <?php if (!empty($h['gambar'])): ?>
                                                    <img src="<?= esc($h['gambar']) ?>" alt="Gambar" style="max-width:60px;max-height:60px;">
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="8" class="text-center text-muted">Belum ada data harga tersedia.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
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
