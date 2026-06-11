<?php
session_start();
require_once '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_pengguna = trim($_POST['nama_pengguna']);
    $password = $_POST['password'];
    $remember = isset($_POST['remember_me']) ? true : false;

    if (empty($nama_pengguna) || empty($password)) {
        $_SESSION['error'] = "Nama pengguna dan password harus diisi.";
        header("Location: masuk.php");
        exit;
    }

    $stmt = $koneksi->prepare("SELECT id_pelanggan, nama_lengkap, kata_sandi, status_akun FROM pelanggan WHERE nama_pengguna = ?");
    $stmt->bind_param("s", $nama_pengguna);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if ($row['status_akun'] === 'nonaktif') {
            $_SESSION['error'] = "Akun Anda dinonaktifkan. Silakan hubungi admin.";
            header("Location: masuk.php");
            exit;
        }

        if (password_verify($password, $row['kata_sandi'])) {
            // Login sukses
            $_SESSION['id_pelanggan'] = $row['id_pelanggan'];
            $_SESSION['nama_lengkap'] = $row['nama_lengkap'];

            // Remember Me
            if ($remember) {
                // Set cookie untuk 30 hari
                setcookie('remember_username', $nama_pengguna, time() + (86400 * 30), "/");
            } else {
                // Hapus cookie jika tidak dicentang
                if (isset($_COOKIE['remember_username'])) {
                    setcookie('remember_username', '', time() - 3600, "/");
                }
            }

            header("Location: ../index.php");
            exit;
        } else {
            $_SESSION['error'] = "Nama pengguna atau password tidak sesuai.";
            header("Location: masuk.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "Nama pengguna atau password tidak sesuai.";
        header("Location: masuk.php");
        exit;
    }

    $stmt->close();
} else {
    header("Location: masuk.php");
    exit;
}
?>
