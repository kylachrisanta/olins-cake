<?php
session_start();
require_once '../konfigurasi/koneksi.php';

if (!isset($_SESSION['status_login_admin']) || $_SESSION['status_login_admin'] !== true) {
    header("Location: ../masuk_admin.php");
    exit;
}

if (isset($_GET['id'])) {
    $id_produk = intval($_GET['id']);
    
    // Opsional: Ambil nama file foto dan hapus dari server
    $stmt_sel = $koneksi->prepare("SELECT foto_produk FROM produk WHERE id_produk = ?");
    $stmt_sel->bind_param("i", $id_produk);
    $stmt_sel->execute();
    $res = $stmt_sel->get_result();
    
    if ($res->num_rows > 0) {
        $foto_lama = $res->fetch_assoc()['foto_produk'];
        $upload_dir = '../../assets/images/';
        // if ($foto_lama && file_exists($upload_dir . $foto_lama) && $foto_lama !== 'product1.png' && $foto_lama !== 'product2.png') {
        //     unlink($upload_dir . $foto_lama);
        // }
    }

    $stmt = $koneksi->prepare("DELETE FROM produk WHERE id_produk = ?");
    $stmt->bind_param("i", $id_produk);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Produk berhasil dihapus.";
    } else {
        $_SESSION['error'] = "Gagal menghapus produk: " . $stmt->error;
    }
}

header("Location: index.php");
exit;
?>
