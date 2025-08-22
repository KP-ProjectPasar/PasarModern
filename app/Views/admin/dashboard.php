<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="dashboard-header mb-4">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2 class="dashboard-title mb-2">
                <i class="bi bi-speedometer2 me-2"></i>Dashboard Sistem Informasi Pasar Modern
            </h2>
            <p class="page-subtitle mb-0" style="color: #ffffff !important; font-weight: 500;">Selamat datang kembali, <?= esc($admin_nama ?? 'Admin') ?>! Berikut adalah ringkasan aktivitas dan informasi sistem hari ini.</p>
        </div>
        <div class="col-md-4 text-end">
            <div class="current-time-container">
                <div class="time-card">
                    <div class="time-icon">
                        <i class="bi bi-clock"></i>
                    </div>
                    <div class="time-content">
                        <div class="current-day-date">
                            <span class="current-day" id="current-day"></span>
                            <span class="current-date" id="current-date"></span>
                        </div>
                        <div class="current-time-display" id="current-time"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="stat-card stat-card-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Jumlah pasar yang tersedia">
            <div class="stat-card-icon">
                <i class="bi bi-building"></i>
            </div>
            <div class="stat-card-content">
                <h3 class="stat-card-number"><?= $total_pasar ?? 0 ?></h3>
                <p class="stat-card-label">Jumlah Pasar</p>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="stat-card stat-card-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Berita yang telah dipublikasikan">
            <div class="stat-card-icon">
                <i class="bi bi-newspaper"></i>
            </div>
            <div class="stat-card-content">
                <h3 class="stat-card-number"><?= $total_berita ?? 0 ?></h3>
                <p class="stat-card-label">Berita</p>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="stat-card stat-card-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Feedback dari pengguna">
            <div class="stat-card-icon">
                <i class="bi bi-chat-dots"></i>
            </div>
            <div class="stat-card-content">
                <h3 class="stat-card-number"><?= $total_feedback ?? 0 ?></h3>
                <p class="stat-card-label">Feedback</p>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="stat-card stat-card-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Total views dari semua berita">
            <div class="stat-card-icon">
                <i class="bi bi-eye"></i>
            </div>
            <div class="stat-card-content">
                <h3 class="stat-card-number"><?= $total_views ?? 0 ?></h3>
                <p class="stat-card-label">Total Views</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mb-3">
        <div class="dashboard-card">
            <div class="dashboard-card-header">
                <h5 class="dashboard-card-title">
                    <i class="bi bi-graph-up text-primary me-2"></i>
                    Grafik Harga Harian Komoditas
                </h5>
            </div>
            <div class="dashboard-card-body">
                <canvas id="activityChart" height="300"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 mb-3">
        <div class="dashboard-card">
            <div class="dashboard-card-header">
                <h5 class="dashboard-card-title">
                    <i class="bi bi-pie-chart text-success me-2"></i>
                    Distribusi Konten
                </h5>
            </div>
            <div class="dashboard-card-body">
                <canvas id="contentChart" height="250"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-3">
        <div class="dashboard-card">
            <div class="dashboard-card-header">
                <h5 class="dashboard-card-title">
                    <i class="bi bi-info-circle text-info me-2"></i>
                    Informasi Sistem
                </h5>
            </div>
            <div class="dashboard-card-body">
                <div class="info-list">
                    <div class="info-item">
                        <div class="info-icon text-primary">
                            <i class="bi bi-server"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Status Server</div>
                            <div class="info-value">Online</div>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon text-success">
                            <i class="bi bi-database"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Database</div>
                            <div class="info-value">Connected</div>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon text-warning">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Last Update</div>
                            <div class="info-value"><?= date('d/m/Y H:i') ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?> 