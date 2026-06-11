<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$base_url = '/olinscake/';
$current_page = basename($_SERVER['SCRIPT_NAME']);
?>
<?php include_once 'header.php'; ?>

<div class="bg-primary text-on-primary py-2 px-4 text-center font-label-bold text-label-bold w-full z-50 relative">
    Dipanggang segar setiap pagi. Nikmati kelezatan kue artisan khas Olin's Cake untuk menyempurnakan hari Anda!
</div>
<nav class="bg-surface dark:bg-surface-dim docked full-width top-0 sticky z-40 border-b border-outline-variant transition-all duration-300 backdrop-blur-md bg-opacity-90">
<div class="flex justify-between items-center w-full px-margin-mobile md:px-margin-desktop max-w-[1440px] mx-auto h-20">
<a class="font-display-md text-headline-lg-mobile md:text-display-md text-primary dark:text-primary-fixed tracking-tight hover:scale-[0.98] transition-transform" href="<?= $base_url ?>index.php">
                Olin's Cake.
            </a>
<div class="hidden md:flex items-center gap-8 nav-links-container">
<div class="relative group">
<a class="nav-link font-label-bold text-label-bold <?= ($current_page == 'index.php' || $current_page == '') ? 'text-primary font-bold border-b-2 border-tertiary-container pb-1 block' : 'text-on-surface-variant font-medium hover:text-primary transition-colors duration-200 block pb-1' ?>" href="<?= $base_url ?>index.php" data-target="beranda">Beranda</a>
</div>
<div class="relative group">
<a class="nav-link font-label-bold text-label-bold <?= ($current_page == 'produk.php') ? 'text-primary font-bold border-b-2 border-tertiary-container pb-1 block' : 'text-on-surface-variant font-medium hover:text-primary transition-colors duration-200 block pb-1' ?>" href="<?= $base_url ?>produk.php">Produk</a>
</div>
<div class="relative group">
<a class="nav-link font-label-bold text-label-bold text-on-surface-variant font-medium hover:text-primary transition-colors duration-200 block pb-1" href="<?= $base_url ?>index.php#cara-pesan" data-target="cara-pesan">Cara Pesan</a>
</div>
<div class="relative group">
<a class="nav-link font-label-bold text-label-bold text-on-surface-variant font-medium hover:text-primary transition-colors duration-200 block pb-1" href="<?= $base_url ?>index.php#tentang-kami" data-target="tentang-kami">Tentang Kami</a>
</div>
<div class="relative group">
<a class="nav-link font-label-bold text-label-bold text-on-surface-variant font-medium hover:text-primary transition-colors duration-200 block pb-1" href="<?= $base_url ?>index.php#hubungi-kami" data-target="hubungi-kami">Hubungi Kami</a>
</div>
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
    <a class="hidden lg:block font-label-bold text-label-bold text-on-surface hover:text-primary transition-colors duration-200" href="<?= $base_url ?>pesanan_saya.php">Pesanan Saya</a>
    <a class="hidden lg:block font-label-bold text-label-bold text-on-surface hover:text-primary transition-colors duration-200" href="<?= $base_url ?>auth/keluar.php">Logout</a>
<?php else: ?>
    <a class="hidden lg:block font-label-bold text-label-bold text-on-surface hover:text-primary transition-colors duration-200" href="<?= $base_url ?>auth/masuk.php">Masuk</a>
<?php endif; ?>
<a class="hidden sm:inline-flex items-center justify-center rounded-full border-[1.5px] border-primary bg-tertiary-fixed text-primary px-6 py-2.5 font-label-bold text-label-bold hover:bg-tertiary-fixed-dim transition-colors Active:scale-95 transition-transform" href="<?= $base_url ?>produk.php">
                    Pesan Sekarang
                </a>
<a href="<?= $base_url ?>keranjang.php" class="text-primary dark:text-primary-fixed p-2 rounded-full hover:bg-surface-variant transition-colors relative group">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 0;">shopping_cart</span>
<span class="absolute top-1 right-1 w-2.5 h-2.5 bg-error rounded-full border-2 border-surface group-hover:border-surface-variant transition-colors"></span>
</a>
<button class="md:hidden text-primary p-2">
<span class="material-symbols-outlined">menu</span>
</button>
</div>
</div>
</nav>
