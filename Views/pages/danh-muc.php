<?php
$categories = $categories ?? [];
$products = $products ?? [];
$current_category = $current_category ?? 'all';

$page_number = isset($_GET['page_number']) ? (int)$_GET['page_number'] : 1;
if ($page_number < 1) $page_number = 1;
?>

<div class="container py-5">
    <h2 class="page-title">
        Danh Mục Sản Phẩm
    </h2>

    <!-- CATEGORY FILTER -->
    <div class="d-flex flex-wrap justify-content-center gap-3 mb-5">

        <a href="?pages=danh-muc&category=all"
            class="category-btn <?= $current_category === 'all' ? 'active' : '' ?>">
            Tất cả
        </a>

        <?php foreach ($categories as $category): ?>
            <a href="?pages=danh-muc&category=<?= htmlspecialchars($category['slug']) ?>"
                class="category-btn <?= $current_category === $category['slug'] ? 'active' : '' ?>">
                <?= htmlspecialchars($category['name']) ?>
            </a>
        <?php endforeach; ?>

    </div>

    <!-- SEARCH -->
    <div class="search-box">
        <form method="GET">
            <input type="hidden" name="pages" value="danh-muc">
            <input type="hidden" name="category" value="<?= htmlspecialchars($current_category) ?>">

            <div class="input-group">
                <input type="text"
                    name="keyword"
                    class="form-control"
                    placeholder="🔍 Tìm iPhone, Samsung, Xiaomi..."
                    value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">

                <button class="btn btn-dark" type="submit">
                    Tìm kiếm
                </button>
            </div>
        </form>
    </div>

    <!-- PRODUCT LIST -->
    <div class="row g-4">

        <?php if (empty($products)): ?>
            <div class="text-center text-muted">
                Không có sản phẩm nào
            </div>
        <?php endif; ?>

        <?php foreach ($products as $product): ?>
            <div class="col-lg-3 col-md-6 d-flex">
                <div class="card product-card w-100">
                       <!-- thêm ơi đây -->
                    <img src="<?= htmlspecialchars($product['image_main']) ?>"
                        class="product-image"
                        alt="<?= htmlspecialchars($product['name']) ?>">

                    <div class="card-body">
                        <div>
                            <h5 class="fw-bold">
                                <?= htmlspecialchars($product['name']) ?>
                            </h5>

                            <p class="text-muted small">
                                <?= htmlspecialchars($product['category_name']) ?>
                            </p>

                            <div class="price mb-3">
                                <?= number_format($product['price']) ?> ₫
                            </div>
                        </div>

                        <a href="?pages=chi-tiet-san-pham&id=<?= $product['id'] ?>"
                            class="btn btn-dark w-100 btn-detail">
                            Chi Tiết
                        </a>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>

    </div>

    <!-- PAGINATION -->
    <?php if (!empty($totalPages) && $totalPages > 1): ?>
        <div class="d-flex justify-content-center mt-4 gap-2">

            <?php if ($page_number > 1): ?>
                <a class="btn btn-outline-dark"
                    href="?pages=danh-muc&category=<?= $current_category ?>&keyword=<?= $_GET['keyword'] ?? '' ?>&page_number=<?= $page_number - 1 ?>">
                    Trước
                </a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a class="btn <?= ($i == $page_number) ? 'btn-dark' : 'btn-outline-dark' ?>"
                    href="?pages=danh-muc&category=<?= $current_category ?>&keyword=<?= $_GET['keyword'] ?? '' ?>&page_number=<?= $i ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <?php if ($page_number < $totalPages): ?>
                <a class="btn btn-outline-dark"
                    href="?pages=danh-muc&category=<?= $current_category ?>&keyword=<?= $_GET['keyword'] ?? '' ?>&page_number=<?= $page_number + 1 ?>">
                    Tiếp
                </a>
            <?php endif; ?>

        </div>
    <?php endif; ?>

</div>