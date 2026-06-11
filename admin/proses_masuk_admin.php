<?php
session_start();
require_once 'konfigurasi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pengguna = trim($_POST['nama_pengguna']);
    $password = $_POST['password'];

    $stmt = $koneksi->prepare("SELECT * FROM admin WHERE nama_pengguna = ?");
    $stmt->bind_param("s", $nama_pengguna);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        
        if (password_verify($password, $admin['kata_sandi'])) {
            if ($admin['status_admin'] === 'aktif') {
                // Set session admin
                $_SESSION['status_login_admin'] = true;
                $_SESSION['id_admin'] = $admin['id_admin'];
                $_SESSION['nama_admin'] = $admin['nama_admin'];
                
                header("Location: dashboard_admin.php");
                exit;
            } else {
                $_SESSION['error'] = "Akun admin tidak aktif.";
            }
        } else {
            $_SESSION['error'] = "Nama pengguna atau password tidak sesuai.";
        }
    } else {
        $_SESSION['error'] = "Nama pengguna atau password tidak sesuai.";
    }
}

header("Location: masuk_admin.php");
exit;
?>
