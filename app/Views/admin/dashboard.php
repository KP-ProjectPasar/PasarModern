<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<!-- Header Section -->
<div class="dashboard-header mb-4">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2 class="dashboard-title mb-2">
                Dashboard Admin
            </h2>
            <p class="page-subtitle mb-0">Selamat datang kembali, <?= esc($admin_nama ?? 'Admin') ?>! Berikut adalah ringkasan aktivitas sistem hari ini.</p>
        </div>
        <div class="col-md-4 text-end">
            <div class="current-time">
                <i class="bi bi-clock me-2"></i>
                <span id="current-time"></span>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-4 col-md-6 mb-3">
        <div class="stat-card stat-card-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Jumlah komoditas yang tersedia">
            <div class="stat-card-icon">
                <i class="bi bi-box-seam"></i>
            </div>
            <div class="stat-card-content">
                <h3 class="stat-card-number"><?= $total_komoditas ?? 0 ?></h3>
                <p class="stat-card-label">Komoditas</p>
            </div>
        </div>
    </div>
    
    <div class="col-xl-4 col-md-6 mb-3">
        <div class="stat-card stat-card-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Berita yang telah dipublikasikan">
            <div class="stat-card-icon">
                <i class="bi bi-newspaper"></i>
            </div>
            <div class="stat-card-content">
                <h3 class="stat-card-number"><?= $total_berita ?? 0 ?></h3>
                <p class="stat-card-label">Berita</p>
            </div>
        </div>
    </div>
    
    <div class="col-xl-4 col-md-6 mb-3">
        <div class="stat-card stat-card-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Foto dalam galeri">
            <div class="stat-card-icon">
                <i class="bi bi-images"></i>
            </div>
            <div class="stat-card-content">
                <h3 class="stat-card-number"><?= $total_galeri ?? 0 ?></h3>
                <p class="stat-card-label">Galeri</p>
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
                    Grafik Harga Harian Komoditas
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
                    <p class="mt-2">Memuat data harga komoditas...</p>
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
                    <!-- Data aktivitas akan dimuat dari database -->
                    <div class="text-center text-muted py-4" id="noActivityData">
                        <i class="bi bi-clock-history" style="font-size: 2rem;"></i>
                        <p class="mt-2 mb-0">Belum ada aktivitas terbaru</p>
                        <small>Data aktivitas akan muncul setelah ada konten yang ditambahkan</small>
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
                    <?php if (in_array(session()->get('admin_role'), ['superadmin', 'admin'])): ?>
                    <a href="/admin/user/create" class="quick-action-item" data-bs-toggle="tooltip" title="Buat user baru untuk sistem">
                        <div class="quick-action-icon bg-primary">
                            <i class="bi bi-person-plus"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Tambah User</h6>
                            <p class="text-muted">Buat user baru</p>
                        </div>
                    </a>
                    <?php endif; ?>
                    
                    <?php if (in_array(session()->get('admin_role'), ['superadmin', 'admin', 'berita'])): ?>
                    <a href="/admin/berita/create" class="quick-action-item" data-bs-toggle="tooltip" title="Tulis dan publikasikan berita baru">
                        <div class="quick-action-icon bg-success">
                            <i class="bi bi-newspaper"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Tulis Berita</h6>
                            <p class="text-muted">Publikasikan berita baru</p>
                        </div>
                    </a>
                    <?php endif; ?>
                    
                    <?php if (in_array(session()->get('admin_role'), ['superadmin', 'admin', 'harga'])): ?>
                    <a href="/admin/harga/create" class="quick-action-item" data-bs-toggle="tooltip" title="Update harga komoditas terbaru">
                        <div class="quick-action-icon bg-warning">
                            <i class="bi bi-cash-coin"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Update Harga</h6>
                            <p class="text-muted">Perbarui harga komoditas</p>
                        </div>
                    </a>
                    <?php endif; ?>
                    
                    <?php if (in_array(session()->get('admin_role'), ['superadmin', 'admin', 'galeri'])): ?>
                    <a href="/admin/galeri/create" class="quick-action-item" data-bs-toggle="tooltip" title="Upload foto ke galeri">
                        <div class="quick-action-icon bg-info">
                            <i class="bi bi-images"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Upload Foto</h6>
                            <p class="text-muted">Tambah foto ke galeri</p>
                        </div>
                    </a>
                    <?php endif; ?>
                    
                    <?php if (in_array(session()->get('admin_role'), ['superadmin', 'admin'])): ?>
                    <a href="/admin/video/create" class="quick-action-item" data-bs-toggle="tooltip" title="Tambah video baru">
                        <div class="quick-action-icon bg-danger">
                            <i class="bi bi-camera-video"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Tambah Video</h6>
                            <p class="text-muted">Upload video baru</p>
                        </div>
                    </a>
                    
                    <a href="/admin/pasar/create" class="quick-action-item" data-bs-toggle="tooltip" title="Tambah data pasar baru">
                        <div class="quick-action-icon bg-secondary">
                            <i class="bi bi-building"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Data Pasar</h6>
                            <p class="text-muted">Tambah data pasar</p>
                        </div>
                    </a>
                    <?php endif; ?>
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

// Chart variables
let activityChart, contentChart; // activityChart sekarang untuk harga komoditas

// Initialize charts after page load
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
        initializeCharts();
        // Auto refresh harga komoditas setiap 5 menit
        setInterval(refreshCommodityPrices, 300000); // 5 menit
    }, 1000);
});

function refreshCommodityPrices() {
    // TODO: Ambil data harga terbaru dari database
    // fetch('/api/dashboard/latest-prices')
    //     .then(res => res.json())
    //     .then(data => {
    //         if (activityChart) {
    //             // Update dengan data terbaru
    //             activityChart.data.datasets[0].data = data.beras || [];
    //             activityChart.data.datasets[1].data = data.jagung || [];
    //             activityChart.data.datasets[2].data = data.kedelai || [];
    //             activityChart.update();
    //         }
    //     })
    //     .catch(error => {
    //         console.error('Error refreshing commodity prices:', error);
    //     });
    
    console.log('Auto-refresh harga komoditas - akan diimplementasikan dengan database');
}

function initializeCharts() {
    // Hide loading and show charts
    document.getElementById('chartLoading').style.display = 'none';
    document.getElementById('pieChartLoading').style.display = 'none';
    document.getElementById('activityChart').style.display = 'block';
    document.getElementById('contentChart').style.display = 'block';

    // Activity Chart - Changed to Commodity Price Chart
    const activityCtx = document.getElementById('activityChart').getContext('2d');
    activityChart = new Chart(activityCtx, {
        type: 'line',
        data: {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            datasets: [{
                label: 'Beras',
                data: [0, 0, 0, 0, 0, 0, 0], // Akan diisi dari database
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                tension: 0.4
            }, {
                label: 'Jagung',
                data: [0, 0, 0, 0, 0, 0, 0], // Akan diisi dari database
                borderColor: '#f59e0b',
                backgroundColor: 'rgba(245, 158, 11, 0.1)',
                tension: 0.4
            }, {
                label: 'Kedelai',
                data: [0, 0, 0, 0, 0, 0, 0], // Akan diisi dari database
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Harga Komoditas (Rp/kg)'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Harga (Rp/kg)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Hari'
                    }
                }
            }
        }
    });

    // Content Distribution Chart
    const contentCtx = document.getElementById('contentChart').getContext('2d');
    contentChart = new Chart(contentCtx, {
        type: 'doughnut',
        data: {
            labels: ['Komoditas', 'Berita', 'Galeri'],
            datasets: [{
                data: [<?= $total_komoditas ?? 0 ?>, <?= $total_berita ?? 0 ?>, <?= $total_galeri ?? 0 ?>],
                backgroundColor: [
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
    // TODO: Ambil data harga komoditas dari database berdasarkan periode
    // fetch(`/api/dashboard/commodity-prices?period=${days}`)
    //     .then(res => res.json())
    //     .then(data => {
    //         // Update chart dengan data harga dari database
    //         if (activityChart) {
    //             activityChart.data.labels = data.labels;
    //             activityChart.data.datasets[0].data = data.beras || [];
    //             activityChart.data.datasets[1].data = data.jagung || [];
    //             activityChart.data.datasets[2].data = data.kedelai || [];
    //             activityChart.update();
    //         }
    //     })
    //     .catch(error => {
    //         console.error('Error fetching commodity prices:', error);
    //     });
    
    // TODO: Update chart data dari database
    if (activityChart) {
        const newData = days === '7' ? 
            [0, 0, 0, 0, 0, 0, 0] : 
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        
        // Update semua dataset dengan data kosong untuk sementara
        activityChart.data.datasets.forEach(dataset => {
            dataset.data = newData;
        });
        activityChart.update();
    }
}

function refreshActivities() {
    // TODO: Ambil aktivitas terbaru dari database
    // fetch('/api/dashboard/activities')
    //     .then(res => res.json())
    //     .then(data => {
    //         // Update aktivitas dengan data dari database
    //         if (data.length > 0) {
    //             displayActivities(data);
    //         } else {
    //             showNoActivityMessage();
    //         }
    //     })
    //     .catch(error => {
    //         console.error('Error fetching activities:', error);
    //         showNoActivityMessage();
    //     });
    
    // Untuk sementara, tampilkan pesan bahwa data belum tersedia
    showNoActivityMessage();
}

function showNoActivityMessage() {
    const activityList = document.getElementById('activityList');
    activityList.innerHTML = `
        <div class="text-center text-muted py-4">
            <i class="bi bi-clock-history" style="font-size: 2rem;"></i>
            <p class="mt-2 mb-0">Belum ada aktivitas terbaru</p>
            <small>Data aktivitas akan muncul setelah ada konten yang ditambahkan</small>
        </div>
    `;
}

function displayActivities(activities) {
    const activityList = document.getElementById('activityList');
    if (activities.length === 0) {
        showNoActivityMessage();
        return;
    }
    
    let html = '';
    activities.forEach(activity => {
        html += `
            <div class="activity-item" onclick="showActivityDetail('${activity.type}')">
                <div class="activity-icon bg-${activity.color}">
                    <i class="bi bi-${activity.icon}"></i>
                </div>
                <div class="activity-content">
                    <h6>${activity.title}</h6>
                    <p class="text-muted">${activity.description}</p>
                    <small class="text-muted">${activity.time}</small>
                </div>
            </div>
        `;
    });
    
    activityList.innerHTML = html;
}

function showActivityDetail(type) {
    // TODO: Ambil detail aktivitas dari database
    // fetch(`/api/dashboard/activity/${type}`)
    //     .then(res => res.json())
    //     .then(data => {
    //         // Tampilkan detail aktivitas dari database
    //     });
    
    // Untuk sementara, tampilkan pesan bahwa fitur belum tersedia
    alert('Detail aktivitas akan tersedia setelah implementasi database');
}
</script>

<?= $this->endSection() ?> 