// Dashboard Charts and Functions

// Inisialisasi chart saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    initializeCharts();
    initializeTimeUpdate();
});

// Inisialisasi semua chart
function initializeCharts() {
    // Chart Aktivitas (Harga Komoditas)
    const activityCtx = document.getElementById('activityChart');
    if (activityCtx) {
        const activityChart = new Chart(activityCtx, {
            type: 'line',
            data: {
                labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                datasets: [{
                    label: 'Harga Rata-rata',
                    data: [0, 0, 0, 0, 0, 0, 0],
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
        }, 2000);
    }

    // Chart Distribusi Konten
    const contentCtx = document.getElementById('contentChart');
    if (contentCtx) {
        new Chart(contentCtx, {
            type: 'doughnut',
            data: {
                labels: ['Berita', 'Galeri', 'Pasar', 'Feedback'],
                datasets: [{
                    data: [0, 0, 3, 0],
                    backgroundColor: [
                        '#3b82f6',
                        '#10b981',
                        '#f59e0b',
                        '#06b6d4'
                    ],
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