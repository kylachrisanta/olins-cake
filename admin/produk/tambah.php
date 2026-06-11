<?php
session_start();
require_once '../konfigurasi/koneksi.php';

if (!isset($_SESSION['status_login_admin']) || $_SESSION['status_login_admin'] !== true) {
    header("Location: ../masuk_admin.php");
    exit;
}

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
            'Tambah Produk' => ''
        ];
        include '../bagian/breadcrumb.php'; 
        ?>
        
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 25px;">
            <h1 class="page-title" style="margin-bottom:0;">Tambah Produk</h1>
            <a href="index.php" class="btn-admin" style="width:auto; padding:10px 20px; background:#7f8c8d;"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>

        <div style="background:white; border-radius:10px; box-shadow:0 5px 15px rgba(0,0,0,0.05); padding: 30px; max-width: 800px;">
            <form action="proses_tambah.php" method="POST" enctype="multipart/form-data">
                
                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:20px;">
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="id_kategori" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php while($k = $kategori_res->fetch_assoc()): ?>
                                <option value="<?= $k['id_kategori'] ?>"><?= htmlspecialchars($k['nama_kategori']) ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Harga (Rp)</label>
                        <input type="number" name="harga" class="form-control" required min="0">
                    </div>

                    <div class="form-group">
                        <label>Minimal Pre-Order (Hari)</label>
                        <input type="number" name="minimal_preorder" class="form-control" required min="1" value="2">
                    </div>

                    <div class="form-group">
                        <label>Ukuran</label>
                        <input type="text" name="ukuran" class="form-control" required placeholder="Contoh: 20x20 cm">
                    </div>

                    <div class="form-group">
                        <label>Masa Simpan</label>
                        <input type="text" name="masa_simpan" class="form-control" required placeholder="Contoh: 5 hari di suhu ruang">
                    </div>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label>Foto Produk</label>
                    <input type="file" name="foto_produk" class="form-control" accept="image/*" required>
                    <small style="color:#666;">Format yang didukung: JPG, JPEG, PNG. Maks: 2MB.</small>
                </div>

                <button type="submit" class="btn-admin" style="margin-top:20px;"><i class="fas fa-save"></i> Simpan Produk</button>
            </form>
        </div>
    </div>
</div>

<?php include '../bagian/footer.php'; ?>
