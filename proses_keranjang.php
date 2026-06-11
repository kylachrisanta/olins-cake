<?php
session_start();
require_once 'koneksi.php';

// Cek login
if (!isset($_SESSION['id_pelanggan'])) {
    if (isset($_POST['is_ajax'])) {
        echo json_encode(['status' => 'error', 'message' => 'Silakan login terlebih dahulu.']);
        exit;
    }
    $_SESSION['error'] = "Silakan login untuk menambahkan produk ke keranjang.";
    header("Location: auth/masuk.php");
    exit;
}

$id_pelanggan = $_SESSION['id_pelanggan'];
$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action === 'add') {
    $id_produk = intval($_POST['id_produk']);
    $jumlah = intval($_POST['jumlah']);
    
    if ($jumlah < 1) $jumlah = 1;
    
    // Cek apakah item sudah ada di keranjang
    $stmt_check = $koneksi->prepare("SELECT id_keranjang, jumlah FROM keranjang WHERE id_pelanggan = ? AND id_produk = ?");
    $stmt_check->bind_param("ii", $id_pelanggan, $id_produk);
    $stmt_check->execute();
    $res = $stmt_check->get_result();
    
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $new_jumlah = $row['jumlah'] + $jumlah;
        $id_keranjang = $row['id_keranjang'];
        
        $stmt_update = $koneksi->prepare("UPDATE keranjang SET jumlah = ?, dipilih = 1 WHERE id_keranjang = ?");
        $stmt_update->bind_param("ii", $new_jumlah, $id_keranjang);
        $stmt_update->execute();
    } else {
        $stmt_insert = $koneksi->prepare("INSERT INTO keranjang (id_pelanggan, id_produk, jumlah, dipilih) VALUES (?, ?, ?, 1)");
        $stmt_insert->bind_param("iii", $id_pelanggan, $id_produk, $jumlah);
        $stmt_insert->execute();
    }
    
    $_SESSION['success'] = "Produk berhasil ditambahkan ke keranjang.";
    header("Location: keranjang.php");
    exit;

} elseif ($action === 'update_qty') {
    // Dipanggil via AJAX
    $id_keranjang = intval($_POST['id_keranjang']);
    $jumlah = intval($_POST['jumlah']);
    
    if ($jumlah < 1) $jumlah = 1;
    
    $stmt = $koneksi->prepare("UPDATE keranjang SET jumlah = ? WHERE id_keranjang = ? AND id_pelanggan = ?");
    $stmt->bind_param("iii", $jumlah, $id_keranjang, $id_pelanggan);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal mengupdate jumlah.']);
    }
    exit;

} elseif ($action === 'update_select') {
    // Dipanggil via AJAX
    $id_keranjang = intval($_POST['id_keranjang']);
    $dipilih = intval($_POST['dipilih']) ? 1 : 0;
    
    $stmt = $koneksi->prepare("UPDATE keranjang SET dipilih = ? WHERE id_keranjang = ? AND id_pelanggan = ?");
    $stmt->bind_param("iii", $dipilih, $id_keranjang, $id_pelanggan);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal mengupdate pilihan.']);
    }
    exit;

} elseif ($action === 'delete') {
    $id_keranjang = intval($_POST['id_keranjang']);
    $stmt = $koneksi->prepare("DELETE FROM keranjang WHERE id_keranjang = ? AND id_pelanggan = ?");
    $stmt->bind_param("ii", $id_keranjang, $id_pelanggan);
    $stmt->execute();
    
    $_SESSION['success'] = "Produk dihapus dari keranjang.";
    header("Location: keranjang.php");
    exit;
}

header("Location: produk.php");
exit;
?>
