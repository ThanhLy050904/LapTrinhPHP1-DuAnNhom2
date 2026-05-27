<?php

$product = $product ?? null;
$relatedProducts = $relatedProducts ?? [];

?>

<?php if (!$product): ?>

<div class="container py-5 text-center">

    <h2 class="text-danger fw-bold">Không tìm thấy sản phẩm!</h2>

    <a href="?pages=danh-muc" class="btn btn-dark mt-3 rounded-pill px-4">
        ← Quay lại cửa hàng
    </a>

</div>

<?php return; endif; ?>

<style>

/* nền nhẹ */
body{
    background:#f6f7f9;
}

/* khung chính */
.product-wrapper{
    background:#fff;
    border-radius:24px;
    padding:30px;
    box-shadow:0 12px 35px rgba(0,0,0,0.06);
}

/* ảnh */
.detail-image{
    width:100%;
    height:480px;
    object-fit:cover;
    border-radius:18px;
    transition:0.3s;
}

.detail-image:hover{
    transform:scale(1.02);
}

/* tiêu đề */
.product-title{
    font-size:28px;
    font-weight:700;
    color:#111;
}

/* giá */
.price{
    font-size:26px;
    font-weight:700;
    color:#e53935;
}

/* info */
.info{
    padding-left:10px;
}

/* nút */
.btn-cart{
    width:100%;
    padding:14px;
    border-radius:14px;
    font-weight:600;
    font-size:16px;
}

/* related */
.section-title{
    font-size:20px;
    font-weight:700;
    margin-bottom:20px;
}

.related-card{
    border-radius:16px;
    overflow:hidden;
    transition:0.25s;
    border:1px solid #eee;
}

.related-card:hover{
    transform:translateY(-5px);
    box-shadow:0 12px 25px rgba(0,0,0,0.08);
}

.related-card img{
    height:150px;
    object-fit:cover;
}

</style>

<main>

<div class="container py-5">

    <!-- BACK -->
    <a href="?pages=danh-muc"
       class="btn btn-outline-dark mb-4 rounded-pill px-4">
        ← Quay lại
    </a>

    <!-- PRODUCT -->
    <div class="product-wrapper">

        <div class="row g-4 align-items-center">

            <!-- IMAGE -->
            <div class="col-lg-6">

                <img
                    src="Views/image/<?= htmlspecialchars($product['image_main']) ?>"
                    class="detail-image"
                    alt="<?= htmlspecialchars($product['name']) ?>"
                >

            </div>

            <!-- INFO -->
            <div class="col-lg-6">

                <div class="info">

                    <h2 class="product-title mb-3">
                        <?= htmlspecialchars($product['name']) ?>
                    </h2>

                    <div class="price mb-3">
                        <?= number_format($product['price']) ?> ₫
                    </div>

                    <p class="text-muted mb-3">
                        <?= nl2br(htmlspecialchars($product['description'])) ?>
                    </p>

                    <p class="mb-4">
                        <strong>Danh mục:</strong>
                        <?= htmlspecialchars($product['category_name']) ?>
                    </p>

                    <button
                        class="btn btn-dark btn-cart"
                        onclick="addToCart()"
                    >
                        🛒 Thêm vào giỏ hàng
                    </button>

                </div>

            </div>

        </div>

    </div>

    <!-- RELATED -->
    <?php if (!empty($relatedProducts)): ?>

    <div class="mt-5">

        <h4 class="section-title">
            🔥 Sản phẩm cùng danh mục
        </h4>

        <div class="row g-3">

            <?php foreach($relatedProducts as $item): ?>

                <?php if($item['id'] == $product['id']) continue; ?>

                <div class="col-6 col-md-4 col-lg-3">

                    <a href="?pages=chi-tiet-san-pham&id=<?= $item['id'] ?>"
                       class="text-decoration-none text-dark">

                        <div class="card related-card">

                            <img src="Views/image/<?= htmlspecialchars($item['image_main']) ?>">

                            <div class="card-body text-center p-2">

                                <div class="fw-semibold small">
                                    <?= htmlspecialchars($item['name']) ?>
                                </div>

                                <div class="text-danger fw-bold mt-1">
                                    <?= number_format($item['price']) ?> ₫
                                </div>

                            </div>

                        </div>

                    </a>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

    <?php endif; ?>

</div>

</main>

<script>

function addToCart(){

    let count = parseInt(localStorage.getItem('cartCount')) || 0;
    count++;

    localStorage.setItem('cartCount', count);

    const cart = document.getElementById('floating-cart-count');

    if(cart){
        cart.innerText = count;
    }

    alert('✅ Đã thêm vào giỏ hàng!');
}

</script>