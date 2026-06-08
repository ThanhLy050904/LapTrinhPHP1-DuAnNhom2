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

<<<<<<< HEAD
    <form class="product-form" method="post" enctype="multipart/form-data">
        <input type="hidden" name="admin_form" value="products">
        <input type="hidden" name="id" value="<?= htmlspecialchars($productEdit['id'] ?? '', ENT_QUOTES) ?>">

        <div class="form-row">
            <div class="form-group">
                <label>Tên sản phẩm</label>
                <input type="text" name="name" placeholder="Nhập tên sản phẩm" value="<?= htmlspecialchars($productEdit['name'] ?? '', ENT_QUOTES) ?>" required>
            </div>

            <div class="form-group">
                <label>Giá sản phẩm</label>
                <input type="number" name="price" placeholder="Nhập giá sản phẩm" value="<?= htmlspecialchars($productEdit['price'] ?? '', ENT_QUOTES) ?>" required>
            </div>
        </div>

        <div class="form-row">

            <div class="form-group">
                <label>Danh mục</label>

                <select name="category_id" required>
                    <option value="">Chọn danh mục</option>
                    <?php foreach ($adminCategories as $cat): ?>
                        <option value="<?= $cat['id'] ?>" <?= (isset($productEdit['category_id']) && $productEdit['category_id'] == $cat['id']) ? 'selected' : '' ?>><?= htmlspecialchars($cat['name'], ENT_QUOTES) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Tình trạng</label>
                <div style="display:flex; gap:12px; align-items:center;">
                    <label><input type="checkbox" name="is_sale" value="1" <?= (!empty($productEdit['is_sale'])) ? 'checked' : '' ?>> Sale</label>
                    <label><input type="checkbox" name="is_hot" value="1" <?= (!empty($productEdit['is_hot'])) ? 'checked' : '' ?>> Hot</label>
                </div>
            </div>

        </div>

        <div class="form-group">
            <label>Mô tả sản phẩm</label>

            <div class="editor-toolbar">
                <button type="button"><b>B</b></button>
                <button type="button"><i>I</i></button>
                <button type="button"><u>U</u></button>
                <button type="button">• List</button>
                <button type="button">🔗 Link</button>
            </div>

            <textarea name="description" rows="8" placeholder="Nhập mô tả chi tiết sản phẩm..."><?= htmlspecialchars($productEdit['description'] ?? '', ENT_QUOTES) ?></textarea>
        </div>

        <div class="form-group">
            <label>Hình ảnh sản phẩm</label>
            <input type="file" id="productImage" name="image">

            <label for="productImage" class="upload-box">
                <div id="uploadContent">
                    <div class="upload-icon">📷</div>
                    <h4>Tải ảnh sản phẩm</h4>
                    <p>Kéo thả hoặc nhấn để chọn ảnh</p>
                </div>

                <?php if (!empty($productEdit['image'])): ?>
                    <img id="previewImage" src="<?= htmlspecialchars($productEdit['image'], ENT_QUOTES) ?>" alt="" style="display:block; width:250px; height:250px; object-fit:cover;">
                <?php else: ?>
                    <img id="previewImage" src="" alt="" style="display:none;">
                <?php endif; ?>
            </label>
        </div>
=======
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
>>>>>>> 5e65d85fd2d5d5ccb45e481e044a54de37b3ec9e

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
