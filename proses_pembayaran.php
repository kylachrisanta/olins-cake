<?php
session_start();
require_once 'koneksi.php';

if (!isset($_SESSION['id_pelanggan']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: auth/masuk.php");
    exit;
}

$id_pelanggan = $_SESSION['id_pelanggan'];

$nama_penerima = $_POST['nama_penerima'];
$nomor_whatsapp = $_POST['nomor_whatsapp'];
$alamat_lengkap = $_POST['alamat_lengkap'];
$titik_koordinat = $_POST['titik_koordinat'];
$jarak_km = floatval($_POST['jarak_km']);

$metode_pengiriman = $_POST['metode_pengiriman'];
$tanggal_pengiriman = $_POST['tanggal_pengiriman'];
$waktu_pengiriman = $_POST['waktu_pengiriman'];

$subtotal = intval($_POST['subtotal']);
$biaya_ongkir = intval($_POST['biaya_ongkir']);
$total_bayar = $subtotal + $biaya_ongkir;

if ($metode_pengiriman === 'Kirim' && $jarak_km > 20) {
    $_SESSION['error'] = "Alamat melebihi jarak maksimal pengiriman (20km).";
    header("Location: pembayaran.php");
    exit;
}

$min_date = date('Y-m-d', strtotime('+3 days'));
if ($tanggal_pengiriman < $min_date) {
    $_SESSION['error'] = "Tanggal pengiriman minimal H-3 dari hari ini.";
    header("Location: pembayaran.php");
    exit;
}

$metode_pembayaran = $_POST['metode_pembayaran'];
$upload_dir = 'assets/uploads/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

$file_name = $_FILES['bukti_pembayaran']['name'];
$file_tmp = $_FILES['bukti_pembayaran']['tmp_name'];
$file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
$allowed_ext = ['jpg', 'jpeg', 'png', 'pdf'];

if (!in_array($file_ext, $allowed_ext)) {
    $_SESSION['error'] = "Format file tidak didukung. Gunakan JPG, PNG, atau PDF.";
    header("Location: pembayaran.php");
    exit;
}

$new_filename = uniqid('bukti_') . '.' . $file_ext;
$dest_path = $upload_dir . $new_filename;

if (move_uploaded_file($file_tmp, $dest_path)) {
    
    $koneksi->begin_transaction();
    
    try {
        $stmt_pesanan = $koneksi->prepare("INSERT INTO pesanan (id_pelanggan, nama_penerima, nomor_whatsapp, alamat_lengkap, titik_koordinat, jarak_km, metode_pengiriman, tanggal_pengiriman, waktu_pengiriman, total_harga_produk, biaya_ongkir, total_bayar, status_pesanan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Menunggu Verifikasi')");
        
        $stmt_pesanan->bind_param("issssddsssii", $id_pelanggan, $nama_penerima, $nomor_whatsapp, $alamat_lengkap, $titik_koordinat, $jarak_km, $metode_pengiriman, $tanggal_pengiriman, $waktu_pengiriman, $subtotal, $biaya_ongkir, $total_bayar);
        
        $stmt_pesanan->execute();
        $id_pesanan = $koneksi->insert_id;
        
        $stmt_bayar = $koneksi->prepare("INSERT INTO pembayaran (id_pesanan, metode_pembayaran, bukti_pembayaran, status_pembayaran) VALUES (?, ?, ?, 'Menunggu Verifikasi')");
        $stmt_bayar->bind_param("iss", $id_pesanan, $metode_pembayaran, $new_filename);
        $stmt_bayar->execute();
        
        $stmt_cart = $koneksi->prepare("SELECT k.id_keranjang, k.id_produk, k.jumlah, p.harga FROM keranjang k JOIN produk p ON k.id_produk = p.id_produk WHERE k.id_pelanggan = ? AND k.dipilih = 1");
        $stmt_cart->bind_param("i", $id_pelanggan);
        $stmt_cart->execute();
        $cart_res = $stmt_cart->get_result();
        
        $stmt_detail = $koneksi->prepare("INSERT INTO detail_pesanan (id_pesanan, id_produk, jumlah, harga_satuan) VALUES (?, ?, ?, ?)");
        
        $ids_to_delete = [];
        while ($row = $cart_res->fetch_assoc()) {
            $stmt_detail->bind_param("iiii", $id_pesanan, $row['id_produk'], $row['jumlah'], $row['harga']);
            $stmt_detail->execute();
            $ids_to_delete[] = $row['id_keranjang'];
        }
        
        if (count($ids_to_delete) > 0) {
            $placeholders = implode(',', array_fill(0, count($ids_to_delete), '?'));
            $types = str_repeat('i', count($ids_to_delete));
            $stmt_del = $koneksi->prepare("DELETE FROM keranjang WHERE id_keranjang IN ($placeholders)");
            $stmt_del->bind_param($types, ...$ids_to_delete);
            $stmt_del->execute();
        }

        $koneksi->commit();
        $_SESSION['success'] = "Pesanan berhasil dibuat dan sedang menunggu verifikasi admin.";
        header("Location: pesanan_saya.php");
        exit;
        
    } catch (Exception $e) {
        $koneksi->rollback();
        $_SESSION['error'] = "Terjadi kesalahan: " . $e->getMessage();
        header("Location: pembayaran.php");
        exit;
    }
    
} else {
    $_SESSION['error'] = "Gagal mengunggah bukti pembayaran.";
    header("Location: pembayaran.php");
    exit;
}
?>

