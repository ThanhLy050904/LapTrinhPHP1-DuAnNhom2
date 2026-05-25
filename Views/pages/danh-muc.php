<?php

$categories = $categories ?? [];
$products = $products ?? [];
$current_category = $current_category ?? 'all';

?>

<style>

.category-btn{
    border-radius:30px;
    padding:10px 24px;
    text-decoration:none;
    border:2px solid black;
    color:black;
    font-weight:600;
    transition:0.3s;
}

.category-btn:hover{
    background:black;
    color:white;
}

.category-btn.active{
    background:black;
    color:white;
}

.product-card{
    border:none;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 5px 20px rgba(0,0,0,0.08);
    transition:0.3s;
}

.product-card:hover{
    transform:translateY(-8px);
}

.product-image{
    height:320px;
    object-fit:cover;
}

.price{
    color:#dc3545;
    font-size:1.3rem;
    font-weight:bold;
}

</style>

<div class="container py-5">

    <h2 class="text-center fw-bold mb-5">

        Danh Mục Sản Phẩm

    </h2>

    <div class="d-flex flex-wrap justify-content-center gap-3 mb-5">

        <a
            href="?pages=danh-muc&category=all"
            class="category-btn <?= $current_category === 'all' ? 'active' : '' ?>"
        >

            Tất cả

        </a>

        <?php foreach($categories as $category): ?>

            <a
                href="?pages=danh-muc&category=<?= htmlspecialchars($category['slug']) ?>"
                class="category-btn <?= $current_category === $category['slug'] ? 'active' : '' ?>"
            >

                <?= htmlspecialchars($category['name']) ?>

            </a>

        <?php endforeach; ?>

    </div>

    <div class="row g-4">

        <?php foreach($products as $product): ?>

            <div class="col-lg-3 col-md-6">

                <div class="card product-card h-100">

                    <img
                        src="<?= htmlspecialchars($product['image_main']) ?>"
                        class="card-img-top product-image"
                    >

                    <div class="card-body text-center">

                        <h5 class="fw-bold">

                            <?= htmlspecialchars($product['name']) ?>

                        </h5>

                        <p class="text-muted">

                            <?= htmlspecialchars($product['category_name']) ?>

                        </p>

                        <div class="price mb-3">

                            <?= number_format($product['price']) ?> ₫

                        </div>

                        <a
                            href="?pages=chi-tiet-san-pham&id=<?= $product['id'] ?>"
                            class="btn btn-dark w-100"
                        >

                            Chi Tiết

                        </a>

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

</div>