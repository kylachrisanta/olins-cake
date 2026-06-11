<?php 
session_start(); 
// Jika sudah login, redirect ke dashboard
if (isset($_SESSION['id_pelanggan'])) {
    header("Location: ../dashboard.php");
    exit;
}

// Cek apakah ada cookie remember_me
$saved_username = isset($_COOKIE['remember_username']) ? $_COOKIE['remember_username'] : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Olin's Cake</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="auth-page">

    <?php include '../includes/navbar.php'; ?>

    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h2>Selamat Datang Kembali</h2>
                <p>Silakan masuk untuk melanjutkan pesanan</p>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <?= $_SESSION['error'] ?>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <?= $_SESSION['success'] ?>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <form action="proses_masuk.php" method="POST">
                <div class="form-group">
                    <label for="nama_pengguna">Nama Pengguna</label>
                    <input type="text" id="nama_pengguna" name="nama_pengguna" class="form-control" required placeholder="Masukkan nama pengguna" value="<?= htmlspecialchars($saved_username) ?>">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required placeholder="Masukkan password">
                </div>

                <div class="form-check">
                    <input type="checkbox" id="remember_me" name="remember_me" <?= $saved_username ? 'checked' : '' ?>>
                    <label for="remember_me">Ingat Nama Pengguna Saya</label>
                </div>

                <button type="submit" class="btn-primary auth-btn">Masuk</button>
            </form>

            <div class="auth-links">
                Belum punya akun? <a href="daftar.php">Daftar Akun</a>
            </div>
        </div>
    </div>

</body>
</html>
