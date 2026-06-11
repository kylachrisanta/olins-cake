<?php
session_start();
require_once '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_lengkap = trim($_POST['nama_lengkap']);
    $nama_pengguna = trim($_POST['nama_pengguna']);
    $nomor_whatsapp = trim($_POST['nomor_whatsapp']);
    $password = $_POST['password'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    if (empty($nama_lengkap) || empty($nama_pengguna) || empty($nomor_whatsapp) || empty($password) || empty($konfirmasi_password)) {
        $_SESSION['error'] = "Semua field wajib diisi.";
        header("Location: daftar.php");
        exit;
    }

    if (preg_match('/\s/', $nama_pengguna)) {
        $_SESSION['error'] = "Nama pengguna tidak boleh mengandung spasi.";
        header("Location: daftar.php");
        exit;
    }

    if (!preg_match('/^[0-9]{9,15}$/', $nomor_whatsapp)) {
        $_SESSION['error'] = "Nomor WhatsApp tidak valid. Gunakan angka (9-15 digit).";
        header("Location: daftar.php");
        exit;
    }

    if (strlen($password) < 8) {
        $_SESSION['error'] = "Password minimal 8 karakter.";
        header("Location: daftar.php");
        exit;
    }

    if ($password !== $konfirmasi_password) {
        $_SESSION['error'] = "Password dan Konfirmasi Password tidak sama.";
        header("Location: daftar.php");
        exit;
    }

    $stmt_check = $koneksi->prepare("SELECT id_pelanggan FROM pelanggan WHERE nama_pengguna = ?");
    $stmt_check->bind_param("s", $nama_pengguna);
    $stmt_check->execute();
    $stmt_check->store_result();
    
    if ($stmt_check->num_rows > 0) {
        $_SESSION['error'] = "Nama pengguna sudah terdaftar, silakan gunakan yang lain.";
        $stmt_check->close();
        header("Location: daftar.php");
        exit;
    }
    $stmt_check->close();

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt_insert = $koneksi->prepare("INSERT INTO pelanggan (nama_lengkap, nama_pengguna, nomor_whatsapp, kata_sandi) VALUES (?, ?, ?, ?)");
    $stmt_insert->bind_param("ssss", $nama_lengkap, $nama_pengguna, $nomor_whatsapp, $password_hash);
    
    if ($stmt_insert->execute()) {
        $_SESSION['success'] = "Pendaftaran berhasil! Silakan masuk menggunakan akun Anda.";
        header("Location: masuk.php");
        exit;
    } else {
        $_SESSION['error'] = "Terjadi kesalahan sistem, silakan coba lagi.";
        header("Location: daftar.php");
        exit;
    }

    $stmt_insert->close();
} else {
    header("Location: daftar.php");
    exit;
}
?>
