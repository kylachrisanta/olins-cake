<?php
require_once 'koneksi.php';

$queries = [
    "CREATE TABLE IF NOT EXISTS kategori_produk (
        id_kategori INT AUTO_INCREMENT PRIMARY KEY,
        nama_kategori VARCHAR(50) NOT NULL
    )",
    "CREATE TABLE IF NOT EXISTS produk (
        id_produk INT AUTO_INCREMENT PRIMARY KEY,
        id_kategori INT NOT NULL,
        nama_produk VARCHAR(100) NOT NULL,
        deskripsi TEXT,
        harga INT NOT NULL,
        ukuran VARCHAR(50),
        masa_simpan VARCHAR(50),
        minimal_preorder INT DEFAULT 2,
        foto_produk VARCHAR(255),
        rating DECIMAL(2,1) DEFAULT 0,
        FOREIGN KEY (id_kategori) REFERENCES kategori_produk(id_kategori) ON DELETE CASCADE
    )",
    "CREATE TABLE IF NOT EXISTS keranjang (
        id_keranjang INT AUTO_INCREMENT PRIMARY KEY,
        id_pelanggan INT NOT NULL,
        id_produk INT NOT NULL,
        jumlah INT NOT NULL DEFAULT 1,
        dipilih TINYINT(1) DEFAULT 1,
        FOREIGN KEY (id_pelanggan) REFERENCES pelanggan(id_pelanggan) ON DELETE CASCADE,
        FOREIGN KEY (id_produk) REFERENCES produk(id_produk) ON DELETE CASCADE
    )",
    "CREATE TABLE IF NOT EXISTS pesanan (
        id_pesanan INT AUTO_INCREMENT PRIMARY KEY,
        id_pelanggan INT NOT NULL,
        tanggal_pesan DATETIME DEFAULT CURRENT_TIMESTAMP,
        nama_penerima VARCHAR(100) NOT NULL,
        nomor_whatsapp VARCHAR(20) NOT NULL,
        alamat_lengkap TEXT NOT NULL,
        titik_koordinat VARCHAR(100),
        jarak_km DECIMAL(5,2),
        metode_pengiriman ENUM('Kirim', 'Ambil Sendiri') NOT NULL,
        tanggal_pengiriman DATE NOT NULL,
        waktu_pengiriman ENUM('08.00 - 13.00', '13.00 - 17.00', '17.00 - 21.00') NOT NULL,
        total_harga_produk INT NOT NULL,
        biaya_ongkir INT NOT NULL,
        total_bayar INT NOT NULL,
        status_pesanan ENUM('Menunggu Verifikasi', 'Diproses', 'Dikirim', 'Selesai', 'Dibatalkan') DEFAULT 'Menunggu Verifikasi',
        FOREIGN KEY (id_pelanggan) REFERENCES pelanggan(id_pelanggan) ON DELETE CASCADE
    )",
    "CREATE TABLE IF NOT EXISTS detail_pesanan (
        id_detail INT AUTO_INCREMENT PRIMARY KEY,
        id_pesanan INT NOT NULL,
        id_produk INT NOT NULL,
        jumlah INT NOT NULL,
        harga_satuan INT NOT NULL,
        FOREIGN KEY (id_pesanan) REFERENCES pesanan(id_pesanan) ON DELETE CASCADE,
        FOREIGN KEY (id_produk) REFERENCES produk(id_produk) ON DELETE CASCADE
    )",
    "CREATE TABLE IF NOT EXISTS pembayaran (
        id_pembayaran INT AUTO_INCREMENT PRIMARY KEY,
        id_pesanan INT NOT NULL,
        metode_pembayaran ENUM('Transfer Bank', 'QRIS') NOT NULL,
        bukti_pembayaran VARCHAR(255) NOT NULL,
        waktu_pembayaran DATETIME DEFAULT CURRENT_TIMESTAMP,
        status_pembayaran ENUM('Menunggu Verifikasi', 'Valid', 'Tidak Valid') DEFAULT 'Menunggu Verifikasi',
        FOREIGN KEY (id_pesanan) REFERENCES pesanan(id_pesanan) ON DELETE CASCADE
    )"
];

foreach ($queries as $query) {
    if (!$koneksi->query($query)) {
        echo "Error: " . $koneksi->error . "\n";
    }
}

$res = $koneksi->query("SELECT COUNT(*) as count FROM kategori_produk");
$row = $res->fetch_assoc();
if ($row['count'] == 0) {
    $koneksi->query("INSERT INTO kategori_produk (nama_kategori) VALUES ('Bolu'), ('Kue Basah'), ('Kue Kering')");
    
    $koneksi->query("INSERT INTO produk (id_kategori, nama_produk, deskripsi, harga, ukuran, masa_simpan, foto_produk, rating) VALUES 
    (1, 'Bolu Jadul Moka', 'Bolu lembut dengan rasa moka klasik dan taburan meises.', 70000, '20x20 cm', '3 hari di suhu ruang', 'product2.png', 4.7),
    (1, 'Lapis Legit Spesial', 'Lapis legit premium dengan full butter.', 250000, '20x20 cm', '7 hari di suhu dingin', 'product1.png', 5.0),
    (3, 'Nastar Keju Premium', 'Nastar lumer dengan isian selai nanas asli.', 120000, 'Toples 500gr', '1 bulan', 'product2.png', 5.0),
    (3, 'Kaastengels Renyah', 'Kastengel keju edam premium yang gurih dan renyah.', 115000, 'Toples 500gr', '1 bulan', 'product1.png', 4.8),
    (3, 'Putri Salju Mede', 'Kue putri salju dengan kacang mede pilihan.', 110000, 'Toples 500gr', '1 bulan', 'product2.png', 4.9),
    (1, 'Fudgy Brownies', 'Brownies coklat padat dengan topping almond dan chocochip.', 85000, '20x20 cm', '5 hari di suhu ruang', 'product1.png', 4.9)
    ");
    echo "Dummy data inserted.\n";
} else {
    echo "Dummy data already exists.\n";
}

echo "Database setup complete.\n";
?>
