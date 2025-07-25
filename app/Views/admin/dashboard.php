<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - E-Pasar Tangerang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="login-admin-bg">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Dashboard Admin</span>
            <div class="d-flex align-items-center gap-3">
                <span class="text-white small">Halo, <b><?= esc($admin_nama) ?></b> <span class="badge bg-light text-primary text-uppercase ms-2"><?= esc($admin_level) ?></span></span>
                <a href="/admin/logout" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-3 mb-4">
                <div class="list-group shadow-sm">
                    <?php if ($admin_level === 'superadmin'): ?>
                        <a href="#user" class="list-group-item list-group-item-action"><i class="bi bi-people me-2"></i> Master User</a>
                        <a href="#level" class="list-group-item list-group-item-action"><i class="bi bi-shield-lock me-2"></i> Level & Grup</a>
                        <a href="#manajemen" class="list-group-item list-group-item-action"><i class="bi bi-gear me-2"></i> Manajemen Data</a>
                        <a href="#berita" class="list-group-item list-group-item-action"><i class="bi bi-newspaper me-2"></i> Berita</a>
                        <a href="#harga" class="list-group-item list-group-item-action"><i class="bi bi-cash-coin me-2"></i> Harga Komoditas</a>
                        <a href="#galeri" class="list-group-item list-group-item-action"><i class="bi bi-images me-2"></i> Galeri</a>
                        <a href="#video" class="list-group-item list-group-item-action"><i class="bi bi-camera-video me-2"></i> Video</a>
                    <?php elseif ($admin_level === 'berita'): ?>
                        <a href="#berita" class="list-group-item list-group-item-action"><i class="bi bi-newspaper me-2"></i> Berita</a>
                    <?php elseif ($admin_level === 'harga'): ?>
                        <a href="#harga" class="list-group-item list-group-item-action"><i class="bi bi-cash-coin me-2"></i> Harga Komoditas</a>
                    <?php elseif ($admin_level === 'galeri'): ?>
                        <a href="#galeri" class="list-group-item list-group-item-action"><i class="bi bi-images me-2"></i> Galeri</a>
                        <a href="#video" class="list-group-item list-group-item-action"><i class="bi bi-camera-video me-2"></i> Video</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h4 class="mb-3">Selamat Datang di Dashboard Admin</h4>
                        <p class="mb-4">Gunakan menu di samping untuk mengelola data sesuai hak akses Anda.</p>
                        <div class="row g-3">
                            <?php if ($admin_level === 'superadmin'): ?>
                                <div class="col-md-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body text-center">
                                            <i class="bi bi-people display-5 text-primary mb-2"></i>
                                            <h6 class="fw-bold">Master User</h6>
                                            <p class="small text-muted">Kelola user admin, level, dan grup.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body text-center">
                                            <i class="bi bi-gear display-5 text-success mb-2"></i>
                                            <h6 class="fw-bold">Manajemen Data</h6>
                                            <p class="small text-muted">Kelola data berita, harga, galeri, video.</p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($admin_level === 'berita' || $admin_level === 'superadmin'): ?>
                                <div class="col-md-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body text-center">
                                            <i class="bi bi-newspaper display-5 text-info mb-2"></i>
                                            <h6 class="fw-bold">Berita</h6>
                                            <p class="small text-muted">Manajemen berita pasar modern.</p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($admin_level === 'harga' || $admin_level === 'superadmin'): ?>
                                <div class="col-md-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body text-center">
                                            <i class="bi bi-cash-coin display-5 text-warning mb-2"></i>
                                            <h6 class="fw-bold">Harga Komoditas</h6>
                                            <p class="small text-muted">Manajemen harga komoditas pasar.</p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($admin_level === 'galeri' || $admin_level === 'superadmin'): ?>
                                <div class="col-md-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body text-center">
                                            <i class="bi bi-images display-5 text-secondary mb-2"></i>
                                            <h6 class="fw-bold">Galeri</h6>
                                            <p class="small text-muted">Manajemen galeri foto pasar.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body text-center">
                                            <i class="bi bi-camera-video display-5 text-danger mb-2"></i>
                                            <h6 class="fw-bold">Video</h6>
                                            <p class="small text-muted">Manajemen video pasar.</p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 