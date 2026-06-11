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

$id_produk = intval($_GET['id']);
$stmt = $koneksi->prepare("SELECT * FROM produk WHERE id_produk = ?");
$stmt->bind_param("i", $id_produk);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: index.php");
    exit;
}

$produk = $result->fetch_assoc();
$nama_admin = $_SESSION['nama_admin'];

$kategori_res = $koneksi->query("SELECT * FROM kategori_produk");
?>
<?php include '../bagian/header.php'; ?>
<?php include '../bagian/sidebar.php'; ?>

<div class="main-content">
    <?php include '../bagian/topbar.php'; ?>

    <div class="page-content">
        <?php 
        $breadcrumbs = [
            'Data Produk' => 'index.php',
            'Edit Produk' => ''
        ];
        include '../bagian/breadcrumb.php'; 
        ?>
        
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 25px;">
            <h1 class="page-title" style="margin-bottom:0;">Edit Produk</h1>
            <a href="index.php" class="btn-admin" style="width:auto; padding:10px 20px; background:#7f8c8d;"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>

        <div style="background:white; border-radius:10px; box-shadow:0 5px 15px rgba(0,0,0,0.05); padding: 30px; max-width: 800px;">
            <form action="proses_edit.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_produk" value="<?= $produk['id_produk'] ?>">
                <input type="hidden" name="foto_lama" value="<?= $produk['foto_produk'] ?>">
                
                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:20px;">
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" required value="<?= htmlspecialchars($produk['nama_produk']) ?>">
                    </div>
                    
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="id_kategori" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php while($k = $kategori_res->fetch_assoc()): ?>
                                <option value="<?= $k['id_kategori'] ?>" <?= $k['id_kategori'] == $produk['id_kategori'] ? 'selected' : '' ?>><?= htmlspecialchars($k['nama_kategori']) ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Harga (Rp)</label>
                        <input type="number" name="harga" class="form-control" required min="0" value="<?= $produk['harga'] ?>">
                    </div>

                    <div class="form-group">
                        <label>Minimal Pre-Order (Hari)</label>
                        <input type="number" name="minimal_preorder" class="form-control" required min="1" value="<?= $produk['minimal_preorder'] ?>">
                    </div>

                    <div class="form-group">
                        <label>Ukuran</label>
                        <input type="text" name="ukuran" class="form-control" required value="<?= htmlspecialchars($produk['ukuran']) ?>">
                    </div>

                    <div class="form-group">
                        <label>Masa Simpan</label>
                        <input type="text" name="masa_simpan" class="form-control" required value="<?= htmlspecialchars($produk['masa_simpan']) ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4" required><?= htmlspecialchars($produk['deskripsi']) ?></textarea>
                </div>

                <div class="form-group">
                    <label>Foto Produk (Opsional)</label>
                    <br>
                    <?php if ($produk['foto_produk']): ?>
                        <img src="../../assets/images/<?= $produk['foto_produk'] ?>" alt="Foto Lama" style="max-width:100px; margin-bottom:10px; border-radius:5px;">
                    <?php endif; ?>
                    <input type="file" name="foto_produk" class="form-control" accept="image/*">
                    <small style="color:#666;">Biarkan kosong jika tidak ingin mengubah foto.</small>
                </div>

                <button type="submit" class="btn-admin" style="margin-top:20px;"><i class="fas fa-save"></i> Perbarui Produk</button>
            </form>
        </div>
    </div>
</div>

<?php include '../bagian/footer.php'; ?>
