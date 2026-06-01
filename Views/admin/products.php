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
    <div class="admin-form-card product-form-card">

        <h3 class="form-title">
            <?= $adminAction === 'edit'
                ? '✏️ Chỉnh sửa sản phẩm'
                : '➕ Thêm sản phẩm mới' ?>
        </h3>

        <form class="product-form" method="post">
            <input type="hidden" name="admin_form" value="products">
            <input type="hidden" name="id" value="<?= $productEdit['id'] ?? '' ?>">

            <div class="form-row">
                <div class="form-group">
                    <label>Tên sản phẩm</label>
                    <input class="form-control" type="text" name="name" placeholder="Nhập tên sản phẩm" value="<?= htmlspecialchars($productEdit['name'] ?? '', ENT_QUOTES) ?>" required>
                </div>

                <div class="form-group">
                    <label>Giá sản phẩm</label>
                    <input class="form-control" type="number" name="price" placeholder="Nhập giá sản phẩm" value="<?= htmlspecialchars($productEdit['price'] ?? '', ENT_QUOTES) ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Danh mục</label>
                    <input class="form-control" type="text" name="category" placeholder="Nhập danh mục" value="<?= htmlspecialchars($productEdit['category'] ?? '', ENT_QUOTES) ?>" required>
                </div>

                <div class="form-group">
                    <label>Hình ảnh sản phẩm</label>
                    <input class="form-control" type="text" name="image" placeholder="Link hình ảnh" value="<?= htmlspecialchars($productEdit['image'] ?? '', ENT_QUOTES) ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label>Mô tả sản phẩm</label>
                <textarea class="form-control" name="description" rows="5" placeholder="Nhập mô tả chi tiết sản phẩm..."><?= htmlspecialchars($productEdit['description'] ?? '', ENT_QUOTES) ?></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">
                    💾 Lưu sản phẩm
                </button>

                <a href="?pages=admin&section=products" class="btn-secondary">
                    Hủy
                </a>
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
                            <a class="btn-danger" href="?pages=admin&section=products&action=delete&id=<?= $product['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</a>
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
