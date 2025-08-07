<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<!-- Government Style Header -->
<div class="dashboard-header mb-4">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2 class="dashboard-title mb-2">
                <i class="bi bi-speedometer2 me-2"></i>Dashboard Sistem Informasi Pasar Modern
            </h2>
            <p class="page-subtitle mb-0">Selamat datang kembali, <?= esc($admin_nama ?? 'Admin') ?>! Berikut adalah ringkasan aktivitas dan informasi sistem hari ini.</p>
        </div>
        <div class="col-md-4 text-end">
            <div class="current-time">
                <i class="bi bi-clock me-2"></i>
                <span id="current-time"></span>
            </div>
        </div>
    </div>
</div>

<!-- Government Statistics Cards -->
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
        <div class="stat-card stat-card-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Galeri foto yang tersedia">
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

<!-- Charts and Information Section -->
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

<!-- Government Information Panel -->
<div class="row mb-4">
    <div class="col-lg-6 mb-3">
        <div class="dashboard-card">
            <div class="dashboard-card-header">
                <h5 class="dashboard-card-title">
                    <i class="bi bi-info-circle text-info me-2"></i>
                    Informasi Sistem
                </h5>
            </div>
            <div class="dashboard-card-body">
                <div class="system-info">
                    <div class="info-item">
                        <i class="bi bi-calendar-check text-success me-2"></i>
                        <span><strong>Tanggal Update:</strong> <?= date('d F Y') ?></span>
                    </div>
                    <div class="info-item">
                        <i class="bi bi-clock text-primary me-2"></i>
                        <span><strong>Waktu Update:</strong> <?= date('H:i:s') ?></span>
                    </div>
                    <div class="info-item">
                        <i class="bi bi-person-badge text-warning me-2"></i>
                        <span><strong>Role Aktif:</strong> <?= ucfirst($admin_role ?? 'Admin') ?></span>
                    </div>
                    <div class="info-item">
                        <i class="bi bi-shield-check text-info me-2"></i>
                        <span><strong>Status Sistem:</strong> <span class="badge bg-success">Aktif</span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6 mb-3">
        <div class="dashboard-card">
            <div class="dashboard-card-header">
                <h5 class="dashboard-card-title">
                    <i class="bi bi-bar-chart text-warning me-2"></i>
                    Statistik Konten
                </h5>
            </div>
            <div class="dashboard-card-body">
                <div class="content-stats">
                    <div class="stat-item">
                        <div class="stat-icon bg-primary">
                            <i class="bi bi-newspaper"></i>
                        </div>
                        <div class="stat-content">
                            <h6>Berita Publikasi</h6>
                            <p class="stat-number"><?= $total_berita ?? 0 ?></p>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon bg-success">
                            <i class="bi bi-images"></i>
                        </div>
                        <div class="stat-content">
                            <h6>Foto Galeri</h6>
                            <p class="stat-number"><?= $total_galeri ?? 0 ?></p>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon bg-warning">
                            <i class="bi bi-chat-dots"></i>
                        </div>
                        <div class="stat-content">
                            <h6>Feedback Masuk</h6>
                            <p class="stat-number"><?= $total_feedback ?? 0 ?></p>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon bg-info">
                            <i class="bi bi-building"></i>
                        </div>
                        <div class="stat-content">
                            <h6>Data Pasar</h6>
                            <p class="stat-number"><?= $total_pasar ?? 0 ?></p>
                        </div>
                    </div>
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
    
    // Update user activity every 2 minutes to keep status online
    setInterval(updateUserActivity, 120000); // 2 menit
});

// Function to update user activity
function updateUserActivity() {
    fetch('/admin/update-activity', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            timestamp: new Date().toISOString()
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('User activity updated');
        }
    })
    .catch(error => {
        console.error('Error updating user activity:', error);
    });
}

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

    // Activity Chart (Harga Komoditas)
    const activityCtx = document.getElementById('activityChart').getContext('2d');
    activityChart = new Chart(activityCtx, {
        type: 'line',
        data: {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
            datasets: [
                {
                    label: 'Beras (Rp/kg)',
                    data: [12000, 12500, 12300, 12700, 12400, 12600, 12500],
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4
                },
                {
                    label: 'Jagung (Rp/kg)',
                    data: [8000, 8200, 8100, 8300, 8250, 8350, 8300],
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4
                },
                {
                    label: 'Kedelai (Rp/kg)',
                    data: [15000, 15200, 15100, 15300, 15250, 15400, 15350],
                    borderColor: '#f59e0b',
                    backgroundColor: 'rgba(245, 158, 11, 0.1)',
                    tension: 0.4
                }
            ]
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
                    text: 'Tren Harga Komoditas Mingguan'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
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
            labels: ['Berita', 'Galeri', 'Video', 'Harga'],
            datasets: [{
                data: [<?= $total_berita ?? 0 ?>, <?= $total_galeri ?? 0 ?>, 5, 12],
                backgroundColor: [
                    '#3b82f6',
                    '#10b981',
                    '#f59e0b',
                    '#8b5cf6'
                ],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Distribusi Konten'
                }
            }
        }
    });
}

function updateChartPeriod(period) {
    // TODO: Implement chart period update
    console.log('Update chart period to:', period, 'days');
    
    // Update button states
    document.querySelectorAll('.dashboard-card-actions .btn').forEach(btn => {
        btn.classList.remove('btn-primary');
        btn.classList.add('btn-outline-primary');
    });
    event.target.classList.remove('btn-outline-primary');
    event.target.classList.add('btn-primary');
}
</script>

<style>
/* Government Dashboard Styles */
.system-info {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.info-item {
    display: flex;
    align-items: center;
    padding: 0.75rem;
    background: #f8fafc;
    border-radius: 8px;
    border-left: 4px solid #3b82f6;
}

.info-item i {
    font-size: 1.2rem;
    width: 24px;
}

.content-stats {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: #f8fafc;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.stat-content h6 {
    margin: 0;
    font-size: 0.875rem;
    color: #64748b;
    font-weight: 500;
}

.stat-number {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
}

.dashboard-header {
    background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
    color: white;
    padding: 2rem;
    border-radius: 12px;
    margin-bottom: 2rem;
}

.dashboard-title {
    color: white;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.current-time {
    background: rgba(255, 255, 255, 0.1);
    padding: 0.75rem 1rem;
    border-radius: 8px;
    font-weight: 500;
}

@media (max-width: 768px) {
    .content-stats {
        grid-template-columns: 1fr;
    }
    
    .dashboard-header {
        padding: 1.5rem;
    }
    
    .stat-item {
        flex-direction: column;
        text-align: center;
    }
}
</style>

<?= $this->endSection() ?> 