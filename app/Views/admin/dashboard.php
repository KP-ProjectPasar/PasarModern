<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<!-- Welcome Notification -->
<div class="welcome-notification" id="welcomeNotification">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        <strong>Selamat datang!</strong> Dashboard telah diperbarui dengan tampilan yang lebih modern dan informatif.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
</div>

<!-- Header Section -->
<div class="dashboard-header mb-4">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2 class="dashboard-title mb-2">
                <i class="bi bi-speedometer2 text-primary me-2"></i>
                Dashboard Admin
            </h2>
            <p class="text-muted mb-0">Selamat datang kembali, <?= esc($admin_nama ?? 'Admin') ?>! Berikut adalah ringkasan aktivitas sistem hari ini.</p>
        </div>
        <div class="col-md-4 text-end">
            <div class="current-time">
                <i class="bi bi-clock text-primary me-2"></i>
                <span id="current-time"></span>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="stat-card stat-card-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Total pengguna terdaftar dalam sistem">
            <div class="stat-card-icon">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-card-content">
                <h3 class="stat-card-number"><?= $total_users ?? 0 ?></h3>
                <p class="stat-card-label">Total Users</p>
                <div class="stat-card-trend positive">
                    <i class="bi bi-arrow-up"></i>
                    <span>+12%</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="stat-card stat-card-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Jumlah komoditas yang tersedia">
            <div class="stat-card-icon">
                <i class="bi bi-box-seam"></i>
            </div>
            <div class="stat-card-content">
                <h3 class="stat-card-number"><?= $total_komoditas ?? 0 ?></h3>
                <p class="stat-card-label">Komoditas</p>
                <div class="stat-card-trend positive">
                    <i class="bi bi-arrow-up"></i>
                    <span>+8%</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="stat-card stat-card-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Berita yang telah dipublikasikan">
            <div class="stat-card-icon">
                <i class="bi bi-newspaper"></i>
            </div>
            <div class="stat-card-content">
                <h3 class="stat-card-number"><?= $total_berita ?? 0 ?></h3>
                <p class="stat-card-label">Berita</p>
                <div class="stat-card-trend positive">
                    <i class="bi bi-arrow-up"></i>
                    <span>+15%</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="stat-card stat-card-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Foto dalam galeri">
            <div class="stat-card-icon">
                <i class="bi bi-images"></i>
            </div>
            <div class="stat-card-content">
                <h3 class="stat-card-number"><?= $total_galeri ?? 0 ?></h3>
                <p class="stat-card-label">Galeri</p>
                <div class="stat-card-trend positive">
                    <i class="bi bi-arrow-up"></i>
                    <span>+5%</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts and Activity Section -->
<div class="row mb-4">
    <div class="col-lg-8 mb-3">
        <div class="dashboard-card">
            <div class="dashboard-card-header">
                <h5 class="dashboard-card-title">
                    <i class="bi bi-graph-up text-primary me-2"></i>
                    Aktivitas Sistem
                </h5>
                <div class="dashboard-card-actions">
                    <button class="btn btn-sm btn-outline-primary" onclick="updateChartPeriod('7')" data-bs-toggle="tooltip" title="Tampilkan data 7 hari terakhir">
                        <i class="bi bi-calendar-week"></i> 7 Hari
                    </button>
                    <button class="btn btn-sm btn-outline-secondary" onclick="updateChartPeriod('30')" data-bs-toggle="tooltip" title="Tampilkan data 30 hari terakhir">
                        <i class="bi bi-calendar-month"></i> 30 Hari
                    </button>
                </div>
            </div>
            <div class="dashboard-card-body">
                <div class="chart-loading" id="chartLoading">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Memuat data grafik...</p>
                </div>
                <canvas id="activityChart" height="300" style="display: none;"></canvas>
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
                <div class="chart-loading" id="pieChartLoading">
                    <div class="spinner-border text-success" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Memuat data distribusi...</p>
                </div>
                <canvas id="contentChart" height="300" style="display: none;"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activities and Quick Actions -->
<div class="row">
    <div class="col-lg-6 mb-3">
        <div class="dashboard-card">
            <div class="dashboard-card-header">
                <h5 class="dashboard-card-title">
                    <i class="bi bi-clock-history text-warning me-2"></i>
                    Aktivitas Terbaru
                </h5>
                <button class="btn btn-sm btn-outline-warning" onclick="refreshActivities()" data-bs-toggle="tooltip" title="Perbarui daftar aktivitas">
                    <i class="bi bi-arrow-clockwise"></i> Refresh
                </button>
            </div>
            <div class="dashboard-card-body">
                <div class="activity-list" id="activityList">
                    <div class="activity-item" onclick="showActivityDetail('user')">
                        <div class="activity-icon bg-primary">
                            <i class="bi bi-person-plus"></i>
                        </div>
                        <div class="activity-content">
                            <h6>User baru ditambahkan</h6>
                            <p class="text-muted">Admin menambahkan user baru "John Doe"</p>
                            <small class="text-muted">2 menit yang lalu</small>
                        </div>
                    </div>
                    
                    <div class="activity-item" onclick="showActivityDetail('komoditas')">
                        <div class="activity-icon bg-success">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <div class="activity-content">
                            <h6>Komoditas diperbarui</h6>
                            <p class="text-muted">Harga beras diperbarui menjadi Rp 12.500/kg</p>
                            <small class="text-muted">15 menit yang lalu</small>
                        </div>
                    </div>
                    
                    <div class="activity-item" onclick="showActivityDetail('berita')">
                        <div class="activity-icon bg-warning">
                            <i class="bi bi-newspaper"></i>
                        </div>
                        <div class="activity-content">
                            <h6>Berita dipublikasikan</h6>
                            <p class="text-muted">Berita "Harga Komoditas Stabil" dipublikasikan</p>
                            <small class="text-muted">1 jam yang lalu</small>
                        </div>
                    </div>
                    
                    <div class="activity-item" onclick="showActivityDetail('galeri')">
                        <div class="activity-icon bg-info">
                            <i class="bi bi-images"></i>
                        </div>
                        <div class="activity-content">
                            <h6>Galeri diperbarui</h6>
                            <p class="text-muted">5 foto baru ditambahkan ke galeri</p>
                            <small class="text-muted">2 jam yang lalu</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6 mb-3">
        <div class="dashboard-card">
            <div class="dashboard-card-header">
                <h5 class="dashboard-card-title">
                    <i class="bi bi-lightning text-danger me-2"></i>
                    Aksi Cepat
                </h5>
            </div>
            <div class="dashboard-card-body">
                <div class="quick-actions">
                    <a href="/admin/user/create" class="quick-action-item" onclick="showNotification('Membuka halaman tambah user...', 'info')" data-bs-toggle="tooltip" title="Buat user baru untuk sistem">
                        <div class="quick-action-icon bg-primary">
                            <i class="bi bi-person-plus"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Tambah User</h6>
                            <p class="text-muted">Buat user baru</p>
                        </div>
                    </a>
                    
                    <a href="/admin/berita/create" class="quick-action-item" onclick="showNotification('Membuka halaman tulis berita...', 'info')" data-bs-toggle="tooltip" title="Tulis dan publikasikan berita baru">
                        <div class="quick-action-icon bg-success">
                            <i class="bi bi-newspaper"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Tulis Berita</h6>
                            <p class="text-muted">Publikasikan berita baru</p>
                        </div>
                    </a>
                    
                    <a href="/admin/harga/create" class="quick-action-item" onclick="showNotification('Membuka halaman update harga...', 'info')" data-bs-toggle="tooltip" title="Update harga komoditas terbaru">
                        <div class="quick-action-icon bg-warning">
                            <i class="bi bi-cash-coin"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Update Harga</h6>
                            <p class="text-muted">Perbarui harga komoditas</p>
                        </div>
                    </a>
                    
                    <a href="/admin/galeri/create" class="quick-action-item" onclick="showNotification('Membuka halaman upload foto...', 'info')" data-bs-toggle="tooltip" title="Upload foto ke galeri">
                        <div class="quick-action-icon bg-info">
                            <i class="bi bi-images"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Upload Foto</h6>
                            <p class="text-muted">Tambah foto ke galeri</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

// Current Time
function updateTime() {
    const now = new Date();
    const timeString = now.toLocaleString('id-ID', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    });
    document.getElementById('current-time').textContent = timeString;
}

setInterval(updateTime, 1000);
updateTime();

// Hide welcome notification after 5 seconds
setTimeout(() => {
    const welcomeNotification = document.getElementById('welcomeNotification');
    if (welcomeNotification) {
        welcomeNotification.style.display = 'none';
    }
}, 5000);

// Chart variables
let activityChart, contentChart;

// Initialize charts after page load
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
        initializeCharts();
    }, 1000);
});

function initializeCharts() {
    // Hide loading and show charts
    document.getElementById('chartLoading').style.display = 'none';
    document.getElementById('pieChartLoading').style.display = 'none';
    document.getElementById('activityChart').style.display = 'block';
    document.getElementById('contentChart').style.display = 'block';

    // Activity Chart
    const activityCtx = document.getElementById('activityChart').getContext('2d');
    activityChart = new Chart(activityCtx, {
        type: 'line',
        data: {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            datasets: [{
                label: 'Users',
                data: [0, 0, 0, 0, 0, 0, 0], // Akan diisi dari database
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.1)',
                tension: 0.4
            }, {
                label: 'Berita',
                data: [0, 0, 0, 0, 0, 0, 0], // Akan diisi dari database
                borderColor: '#f59e0b',
                backgroundColor: 'rgba(245, 158, 11, 0.1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Content Distribution Chart
    const contentCtx = document.getElementById('contentChart').getContext('2d');
    contentChart = new Chart(contentCtx, {
        type: 'doughnut',
        data: {
            labels: ['Users', 'Komoditas', 'Berita', 'Galeri'],
            datasets: [{
                data: [<?= $total_users ?? 0 ?>, <?= $total_komoditas ?? 0 ?>, <?= $total_berita ?? 0 ?>, <?= $total_galeri ?? 0 ?>],
                backgroundColor: [
                    '#2563eb',
                    '#10b981',
                    '#f59e0b',
                    '#06b6d4'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });
}

function updateChartPeriod(days) {
    // TODO: Ambil data dari database berdasarkan periode
    // fetch(`/api/dashboard/stats?period=${days}`)
    //     .then(res => res.json())
    //     .then(data => {
    //         // Update chart dengan data dari database
    //     });
    
    showNotification(`Memperbarui data untuk ${days} hari terakhir...`, 'info');
    
    // TODO: Update chart data dari database
    if (activityChart) {
        const newData = days === '7' ? 
            [0, 0, 0, 0, 0, 0, 0] : 
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        
        activityChart.data.datasets[0].data = newData;
        activityChart.update();
    }
}

function refreshActivities() {
    // TODO: Ambil aktivitas terbaru dari database
    // fetch('/api/dashboard/activities')
    //     .then(res => res.json())
    //     .then(data => {
    //         // Update aktivitas dengan data dari database
    //     });
    
    showNotification('Memperbarui aktivitas terbaru...', 'info');
    setTimeout(() => {
        showNotification('Aktivitas berhasil diperbarui!', 'success');
    }, 1000);
}

function showActivityDetail(type) {
    // TODO: Ambil detail aktivitas dari database
    // fetch(`/api/dashboard/activity/${type}`)
    //     .then(res => res.json())
    //     .then(data => {
    //         // Tampilkan detail aktivitas dari database
    //     });
    
    const details = {
        user: 'Detail aktivitas user akan tersedia setelah implementasi database',
        komoditas: 'Detail aktivitas komoditas akan tersedia setelah implementasi database',
        berita: 'Detail aktivitas berita akan tersedia setelah implementasi database',
        galeri: 'Detail aktivitas galeri akan tersedia setelah implementasi database'
    };
    
    showNotification(details[type] || 'Detail aktivitas tidak tersedia', 'info');
}
</script>

<?= $this->endSection() ?> 