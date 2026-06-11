<div class="topbar">

    <div class="topbar-dropdown">
        <div class="topbar-user" id="topbarUserDropdown">
            <div class="sidebar-user-avatar" style="width: 28px; height: 28px; font-size: 12px; margin-right: 4px;">
                <?= strtoupper(substr($nama_admin, 0, 1)) ?>
            </div>
            <?= htmlspecialchars($nama_admin) ?>
            <i class="fas fa-chevron-down" style="font-size:12px; margin-left:2px; color:#71717a;"></i>
        </div>
        <div class="topbar-dropdown-content">
            <a href="/olinscake/admin/keluar_admin.php">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </a>
        </div>
    </div>
</div>
