<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$base_url = '/olinscake/';
?>
<nav class="navbar">
  <div class="navbar-container">
    <div class="nav-brand">
      <a href="<?= $base_url ?>index.php#beranda" class="brand">Olin's Cake</a>
    </div>
    
    <div class="nav-menu">
      <ul class="nav-links" id="nav-links">
        <li class="dropdown" id="berandaDropdownContainer">
          <a href="#" class="dropdown-toggle" id="berandaDropdown" style="display: flex; align-items: center;">
            Beranda <i class="fas fa-chevron-down" style="font-size: 12px; margin-left: 5px;"></i>
          </a>
          <div class="dropdown-menu" id="berandaMenu" style="top: 150%;">
            <a href="<?= $base_url ?>index.php#tentang-kami" class="dropdown-item">Tentang Kami</a>
            <a href="<?= $base_url ?>index.php#produk" class="dropdown-item">Produk Pilihan</a>
            <a href="<?= $base_url ?>index.php#cara-pesan" class="dropdown-item">Cara Pesan</a>
          </div>
        </li>
        <li><a href="<?= $base_url ?>produk.php">Produk</a></li>
        <?php if (isset($_SESSION['id_pelanggan'])): ?>
        <li><a href="<?= $base_url ?>keranjang.php">Keranjang</a></li>
        <li><a href="<?= $base_url ?>pesanan_saya.php">Pesanan Saya</a></li>
        <?php endif; ?>
      </ul>
    </div>

    <div class="nav-actions">
      <?php if (isset($_SESSION['id_pelanggan'])): ?>
        <span class="user-greeting" style="font-weight: 600; color: var(--primary-color);">
          Halo, <?= htmlspecialchars(explode(' ', $_SESSION['nama_lengkap'])[0]) ?>
        </span>
        <a href="<?= $base_url ?>auth/keluar.php" class="btn-outline text-danger" style="border-color: #e74c3c;">Logout</a>
      <?php else: ?>
        <a href="<?= $base_url ?>auth/masuk.php" class="btn-outline">Masuk</a>
        <a href="<?= $base_url ?>auth/daftar.php" class="btn-primary">Daftar</a>
      <?php endif; ?>
      
      <div class="menu-toggle" id="mobile-menu">
        <i class="fas fa-bars"></i>
      </div>
    </div>
  </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dropdown toggle logic untuk Beranda
    const berandaDropdown = document.getElementById('berandaDropdown');
    const berandaMenu = document.getElementById('berandaMenu');
    
    if (berandaDropdown && berandaMenu) {
        berandaDropdown.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            berandaMenu.classList.toggle('show');
        });

        document.addEventListener('click', function(e) {
            if (!berandaDropdown.contains(e.target) && !berandaMenu.contains(e.target)) {
                berandaMenu.classList.remove('show');
            }
        });
    }

    // Mobile menu logic
    const mobileMenuBtn = document.getElementById('mobile-menu');
    const navLinks = document.getElementById('nav-links');
    
    if (mobileMenuBtn && navLinks) {
        mobileMenuBtn.addEventListener('click', function() {
            navLinks.classList.toggle('active');
        });
    }
});
</script>
