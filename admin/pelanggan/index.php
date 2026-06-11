<?php
session_start();
require_once '../konfigurasi/koneksi.php';

if (!isset($_SESSION['status_login_admin']) || $_SESSION['status_login_admin'] !== true) {
    header("Location: ../masuk_admin.php");
    exit;
}

$nama_admin = $_SESSION['nama_admin'];
?>
<?php include '../bagian/header.php'; ?>
<?php include '../bagian/sidebar.php'; ?>

<div class="main-content">
    <?php 
    $breadcrumbs = [
        'Data Pelanggan' => ''
    ];
    include '../bagian/topbar.php'; 
    ?>

    <div class="page-content">
        <?php include '../bagian/breadcrumb.php'; ?>
        
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 25px;">
            <h1 class="page-title" style="margin-bottom:0;">Data Pelanggan</h1>
        </div>

        <div style="background:white; padding:50px; border-radius:10px; box-shadow:0 5px 15px rgba(0,0,0,0.05); text-align:center;">
            <i class="fas fa-users" style="font-size: 48px; color: #cbd5e1; margin-bottom: 15px;"></i>
            <h3 style="color: #475569; margin-bottom: 10px;">Fitur Dalam Pengembangan</h3>
            <p style="color: #94a3b8; line-height:1.6;">Halaman manajemen pelanggan sudah disiapkan templatenya.<br>Anda dapat memuat data pelanggan dari database Anda di sini nanti.</p>
        </div>
    </div>
</div>

<?php include '../bagian/footer.php'; ?>
