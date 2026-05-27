<?php
$section = $section ?? ($_GET['section'] ?? 'dashboard');
?>

<aside class="admin-sidebar">
    <div class="admin-brand">ADMIN</div>
    <ul class="admin-nav">
        <li><a href="?pages=admin&section=dashboard" class="<?= $section=='dashboard' ? 'active' : '' ?>"><i class="fas fa-chart-line"></i> <span>Dashboard</span></a></li>
        <li><a href="?pages=admin&section=products" class="<?= $section=='products' ? 'active' : '' ?>"><i class="fas fa-box-open"></i> <span>Sản phẩm</span></a></li>
        <li><a href="?pages=admin&section=orders" class="<?= $section=='orders' ? 'active' : '' ?>"><i class="fas fa-shopping-cart"></i> <span>Đơn hàng</span></a></li>
        <li><a href="?pages=admin&section=accounts" class="<?= $section=='accounts' ? 'active' : '' ?>"><i class="fas fa-users"></i> <span>Người dùng</span></a></li>
        <li><a href="?pages=admin&section=categories" class="<?= $section=='categories' ? 'active' : '' ?>"><i class="fas fa-layer-group"></i> <span>Danh mục</span></a></li>
    </ul>
    
    <div style="position:absolute;bottom:20px;left:16px;right:16px;">
        <a href="?pages=home" class="btn-primary" style="display:block;text-align:center;">Về trang chính</a>
    </div>
</aside>
