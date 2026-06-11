<?php
session_start();
require_once '../konfigurasi/koneksi.php';

if (!isset($_SESSION['status_login_admin']) || $_SESSION['status_login_admin'] !== true) {
    header("Location: ../masuk_admin.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_produk = $_POST['nama_produk'];
    $id_kategori = intval($_POST['id_kategori']);
    $harga = intval($_POST['harga']);
    $minimal_preorder = intval($_POST['minimal_preorder']);
    $ukuran = $_POST['ukuran'];
    $masa_simpan = $_POST['masa_simpan'];
    $deskripsi = $_POST['deskripsi'];

    $foto_produk = '';
    if (isset($_FILES['foto_produk']) && $_FILES['foto_produk']['error'] === 0) {
        $file_tmp = $_FILES['foto_produk']['tmp_name'];
        $file_name = $_FILES['foto_produk']['name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        $allowed_ext = ['jpg', 'jpeg', 'png'];
        if (in_array($file_ext, $allowed_ext)) {
            $new_filename = uniqid('prod_') . '.' . $file_ext;
            $upload_dir = '../../assets/images/';
            
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            if (move_uploaded_file($file_tmp, $upload_dir . $new_filename)) {
                $foto_produk = $new_filename;
            } else {
                $_SESSION['error'] = "Gagal mengunggah foto.";
                header("Location: tambah.php");
                exit;
            }
        } else {
            $_SESSION['error'] = "Format foto tidak didukung.";
            header("Location: tambah.php");
            exit;
        }
    }

    $stmt = $koneksi->prepare("INSERT INTO produk (id_kategori, nama_produk, deskripsi, harga, ukuran, masa_simpan, minimal_preorder, foto_produk) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ississis", $id_kategori, $nama_produk, $deskripsi, $harga, $ukuran, $masa_simpan, $minimal_preorder, $foto_produk);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Produk berhasil ditambahkan.";
    } else {
        $_SESSION['error'] = "Gagal menyimpan produk: " . $stmt->error;
    }
}

header("Location: index.php");
exit;
?>
