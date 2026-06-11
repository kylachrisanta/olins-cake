<?php
session_start();
require_once 'konfigurasi/koneksi.php';

if (!isset($_SESSION['status_login_admin']) || $_SESSION['status_login_admin'] !== true) {
    header("Location: masuk_admin.php");
    exit;
}

$nama_admin = $_SESSION['nama_admin'];

$res_produk = $koneksi->query("SELECT COUNT(*) as total FROM produk");
$total_produk = $res_produk->fetch_assoc()['total'];

$res_pesanan = $koneksi->query("SELECT COUNT(*) as total FROM pesanan");
$total_pesanan = $res_pesanan->fetch_assoc()['total'];

$res_pelanggan = $koneksi->query("SELECT COUNT(*) as total FROM pelanggan");
$total_pelanggan = $res_pelanggan->fetch_assoc()['total'];
?>

<?php include 'bagian/header.php'; ?>

    <?php include 'bagian/sidebar.php'; ?>

    <div class="main-content">
        <?php 
        $breadcrumbs = [
            'Dashboard' => ''
        ];
        include 'bagian/topbar.php'; 
        ?>

        <div class="page-content">
            <?php include 'bagian/breadcrumb.php'; ?>
            
            <div style="background: linear-gradient(135deg, var(--admin-primary), var(--admin-accent)); color: white; border-radius: 16px; padding: 30px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 10px 30px rgba(68, 45, 28, 0.2); position: relative; overflow: hidden; flex-wrap: wrap; gap: 20px;">
                <div style="position: absolute; right: -5%; top: -50%; width: 300px; height: 300px; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%); border-radius: 50%;"></div>
                
                <div style="position: relative; z-index: 1; flex: 1; min-width: 280px;">
                    <h1 style="margin-top: 0; margin-bottom: 8px; font-size: 28px; font-weight: 700; display: flex; align-items: center; gap: 10px;">
                        Selamat Datang, <?= htmlspecialchars($nama_admin) ?>! <span style="font-size: 24px;">👋</span>
                    </h1>
                    <p style="margin: 0; font-size: 15px; color: rgba(255,255,255,0.85); line-height: 1.5; max-width: 550px;">
                        Semoga hari Anda menyenangkan! Pantau terus perkembangan penjualan, data produk, dan aktivitas pelanggan Olin's Cake hari ini.
                    </p>
                </div>
                
                <div style="position: relative; z-index: 1; background: rgba(255,255,255,0.15); padding: 15px 25px; border-radius: 12px; text-align: center; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); min-width: 200px;">
                    <div id="realtime-clock" style="font-size: 28px; font-weight: 700; letter-spacing: 2px; margin-bottom: 5px; text-shadow: 0 2px 4px rgba(0,0,0,0.1); font-family: monospace;">00:00:00</div>
                    <div id="realtime-date" style="font-size: 13px; font-weight: 500; color: rgba(255,255,255,0.9); text-transform: capitalize;">Memuat tanggal...</div>
                </div>
            </div>

            <script>
            function updateTime() {
                const now = new Date();
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');
                document.getElementById('realtime-clock').textContent = hours + ':' + minutes + ':' + seconds;
                
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                document.getElementById('realtime-date').textContent = now.toLocaleDateString('id-ID', options);
            }
            setInterval(updateTime, 1000);
            updateTime();
            </script>
            <div class="card-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Total Produk</h3>
                        <div class="h2"><?= number_format($total_produk, 0, ',', '.') ?></div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Total Pesanan</h3>
                        <div class="h2"><?= number_format($total_pesanan, 0, ',', '.') ?></div>
                    </div>
                </div>

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

            <div style="background:white; padding:30px; border-radius:10px; box-shadow:0 5px 15px rgba(0,0,0,0.05);">
                <h3 style="margin-bottom:15px; color:var(--admin-primary);"><i class="fas fa-info-circle"></i> Informasi Sistem</h3>
                <p style="color:#666; line-height:1.6;">Selamat datang di Control Panel Olin's Cake. Gunakan menu navigasi di sebelah kiri untuk mengelola katalog produk, memproses pesanan yang masuk, serta melihat daftar pelanggan Anda.</p>
            </div>
        </div>
    </div>

<?php include 'bagian/footer.php'; ?>

