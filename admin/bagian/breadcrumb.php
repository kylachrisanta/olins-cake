<?php
if (!isset($breadcrumbs)) {
    $breadcrumbs = [];
}
?>
<nav class="page-breadcrumb">
    <a href="/olinscake/admin/dasbor_admin.php" title="Dashboard"><i class="fas fa-home"></i></a>
    <?php foreach ($breadcrumbs as $name => $link): ?>
        <i class="fas fa-chevron-right" style="font-size:10px;"></i>
        <?php if ($link): ?>
            <a href="<?= $link ?>"><?= htmlspecialchars($name) ?></a>
        <?php else: ?>
            <span class="current"><?= htmlspecialchars($name) ?></span>
        <?php endif; ?>
    <?php endforeach; ?>
</nav>
