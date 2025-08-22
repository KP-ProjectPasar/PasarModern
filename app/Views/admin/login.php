<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Pasar Modern</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/admin/login-styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="login-admin-bg d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="login-admin-card shadow-sm border-0">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <div class="login-admin-logo-wrapper mb-2">
                                <img src="/assets/img/logo/Logorbg.png" alt="Logo Pasar Modern" class="login-admin-logo">
                            </div>
                            <h5 class="fw-bold mb-1 text-primary">Admin Pasar Modern</h5>
                            <div class="text-muted mb-3 small">Masuk ke Panel Admin</div>
                        </div>
                        <?php if (!empty($error)) : ?>
                            <div class="alert alert-danger text-center small py-2 mb-3 animate__animated animate__shakeX"><?= esc($error) ?></div>
                        <?php endif; ?>
                        <form method="post" action="" autocomplete="off" id="loginForm">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control form-control-lg" id="username" name="username" required autofocus value="<?= set_value('username') ?>">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" class="form-control form-control-lg" id="password" name="password" required>
                                    <span class="input-group-text show-password-toggle" onclick="togglePassword()" style="cursor:pointer;"><i class="bi bi-eye-slash" id="toggleIcon"></i></span>
                                </div>
                            </div>
                            <button type="submit" class="btn login-admin-btn w-100 py-2 mt-2" id="loginBtn">
                                <span id="loginBtnText">Login</span>
                                <span class="spinner-border spinner-border-sm d-none" id="loginSpinner" role="status" aria-hidden="true"></span>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-4 text-muted small copyright">
                    &copy; <?= date('Y') ?> Pasar Modern
                </div>
            </div>
        </div>
    </div>
    
    <script src="/assets/js/admin/login.js"></script>
</body>
</html>