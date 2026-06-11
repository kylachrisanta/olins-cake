<?php
session_start();
require_once 'koneksi.php';

if (!isset($_SESSION['id_pelanggan'])) {
    $_SESSION['error'] = "Silakan login untuk mengakses keranjang.";
    header("Location: auth/masuk.php");
    exit;
}

$id_pelanggan = $_SESSION['id_pelanggan'];

$stmt = $koneksi->prepare("SELECT k.*, p.nama_produk, p.harga, p.foto_produk FROM keranjang k JOIN produk p ON k.id_produk = p.id_produk WHERE k.id_pelanggan = ? ORDER BY k.id_keranjang DESC");
$stmt->bind_param("i", $id_pelanggan);
$stmt->execute();
$res = $stmt->get_result();
$keranjang_items = [];
while ($row = $res->fetch_assoc()) {
    $keranjang_items[] = $row;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - Olin's Cake</title>
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
            <h1 style="font-size: 32px;">Keranjang Belanja</h1>
        </div>
    </header>

    <section class="cart-page">
        <div class="container">
            
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> <?= $_SESSION['success'] ?>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (count($keranjang_items) > 0): ?>
            <div class="cart-grid">
                
                <div class="cart-items">
                    <div class="cart-header">
                        <div style="display:flex; align-items:center; gap:10px;">
                            <input type="checkbox" id="selectAll" style="width:18px; height:18px; accent-color: var(--accent-color);" checked>
                            <label for="selectAll" style="font-weight:600;">Pilih Semua</label>
                        </div>
                    </div>

                    <?php foreach ($keranjang_items as $item): ?>
                    <div class="cart-item" data-id="<?= $item['id_keranjang'] ?>" data-harga="<?= $item['harga'] ?>">
                        <input type="checkbox" class="item-checkbox" <?= $item['dipilih'] ? 'checked' : '' ?> style="width:18px; height:18px; accent-color: var(--accent-color);">
                        <img src="assets/images/<?= htmlspecialchars($item['foto_produk'] ?: 'product1.png') ?>" class="cart-item-img" alt="Produk">
                        
                        <div class="cart-item-details">
                            <div class="cart-item-title"><?= htmlspecialchars($item['nama_produk']) ?></div>
                            <div class="cart-item-price">Rp <?= number_format($item['harga'], 0, ',', '.') ?></div>
                        </div>

                        <div class="cart-item-actions">
                            <form action="proses_keranjang.php" method="POST" style="margin:0;">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id_keranjang" value="<?= $item['id_keranjang'] ?>">
                                <button type="submit" class="btn-remove" onclick="return confirm('Hapus item ini dari keranjang?')"><i class="fas fa-trash-alt"></i> Hapus</button>
                            </form>
                            
                            <div class="qty-control" style="margin:0; gap:5px;">
                                <button type="button" class="qty-btn btn-min" style="width:30px; height:30px; font-size:14px;"><i class="fas fa-minus"></i></button>
                                <input type="number" class="qty-input" value="<?= $item['jumlah'] ?>" min="1" readonly style="width:40px; font-size:16px;">
                                <button type="button" class="qty-btn btn-plus" style="width:30px; height:30px; font-size:14px;"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div>
                    <div class="cart-summary">
                        <h3 style="margin-bottom: 20px;">Ringkasan Belanja</h3>
                        <div class="summary-row">
                            <span>Total Produk</span>
                            <span id="summary-total-item">0 Produk</span>
                        </div>
                        <div class="summary-total">
                            <span>Total Harga</span>
                            <span id="summary-total-price" style="color: var(--accent-color);">Rp 0</span>
                        </div>
                        
                        <form action="pembayaran.php" method="GET" style="margin-top: 25px;">
                            <button type="submit" class="btn-primary" style="width:100%; border:none; padding:15px; font-size:18px; cursor:pointer;" id="btn-checkout">Beli Sekarang</button>
                        </form>
                    </div>
                </div>

            </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-shopping-cart"></i>
                    <h3>Keranjang Masih Kosong</h3>
                    <p>Yuk, lihat katalog kami dan temukan kue favoritmu!</p>
                    <a href="produk.php" class="btn-primary mt-4" style="display: inline-block;">Belanja Sekarang</a>
                </div>
            <?php endif; ?>

        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const cartItems = document.querySelectorAll('.cart-item');
        const selectAllCheckbox = document.getElementById('selectAll');
        const summaryTotalItem = document.getElementById('summary-total-item');
        const summaryTotalPrice = document.getElementById('summary-total-price');
        const btnCheckout = document.getElementById('btn-checkout');

        function updateSummary() {
            let totalItems = 0;
            let totalPrice = 0;
            let allChecked = true;
            let anyChecked = false;

            cartItems.forEach(item => {
                const checkbox = item.querySelector('.item-checkbox');
                const qtyInput = item.querySelector('.qty-input');
                const price = parseInt(item.dataset.harga);
                const qty = parseInt(qtyInput.value);

                if (checkbox.checked) {
                    totalItems += qty;
                    totalPrice += (price * qty);
                    anyChecked = true;
                } else {
                    allChecked = false;
                }
            });

            if (cartItems.length > 0) {
                selectAllCheckbox.checked = allChecked;
            }
            
            summaryTotalItem.textContent = totalItems + ' Produk';
            summaryTotalPrice.textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
            btnCheckout.disabled = !anyChecked;
            btnCheckout.style.opacity = anyChecked ? '1' : '0.5';
        }

        function syncServerSelect(id_keranjang, isChecked) {
            const formData = new FormData();
            formData.append('action', 'update_select');
            formData.append('id_keranjang', id_keranjang);
            formData.append('dipilih', isChecked ? 1 : 0);
            fetch('proses_keranjang.php', { method: 'POST', body: formData });
        }

        function syncServerQty(id_keranjang, qty) {
            const formData = new FormData();
            formData.append('action', 'update_qty');
            formData.append('id_keranjang', id_keranjang);
            formData.append('jumlah', qty);
            fetch('proses_keranjang.php', { method: 'POST', body: formData });
        }

        if(selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function() {
                const isChecked = this.checked;
                cartItems.forEach(item => {
                    const cb = item.querySelector('.item-checkbox');
                    if(cb.checked !== isChecked) {
                        cb.checked = isChecked;
                        syncServerSelect(item.dataset.id, isChecked);
                    }
                });
                updateSummary();
            });
        }

        cartItems.forEach(item => {
            const cb = item.querySelector('.item-checkbox');
            const btnMin = item.querySelector('.btn-min');
            const btnPlus = item.querySelector('.btn-plus');
            const qtyInput = item.querySelector('.qty-input');
            const id_keranjang = item.dataset.id;

            cb.addEventListener('change', function() {
                syncServerSelect(id_keranjang, this.checked);
                updateSummary();
            });

            btnMin.addEventListener('click', function() {
                let val = parseInt(qtyInput.value);
                if (val > 1) {
                    qtyInput.value = val - 1;
                    syncServerQty(id_keranjang, val - 1);
                    updateSummary();
                }
            });

            btnPlus.addEventListener('click', function() {
                let val = parseInt(qtyInput.value);
                qtyInput.value = val + 1;
                syncServerQty(id_keranjang, val + 1);
                updateSummary();
            });
        });

        if(cartItems.length > 0) updateSummary();
    });
    </script>
</body>
</html>

