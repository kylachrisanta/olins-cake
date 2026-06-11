<?php
$current_page = basename($_SERVER['PHP_SELF']);
$current_uri = $_SERVER['REQUEST_URI'];
$nama_admin_sidebar = $_SESSION['nama_admin'] ?? 'Admin';
$inisial = substr($nama_admin_sidebar, 0, 1);
?>
<div class="sidebar">
    <div class="sidebar-header-container">
        <div class="sidebar-header">
            <div class="sidebar-brand-icon">
                <i class="fas fa-cookie-bite"></i>
            </div>
            <div class="sidebar-brand-text">
                <span class="title">Olin's Cake</span>
                <span class="subtitle">Admin Dashboard</span>
            </div>
        </div>
    </div>
    
    <div class="sidebar-content">
        <div class="sidebar-group">
            <div class="sidebar-group-label">Platform</div>
            <ul class="sidebar-menu">
                <li>
                    <a href="/olinscake/admin/dasbor_admin.php" class="<?= ($current_page == 'dasbor_admin.php') ? 'active' : '' ?>">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/olinscake/admin/produk/index.php" class="<?= (strpos($current_uri, '/produk/') !== false) ? 'active' : '' ?>">
                        <i class="fas fa-box"></i>
                        <span>Data Produk</span>
                    </a>
                </li>
                <li>
                    <a href="/olinscake/admin/pesanan/index.php" class="<?= (strpos($current_uri, '/pesanan/') !== false) ? 'active' : '' ?>">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Data Pesanan</span>
                    </a>
                </li>
                <li>
                    <a href="/olinscake/admin/pelanggan/index.php" class="<?= (strpos($current_uri, '/pelanggan/') !== false) ? 'active' : '' ?>">
                        <i class="fas fa-users"></i>
                        <span>Data Pelanggan</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="sidebar-footer">
        <div class="sidebar-user-info">
            <div class="sidebar-user-avatar">
                <?= strtoupper($inisial) ?>
            </div>
            <div class="sidebar-user-text">
                <span class="title"><?= htmlspecialchars($nama_admin_sidebar) ?></span>
                <span class="subtitle">Administrator</span>
            </div>
        </div>
        <a href="/olinscake/admin/keluar_admin.php" class="sidebar-logout-btn" title="Keluar">
            <i class="fas fa-sign-out-alt"></i> <span>Keluar</span>
        </a>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var topbar = document.querySelector('.topbar');
    if (topbar) {
        var toggleBtn = document.createElement('button');
        toggleBtn.innerHTML = '<i class="fas fa-columns"></i>';
        toggleBtn.className = 'sidebar-toggle-btn';
        
        topbar.insertBefore(toggleBtn, topbar.firstChild);

        toggleBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            document.body.classList.toggle('sidebar-collapsed');
        });
    }

    var userDropdown = document.querySelector('.topbar-dropdown');
    var userDropdownBtn = document.getElementById('topbarUserDropdown');
    
    if (userDropdownBtn && userDropdown) {
        userDropdownBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdown.classList.toggle('show');
        });
    }

    document.addEventListener('click', function(e) {
        if (userDropdown && !userDropdown.contains(e.target)) {
            userDropdown.classList.remove('show');
        }
    });
});
</script>
