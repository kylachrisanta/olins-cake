<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Olin's Cake</title>
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
                <h2>Daftar Akun</h2>
                <p>Bergabung dan nikmati kue lezat Olin's Cake</p>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <?= $_SESSION['error'] ?>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <form action="proses_daftar.php" method="POST">
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" required placeholder="Masukkan nama lengkap">
                </div>

                <div class="form-group">
                    <label for="nama_pengguna">Nama Pengguna</label>
                    <input type="text" id="nama_pengguna" name="nama_pengguna" class="form-control" required placeholder="Buat nama pengguna (tanpa spasi)">
                </div>

                <div class="form-group">
                    <label for="nomor_whatsapp">Nomor WhatsApp</label>
                    <input type="tel" id="nomor_whatsapp" name="nomor_whatsapp" class="form-control" required placeholder="Contoh: 08123456789">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required minlength="8" placeholder="Minimal 8 karakter">
                </div>

                <div class="form-group" style="margin-bottom: 30px;">
                    <label for="konfirmasi_password">Konfirmasi Password</label>
                    <input type="password" id="konfirmasi_password" name="konfirmasi_password" class="form-control" required placeholder="Ulangi password">
                </div>

                <button type="submit" class="btn-primary auth-btn">Daftar</button>
            </form>

            <div class="auth-links">
                Sudah punya akun? <a href="masuk.php">Masuk</a>
            </div>
        </div>
    </div>

</body>
</html>
