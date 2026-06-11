<?php
session_start();
require_once '../konfigurasi/koneksi.php';

if (!isset($_SESSION['status_login_admin']) || $_SESSION['status_login_admin'] !== true) {
    header("Location: ../masuk_admin.php");
    exit;
}

$nama_admin = $_SESSION['nama_admin'];

$kategori_res = $koneksi->query("SELECT * FROM kategori_produk ORDER BY id_kategori DESC");
?>
<?php include '../bagian/header.php'; ?>
<?php include '../bagian/sidebar.php'; ?>

<div class="main-content">
    <?php 
    $breadcrumbs = [
        'Data Kategori' => ''
    ];
    include '../bagian/topbar.php'; 
    ?>

    <div class="page-content">
        <?php include '../bagian/breadcrumb.php'; ?>
        
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 25px;">
            <h1 class="page-title" style="margin-bottom:0;">Data Kategori</h1>
            <a href="tambah.php" class="btn-admin" style="width:auto; padding:10px 20px;"><i class="fas fa-plus"></i> Tambah Kategori</a>
        </div>

        <div style="background:white; border-radius:10px; box-shadow:0 5px 15px rgba(0,0,0,0.05); overflow:hidden;">
            <table style="width:100%; border-collapse:collapse; text-align:left;">
                <thead style="background:var(--admin-primary); color:white;">
                    <tr>
                        <th style="padding:15px 20px; width:50px;">No</th>
                        <th style="padding:15px 20px;">Nama Kategori</th>
                        <th style="padding:15px 20px; width:200px; text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($kategori_res->num_rows > 0): ?>
                        <?php $no = 1; while($row = $kategori_res->fetch_assoc()): ?>
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding:15px 20px;"><?= $no++ ?></td>
                            <td style="padding:15px 20px; font-weight:500;"><?= htmlspecialchars($row['nama_kategori']) ?></td>
                            <td style="padding:15px 20px; text-align:center;">
                                <a href="edit.php?id=<?= $row['id_kategori'] ?>" class="btn-admin" style="background:#f39c12; padding:8px 15px; font-size:14px; text-decoration:none; display:inline-block; margin-right:5px;"><i class="fas fa-edit"></i> Edit</a>
                                <a href="proses_hapus.php?id=<?= $row['id_kategori'] ?>" class="btn-admin btn-delete" data-text="Kategori ini akan dihapus secara permanen!" style="background:#e74c3c; padding:8px 15px; font-size:14px; text-decoration:none; display:inline-block;"><i class="fas fa-trash-alt"></i> Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" style="padding:30px; text-align:center; color:#777;">Belum ada data kategori.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../bagian/footer.php'; ?>
