<?php
session_start();
require_once '../konfigurasi/koneksi.php';

if (!isset($_SESSION['status_login_admin']) || $_SESSION['status_login_admin'] !== true) {
    header("Location: ../masuk_admin.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id_kategori = intval($_GET['id']);
$stmt = $koneksi->prepare("SELECT * FROM kategori_produk WHERE id_kategori = ?");
$stmt->bind_param("i", $id_kategori);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: index.php");
    exit;
}

$kategori = $result->fetch_assoc();
$nama_admin = $_SESSION['nama_admin'];
?>
<?php include '../bagian/header.php'; ?>
<?php include '../bagian/sidebar.php'; ?>

<div class="main-content">
    <?php include '../bagian/topbar.php'; ?>

    <div class="page-content">
        <?php 
        $breadcrumbs = [
            'Data Kategori' => 'index.php',
            'Edit Kategori' => ''
        ];
        include '../bagian/breadcrumb.php'; 
        ?>
        
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 25px;">
            <h1 class="page-title" style="margin-bottom:0;">Edit Kategori</h1>
            <a href="index.php" class="btn-admin" style="width:auto; padding:10px 20px; background:#7f8c8d;"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>

        <div style="background:white; border-radius:10px; box-shadow:0 5px 15px rgba(0,0,0,0.05); padding: 30px; max-width: 600px;">
            <form action="proses_edit.php" method="POST">
                <input type="hidden" name="id_kategori" value="<?= $kategori['id_kategori'] ?>">
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" name="nama_kategori" class="form-control" required value="<?= htmlspecialchars($kategori['nama_kategori']) ?>">
                </div>
                <button type="submit" class="btn-admin"><i class="fas fa-save"></i> Perbarui Kategori</button>
            </form>
        </div>
    </div>
</div>

<?php include '../bagian/footer.php'; ?>
