<?php
session_start();
require_once '../konfigurasi/koneksi.php';

if (!isset($_SESSION['status_login_admin']) || $_SESSION['status_login_admin'] !== true) {
    header("Location: ../masuk_admin.php");
    exit;
}

if (isset($_GET['id'])) {
    $id_kategori = intval($_GET['id']);
    
    $check_stmt = $koneksi->prepare("SELECT COUNT(*) as total FROM produk WHERE id_kategori = ?");
    $check_stmt->bind_param("i", $id_kategori);
    $check_stmt->execute();
    $total_produk = $check_stmt->get_result()->fetch_assoc()['total'];
    
    if ($total_produk > 0) {
        $_SESSION['error'] = "Tidak dapat menghapus kategori. Terdapat $total_produk produk yang masih terhubung ke kategori ini.";
    } else {
        $stmt = $koneksi->prepare("DELETE FROM kategori_produk WHERE id_kategori = ?");
        $stmt->bind_param("i", $id_kategori);
        if ($stmt->execute()) {
            $_SESSION['success'] = "Kategori berhasil dihapus.";
        } else {
            $_SESSION['error'] = "Gagal menghapus kategori: " . $stmt->error;
        }
    }
}

header("Location: ../produk/index.php?tab=kategori");
exit;
?>
