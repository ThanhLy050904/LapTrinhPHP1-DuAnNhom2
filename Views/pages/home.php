<?php
$categories = $categories ?? [];
$featured_products = $featured_products ?? [];
$reviews = $reviews ?? [];
$news = $news ?? [];
?>

<main>
    <div id="homeBanner" class="carousel slide mb-5" data-bs-ride="carousel">

        <div class="carousel-indicators">
            <button type="button" data-bs-target="#homeBanner" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#homeBanner" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#homeBanner" data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner">

            <div class="carousel-item active">
                <img src="Views/image/banner1.png"
                    class="d-block w-100 banner-img"
                    alt="Banner 1">

                <div class="carousel-caption">
                    <h2>BST Mùa Hè 2026</h2>
                    <p>Giảm giá lên đến 50%</p>
                    <a href="?pages=danh-muc" class="btn btn-light">
                        Mua ngay
                    </a>
                </div>
            </div>

            <div class="carousel-item">
                <img src="Views/image/banner2.png"
                    class="d-block w-100 banner-img"
                    alt="Banner 2">

                <div class="carousel-caption">
                    <h2>Áo Hoodie Hot Trend</h2>
                    <p>Phong cách trẻ trung năng động</p>
                    <a href="?pages=danh-muc" class="btn btn-light">
                        Khám phá
                    </a>
                </div>
            </div>

            <div class="carousel-item">
                <img src="Views/image/banner3.png"
                    class="d-block w-100 banner-img"
                    alt="Banner 3">

                <div class="carousel-caption">
                    <h2>Freeship Toàn Quốc</h2>
                    <p>Cho đơn hàng từ 299.000đ</p>
                    <a href="?pages=danh-muc" class="btn btn-light">
                        Xem ngay
                    </a>
                </div>
            </div>

        </div>

        <button class="carousel-control-prev"
            type="button"
            data-bs-target="#homeBanner"
            data-bs-slide="prev">

            <span class="carousel-control-prev-icon"></span>

        </button>

        <button class="carousel-control-next"
            type="button"
            data-bs-target="#homeBanner"
            data-bs-slide="next">

            <span class="carousel-control-next-icon"></span>

        </button>

    </div>

    <!-- ================= CATEGORY ================= -->
    <div class="container my-5 text-center">
        <h3 class="section-title">Danh mục sản phẩm</h3>

        <div class="row g-3">
            <?php foreach ($categories as $category): ?>
                <div class="col-md-2 col-6">
                    <a href="?pages=danh-muc&category=<?= htmlspecialchars($category['slug']) ?>"
                        class="text-decoration-none text-dark">
                        <div class="category-box">
                            <h6 class="fw-bold mb-0">
                                <?= htmlspecialchars($category['name']) ?>
                            </h6>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- ================= FEATURED ================= -->
    <div class="container mb-5">
        <h3 class="section-title text-center">Sản phẩm nổi bật</h3>

        <div class="row g-4">
            <?php foreach ($featured_products as $product): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="product-card">
                        <!-- thêm ơi đây -->
                        <img
                            src="<?= htmlspecialchars($product['image_main']) ?>"
                            class="product-image"
                            alt="<?= htmlspecialchars($product['name']) ?>">

                        <div class="p-3 text-center">
                            <h6 class="fw-bold">
                                <?= htmlspecialchars($product['name']) ?>
                            </h6>

                            <small class="text-muted">
                                <?= htmlspecialchars($product['category_name'] ?? '') ?>
                            </small>

                            <div class="price my-2">
                                <?= number_format($product['price']) ?> ₫
                            </div>

                            <a href="?pages=chi-tiet-san-pham&id=<?= $product['id'] ?>"
                                class="btn btn-dark btn-sm w-100">
                                Xem chi tiết
                            </a>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- ================= SUPPORT ================= -->
    <div class="container my-5">
        <h3 class="section-title text-center">Hỗ trợ khách hàng</h3>

        <div class="row g-3">
            <div class="col-md-6">
                <div class="p-4 bg-white rounded shadow-sm h-100">
                    🚚 <b>Giao hàng nhanh</b>
                    <p class="text-muted small mb-0">2-4 ngày toàn quốc</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-4 bg-white rounded shadow-sm h-100">
                    🔄 <b>Đổi trả dễ dàng</b>
                    <p class="text-muted small mb-0">Trong 30 ngày</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-4 bg-white rounded shadow-sm h-100">
                    📏 <b>Tư vấn size</b>
                    <p class="text-muted small mb-0">Chat để được hỗ trợ</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-4 bg-white rounded shadow-sm h-100">
                    ⭐ <b>Cam kết chất lượng</b>
                    <p class="text-muted small mb-0">Đúng hình 100%</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= REVIEWS ================= -->
    <div class="container my-5">
        <h3 class="section-title text-center">Khách hàng nói gì</h3>

        <div class="row g-4">
            <?php foreach ($reviews as $review): ?>
                <div class="col-md-4">
                    <div class="review-card p-4 text-center">

                        <img src="<?= htmlspecialchars($review['avatar']) ?>"
                            class="rounded-circle mb-3"
                            width="70" height="70"
                            style="object-fit:cover">

                        <p class="text-warning mb-1">★★★★★</p>

                        <p class="text-muted small">
                            "<?= htmlspecialchars($review['content']) ?>"
                        </p>

                        <b><?= htmlspecialchars($review['name']) ?></b>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- ================= NEWS ================= -->
    <div class="container my-5">
        <h3 class="section-title text-center">Tin tức</h3>

        <div class="row g-4">
            <?php foreach ($news as $item): ?>
                <div class="col-md-4">
                    <div class="card news-card border-0 shadow-sm">

                        <img src="<?= htmlspecialchars($item['image']) ?>" class="card-img-top">

                        <div class="card-body">
                            <small class="text-muted">
                                <?= $item['date'] ?>
                            </small>

                            <h6 class="fw-bold mt-2">
                                <?= htmlspecialchars($item['title']) ?>
                            </h6>

                            <p class="text-muted small">
                                <?= htmlspecialchars($item['excerpt']) ?>
                            </p>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</main>