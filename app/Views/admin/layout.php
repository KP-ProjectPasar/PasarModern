<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Dashboard' ?> - E-Pasar Tangerang</title>
    
    <!-- Google Fonts - Inter for modern institutional look -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Custom Admin CSS -->
    <link rel="stylesheet" href="/assets/css/admin/admin-dashboard.css">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
</head>
<body>
<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="border-end" id="sidebar-wrapper">
        <div class="sidebar-heading text-white py-4 px-3 d-flex align-items-center">
            <img src="/assets/img/logo/Logorbg.png" width="32" class="me-2" alt="Logo"> Pasar Modern Tangerang
        </div>
        <div class="list-group list-group-flush">
            <!-- Dashboard -->
            <a href="/admin/dashboard" class="list-group-item<?= (strpos($_SERVER['REQUEST_URI'], '/admin/dashboard') === 0 ? ' active' : '') ?>">
                <i class="bi bi-house"></i> Dashboard
            </a>
            
            <!-- Pengaturan Akun Dropdown -->
            <div class="sidebar-dropdown">
                <div class="dropdown-header" data-bs-toggle="collapse" data-bs-target="#pengaturanAkun" aria-expanded="false">
                    <i class="bi bi-chevron-down"></i>
                    <span>Pengaturan Akun</span>
                </div>
                <div class="collapse" id="pengaturanAkun">
                    <div class="dropdown-items">
                        <?php if (isset($admin_role) && $admin_role === 'superadmin'): ?>
                            <a href="/admin/user" class="dropdown-item<?= (strpos($_SERVER['REQUEST_URI'], '/admin/user') === 0 ? ' active' : '') ?>">
                                <i class="bi bi-people"></i> Kelola Admin
                            </a>
                            <a href="/admin/role" class="dropdown-item<?= (strpos($_SERVER['REQUEST_URI'], '/admin/role') === 0 ? ' active' : '') ?>">
                                <i class="bi bi-shield-lock"></i> Kelola Role
                            </a>
                            <a href="/admin/grup" class="dropdown-item<?= (strpos($_SERVER['REQUEST_URI'], '/admin/grup') === 0 ? ' active' : '') ?>">
                                <i class="bi bi-box"></i> Kelola Grup
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- Manajemen Konten Dropdown -->
            <div class="sidebar-dropdown">
                <div class="dropdown-header" data-bs-toggle="collapse" data-bs-target="#manajemenKonten" aria-expanded="false">
                    <i class="bi bi-chevron-down"></i>
                    <span>Manajemen Konten</span>
                </div>
                <div class="collapse" id="manajemenKonten">
                    <div class="dropdown-items">
                        <a href="/admin/pasar" class="dropdown-item<?= (strpos($_SERVER['REQUEST_URI'], '/admin/pasar') === 0 ? ' active' : '') ?>">
                            <i class="bi bi-building"></i> Data Pasar
                        </a>
                        <a href="/admin/berita" class="dropdown-item<?= (strpos($_SERVER['REQUEST_URI'], '/admin/berita') === 0 ? ' active' : '') ?>">
                            <i class="bi bi-newspaper"></i> Berita Pasar
                        </a>
                        <a href="/admin/galeri" class="dropdown-item<?= (strpos($_SERVER['REQUEST_URI'], '/admin/galeri') === 0 ? ' active' : '') ?>">
                            <i class="bi bi-images"></i> Galeri
                        </a>
                        <a href="/admin/video" class="dropdown-item<?= (strpos($_SERVER['REQUEST_URI'], '/admin/video') === 0 ? ' active' : '') ?>">
                            <i class="bi bi-camera-video"></i> Video
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Standalone Links -->
            <a href="/admin/harga" class="list-group-item<?= (strpos($_SERVER['REQUEST_URI'], '/admin/harga') === 0 ? ' active' : '') ?>">
                <i class="bi bi-cash-coin"></i> Harga Komoditas
            </a>
            
            <a href="/admin/logout" class="list-group-item text-danger">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper" class="flex-grow-1">
        <!-- Modern Top Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
            <div class="container-fluid">
                <!-- Right side - User profile and actions -->
                <div class="d-flex align-items-center ms-auto">
                    <!-- User Profile -->
                    <div class="dropdown">
                        <button class="btn btn-light d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-avatar me-2">
                                <i class="bi bi-person-circle text-primary"></i>
                            </div>
                            <div class="user-info text-start">
                                <div class="fw-semibold text-dark"><?= esc($admin_nama ?? 'Admin') ?></div>
                                <small class="text-muted"><?= esc(ucfirst($admin_role ?? 'admin')) ?></small>
                            </div>
                            <i class="bi bi-chevron-down ms-2"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><h6 class="dropdown-header">Profil</h6></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profil Saya</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Pengaturan</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="/admin/logout"><i class="bi bi-box-arrow-right me-2"></i>Keluar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container-fluid mt-4">
            <?= $this->renderSection('content') ?>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="/assets/js/admin/dashboard.js"></script>

<!-- Custom Scripts -->
<script>
// Add smooth scrolling and enhanced interactions
document.addEventListener('DOMContentLoaded', function() {
    // Add hover effects to sidebar items
    const sidebarItems = document.querySelectorAll('#sidebar-wrapper .list-group-item');
    sidebarItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(5px)';
        });
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });

    // Add click effects to quick action items
    const quickActionItems = document.querySelectorAll('.quick-action-item');
    quickActionItems.forEach(item => {
        item.addEventListener('click', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });
    });

    // Add loading animation for charts
    const chartContainers = document.querySelectorAll('canvas');
    chartContainers.forEach(canvas => {
        canvas.style.opacity = '0';
        canvas.style.transition = 'opacity 0.5s ease';
        setTimeout(() => {
            canvas.style.opacity = '1';
        }, 500);
    });

    // Sidebar dropdown functionality
    const dropdownHeaders = document.querySelectorAll('.sidebar-dropdown .dropdown-header');
    // Auto-expand dropdown if it contains active item
    const activeDropdownItems = document.querySelectorAll('.sidebar-dropdown .dropdown-item.active');
    activeDropdownItems.forEach(item => {
        const parentDropdown = item.closest('.sidebar-dropdown');
        if (parentDropdown) {
            const dropdownHeader = parentDropdown.querySelector('.dropdown-header');
            const collapse = parentDropdown.querySelector('.collapse');
            if (dropdownHeader && collapse) {
                // Only expand if this item is actually active
                if (item.classList.contains('active')) {
                    collapse.classList.add('show');
                    dropdownHeader.setAttribute('aria-expanded', 'true');
                }
            }
        }
    });

    // Ensure only one dropdown is open at a time
    dropdownHeaders.forEach(header => {
        header.addEventListener('click', function() {
            const target = this.getAttribute('data-bs-target');
            const collapse = document.querySelector(target);
            
            // Close other dropdowns
            dropdownHeaders.forEach(otherHeader => {
                if (otherHeader !== this) {
                    const otherTarget = otherHeader.getAttribute('data-bs-target');
                    const otherCollapse = document.querySelector(otherTarget);
                    if (otherCollapse.classList.contains('show')) {
                        otherCollapse.classList.remove('show');
                        otherHeader.setAttribute('aria-expanded', 'false');
                    }
                }
            });
        });
    });
});
</script>

</body>
</html> 