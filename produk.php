<?php
session_start();
require_once 'koneksi.php';

if (!isset($_SESSION['id_pelanggan'])) {
    header("Location: auth/masuk.php");
    exit;
}

$kategori_aktif = isset($_GET['kategori']) ? $_GET['kategori'] : 'semua';

$kategori_res = $koneksi->query("SELECT * FROM kategori_produk");

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
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk - Olin's Cake</title>
    <?php include 'includes/header.php'; ?>
</head>
<body class="bg-surface text-on-surface font-body-md text-body-md antialiased overflow-x-hidden">

    <?php include 'includes/navbar.php'; ?>

    <main class="w-full min-h-screen">
        <div class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop py-section-padding">
            
            <div class="text-center mb-12">
                <h1 class="font-display-md text-headline-lg-mobile md:text-display-md text-primary mb-4">Katalog Produk</h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mx-auto">Pilih kue favorit Anda untuk menemani setiap momen spesial.</p>
            </div>

            <div class="flex flex-wrap justify-center gap-4 mb-12">
                <a href="produk.php?kategori=semua" class="rounded-full px-6 py-2.5 font-label-bold text-label-bold transition-colors <?= $kategori_aktif == 'semua' ? 'bg-primary text-on-primary border-[1.5px] border-primary' : 'bg-transparent text-primary border border-outline hover:bg-surface-variant' ?>">
                    Semua Produk
                </a>
                <?php while ($kat = $kategori_res->fetch_assoc()): ?>
                    <a href="produk.php?kategori=<?= $kat['id_kategori'] ?>" class="rounded-full px-6 py-2.5 font-label-bold text-label-bold transition-colors <?= $kategori_aktif == $kat['id_kategori'] ? 'bg-primary text-on-primary border-[1.5px] border-primary' : 'bg-transparent text-primary border border-outline hover:bg-surface-variant' ?>">
                        <?= htmlspecialchars($kat['nama_kategori']) ?>
                    </a>
                <?php endwhile; ?>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-gutter">
                <?php if ($produk_res->num_rows > 0): ?>
                    <?php while ($row = $produk_res->fetch_assoc()): ?>
                    <div class="group bg-surface-container-lowest rounded-xl border border-outline-variant overflow-hidden tactile-shadow hover:-translate-y-1 transition-transform duration-300 flex flex-col">
                        <div class="h-64 bg-surface-variant relative overflow-hidden flex items-center justify-center p-4">
                            <img src="assets/images/<?= htmlspecialchars($row['foto_produk'] ?: 'product1.png') ?>" alt="<?= htmlspecialchars($row['nama_produk']) ?>" class="w-full h-full object-cover rounded-lg transform group-hover:scale-105 transition-transform duration-700">
                            <div class="absolute top-4 left-4 bg-surface px-3 py-1 rounded-full border border-outline-variant shadow-sm -rotate-2">
                                <span class="font-label-bold text-[12px] font-bold text-primary"><?= htmlspecialchars($row['nama_kategori']) ?></span>
                            </div>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-headline-lg text-headline-lg-mobile text-primary"><?= htmlspecialchars($row['nama_produk']) ?></h3>
                            </div>
                            <div class="flex justify-between items-center mb-6">
                                <p class="font-label-bold text-label-bold text-tertiary-container">Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
                                <span class="flex items-center text-[#FFB74D] font-label-bold text-sm">
                                    <span class="material-symbols-outlined text-sm mr-1" style="font-variation-settings: 'FILL' 1;">star</span> <?= number_format($row['rating'], 1) ?>
                                </span>
                            </div>
                            <div class="flex gap-3 mt-auto">
                                <a href="detail_produk.php?id=<?= $row['id_produk'] ?>" class="flex-1 rounded-full border border-primary px-4 py-2 font-label-bold text-label-bold text-primary hover:bg-surface-variant transition-colors text-center flex items-center justify-center">Detail</a>
                                <form action="proses_keranjang.php" method="POST" class="flex-none">
                                    <input type="hidden" name="action" value="add">
                                    <input type="hidden" name="id_produk" value="<?= $row['id_produk'] ?>">
                                    <input type="hidden" name="jumlah" value="1">
                                    <button type="submit" class="rounded-full border-[1.5px] border-primary bg-primary text-on-primary w-12 h-12 flex items-center justify-center hover:scale-95 transition-transform">
                                        <span class="material-symbols-outlined text-sm">add_shopping_cart</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-span-full py-16 text-center bg-surface-container-low rounded-xl border border-outline-variant">
                        <span class="material-symbols-outlined text-6xl text-outline mb-4">box</span>
                        <h3 class="font-headline-lg text-primary mb-2">Tidak Ada Produk</h3>
                        <p class="font-body-md text-on-surface-variant">Belum ada produk dalam kategori ini.</p>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

</body>
</html>
