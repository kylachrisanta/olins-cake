<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olin's Cake - Aneka Kue Rumahan Pre-Order</title>
    
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Section Beranda -->
    <section id="beranda" class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Olin's Cake</h1>
            <h2>Sajian manis untuk setiap momen spesialmu.</h2>

            <div class="trust-indicators">
                <div class="trust-item">
                    <i class="fas fa-leaf"></i>
                    <span>Dibuat Fresh Sesuai Pesanan</span>
                </div>
                <div class="trust-item">
                    <i class="fas fa-star"></i>
                    <span>Bahan Berkualitas</span>
                </div>
                <div class="trust-item">
                    <i class="fas fa-box"></i>
                    <span>Pengiriman Aman</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Tentang Kami -->
    <section id="tentang-kami" class="tentang-kami">
        <div class="container">
            <div class="tentang-text">
                <h2>Tentang Olin's Cake</h2>
                <p>Olin's Cake adalah toko kue rumahan yang menghadirkan berbagai pilihan kue lezat dengan cita rasa autentik dan kualitas premium untuk menemani setiap momen spesial Anda. Berawal dari hobi membuat sajian manis untuk keluarga, kini kami hadir untuk menyebarkan kehangatan melalui setiap gigitan. Dengan menerapkan sistem <em>pre-order</em>, kami memastikan setiap kue dibuat secara <em>fresh</em> tepat setelah pesanan Anda diterima. Kami hanya menggunakan bahan-bahan pilihan yang terjamin kehalalan serta kebersihannya, dan diproses dengan penuh cinta serta kehati-hatian, sehingga kualitas, tekstur lembut, dan kelezatan rasanya akan selalu terjaga sempurna ketika sampai di tangan Anda.</p>
                <div class="pencapaian-grid">
                    <div class="pencapaian-item">
                        <i class="fas fa-check-circle"></i>
                        <span>100+ Pesanan Berhasil</span>
                    </div>
                    <div class="pencapaian-item">
                        <i class="fas fa-smile"></i>
                        <span>95% Pelanggan Puas</span>
                    </div>
                    <div class="pencapaian-item">
                        <i class="fas fa-leaf"></i>
                        <span>Fresh Dibuat Saat Dipesan</span>
                    </div>
                    <div class="pencapaian-item">
                        <i class="fas fa-truck-fast"></i>
                        <span>Pengiriman Tepat Waktu</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Produk Pilihan -->
    <section id="produk" class="produk-pilihan">
        <div class="container">
            <div class="section-header text-center">
                <h2>Produk Favorit Pelanggan</h2>
                <p>Aneka kue rumahan yang dibuat fresh sesuai pesanan dengan bahan berkualitas.</p>
            </div>
            
            <div class="produk-grid">
                <?php 
                $products = [
                    ["name" => "Fudgy Brownies", "price" => "Rp 85.000", "img" => "product1.png", "rating" => "4.9"],
                    ["name" => "Nastar Keju Premium", "price" => "Rp 120.000", "img" => "product2.png", "rating" => "5.0"],
                    ["name" => "Kaastengels Renyah", "price" => "Rp 115.000", "img" => "product1.png", "rating" => "4.8"],
                    ["name" => "Bolu Jadul Moka", "price" => "Rp 70.000", "img" => "product2.png", "rating" => "4.7"],
                    ["name" => "Lapis Legit Spesial", "price" => "Rp 250.000", "img" => "product1.png", "rating" => "5.0"],
                    ["name" => "Putri Salju Mede", "price" => "Rp 110.000", "img" => "product2.png", "rating" => "4.9"]
                ];
                foreach($products as $product): ?>
                <div class="produk-card">
                    <img src="assets/images/<?= $product['img'] ?>" alt="<?= $product['name'] ?>">
                    <div class="produk-info">
                        <h3><?= $product['name'] ?></h3>
                        <div class="produk-meta">
                            <span class="price"><?= $product['price'] ?></span>
                            <span class="rating"><i class="fas fa-star"></i> <?= $product['rating'] ?></span>
                        </div>
                        <a href="#" class="btn-outline btn-block">Detail</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="text-center mt-4">
                <a href="#" class="btn-primary">Lihat Semua Produk</a>
            </div>
        </div>
    </section>

    <!-- Section Cara Pemesanan -->
    <section id="cara-pesan" class="cara-pesan">
        <div class="container">
            <div class="section-header text-center">
                <h2>Cara Pemesanan</h2>
                <p>Pesan kue favoritmu dengan langkah mudah berikut ini.</p>
            </div>
            
            <div class="step-grid">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <i class="fas fa-hand-pointer step-icon"></i>
                    <p>Pilih kue yang diinginkan.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">2</div>
                    <i class="fas fa-shopping-cart step-icon"></i>
                    <p>Klik Detail lalu tambahkan ke Keranjang.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">3</div>
                    <i class="fas fa-map-marker-alt step-icon"></i>
                    <p>Isi alamat & pilih tanggal pengiriman.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">4</div>
                    <i class="fas fa-credit-card step-icon"></i>
                    <p>Lakukan pembayaran.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">5</div>
                    <i class="fas fa-clipboard-check step-icon"></i>
                    <p>Pesanan diproses oleh Olin's Cake.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">6</div>
                    <i class="fas fa-truck step-icon"></i>
                    <p>Pesanan dikirim ke alamat tujuan.</p>
                </div>
            </div>
            
        </div>
    </section>


    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>
