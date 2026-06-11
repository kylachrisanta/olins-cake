<?php
session_start();
require_once 'koneksi.php';

if (!isset($_SESSION['id_pelanggan'])) {
    header("Location: auth/masuk.php");
    exit;
}

$id_pelanggan = $_SESSION['id_pelanggan'];

// Ambil item keranjang yang DIPILIH
$stmt = $koneksi->prepare("SELECT k.*, p.nama_produk, p.harga, p.foto_produk FROM keranjang k JOIN produk p ON k.id_produk = p.id_produk WHERE k.id_pelanggan = ? AND k.dipilih = 1");
$stmt->bind_param("i", $id_pelanggan);
$stmt->execute();
$res = $stmt->get_result();

$checkout_items = [];
$subtotal = 0;
while ($row = $res->fetch_assoc()) {
    $checkout_items[] = $row;
    $subtotal += ($row['harga'] * $row['jumlah']);
}

if (count($checkout_items) === 0) {
    $_SESSION['error'] = "Pilih minimal satu produk untuk di-checkout.";
    header("Location: keranjang.php");
    exit;
}

// Ambil data pelanggan untuk default form
$stmt_user = $koneksi->prepare("SELECT nama_lengkap, nomor_whatsapp FROM pelanggan WHERE id_pelanggan = ?");
$stmt_user->bind_param("i", $id_pelanggan);
$stmt_user->execute();
$pelanggan = $stmt_user->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Olin's Cake</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <?php include 'includes/navbar.php'; ?>

    <header class="page-header" style="padding-top: 100px; padding-bottom: 40px;">
        <div class="container">
            <h1 style="font-size: 32px;">Checkout Pesanan</h1>
        </div>
    </header>

    <section class="checkout-page">
        <div class="container">
            
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> <?= $_SESSION['error'] ?>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <form action="proses_checkout.php" method="POST" enctype="multipart/form-data" id="checkoutForm">
                <input type="hidden" name="subtotal" value="<?= $subtotal ?>">
                <input type="hidden" name="biaya_ongkir" id="biaya_ongkir_input" value="0">

                <div class="checkout-grid">
                    <div>
                        <!-- Data Penerima -->
                        <div class="checkout-section">
                            <h3>1. Data Penerima</h3>
                            <div class="form-group">
                                <label>Nama Penerima</label>
                                <input type="text" name="nama_penerima" class="form-control" required value="<?= htmlspecialchars($pelanggan['nama_lengkap']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Nomor WhatsApp</label>
                                <input type="tel" name="nomor_whatsapp" class="form-control" required value="<?= htmlspecialchars($pelanggan['nomor_whatsapp']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Alamat Lengkap</label>
                                <textarea name="alamat_lengkap" class="form-control" rows="3" required></textarea>
                            </div>
                            
                            <label style="font-weight:600; margin-bottom:10px; display:block; color:var(--primary-color);">Titik Lokasi (Simulasi Jarak)</label>
                            <div class="map-placeholder">
                                <div>
                                    <i class="fas fa-map-marker-alt" style="display:block; margin-bottom:10px; font-size:30px;"></i>
                                    Peta Google Maps (Placeholder)
                                </div>
                            </div>
                            <input type="hidden" name="titik_koordinat" value="-6.200000,106.816666">
                            
                            <p style="font-size:14px; color:#666; margin-bottom:5px;">Simulasi Jarak dari Toko: <span id="jarak_text" style="font-weight:bold; color:var(--accent-color);">0 km</span></p>
                            <input type="range" name="jarak_km" id="jarak_km" class="distance-slider" min="0" max="25" step="0.5" value="0">
                        </div>

                        <!-- Pengiriman -->
                        <div class="checkout-section">
                            <h3>2. Pengiriman</h3>
                            
                            <div class="form-group" style="margin-bottom:20px;">
                                <label>Pilihan Pengiriman</label>
                                <select name="metode_pengiriman" id="metode_pengiriman" class="form-control" required>
                                    <option value="Kirim">Kirim ke Alamat</option>
                                    <option value="Ambil Sendiri">Ambil Sendiri di Toko</option>
                                </select>
                            </div>

                            <div id="alert_jarak" class="alert alert-danger" style="display:none;">
                                <i class="fas fa-exclamation-triangle"></i> Alamat berada di luar area layanan pengiriman (> 20 km). Silakan ubah alamat atau pilih opsi "Ambil Sendiri di Toko".
                            </div>

                            <div class="form-group">
                                <label>Tanggal Pengiriman</label>
                                <input type="date" name="tanggal_pengiriman" class="form-control" required min="<?= date('Y-m-d', strtotime('+2 days')) ?>">
                                <small style="color:#666;">Minimal pemesanan H-2.</small>
                            </div>
                            <div class="form-group">
                                <label>Waktu Pengiriman / Pengambilan</label>
                                <select name="waktu_pengiriman" class="form-control" required>
                                    <option value="08.00 - 13.00">08.00 - 13.00</option>
                                    <option value="13.00 - 17.00">13.00 - 17.00</option>
                                    <option value="17.00 - 21.00">17.00 - 21.00</option>
                                </select>
                            </div>
                        </div>

                        <!-- Pembayaran -->
                        <div class="checkout-section">
                            <h3>3. Pembayaran</h3>
                            <div class="payment-method">
                                <input type="radio" name="metode_pembayaran" id="pay_transfer" value="Transfer Bank" checked style="display:none;">
                                <label for="pay_transfer"><i class="fas fa-university" style="font-size:24px; color:var(--support-color); margin-bottom:10px; display:block;"></i> Transfer Bank<br><small>BCA 12345678 a.n Olin's Cake</small></label>
                                
                                <input type="radio" name="metode_pembayaran" id="pay_qris" value="QRIS" style="display:none;">
                                <label for="pay_qris"><i class="fas fa-qrcode" style="font-size:24px; color:var(--support-color); margin-bottom:10px; display:block;"></i> QRIS<br><small>Scan via E-Wallet / M-Banking</small></label>
                            </div>

                            <div class="form-group">
                                <label>Upload Bukti Pembayaran</label>
                                <input type="file" name="bukti_pembayaran" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>
                                <small style="color:#666;">Format: JPG, PNG, PDF. Maksimal 2MB.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Ringkasan Pesanan -->
                    <div>
                        <div class="cart-summary">
                            <h3 style="margin-bottom: 20px;">Ringkasan Pesanan</h3>
                            
                            <div style="margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom:15px;">
                                <?php foreach($checkout_items as $item): ?>
                                <div style="display:flex; justify-content:space-between; margin-bottom:10px; font-size:14px;">
                                    <div style="flex:1;">
                                        <span style="font-weight:600;"><?= htmlspecialchars($item['nama_produk']) ?></span><br>
                                        <span style="color:#777;"><?= $item['jumlah'] ?> x Rp <?= number_format($item['harga'],0,',','.') ?></span>
                                    </div>
                                    <div style="font-weight:600; margin-left:10px;">
                                        Rp <?= number_format($item['jumlah'] * $item['harga'],0,',','.') ?>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="summary-row">
                                <span>Subtotal Produk</span>
                                <span>Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
                            </div>
                            <div class="summary-row">
                                <span>Ongkos Kirim</span>
                                <span id="txt_ongkir">Rp 0</span>
                            </div>
                            
                            <div class="summary-total">
                                <span>Total Bayar</span>
                                <span id="txt_total" style="color: var(--accent-color);">Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
                            </div>
                            
                            <button type="submit" class="btn-primary" style="width:100%; border:none; padding:15px; font-size:18px; cursor:pointer; margin-top:25px;" id="btn-submit">Buat Pesanan</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const sliderJarak = document.getElementById('jarak_km');
        const txtJarak = document.getElementById('jarak_text');
        const metodePengiriman = document.getElementById('metode_pengiriman');
        const txtOngkir = document.getElementById('txt_ongkir');
        const txtTotal = document.getElementById('txt_total');
        const inputOngkir = document.getElementById('biaya_ongkir_input');
        const alertJarak = document.getElementById('alert_jarak');
        const btnSubmit = document.getElementById('btn-submit');
        
        const subtotal = <?= $subtotal ?>;

        function hitungOngkir() {
            let jarak = parseFloat(sliderJarak.value);
            let ongkir = 0;
            let metode = metodePengiriman.value;
            
            txtJarak.textContent = jarak + ' km';
            alertJarak.style.display = 'none';
            btnSubmit.disabled = false;
            btnSubmit.style.opacity = '1';

            if (metode === 'Ambil Sendiri') {
                ongkir = 0;
            } else {
                if (jarak <= 5) {
                    ongkir = 10000;
                } else if (jarak <= 10) {
                    ongkir = 15000;
                } else if (jarak <= 15) {
                    ongkir = 20000;
                } else if (jarak <= 20) {
                    ongkir = 25000;
                } else {
                    // Lebih dari 20km
                    alertJarak.style.display = 'block';
                    btnSubmit.disabled = true;
                    btnSubmit.style.opacity = '0.5';
                    ongkir = 0;
                }
            }

            inputOngkir.value = ongkir;
            if(ongkir > 0) {
                txtOngkir.textContent = 'Rp ' + ongkir.toLocaleString('id-ID');
            } else {
                txtOngkir.textContent = 'Rp 0';
            }
            
            let total = subtotal + ongkir;
            txtTotal.textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        sliderJarak.addEventListener('input', hitungOngkir);
        metodePengiriman.addEventListener('change', hitungOngkir);
        
        // Initial calculation
        hitungOngkir();
    });
    </script>
</body>
</html>
