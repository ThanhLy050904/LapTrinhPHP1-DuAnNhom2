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
.admin-card{
    background:#fff;
    border-radius:24px;
    padding:35px;
    box-shadow:0 15px 40px rgba(0,0,0,.06);
}

.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;
    flex-wrap:wrap;
    gap:20px;
}

.page-title{
    font-size:32px;
    font-weight:700;
    margin:0;
    color:#111827;
}

.page-subtitle{
    color:#6b7280;
    margin-top:6px;
}

.page-actions{
    display:flex;
    gap:12px;
    flex-wrap:wrap;
}

.search-box{
    display:flex;
    align-items:center;
    background:#f8fafc;
    border-radius:14px;
    overflow:hidden;
    border:1px solid #e5e7eb;
}

.search-box input{
    border:none;
    background:none;
    padding:14px 18px;
    width:260px;
    outline:none;
}

.search-box button{
    border:none;
    background:#111827;
    color:white;
    padding:14px 20px;
    cursor:pointer;
}

.btn-primary{
    background:#2563eb;
    color:white;
    padding:14px 20px;
    border-radius:14px;
    text-decoration:none;
    font-weight:600;
}

.btn-primary:hover{
    background:#1d4ed8;
}

.btn-secondary{
    background:#f3f4f6;
    color:#111827;
    padding:10px 16px;
    border-radius:12px;
    text-decoration:none;
}

.btn-danger{
    background:#ef4444;
    color:white;
    padding:10px 16px;
    border-radius:12px;
    text-decoration:none;
}

.category-form-card{
    background:linear-gradient(135deg,#ffffff,#f8fafc);
    border:1px solid #e5e7eb;
    border-radius:24px;
    padding:30px;
    margin-bottom:30px;
}

.form-title{
    font-size:24px;
    margin-bottom:25px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
}

.form-group input{
    width:100%;
    padding:15px;
    border:1px solid #d1d5db;
    border-radius:14px;
    transition:.3s;
}

.form-group input:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 4px rgba(37,99,235,.12);
    outline:none;
}

.category-preview{
    margin-top:25px;
    background:white;
    border-radius:20px;
    padding:40px;
    text-align:center;
    border:2px dashed #cbd5e1;
}

.preview-icon{
    font-size:70px;
    margin-bottom:15px;
}

.category-preview h4{
    font-size:24px;
    margin-bottom:5px;
}

.category-preview p{
    color:#6b7280;
}

.form-actions{
    margin-top:25px;
    display:flex;
    gap:12px;
}

.table-admin{
    width:100%;
    border-collapse:separate;
    border-spacing:0;
    overflow:hidden;
    border-radius:20px;
    background:white;
    box-shadow:0 10px 30px rgba(0,0,0,.05);
}

.table-admin th{
    background:#111827;
    color:white;
    padding:18px;
    font-weight:600;
}

.table-admin td{
    padding:18px;
    border-bottom:1px solid #f1f5f9;
}

.table-admin tr:hover{
    background:#f8fafc;
}

.table-admin td:last-child{
    display:flex;
    gap:8px;
}

@media(max-width:768px){

    .page-header{
        flex-direction:column;
        align-items:flex-start;
    }

    .search-box{
        width:100%;
    }

    .search-box input{
        width:100%;
    }

    .form-actions{
        flex-direction:column;
    }
}
</style>

<div class="admin-card">

    <div class="page-header">

        <div>
            <h2 class="page-title">👕 Quản lý danh mục</h2>
            <p class="page-subtitle">
                Quản lý danh mục sản phẩm thời trang của cửa hàng
            </p>
        </div>

        <div class="page-actions">

            <form class="search-box"
                action="?pages=admin&section=categories"
                method="get">

                <input type="hidden" name="pages" value="admin">
                <input type="hidden" name="section" value="categories">

                <input
                    type="text"
                    name="q"
                    placeholder="Tìm kiếm danh mục...">

                <button type="submit">
                    🔍
                </button>

            </form>

            <a class="btn-primary"
                href="?pages=admin&section=categories&action=add">

                + Thêm danh mục

            </a>

        </div>

    </div>

    <?php if ($adminAction === 'add' || $adminAction === 'edit'): ?>

        <div class="category-form-card">

            <h3 class="form-title">
                <?= $adminAction === 'edit'
                    ? '✏️ Chỉnh sửa danh mục'
                    : '➕ Thêm danh mục mới' ?>
            </h3>

            <form method="post">

                <input type="hidden" name="admin_form" value="categories">
                <input type="hidden" name="id" value="<?= $categoryEdit['id'] ?? '' ?>">

                <div class="form-group">

                    <label>Tên danh mục</label>

                    <input
                        type="text"
                        name="name"
                        placeholder="Ví dụ: Áo thun nam"
                        value="<?= htmlspecialchars($categoryEdit['name'] ?? '', ENT_QUOTES) ?>"
                        required>

                </div>

                <div class="category-preview">

                    <div class="preview-icon">👕</div>

                    <h4 id="previewName">

                        <?= !empty($categoryEdit['name'])
                            ? htmlspecialchars($categoryEdit['name'])
                            : 'Tên danh mục sẽ hiển thị ở đây' ?>

                    </h4>

                    <p>
                        Thời trang • Phụ kiện • Xu hướng
                    </p>

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
                <th width="80">ID</th>
                <th>Tên danh mục</th>
                <th width="220">Hành động</th>
            </tr>

        </thead>

        <tbody>

            <?php if (!empty($adminCategories)): ?>

                <?php foreach ($adminCategories as $category): ?>

                    <tr>

                        <td>
                            #<?= $category['id'] ?>
                        </td>

                        <td>

                            <strong>
                                <?= htmlspecialchars($category['name'], ENT_QUOTES) ?>
                            </strong>

                        </td>

                        <td>

                            <a class="btn-secondary"
                                href="?pages=admin&section=categories&action=edit&id=<?= $category['id'] ?>">

                                ✏️ Sửa

                            </a>

                            <a class="btn-danger"
                                href="?pages=admin&section=categories&action=delete&id=<?= $category['id'] ?>"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">

                                🗑 Xóa

                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td colspan="3" style="text-align:center;padding:40px;">

                        📂 Chưa có danh mục nào

                    </td>

                </tr>

            <?php endif; ?>

        </tbody>

    </table>

</div>