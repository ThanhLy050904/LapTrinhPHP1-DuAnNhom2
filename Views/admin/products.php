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
<style>
    .product-form-card{
    margin-bottom:25px;
    padding:30px;
}

.form-title{
    margin-bottom:25px;
    font-size:24px;
}

.product-form{
    width:100%;
}

.form-row{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
    margin-bottom:20px;
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

.form-group input,
.form-group select,
.form-group textarea{
    padding:12px 15px;
    border:1px solid #d1d5db;
    border-radius:12px;
    font-size:14px;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus{
    outline:none;
    border-color:#4f46e5;
}

.editor-toolbar{
    display:flex;
    gap:8px;
    padding:10px;
    border:1px solid #d1d5db;
    border-bottom:none;
    border-radius:12px 12px 0 0;
    background:#f8fafc;
}

.editor-toolbar button{
    border:none;
    background:white;
    padding:8px 12px;
    border-radius:8px;
    cursor:pointer;
}

.form-group textarea{
    resize:none;
    min-height:220px;
    border-radius:0 0 12px 12px;
}

.upload-box{
    min-height:280px;
    border:2px dashed #cbd5e1;
    border-radius:20px;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    cursor:pointer;
    transition:.3s;
    background:#fafafa;
}

.upload-box:hover{
    border-color:#4f46e5;
    background:#f5f3ff;
}

.upload-icon{
    font-size:55px;
    margin-bottom:10px;
}

.upload-box h4{
    margin:0;
}

.upload-box p{
    color:#6b7280;
}

.upload-box img{
    width:250px;
    height:250px;
    object-fit:cover;
    border-radius:16px;
}

.form-actions{
    display:flex;
    gap:10px;
    margin-top:25px;
}

@media(max-width:768px){

    .form-row{
        grid-template-columns:1fr;
    }

}
</style>

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
<div class="admin-card product-form-card">

    <h3 class="form-title">
        <?= $adminAction === 'edit'
            ? '✏️ Chỉnh sửa sản phẩm'
            : '➕ Thêm sản phẩm mới' ?>
    </h3>

    <form class="product-form">

        <div class="form-row">
            <div class="form-group">
                <label>Tên sản phẩm</label>
                <input type="text" placeholder="Nhập tên sản phẩm">
            </div>

            <div class="form-group">
                <label>Giá sản phẩm</label>
                <input type="number" placeholder="Nhập giá sản phẩm">
            </div>
        </div>

        <div class="form-row">

            <div class="form-group">
                <label>Danh mục</label>

                <select>
                    <option>Chọn danh mục</option>
                    <option>Áo Thun</option>
                    <option>Quần Jeans</option>
                    <option>Hoodie</option>
                    <option>Áo Khoác</option>
                    <option>Quần Short</option>
                </select>
            </div>

            <div class="form-group">
                <label>Tình trạng</label>

                <select>
                    <option>Còn hàng</option>
                    <option>Hết hàng</option>
                </select>
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

            <textarea rows="8"
                placeholder="Nhập mô tả chi tiết sản phẩm..."></textarea>
        </div>

        <div class="form-group">
            <label>Hình ảnh sản phẩm</label>

            <input type="file"
                id="productImage"
                hidden>

            <label for="productImage" class="upload-box">

                <div id="uploadContent">
                    <div class="upload-icon">📷</div>
                    <h4>Tải ảnh sản phẩm</h4>
                    <p>Kéo thả hoặc nhấn để chọn ảnh</p>
                </div>

                <img id="previewImage"
                    src=""
                    alt=""
                    style="display:none;">
            </label>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">
                💾 Lưu sản phẩm
            </button>

            <a href="?pages=admin&section=products"
                class="btn-secondary">
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
