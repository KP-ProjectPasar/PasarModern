// Dashboard Charts and Functions

// Inisialisasi chart saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    loadDashboardData();
    initializeTimeUpdate();
});

// Load dashboard data from API
async function loadDashboardData() {
    try {
        const response = await fetch('/api/dashboard/stats');
        const data = await response.json();
        
        // Update stat cards
        updateStatCards(data);
        
        // Initialize charts with real data
        initializeCharts(data);
        
    } catch (error) {
        console.error('Error loading dashboard data:', error);
        // Initialize charts with default data
        initializeCharts();
    }
}

// Update stat cards with real data
function updateStatCards(data) {
    const statCards = {
        'total_pasar': data.total_pasar || 0,
        'total_berita': data.total_berita || 0,
        'total_feedback': data.total_feedback || 0,
        'total_views': data.total_views || 0
    };
    
    // Update each stat card
    Object.keys(statCards).forEach(key => {
        const elements = document.querySelectorAll(`[data-stat="${key}"]`);
        elements.forEach(element => {
            element.textContent = statCards[key];
        });
    });
}

// Inisialisasi semua chart
function initializeCharts(data = null) {
    // Chart Aktivitas (Harga Komoditas)
    const activityCtx = document.getElementById('activityChart');
    if (activityCtx) {
        // Prepare chart data
        let chartLabels = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        let chartData = [0, 0, 0, 0, 0, 0, 0];
        
        if (data && data.chart_data && data.chart_data.length > 0) {
            chartLabels = data.chart_data.map(item => item.day);
            chartData = data.chart_data.map(item => item.price);
        }
        
        const activityChart = new Chart(activityCtx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Harga Rata-rata',
                    data: chartData,
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true
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
                        text: 'Tren Harga Komoditas Mingguan'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Sembunyikan loading dan tampilkan chart
        setTimeout(() => {
            const loading = document.getElementById('chartLoading');
            const canvas = document.getElementById('activityChart');
            if (loading) loading.style.display = 'none';
            if (canvas) canvas.style.display = 'block';
        }, 1000);
    }

    // Chart Distribusi Konten
    const contentCtx = document.getElementById('contentChart');
    if (contentCtx) {
        // Prepare content distribution data
        let contentLabels = ['Berita', 'Galeri', 'Pasar', 'Feedback'];
        let contentData = [0, 0, 0, 0];
        let contentColors = ['#3b82f6', '#10b981', '#f59e0b', '#06b6d4'];
        
        if (data && data.content_distribution && data.content_distribution.length > 0) {
            contentLabels = data.content_distribution.map(item => item.label);
            contentData = data.content_distribution.map(item => item.value);
            contentColors = data.content_distribution.map(item => item.color);
        }
        
        new Chart(contentCtx, {
            type: 'doughnut',
            data: {
                labels: contentLabels,
                datasets: [{
                    data: contentData,
                    backgroundColor: contentColors,
                    borderWidth: 2,
                    borderColor: '#ffffff'
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
}

// Update periode chart
function updateChartPeriod(period) {
    // Update button states
    document.querySelectorAll('.dashboard-card-actions .btn').forEach(btn => {
        btn.classList.remove('btn-primary');
        btn.classList.add('btn-outline-primary');
    });
    event.target.classList.remove('btn-outline-primary');
    event.target.classList.add('btn-primary');
}

// Initialize time update
function initializeTimeUpdate() {
    // Update waktu real-time
    function updateTime() {
        const now = new Date();
        
        // Format hari dan tanggal Indonesia
        const dayOptions = { weekday: 'long' };
        const dateOptions = { 
            day: 'numeric',
            month: 'long', 
            year: 'numeric' 
        };
        
        const dayStr = now.toLocaleDateString('id-ID', dayOptions);
        const dateStr = now.toLocaleDateString('id-ID', dateOptions);
        
        // Format waktu dengan leading zero
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const timeStr = `${hours} : ${minutes} : ${seconds}`;
        
        // Update elemen tanpa animasi
        const dayElement = document.getElementById('current-day');
        const dateElement = document.getElementById('current-date');
        const timeElement = document.getElementById('current-time');
        
        if (dayElement) {
            dayElement.textContent = dayStr;
        }
        
        if (dateElement) {
            dateElement.textContent = dateStr;
        }
        
        if (timeElement) {
            timeElement.textContent = timeStr;
        }
    }
    
    // Update waktu setiap detik
    setInterval(updateTime, 1000);
    updateTime(); // Update sekali saat halaman dimuat
}

// Auto refresh harga komoditas setiap 5 menit
setInterval(() => {
    // Refresh harga data setiap 5 menit
}, 5 * 60 * 1000);

// Update user activity every 2 minutes to keep status online
setInterval(() => {
    updateUserActivity();
}, 2 * 60 * 1000);

// Function to update user activity
function updateUserActivity() {
    fetch('/admin/update-activity', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            console.error('Failed to update activity:', data.message);
        }
    })
    .catch(error => {
        console.error('Error updating activity:', error);
    });
} 