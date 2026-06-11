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
    <div class="topbar">
        <div class="topbar-user">
            <i class="fas fa-user-circle" style="margin-right:5px; color:var(--admin-accent);"></i> 
            <?= htmlspecialchars($nama_admin) ?>
        </div>
    </div>

    <div class="page-content">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 25px;">
            <h1 class="page-title" style="margin-bottom:0;">Tambah Kategori</h1>
            <a href="index.php" class="btn-admin" style="width:auto; padding:10px 20px; background:#7f8c8d;"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>

        <div style="background:white; border-radius:10px; box-shadow:0 5px 15px rgba(0,0,0,0.05); padding: 30px; max-width: 600px;">
            <form action="proses_tambah.php" method="POST">
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" name="nama_kategori" class="form-control" required placeholder="Contoh: Kue Kering Spesial">
                </div>
                <button type="submit" class="btn-admin"><i class="fas fa-save"></i> Simpan Kategori</button>
            </form>
        </div>
    </div>
</div>

<?php include '../bagian/footer.php'; ?>
