<?php
session_start();
require_once '../konfigurasi/koneksi.php';

if (!isset($_SESSION['status_login_admin']) || $_SESSION['status_login_admin'] !== true) {
    header("Location: ../masuk_admin.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kategori = trim($_POST['nama_kategori']);

    if (!empty($nama_kategori)) {
        $stmt = $koneksi->prepare("INSERT INTO kategori_produk (nama_kategori) VALUES (?)");
        $stmt->bind_param("s", $nama_kategori);
        if ($stmt->execute()) {
            $_SESSION['success'] = "Kategori berhasil ditambahkan.";
        } else {
            $_SESSION['error'] = "Gagal menambahkan kategori: " . $stmt->error;
        }
    } else {
        $_SESSION['error'] = "Nama kategori tidak boleh kosong.";
    }
}

header("Location: ../produk/index.php?tab=kategori");
exit;
?>
