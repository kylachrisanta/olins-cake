<?php
session_start();
require_once 'konfigurasi/koneksi.php';

// Validasi Session Admin
if (!isset($_SESSION['status_login_admin']) || $_SESSION['status_login_admin'] !== true) {
    header("Location: masuk_admin.php");
    exit;
}

$nama_admin = $_SESSION['nama_admin'];

// Query Statistik
// 1. Total Produk
$res_produk = $koneksi->query("SELECT COUNT(*) as total FROM produk");
$total_produk = $res_produk->fetch_assoc()['total'];

// 2. Total Pesanan
$res_pesanan = $koneksi->query("SELECT COUNT(*) as total FROM pesanan");
$total_pesanan = $res_pesanan->fetch_assoc()['total'];

// 3. Total Pelanggan
$res_pelanggan = $koneksi->query("SELECT COUNT(*) as total FROM pelanggan");
$total_pelanggan = $res_pelanggan->fetch_assoc()['total'];
?>

<?php include 'bagian/header.php'; ?>

    <?php include 'bagian/sidebar.php'; ?>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-user">
                <i class="fas fa-user-circle" style="margin-right:5px; font-size:18px; color:var(--admin-accent);"></i> 
                <?= htmlspecialchars($nama_admin) ?>
            </div>
        </div>

        <div class="page-content">
            <h1 class="page-title">Selamat Datang, <?= htmlspecialchars($nama_admin) ?></h1>
            
            <div class="card-grid">
                <!-- Card Total Produk -->
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Total Produk</h3>
                        <div class="h2"><?= number_format($total_produk, 0, ',', '.') ?></div>
                    </div>
                </div>

                <!-- Card Total Pesanan -->
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Total Pesanan</h3>
                        <div class="h2"><?= number_format($total_pesanan, 0, ',', '.') ?></div>
                    </div>
                </div>

                <!-- Card Total Pelanggan -->
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Total Pelanggan</h3>
                        <div class="h2"><?= number_format($total_pelanggan, 0, ',', '.') ?></div>
                    </div>
                </div>
            </div>

            <!-- Area untuk tabel terbaru dsb bisa ditambahkan di bawah sini nanti -->
            <div style="background:white; padding:30px; border-radius:10px; box-shadow:0 5px 15px rgba(0,0,0,0.05);">
                <h3 style="margin-bottom:15px; color:var(--admin-primary);"><i class="fas fa-info-circle"></i> Informasi Sistem</h3>
                <p style="color:#666; line-height:1.6;">Selamat datang di Control Panel Olin's Cake. Gunakan menu navigasi di sebelah kiri untuk mengelola katalog produk, memproses pesanan yang masuk, serta melihat daftar pelanggan Anda.</p>
            </div>
        </div>
    </div>

<?php include 'bagian/footer.php'; ?>
