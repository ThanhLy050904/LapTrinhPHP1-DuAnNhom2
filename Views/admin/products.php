<?php
$adminAction = $_GET['action'] ?? '';
$productEdit = null;

if ($adminAction === 'edit' && isset($_GET['id'])) {
    foreach ($adminProducts as $p) {
        if ($p['id'] == $_GET['id']) {
            $productEdit = $p;
            break;
        }
    }
}
?>

<style>
.admin-wrapper-center {
    display: flex;
    justify-content: center;
    padding: 30px;
}

.admin-box {
    width: 100%;
    max-width: 1100px;
}

.admin-card {
    background: #fff;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.admin-btn {
    padding: 10px 14px;
    background: #3b82f6;
    color: #fff;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 500;
}

.admin-btn:hover {
    background: #2563eb;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
}

th {
    background: #f1f5f9;
    padding: 12px;
    text-align: left;
}

td {
    padding: 12px;
    border-top: 1px solid #eee;
}

img {
    border-radius: 8px;
}
</style>

<div class="admin-wrapper-center">
<div class="admin-box">

<div class="admin-card">

    <!-- HEADER -->
    <div class="admin-header">
        <h2>Quản lý sản phẩm</h2>

        <a href="?pages=admin&section=products&action=add" class="admin-btn">
            + Thêm sản phẩm
        </a>
    </div>

    <!-- SEARCH -->
    <form method="get" style="margin-bottom:15px;">
        <input type="hidden" name="pages" value="admin">
        <input type="hidden" name="section" value="products">

        <input type="text"
               name="q"
               placeholder="Tìm sản phẩm..."
               value="<?= $_GET['q'] ?? '' ?>"
               style="padding:10px;width:250px;border:1px solid #ddd;border-radius:8px;">

        <button style="padding:10px 14px;border:none;background:#111;color:#fff;border-radius:8px;">
            Tìm
        </button>
    </form>

    <!-- FORM ADD / EDIT -->
    <?php if ($adminAction === 'add' || $adminAction === 'edit'): ?>

    <div style="margin-top:20px;margin-bottom:20px;">
        <form method="post" enctype="multipart/form-data"
              style="padding:20px;border:1px solid #eee;border-radius:12px;background:#fafafa;">

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:15px;">

                <input type="text" name="name" placeholder="Tên sản phẩm"
                       value="<?= $productEdit['name'] ?? '' ?>" required>

                <input type="number" name="price" placeholder="Giá"
                       value="<?= $productEdit['price'] ?? '' ?>" required>

                <input type="number" name="old_price" placeholder="Giá cũ"
                       value="<?= $productEdit['old_price'] ?? '' ?>">

                <select name="category_id" required>
                    <option value="">-- Danh mục --</option>
                    <?php foreach ($adminCategories as $cat): ?>
                        <option value="<?= $cat['id'] ?>"
                            <?= (isset($productEdit['category_id']) && $productEdit['category_id'] == $cat['id']) ? 'selected' : '' ?>>
                            <?= $cat['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>

            </div>

            <textarea name="description"
                      placeholder="Mô tả"
                      style="width:100%;margin-top:10px;padding:10px;border-radius:8px;border:1px solid #ddd;">
                <?= $productEdit['description'] ?? '' ?>
            </textarea>

            <div style="margin-top:10px;">
                <input type="file" name="image">
                <input type="hidden" name="old_image" value="<?= $productEdit['image_main'] ?? '' ?>">
            </div>

            <div style="margin-top:10px;display:flex;gap:20px;">
                <label><input type="checkbox" name="is_sale" <?= !empty($productEdit['is_sale']) ? 'checked' : '' ?>> Sale</label>
                <label><input type="checkbox" name="is_hot" <?= !empty($productEdit['is_hot']) ? 'checked' : '' ?>> Nổi bật</label>
            </div>

            <button style="margin-top:15px;padding:10px 16px;background:#22c55e;color:#fff;border:none;border-radius:8px;">
                Lưu sản phẩm
            </button>

        </form>
    </div>

    <?php endif; ?>

    <!-- TABLE -->
    <table>
        <tr>
            <th>ID</th>
            <th>Ảnh</th>
            <th>Tên</th>
            <th>Giá</th>
            <th>Danh mục</th>
            <th>Hot</th>
            <th>Action</th>
        </tr>

        <?php foreach ($adminProducts as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><img src="<?= $p['image_main'] ?>" width="60"></td>
            <td><?= $p['name'] ?></td>
            <td><?= number_format($p['price']) ?> đ</td>
            <td><?= $p['category_name'] ?></td>
            <td><?= !empty($p['is_hot']) ? '🔥' : '-' ?></td>
            <td>
                <a href="?pages=admin&section=products&action=edit&id=<?= $p['id'] ?>">Sửa</a> |
                <a onclick="return confirm('Xóa?')"
                   href="?pages=admin&section=products&action=delete&id=<?= $p['id'] ?>">
                   Xóa
                </a>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>

</div>

</div>
</div>