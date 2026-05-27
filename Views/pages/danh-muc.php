<?php
$categories = $categories ?? [];
$products = $products ?? [];
$current_category = $current_category ?? 'all';
?>

<div class="container py-5">
    <h2 class="text-center fw-bold mb-5">Danh Mục Sản Phẩm</h2>

    <div class="d-flex flex-wrap justify-content-center gap-3 mb-5">
        <a href="?pages=danh-muc&category=all" class="category-btn <?= $current_category === 'all' ? 'active' : '' ?>">Tất cả</a>
        <?php foreach ($categories as $category): ?>
            <a href="?pages=danh-muc&category=<?= htmlspecialchars($category['slug']) ?>" 
               class="category-btn <?= $current_category === $category['slug'] ? 'active' : '' ?>">
                <?= htmlspecialchars($category['name']) ?>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="row g-4">
        <?php foreach ($products as $product): ?>
            <div class="col-lg-3 col-md-6 d-flex">
                <div class="card product-card w-100">
                    <img src="Views/image/<?= htmlspecialchars($product['image_main']) ?>" 
                         class="product-image" 
                         alt="<?= htmlspecialchars($product['name']) ?>">
                    <div class="card-body">
                        <div>
                            <h5 class="fw-bold"><?= htmlspecialchars($product['name']) ?></h5>
                            <p class="text-muted small"><?= htmlspecialchars($product['category_name']) ?></p>
                            <div class="price mb-3"><?= number_format($product['price']) ?> ₫</div>
                        </div>
                        <a href="?pages=chi-tiet-san-pham&id=<?= $product['id'] ?>" 
                           class="btn btn-dark w-100 btn-detail">Chi Tiết</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>