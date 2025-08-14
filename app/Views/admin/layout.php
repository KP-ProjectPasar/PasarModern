<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Dashboard' ?> - Pasar Modern</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Custom Admin CSS -->
    <link rel="stylesheet" href="/assets/css/admin/admin-dashboard.css">
    <link rel="stylesheet" href="/assets/css/admin/form-styles.css">
    
    <?= $this->renderSection('head') ?>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-heading text-white">
                <img src="/assets/img/logo/Logorbg.png" alt="Logo" width="32" height="32">
                <span>Admin Panel</span>
            </div>
            
            <div class="list-group list-group-flush">
                <a href="/admin/dashboard" class="list-group-item list-group-item-action <?= $active_page == 'dashboard' ? 'active' : '' ?>">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
                
                <div class="sidebar-dropdown">
                    <div class="dropdown-header" data-bs-toggle="collapse" data-bs-target="#userCollapse">
                        <span><i class="bi bi-people"></i> User</span>
                        <i class="bi bi-chevron-down"></i>
                    </div>
                    <div class="collapse" id="userCollapse">
                        <div class="dropdown-items">
                            <a href="/admin/user" class="dropdown-item <?= $active_page == 'user' ? 'active' : '' ?>">
                                <i class="bi bi-person"></i>
                                <span>User</span>
                            </a>
                            <a href="/admin/role" class="dropdown-item <?= $active_page == 'role' ? 'active' : '' ?>">
                                <i class="bi bi-shield"></i>
                                <span>Role</span>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="sidebar-dropdown">
                    <div class="dropdown-header" data-bs-toggle="collapse" data-bs-target="#contentCollapse">
                        <span><i class="bi bi-file-text"></i> Konten</span>
                        <i class="bi bi-chevron-down"></i>
                    </div>
                    <div class="collapse" id="contentCollapse">
                        <div class="dropdown-items">
                            <a href="/admin/berita" class="dropdown-item <?= $active_page == 'berita' ? 'active' : '' ?>">
                                <i class="bi bi-newspaper"></i>
                                <span>Berita</span>
                            </a>
                            <a href="/admin/galeri" class="dropdown-item <?= $active_page == 'galeri' ? 'active' : '' ?>">
                                <i class="bi bi-images"></i>
                                <span>Galeri</span>
                            </a>
                            <a href="/admin/video" class="dropdown-item <?= $active_page == 'video' ? 'active' : '' ?>">
                                <i class="bi bi-camera-video"></i>
                                <span>Video</span>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="sidebar-dropdown">
                    <div class="dropdown-header" data-bs-toggle="collapse" data-bs-target="#dataCollapse">
                        <span><i class="bi bi-database"></i> Data</span>
                        <i class="bi bi-chevron-down"></i>
                    </div>
                    <div class="collapse" id="dataCollapse">
                        <div class="dropdown-items">
                            <a href="/admin/pasar" class="dropdown-item <?= $active_page == 'pasar' ? 'active' : '' ?>">
                                <i class="bi bi-building"></i>
                                <span>Pasar</span>
                            </a>
                            <a href="/admin/harga" class="dropdown-item <?= $active_page == 'harga' ? 'active' : '' ?>">
                                <i class="bi bi-currency-dollar"></i>
                                <span>Harga</span>
                            </a>
                        </div>
                    </div>
                </div>
                
                <a href="/admin/feedback" class="list-group-item list-group-item-action <?= $active_page == 'feedback' ? 'active' : '' ?>">
                    <i class="bi bi-chat-dots"></i>
                    <span>Feedback</span>
                </a>
            </div>
        </div>
        
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <!-- Top Navigation -->
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <div class="navbar-nav ms-auto">
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                                <div class="user-avatar me-2">
                                    <?= substr(session()->get('admin_nama'), 0, 1) ?>
                                </div>
                                <div class="user-info">
                                    <div class="user-name"><?= session()->get('admin_nama') ?></div>
                                    <div class="user-role"><?= ucfirst(session()->get('admin_role')) ?></div>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="/admin/profile"><i class="bi bi-person me-2"></i>Profile</a></li>
                                <li><a class="dropdown-item" href="/admin/settings"><i class="bi bi-gear me-2"></i>Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/admin/logout"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            
            <!-- Main Content -->
            <div class="container-fluid">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom Admin JavaScript - Hanya yang diperlukan -->
    <script src="/assets/js/admin/dashboard-charts.js"></script>
    
    <script>
        // Update activity every 5 minutes
        setInterval(function() {
            fetch('/admin/update-activity', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                }
            });
        }, 5 * 60 * 1000);
    </script>
</body>
</html> 