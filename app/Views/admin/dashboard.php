<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - E-Pasar Tangerang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-primary">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Dashboard Admin</span>
            <span class="text-white">Selamat datang, <?= esc($admin_nama) ?></span>
            <a href="/admin/logout" class="btn btn-outline-light">Logout</a>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="alert alert-success">Anda berhasil login sebagai admin.</div>
        <p>Silakan tambahkan menu admin lain di sini sesuai kebutuhan.</p>
    </div>
</body>
</html> 