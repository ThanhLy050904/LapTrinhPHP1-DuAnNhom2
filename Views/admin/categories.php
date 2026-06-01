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
<style>
.category-form-card{
    padding:30px;
    margin-bottom:25px;
}

.form-title{
    font-size:24px;
    margin-bottom:25px;
    color:#111827;
}

.category-form{
    max-width:700px;
}

.form-group{
    display:flex;
    flex-direction:column;
}

.form-group label{
    font-weight:600;
    margin-bottom:8px;
    color:#374151;
}

.form-group input{
    padding:14px 16px;
    border:1px solid #d1d5db;
    border-radius:12px;
    font-size:15px;
}

.form-group input:focus{
    outline:none;
    border-color:#4f46e5;
    box-shadow:0 0 0 4px rgba(79,70,229,.12);
}

.category-preview{
    margin-top:25px;
    padding:30px;
    border:2px dashed #d1d5db;
    border-radius:18px;
    text-align:center;
    background:#fafafa;
}

.preview-icon{
    font-size:60px;
    margin-bottom:15px;
}

.category-preview h4{
    margin:0;
    font-size:22px;
    color:#111827;
}

.category-preview p{
    margin-top:8px;
    color:#6b7280;
}

.form-actions{
    display:flex;
    gap:10px;
    margin-top:25px;
}
</style>
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
<div class="admin-card category-form-card">

    <h3 class="form-title">
        <?= $adminAction === 'edit'
            ? '✏️ Chỉnh sửa danh mục'
            : '➕ Thêm danh mục mới' ?>
    </h3>

    <form method="post" class="category-form">

        <input type="hidden" name="admin_form" value="categories">
        <input type="hidden" name="id" value="<?= $categoryEdit['id'] ?? '' ?>">

        <div class="form-group">

            <label>Tên danh mục</label>

            <input
                type="text"
                name="name"
                placeholder="Nhập tên danh mục..."
                value="<?= htmlspecialchars($categoryEdit['name'] ?? '', ENT_QUOTES) ?>"
                required>

        </div>

        <div class="category-preview">

            <div class="preview-icon">📂</div>

            <h4 id="previewName">
                <?= !empty($categoryEdit['name'])
                    ? htmlspecialchars($categoryEdit['name'])
                    : 'Tên danh mục sẽ hiển thị ở đây' ?>
            </h4>

            <p>Danh mục sản phẩm</p>

        </div>

        <div class="form-actions">

            <button class="btn-primary" type="submit">
                💾 Lưu danh mục
            </button>

            <a class="btn-secondary"
                href="?pages=admin&section=categories">
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
