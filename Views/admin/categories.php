<?php
$adminAction = $_GET['action'] ?? '';
$categoryEdit = null;
if ($adminAction === 'edit' && isset($_GET['id'])) {
    foreach ($adminCategories as $category) {
        if (intval($category['id']) === intval($_GET['id'])) {
            $categoryEdit = $category;
            break;
        }
    }
}
?>

<div class="admin-card">
    <div class="page-header">
        <div>
            <h2 class="page-title">Quản lý danh mục</h2>
            <p class="page-subtitle">Tạo và chỉnh sửa các danh mục sản phẩm.</p>
        </div>
        <div class="page-actions">
            <form class="search-box" action="?pages=admin&section=categories" method="get">
                <input type="hidden" name="pages" value="admin">
                <input type="hidden" name="section" value="categories">
                <input type="text" name="q" placeholder="Tìm kiếm danh mục...">
                <button type="submit">Tìm</button>
            </form>
            <a class="btn-primary" href="?pages=admin&section=categories&action=add">+ Thêm danh mục</a>
        </div>
    </div>

    <?php if ($adminAction === 'add' || $adminAction === 'edit'): ?>
        <div class="admin-card" style="margin-bottom:24px; padding:24px;">
            <h3><?= $adminAction === 'edit' ? 'Chỉnh sửa danh mục' : 'Thêm danh mục mới' ?></h3>
            <form method="post">
                <input type="hidden" name="admin_form" value="categories">
                <input type="hidden" name="id" value="<?= $categoryEdit['id'] ?? '' ?>">
                <div style="margin-top:18px;">
                    <input name="name" placeholder="Tên danh mục" value="<?= htmlspecialchars($categoryEdit['name'] ?? '', ENT_QUOTES) ?>" required>
                </div>
                <div style="margin-top:16px; display:flex; gap:12px; flex-wrap:wrap;">
                    <button class="btn-primary" type="submit">Lưu</button>
                    <a class="btn-secondary" href="?pages=admin&section=categories">Hủy</a>
                </div>
            </form>
        </div>
    <?php endif; ?>

    <table class="table-admin">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($adminCategories)): ?>
                <?php foreach ($adminCategories as $category): ?>
                    <tr>
                        <td><?= $category['id'] ?></td>
                        <td><?= htmlspecialchars($category['name'], ENT_QUOTES) ?></td>
                        <td>
                            <a class="btn-secondary" href="?pages=admin&section=categories&action=edit&id=<?= $category['id'] ?>">Sửa</a>
                            <a class="btn-danger" href="?pages=admin&section=categories&action=delete&id=<?= $category['id'] ?>">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">Chưa có dữ liệu</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
