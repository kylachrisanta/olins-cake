<?php
session_start();
require_once '../konfigurasi/koneksi.php';

if (!isset($_SESSION['status_login_admin']) || $_SESSION['status_login_admin'] !== true) {
    header("Location: ../masuk_admin.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_produk = intval($_POST['id_produk']);
    $nama_produk = $_POST['nama_produk'];
    $id_kategori = intval($_POST['id_kategori']);
    $harga = intval($_POST['harga']);
    $minimal_preorder = intval($_POST['minimal_preorder']);
    $ukuran = $_POST['ukuran'];
    $masa_simpan = $_POST['masa_simpan'];
    $deskripsi = $_POST['deskripsi'];
    $foto_lama = $_POST['foto_lama'];
    
    $foto_produk = $foto_lama;

    // Handle Upload Foto jika ada yang baru
    if (isset($_FILES['foto_produk']) && $_FILES['foto_produk']['error'] === 0) {
        $file_tmp = $_FILES['foto_produk']['tmp_name'];
        $file_name = $_FILES['foto_produk']['name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        $allowed_ext = ['jpg', 'jpeg', 'png'];
        if (in_array($file_ext, $allowed_ext)) {
            $new_filename = uniqid('prod_') . '.' . $file_ext;
            $upload_dir = '../../assets/images/';
            
            if (move_uploaded_file($file_tmp, $upload_dir . $new_filename)) {
                $foto_produk = $new_filename;
                // Opsional: Hapus file foto lama jika bukan file default
                // if ($foto_lama && file_exists($upload_dir . $foto_lama) && $foto_lama !== 'product1.png' && $foto_lama !== 'product2.png') {
                //    unlink($upload_dir . $foto_lama);
                // }
            } else {
                $_SESSION['error'] = "Gagal mengunggah foto.";
                header("Location: edit.php?id=$id_produk");
                exit;
            }
        } else {
            $_SESSION['error'] = "Format foto tidak didukung.";
            header("Location: edit.php?id=$id_produk");
            exit;
        }
    }

    $stmt = $koneksi->prepare("UPDATE produk SET id_kategori=?, nama_produk=?, deskripsi=?, harga=?, ukuran=?, masa_simpan=?, minimal_preorder=?, foto_produk=? WHERE id_produk=?");
    $stmt->bind_param("ississisi", $id_kategori, $nama_produk, $deskripsi, $harga, $ukuran, $masa_simpan, $minimal_preorder, $foto_produk, $id_produk);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Produk berhasil diperbarui.";
    } else {
        $_SESSION['error'] = "Gagal memperbarui produk: " . $stmt->error;
    }
}

header("Location: index.php");
exit;
?>
