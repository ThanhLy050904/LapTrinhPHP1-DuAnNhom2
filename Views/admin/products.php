<?php
$adminAction = $_GET['action'] ?? '';
$productEdit = null;
if ($adminAction === 'edit' && isset($_GET['id'])) {
    foreach ($adminProducts as $product) {
        if (intval($product['id']) === intval($_GET['id'])) {
            $productEdit = $product;
            break;
        }
    }
}
?>

<div class="admin-card">
    <div class="page-header">
        <div>
            <h2 class="page-title">Quản lý sản phẩm</h2>
            <p class="page-subtitle">Xem và quản lý danh sách sản phẩm hiện có.</p>
        </div>
        <div class="page-actions">
            <form class="search-box" action="?pages=admin&section=products" method="get">
                <input type="hidden" name="pages" value="admin">
                <input type="hidden" name="section" value="products">
                <input type="text" name="q" placeholder="Tìm kiếm sản phẩm...">
                <button type="submit">Tìm</button>
            </form>
            <a class="btn-primary" href="?pages=admin&section=products&action=add">+ Thêm sản phẩm</a>
        </div>
    </div>

    <?php if ($adminAction === 'add' || $adminAction === 'edit'): ?>
        <div class="admin-card" style="margin-bottom:24px; padding:24px;">
            <h3><?= $adminAction === 'edit' ? 'Chỉnh sửa sản phẩm' : 'Thêm sản phẩm mới' ?></h3>
            <form method="post">
                <input type="hidden" name="admin_form" value="products">
                <input type="hidden" name="id" value="<?= $productEdit['id'] ?? '' ?>">
                <div style="display:grid;grid-template-columns:1fr 1fr; gap:16px; margin-top:18px;">
                    <input name="name" placeholder="Tên sản phẩm" value="<?= htmlspecialchars($productEdit['name'] ?? '', ENT_QUOTES) ?>" required>
                    <input name="price" placeholder="Giá" value="<?= htmlspecialchars($productEdit['price'] ?? '', ENT_QUOTES) ?>" required>
                    <input name="category" placeholder="Danh mục" value="<?= htmlspecialchars($productEdit['category'] ?? '', ENT_QUOTES) ?>" required>
                    <input name="image" placeholder="Link hình ảnh" value="<?= htmlspecialchars($productEdit['image'] ?? '', ENT_QUOTES) ?>" required>
                </div>
                <div style="margin-top:16px; display:flex; gap:12px; flex-wrap:wrap;">
                    <button class="btn-primary" type="submit">Lưu</button>
                    <a class="btn-secondary" href="?pages=admin&section=products">Hủy</a>
                </div>
            </form>
        </div>
    <?php endif; ?>

    <table class="table-admin">
        <thead>
            <tr>
                <th>ID</th>
                <th>Hình ảnh</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Danh mục</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($adminProducts)): ?>
                <?php foreach ($adminProducts as $product): ?>
                    <tr>
                        <td>#<?= $product['id'] ?></td>
                        <td><img src="<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['name'], ENT_QUOTES) ?>" width="60"></td>
                        <td><?= htmlspecialchars($product['name'], ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($product['price'], ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($product['category'], ENT_QUOTES) ?></td>
                        <td>
                            <a class="btn-secondary" href="?pages=admin&section=products&action=edit&id=<?= $product['id'] ?>">Sửa</a>
                            <a class="btn-danger" href="?pages=admin&section=products&action=delete&id=<?= $product['id'] ?>">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Chưa có dữ liệu</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
