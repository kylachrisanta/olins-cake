<?php
session_start();
require_once 'koneksi.php';

$kategori_aktif = isset($_GET['kategori']) ? $_GET['kategori'] : 'semua';

// Get categories
$kategori_res = $koneksi->query("SELECT * FROM kategori_produk");

// Get products based on category
$query_produk = "SELECT p.*, k.nama_kategori FROM produk p JOIN kategori_produk k ON p.id_kategori = k.id_kategori";
if ($kategori_aktif !== 'semua') {
    $stmt = $koneksi->prepare($query_produk . " WHERE p.id_kategori = ?");
    $stmt->bind_param("i", $kategori_aktif);
    $stmt->execute();
    $produk_res = $stmt->get_result();
} else {
    $produk_res = $koneksi->query($query_produk);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk - Olin's Cake</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Header -->
    <header class="page-header">
        <div class="container">
            <h1>Katalog Produk</h1>
            <p>Pilih kue favorit Anda untuk menemani setiap momen spesial.</p>
        </div>
    </header>

    <!-- Content -->
    <section class="katalog-page">
        <div class="container">
            
            <!-- Filter Kategori -->
            <div class="kategori-filter">
                <a href="produk.php?kategori=semua" class="kategori-btn <?= $kategori_aktif == 'semua' ? 'active' : '' ?>">Semua Produk</a>
                <?php while ($kat = $kategori_res->fetch_assoc()): ?>
                    <a href="produk.php?kategori=<?= $kat['id_kategori'] ?>" class="kategori-btn <?= $kategori_aktif == $kat['id_kategori'] ? 'active' : '' ?>"><?= htmlspecialchars($kat['nama_kategori']) ?></a>
                <?php endwhile; ?>
            </div>

            <!-- Produk Grid -->
            <div class="produk-grid">
                <?php if ($produk_res->num_rows > 0): ?>
                    <?php while ($row = $produk_res->fetch_assoc()): ?>
                    <div class="produk-card">
                        <img src="assets/images/<?= htmlspecialchars($row['foto_produk'] ?: 'product1.png') ?>" alt="<?= htmlspecialchars($row['nama_produk']) ?>">
                        <div class="produk-info">
                            <h3><?= htmlspecialchars($row['nama_produk']) ?></h3>
                            <p style="font-size: 14px; color: #777; margin-bottom: 15px;"><?= htmlspecialchars($row['nama_kategori']) ?></p>
                            <div class="produk-meta">
                                <span class="price">Rp <?= number_format($row['harga'], 0, ',', '.') ?></span>
                                <span class="rating"><i class="fas fa-star"></i> <?= number_format($row['rating'], 1) ?></span>
                            </div>
                            <div style="display: flex; gap: 10px; margin-top: 15px;">
                                <a href="detail_produk.php?id=<?= $row['id_produk'] ?>" class="btn-outline btn-block" style="flex: 1; margin-top:0;">Detail</a>
                                <form action="proses_keranjang.php" method="POST" style="flex: 1;">
                                    <input type="hidden" name="action" value="add">
                                    <input type="hidden" name="id_produk" value="<?= $row['id_produk'] ?>">
                                    <input type="hidden" name="jumlah" value="1">
                                    <button type="submit" class="btn-primary btn-block" style="margin-top:0; border:none; cursor:pointer;"><i class="fas fa-cart-plus"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="empty-state" style="grid-column: 1 / -1;">
                        <i class="fas fa-box-open"></i>
                        <h3>Tidak Ada Produk</h3>
                        <p>Belum ada produk dalam kategori ini.</p>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </section>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

</body>
</html>
