<?php

$product = $product ?? null;
$relatedProducts = $relatedProducts ?? [];

if (!$product):
    ?>

    <div class="container py-5 text-center">
        <h2 class="text-danger fw-bold">Không tìm thấy sản phẩm!</h2>
        <a href="?pages=danh-muc" class="btn btn-dark mt-3 rounded-pill px-4">
            ← Quay lại cửa hàng
        </a>
    </div>

    <?php return; endif; ?>

<!-- LINK CSS -->
<link rel="stylesheet" href="Views/css/chi-tiet-san-pham.css">

<main>

    <div class="container py-5">

        <a href="?pages=danh-muc" class="btn btn-outline-dark mb-4 rounded-pill px-4">
            ← Quay lại
        </a>

        <div class="product-wrapper">

            <div class="row g-4 align-items-center">

                <!-- IMAGE -->
                <div class="col-lg-6">
                    <img src="Views/image/<?= htmlspecialchars($product['image_main']) ?>" class="detail-image"
                        alt="<?= htmlspecialchars($product['name']) ?>">
                </div>

                <!-- INFO -->
                <div class="col-lg-6">

                    <h2 class="product-title">
                        <?= htmlspecialchars($product['name']) ?>
                    </h2>

                    <div class="price mb-3">
                        <?= number_format($product['price']) ?> ₫
                    </div>

                    <!-- AN TÂM MUA SẮM -->
                    <div class="alert alert-success mt-3 p-2 rounded-3">
                        ✅ An tâm mua sắm: Trả hàng miễn phí 15 ngày
                    </div>

                    <!-- SIZE -->
                    <div class="mb-3">
                        <strong>Size:</strong>

                        <div class="size-box mt-2">
                            <button type="button" class="size-btn active">38</button>
                            <button type="button" class="size-btn">39</button>
                            <button type="button" class="size-btn">40</button>
                            <button type="button" class="size-btn">41</button>
                            <button type="button" class="size-btn">42</button>
                        </div>
                    </div>

                    <p class="mb-4">
                        <strong>Danh mục:</strong>
                        <?= htmlspecialchars($product['category_name']) ?>
                    </p>

                    <!-- QUANTITY -->
                    <div class="quantity-box">
                        <button type="button" onclick="changeQty(-1)" class="qty-btn">−</button>
                        <input type="number" id="qty" value="1" min="1">
                        <button type="button" onclick="changeQty(1)" class="qty-btn">+</button>
                    </div>

                    <form action="?pages=cart-add" method="POST">

                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

                        <input type="hidden" name="quantity" id="cartQty" value="1">

                        <input type="hidden" name="size" id="cartSize" value="38">

                        <button type="submit" class="btn btn-dark btn-cart">
                            🛒 Thêm vào giỏ hàng
                        </button>

                    </form>

                </div>

            </div>

        </div>

        <!-- 🔥 MÔ TẢ ĐÃ ĐƯA XUỐNG DƯỚI -->
        <div class="mt-4 description-box">

            <h5 class="fw-bold">Mô tả sản phẩm</h5>

            <div class="text-muted mt-2">
                <?= nl2br(htmlspecialchars($product['description'])) ?>
            </div>

        </div>

        <!-- RELATED -->
        <?php if (!empty($relatedProducts)): ?>

            <div class="mt-5">

                <h4 class="section-title">🔥 Sản phẩm cùng danh mục</h4>

                <div class="row g-3">

                    <?php foreach ($relatedProducts as $item): ?>
                        <?php if ($item['id'] == $product['id'])
                            continue; ?>

                        <div class="col-6 col-md-4 col-lg-3">

                            <a href="?pages=chi-tiet-san-pham&id=<?= $item['id'] ?>" class="text-decoration-none text-dark">

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
    document.querySelectorAll('.size-btn').forEach(btn => {

        btn.addEventListener('click', function () {

            document.querySelectorAll('.size-btn').forEach(item => {
                item.classList.remove('active');
            });

            this.classList.add('active');

            document.getElementById('cartSize').value = this.innerText;
        });

    });

    function changeQty(value) {

        let qtyInput = document.getElementById('qty');

        let current = parseInt(qtyInput.value);

        current += value;

        if (current < 1)
            current = 1;

        qtyInput.value = current;

        document
            .getElementById('cartQty')
            .value = current;
    }

    function addToCart() {

        let qty = parseInt(document.getElementById('qty').value) || 1;

        let count = parseInt(localStorage.getItem('cartCount')) || 0;

        count += qty;

        localStorage.setItem('cartCount', count);

        let cart = document.getElementById('floating-cart-count');
        if (cart) cart.innerText = count;

        alert('✅ Đã thêm ' + qty + ' sản phẩm vào giỏ hàng!');
    }

</script>