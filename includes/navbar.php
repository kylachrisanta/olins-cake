<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$base_url = '/olinscake/';
$current_page = basename($_SERVER['SCRIPT_NAME']);
?>
<?php include_once 'header.php'; ?>


<nav class="bg-surface dark:bg-surface-dim docked full-width top-0 sticky z-40 border-b border-outline-variant transition-all duration-300 backdrop-blur-md bg-opacity-90">
<div class="flex justify-between items-center w-full px-margin-mobile md:px-margin-desktop max-w-[1440px] mx-auto h-20">
<a class="font-display-md text-headline-lg-mobile md:text-display-md text-primary dark:text-primary-fixed tracking-tight hover:scale-[0.98] transition-transform" href="<?= $base_url ?>index.php">
                Olin's Cake.
            </a>
<div class="hidden md:flex items-center gap-8 nav-links-container">
<?php if (isset($_SESSION['id_pelanggan'])): ?>
<div class="relative group">
<a class="nav-link font-label-bold text-label-bold flex items-center gap-1 <?= ($current_page == 'index.php' || $current_page == '') ? 'text-primary font-bold border-b-2 border-tertiary-container pb-1' : 'text-on-surface-variant font-medium hover:text-primary transition-colors duration-200 pb-1' ?>" href="<?= $base_url ?>index.php" data-target="beranda">
Beranda <span class="material-symbols-outlined text-sm">expand_more</span>
</a>
<div class="absolute top-full left-0 mt-2 w-48 bg-surface rounded-xl shadow-lg border border-outline-variant opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 overflow-hidden py-2">
<a href="<?= $base_url ?>index.php#tentang-kami" class="block px-4 py-2 font-label-bold text-on-surface-variant hover:text-primary hover:bg-surface-variant transition-colors" data-target="tentang-kami">Tentang Kami</a>
<a href="<?= $base_url ?>index.php#produk" class="block px-4 py-2 font-label-bold text-on-surface-variant hover:text-primary hover:bg-surface-variant transition-colors" data-target="produk">Favorit</a>
<a href="<?= $base_url ?>index.php#cara-pesan" class="block px-4 py-2 font-label-bold text-on-surface-variant hover:text-primary hover:bg-surface-variant transition-colors" data-target="cara-pesan">Cara Pesan</a>
<a href="<?= $base_url ?>index.php#testimoni" class="block px-4 py-2 font-label-bold text-on-surface-variant hover:text-primary hover:bg-surface-variant transition-colors" data-target="testimoni">Testimoni</a>
<a href="<?= $base_url ?>index.php#hubungi-kami" class="block px-4 py-2 font-label-bold text-on-surface-variant hover:text-primary hover:bg-surface-variant transition-colors" data-target="hubungi-kami">Hubungi Kami</a>
</div>
</div>
<div class="relative group">
<a class="nav-link font-label-bold text-label-bold <?= ($current_page == 'produk.php') ? 'text-primary font-bold border-b-2 border-tertiary-container pb-1 block' : 'text-on-surface-variant font-medium hover:text-primary transition-colors duration-200 block pb-1' ?>" href="<?= $base_url ?>produk.php">Produk</a>
</div>
<div class="relative group">
<a class="nav-link font-label-bold text-label-bold <?= ($current_page == 'pesanan_saya.php') ? 'text-primary font-bold border-b-2 border-tertiary-container pb-1 block' : 'text-on-surface-variant font-medium hover:text-primary transition-colors duration-200 block pb-1' ?>" href="<?= $base_url ?>pesanan_saya.php">Pesanan Saya</a>
</div>
<?php else: ?>
<div class="relative group">
<a class="nav-link font-label-bold text-label-bold <?= ($current_page == 'index.php' || $current_page == '') ? 'text-primary font-bold border-b-2 border-tertiary-container pb-1 block' : 'text-on-surface-variant font-medium hover:text-primary transition-colors duration-200 block pb-1' ?>" href="<?= $base_url ?>index.php" data-target="beranda">Beranda</a>
</div>
<div class="relative group">
<a class="nav-link font-label-bold text-label-bold text-on-surface-variant font-medium hover:text-primary transition-colors duration-200 block pb-1" href="<?= $base_url ?>index.php#tentang-kami" data-target="tentang-kami">Tentang Kami</a>
</div>
<div class="relative group">
<a class="nav-link font-label-bold text-label-bold text-on-surface-variant font-medium hover:text-primary transition-colors duration-200 block pb-1" href="<?= $base_url ?>index.php#produk" data-target="produk">Favorit</a>
</div>
<div class="relative group">
<a class="nav-link font-label-bold text-label-bold text-on-surface-variant font-medium hover:text-primary transition-colors duration-200 block pb-1" href="<?= $base_url ?>index.php#cara-pesan" data-target="cara-pesan">Cara Pesan</a>
</div>
<div class="relative group">
<a class="nav-link font-label-bold text-label-bold text-on-surface-variant font-medium hover:text-primary transition-colors duration-200 block pb-1" href="<?= $base_url ?>index.php#testimoni" data-target="testimoni">Testimoni</a>
</div>
<div class="relative group">
<a class="nav-link font-label-bold text-label-bold text-on-surface-variant font-medium hover:text-primary transition-colors duration-200 block pb-1" href="<?= $base_url ?>index.php#hubungi-kami" data-target="hubungi-kami">Hubungi Kami</a>
</div>
<?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const isIndexPage = window.location.pathname.endsWith('index.php') || window.location.pathname.endsWith('/olinscake/');
    if (!isIndexPage) return;


    const navLinks = document.querySelectorAll('.nav-link[data-target]');
    const sections = Array.from(navLinks).map(link => {
        const target = link.getAttribute('data-target');
        if (target === 'beranda') return { link, el: document.querySelector('main > section:first-of-type') || document.body };
        return { link, el: document.getElementById(target) };
    }).filter(s => s.el);

    function updateActiveLink() {
        let currentHash = window.location.hash;
        
        const activeClasses = ['text-primary', 'font-bold', 'border-b-2', 'border-tertiary-container'];
        const inactiveClasses = ['text-on-surface-variant', 'font-medium', 'hover:text-primary'];

        navLinks.forEach(link => {
            link.classList.remove(...activeClasses);
            link.classList.add(...inactiveClasses);
        });

        if (currentHash) {
            const activeLink = document.querySelector(`.nav-link[href$="${currentHash}"]`);
            if (activeLink) {
                activeLink.classList.remove(...inactiveClasses);
                activeLink.classList.add(...activeClasses);
                return;
            }
        }

        let currentSection = sections[0];

        const scrollY = window.scrollY;

        for (const section of sections) {
            if (!section.el || section.el === document.body) continue;
            const offsetTop = section.el.offsetTop - 150;
            if (scrollY >= offsetTop) {
                currentSection = section;
            }
        }

        if (currentSection && currentSection.link) {
            currentSection.link.classList.remove(...inactiveClasses);
            currentSection.link.classList.add(...activeClasses);
        }
    }

    window.addEventListener('scroll', updateActiveLink, { passive: true });
    window.addEventListener('hashchange', updateActiveLink);
    
    setTimeout(updateActiveLink, 100);
});
</script>
<div class="flex items-center gap-4">
<?php if (isset($_SESSION['id_pelanggan'])): ?>
    <a class="hidden lg:block font-label-bold text-label-bold text-on-surface hover:text-primary transition-colors duration-200" href="<?= $base_url ?>auth/keluar.php">Keluar</a>
    <a href="<?= $base_url ?>keranjang.php" class="text-primary dark:text-primary-fixed p-2 rounded-full hover:bg-surface-variant transition-colors relative group">
        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 0;">shopping_cart</span>
        <?php
        // Count items in cart if logged in
        $keranjang_count = 0;
        if(isset($koneksi)){
            $stmt_count = $koneksi->prepare("SELECT SUM(jumlah) as total FROM keranjang WHERE id_pelanggan = ?");
            $stmt_count->bind_param("i", $_SESSION['id_pelanggan']);
            $stmt_count->execute();
            $res_count = $stmt_count->get_result();
            if($row_count = $res_count->fetch_assoc()){
                $keranjang_count = $row_count['total'] ?: 0;
            }
        }
        if($keranjang_count > 0):
        ?>
        <span class="absolute -top-1 -right-1 bg-error text-on-error rounded-full border-2 border-surface group-hover:border-surface-variant transition-colors text-[10px] w-5 h-5 flex items-center justify-center font-bold"><?= $keranjang_count ?></span>
        <?php endif; ?>
    </a>
<?php else: ?>
    <a class="hidden lg:block font-label-bold text-label-bold text-on-surface hover:text-primary transition-colors duration-200" href="<?= $base_url ?>auth/masuk.php">Masuk</a>
    <a class="hidden lg:block font-label-bold text-label-bold text-on-surface hover:text-primary transition-colors duration-200" href="<?= $base_url ?>auth/daftar.php">Daftar</a>
<?php endif; ?>
<button class="md:hidden text-primary p-2">
<span class="material-symbols-outlined">menu</span>
</button>
</div>
</div>
</nav>
