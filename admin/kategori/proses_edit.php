<?php
session_start();
require_once '../konfigurasi/koneksi.php';

if (!isset($_SESSION['status_login_admin']) || $_SESSION['status_login_admin'] !== true) {
    header("Location: ../masuk_admin.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_kategori = intval($_POST['id_kategori']);
    $nama_kategori = trim($_POST['nama_kategori']);

    if (!empty($nama_kategori)) {
        $stmt = $koneksi->prepare("UPDATE kategori_produk SET nama_kategori = ? WHERE id_kategori = ?");
        $stmt->bind_param("si", $nama_kategori, $id_kategori);
        if ($stmt->execute()) {
            $_SESSION['success'] = "Kategori berhasil diperbarui.";
        } else {
            $_SESSION['error'] = "Gagal memperbarui kategori: " . $stmt->error;
        }
    } else {
        $_SESSION['error'] = "Nama kategori tidak boleh kosong.";
    }
}

header("Location: ../produk/index.php?tab=kategori");
exit;
?>
