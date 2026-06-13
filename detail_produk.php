<?php
session_start();
require_once 'koneksi.php';

if (!isset($_SESSION['id_pelanggan'])) {
    header("Location: auth/masuk.php");
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: produk.php");
    exit;
}

$id_produk = intval($_GET['id']);
$stmt = $koneksi->prepare("SELECT p.*, k.nama_kategori FROM produk p JOIN kategori_produk k ON p.id_kategori = k.id_kategori WHERE p.id_produk = ?");
$stmt->bind_param("i", $id_produk);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: produk.php");
    exit;
}

$produk = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($produk['nama_produk']) ?> - Olin's Cake</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Antonio:wght@100..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <?php include 'includes/navbar.php'; ?>

    <header class="page-header" style="padding-top: 100px; padding-bottom: 40px;">
        <div class="container">
            <h1 style="font-size: 32px;">Detail Produk</h1>
        </div>
    </header>

    <section class="detail-page">
        <div class="container">
            
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <?= $_SESSION['success'] ?>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>
            
            <div class="detail-grid">
                <div>
                    <img src="assets/images/<?= htmlspecialchars($produk['foto_produk'] ?: 'product1.png') ?>" alt="<?= htmlspecialchars($produk['nama_produk']) ?>" class="detail-img">
                </div>
                
                <div class="detail-info">
                    <p style="color: var(--support-color); font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px;"><?= htmlspecialchars($produk['nama_kategori']) ?></p>
                    <h1><?= htmlspecialchars($produk['nama_produk']) ?></h1>
                    
                    <div class="detail-price">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></div>
                    
                    <div class="detail-meta">
                        <div class="detail-meta-item">
                            <i class="fas fa-star"></i> <?= number_format($produk['rating'], 1) ?>
                        </div>
                        <div class="detail-meta-item">
                            <i class="fas fa-ruler-combined"></i> <?= htmlspecialchars($produk['ukuran']) ?>
                        </div>
                        <div class="detail-meta-item">
                            <i class="fas fa-clock"></i> PO H-<?= htmlspecialchars($produk['minimal_preorder']) ?>
                        </div>
                    </div>
                    
                    <div class="detail-desc">
                        <p><?= nl2br(htmlspecialchars($produk['deskripsi'])) ?></p>
                        <p><strong>Masa Simpan:</strong> <?= htmlspecialchars($produk['masa_simpan']) ?></p>
                    </div>

                    <form action="proses_keranjang.php" method="POST">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="id_produk" value="<?= $produk['id_produk'] ?>">
                        
                        <div class="qty-control">
                            <button type="button" class="qty-btn" id="btn-min"><i class="fas fa-minus"></i></button>
                            <input type="number" name="jumlah" id="jumlah" class="qty-input" value="1" min="1" readonly>
                            <button type="button" class="qty-btn" id="btn-plus"><i class="fas fa-plus"></i></button>
                        </div>
                        
                        <button type="submit" class="btn-primary" style="width: 100%; padding: 15px; font-size: 18px; border:none; cursor:pointer;">
                            <i class="fas fa-shopping-cart" style="margin-right: 10px;"></i> Tambah ke Keranjang
                        </button>
                    </form>
                    
                </div>
            </div>

        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnMin = document.getElementById('btn-min');
        const btnPlus = document.getElementById('btn-plus');
        const inputQty = document.getElementById('jumlah');
        
        btnMin.addEventListener('click', function() {
            let val = parseInt(inputQty.value);
            if (val > 1) {
                inputQty.value = val - 1;
            }
        });
        
        btnPlus.addEventListener('click', function() {
            let val = parseInt(inputQty.value);
            inputQty.value = val + 1;
        });
    });
    </script>
</body>
</html>
