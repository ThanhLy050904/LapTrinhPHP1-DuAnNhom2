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
    padding: 20px;
}

.admin-box {
    width: 100%;
    max-width: 1200px;
}

.admin-card {
    background: #fff;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
}

.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 12px;
}

.admin-header h2 {
    font-size: 22px;
    color: #1f2937;
}

.admin-btn {
    padding: 10px 18px;
    background: #3b82f6;
    color: #fff;
    border: none;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    display: inline-block;
    transition: background 0.2s;
}

.admin-btn:hover {
    background: #2563eb;
    color: #fff;
}

.admin-btn-danger {
    background: #ef4444;
}

.admin-btn-danger:hover {
    background: #dc2626;
}

/* Alert */
.alert {
    padding: 12px 16px;
    border-radius: 8px;
    margin-bottom: 16px;
    font-size: 14px;
}

.alert-success {
    background: #d1fae5;
    color: #065f46;
    border: 1px solid #a7f3d0;
}

.alert-error {
    background: #fecaca;
    color: #991b1b;
    border: 1px solid #fca5a5;
}

.alert-info {
    background: #dbeafe;
    color: #1e40af;
    border: 1px solid #bfdbfe;
}

/* Search */
.search-form {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.search-form input[type="text"] {
    flex: 1;
    min-width: 250px;
    padding: 10px 14px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 14px;
    transition: border-color 0.2s;
}

.search-form input[type="text"]:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.search-form button {
    padding: 10px 20px;
    background: #1f2937;
    color: #fff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 500;
    transition: background 0.2s;
}

.search-form button:hover {
    background: #111827;
}

.search-form .clear-link {
    display: inline-flex;
    align-items: center;
    padding: 10px 16px;
    color: #6b7280;
    text-decoration: none;
    border-radius: 8px;
    transition: background 0.2s;
}

.search-form .clear-link:hover {
    background: #f3f4f6;
}

/* Form */
.product-form {
    background: #f9fafb;
    padding: 24px;
    border-radius: 12px;
    margin-bottom: 24px;
    border: 1px solid #e5e7eb;
}

.product-form h3 {
    margin-bottom: 20px;
    color: #1f2937;
    font-size: 18px;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-size: 13px;
    font-weight: 500;
    color: #374151;
    margin-bottom: 4px;
}

.form-group .form-control {
    padding: 10px 12px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 14px;
    transition: border-color 0.2s;
}

.form-group .form-control:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-group textarea.form-control {
    min-height: 80px;
    resize: vertical;
}

.form-group select.form-control {
    appearance: auto;
}

.form-check {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 8px;
}

.form-check input[type="checkbox"] {
    width: 18px;
    height: 18px;
    cursor: pointer;
}

.form-check label {
    font-size: 14px;
    color: #374151;
    cursor: pointer;
}

.form-actions {
    display: flex;
    gap: 10px;
    margin-top: 20px;
}

.form-actions .btn-submit {
    padding: 10px 24px;
    background: #22c55e;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.2s;
}

.form-actions .btn-submit:hover {
    background: #16a34a;
}

.form-actions .btn-cancel {
    padding: 10px 24px;
    background: #6b7280;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    transition: background 0.2s;
}

.form-actions .btn-cancel:hover {
    background: #4b5563;
}

/* Table */
.table-wrapper{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
    table-layout:fixed;
    font-size:14px;
}

table thead{
    background:#f9fafb;
}

table th{
    padding:12px 16px;
    text-align:left;
    font-weight:600;
    color:#374151;
    border-bottom:2px solid #e5e7eb;
}

table td{
    padding:12px 16px;
    border-bottom:1px solid #f3f4f6;
    vertical-align:middle;
}

/* Chỉnh độ rộng cột */
table th:nth-child(1),
table td:nth-child(1){
    width:60px;
    text-align:center;
}

table th:nth-child(2),
table td:nth-child(2){
    width:90px;
    text-align:center;
}

table th:nth-child(3),
table td:nth-child(3){
    width:280px;
}

table th:nth-child(4),
table td:nth-child(4){
    width:170px;
}

table th:nth-child(5),
table td:nth-child(5){
    width:150px;
}

table th:nth-child(6),
table td:nth-child(6){
    width:80px;
    text-align:center;
}

table th:nth-child(7),
table td:nth-child(7){
    width:180px;
    text-align:center;
}

.product-image{
    width:70px;
    height:70px;
    object-fit:cover;
    border-radius:8px;
    border:1px solid #ddd;
}

.action-links{
    display:flex;
    justify-content:center;
    gap:8px;
}

.action-links a{
    min-width:80px;
    text-align:center;
}
table tbody tr:hover {
    background: #f9fafb;
}

.product-image {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
}

.product-name {
    font-weight: 500;
    color: #1f2937;
}

.badge-sale {
    display: inline-block;
    background: #ef4444;
    color: #fff;
    padding: 2px 10px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 600;
    margin-left: 6px;
}

.badge-hot {
    font-size: 18px;
}

.price-old {
    display: block;
    color: #6b7280;
    text-decoration: line-through;
    font-size: 12px;
}

.action-links {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
}

.action-links a {
    padding: 4px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 13px;
    transition: all 0.2s;
}

.action-links .edit-link {
    color: #3b82f6;
    background: #eff6ff;
}

.action-links .edit-link:hover {
    background: #dbeafe;
}

.action-links .delete-link {
    color: #ef4444;
    background: #fef2f2;
}

.action-links .delete-link:hover {
    background: #fecaca;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #6b7280;
}

.empty-state .empty-icon {
    font-size: 56px;
    margin-bottom: 16px;
}

.empty-state p {
    font-size: 16px;
    margin-bottom: 16px;
}

/* Responsive */
@media (max-width: 768px) {
    .admin-header {
        flex-direction: column;
        align-items: stretch;
        text-align: center;
    }

    .form-grid {
        grid-template-columns: 1fr;
    }

    table {
        font-size: 13px;
    }

    table th,
    table td {
        padding: 8px 10px;
    }

    .search-form {
        flex-direction: column;
    }

    .search-form input[type="text"] {
        min-width: auto;
    }
}
</style>

<div class="admin-wrapper-center">
<div class="admin-box">

<div class="admin-card">

    <!-- HEADER -->
    <div class="admin-header">
        <h2>📦 Quản lý sản phẩm</h2>
        <a href="?pages=admin&section=products&action=add" class="admin-btn">
            + Thêm sản phẩm
        </a>
    </div>

    <!-- ALERT -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-error"><?= $_SESSION['error'] ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])): ?>
        <div class="alert alert-error">
            <ul style="margin:0;padding-left:20px;">
                <?php foreach ($_SESSION['errors'] as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php unset($_SESSION['errors']); ?>
    <?php endif; ?>

    <!-- SEARCH -->
    <form method="get" class="search-form">
        <input type="hidden" name="pages" value="admin">
        <input type="hidden" name="section" value="products">
        
        <input type="text" 
               name="q" 
               placeholder="Tìm sản phẩm theo tên hoặc mô tả..." 
               value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
        
        <button type="submit">🔍 Tìm</button>
        
        <?php if (!empty($_GET['q'])): ?>
            <a href="?pages=admin&section=products" class="clear-link">✕ Xóa tìm kiếm</a>
        <?php endif; ?>
    </form>

    <!-- FORM ADD / EDIT -->
    <?php if ($adminAction === 'add' || $adminAction === 'edit'): ?>
    <div class="product-form">
        <h3><?= $adminAction === 'add' ? '➕ Thêm sản phẩm mới' : '✏️ Chỉnh sửa sản phẩm' ?></h3>
        
        <form method="post" enctype="multipart/form-data">
            <?php if ($adminAction === 'edit'): ?>
                <input type="hidden" name="id" value="<?= $productEdit['id'] ?? '' ?>">
            <?php endif; ?>

            <div class="form-grid">
                <div class="form-group">
                    <label for="name">Tên sản phẩm *</label>
                    <input type="text" 
                           id="name"
                           name="name" 
                           class="form-control"
                           placeholder="Tên sản phẩm"
                           value="<?= htmlspecialchars($productEdit['name'] ?? '') ?>" 
                           required>
                </div>

                <div class="form-group">
                    <label for="price">Giá (VNĐ) *</label>
                    <input type="number" 
                           id="price"
                           name="price" 
                           class="form-control"
                           placeholder="Giá sản phẩm"
                           value="<?= $productEdit['price'] ?? '' ?>" 
                           required>
                </div>

                <div class="form-group">
                    <label for="old_price">Giá cũ (VNĐ)</label>
                    <input type="number" 
                           id="old_price"
                           name="old_price" 
                           class="form-control"
                           placeholder="Giá cũ (nếu có)"
                           value="<?= $productEdit['old_price'] ?? '' ?>">
                </div>

                <div class="form-group">
                    <label for="category_id">Danh mục *</label>
                    <select id="category_id" name="category_id" class="form-control" required>
                        <option value="">-- Chọn danh mục --</option>
                        <?php foreach ($adminCategories as $cat): ?>
                            <option value="<?= $cat['id'] ?>"
                                <?= (isset($productEdit['category_id']) && $productEdit['category_id'] == $cat['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group" style="grid-column: 1 / -1;">
                    <label for="description">Mô tả</label>
                    <textarea id="description"
                              name="description"
                              class="form-control"
                              placeholder="Mô tả sản phẩm"><?= htmlspecialchars($productEdit['description'] ?? '') ?></textarea>
                </div>

                <div class="form-group" style="grid-column: 1 / -1;">
                    <label>Ảnh sản phẩm</label>
                    <?php if (!empty($productEdit['image_main'])): ?>
                        <div style="margin-bottom:10px;">
                            <img src="<?= htmlspecialchars($productEdit['image_main']) ?>" 
                                 alt="Product image" 
                                 style="max-width:150px;border-radius:8px;border:1px solid #e5e7eb;">
                            <input type="hidden" name="old_image" value="<?= htmlspecialchars($productEdit['image_main']) ?>">
                        </div>
                    <?php endif; ?>
                    <input type="file" name="image" class="form-control" style="padding:8px;">
                    <small style="color:#6b7280;margin-top:4px;">
                        Chấp nhận: JPG, PNG, GIF, WEBP (tối đa 2MB)
                    </small>
                </div>
            </div>

            <div style="display:flex;gap:20px;margin-top:12px;flex-wrap:wrap;">
                <label class="form-check">
                    <input type="checkbox" name="is_sale" <?= !empty($productEdit['is_sale']) ? 'checked' : '' ?>>
                    <span>🏷️ Sản phẩm giảm giá</span>
                </label>
                <label class="form-check">
                    <input type="checkbox" name="is_hot" <?= !empty($productEdit['is_hot']) ? 'checked' : '' ?>>
                    <span>🔥 Sản phẩm nổi bật</span>
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <?= $adminAction === 'add' ? '➕ Thêm sản phẩm' : '💾 Cập nhật' ?>
                </button>
                <a href="?pages=admin&section=products" class="btn-cancel">❌ Hủy</a>
            </div>
        </form>
    </div>
    <?php endif; ?>

    <!-- TABLE -->
    <?php if (empty($adminProducts)): ?>
        <div class="empty-state">
            <div class="empty-icon">📦</div>
            <p>Chưa có sản phẩm nào trong hệ thống.</p>
            <a href="?pages=admin&section=products&action=add" class="admin-btn" style="display:inline-block;">
                + Thêm sản phẩm đầu tiên
            </a>
        </div>
    <?php else: ?>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Danh mục</th>
                    <th>Hot</th>
                    <th style="text-align:center;">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($adminProducts as $p): ?>
                <tr>
                    <td>#<?= $p['id'] ?></td>
                    <td>
                        <?php if (!empty($p['image_main'])): ?>
                            <img src="<?= htmlspecialchars($p['image_main']) ?>" 
                                 class="product-image" 
                                 alt="<?= htmlspecialchars($p['name']) ?>">
                        <?php else: ?>
                            <span style="color:#9ca3af;font-size:12px;">No image</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="product-name">
                            <?= htmlspecialchars($p['name']) ?>
                            <?php if (!empty($p['is_sale'])): ?>
                                <span class="badge-sale">SALE</span>
                            <?php endif; ?>
                        </div>
                    </td>
                    <td>
                        <strong><?= number_format($p['price']) ?> đ</strong>
                        <?php if (!empty($p['old_price'])): ?>
                            <span class="price-old"><?= number_format($p['old_price']) ?> đ</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($p['category_name'] ?? 'Chưa phân loại') ?></td>
                    <td class="badge-hot"><?= !empty($p['is_hot']) ? '🔥' : '−' ?></td>
                    <td>
                        <div class="action-links" style="justify-content:center;">
                            <a href="?pages=admin&section=products&action=edit&id=<?= $p['id'] ?>" class="edit-link">✏️ Sửa</a>
                            <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm &quot;<?= htmlspecialchars($p['name']) ?>&quot;?')" 
                               href="?pages=admin&section=products&action=delete&id=<?= $p['id'] ?>" 
                               class="delete-link">🗑️ Xóa</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

</div>

</div>
</div>