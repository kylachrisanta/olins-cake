<?php
session_start();
if (isset($_SESSION['status_login_admin']) && $_SESSION['status_login_admin'] === true) {
    header("Location: dashboard_admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Olin's Cake</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="aset/css/admin_style.css">
</head>
<body class="login-admin-bg">

    <div class="login-admin-card">
        <div class="login-admin-header">
            <h1>Olin's Cake</h1>
            <p>Portal Administrator</p>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?= $_SESSION['error'] ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form action="proses_masuk_admin.php" method="POST">
            <div class="form-group">
                <label>Nama Pengguna</label>
                <input type="text" name="nama_pengguna" class="form-control" required autocomplete="off">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn-admin">Masuk</button>
        </form>
    </div>

</body>
</html>
