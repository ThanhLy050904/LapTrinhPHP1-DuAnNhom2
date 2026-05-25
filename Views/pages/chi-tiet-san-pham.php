<?php

$product = $product ?? null;

$colors = $colors ?? [];

?>

<?php if (!$product): ?>

<div class="container py-5">

    <h2 class="text-danger text-center">

        Không tìm thấy sản phẩm!

    </h2>

    <div class="text-center mt-4">

        <a href="?pages=danh-muc"
           class="btn btn-dark">

            ← Quay lại cửa hàng

        </a>

    </div>

</div>

<?php return; endif; ?>

<style>

.detail-image{

    width:100%;
    height:500px;
    object-fit:cover;
    border-radius:20px;
    box-shadow:0 10px 30px rgba(0,0,0,0.1);

}

.price{

    font-size:2rem;
    font-weight:bold;
    color:#dc3545;

}

.color-image{

    width:80px;
    height:80px;
    object-fit:cover;
    border-radius:12px;
    border:3px solid transparent;
    cursor:pointer;
    transition:0.3s;

}

.color-image:hover{

    transform:scale(1.08);

}

.color-image.active{

    border-color:black;

}

</style>

<main>

<div class="container py-5">

    <!-- BACK -->

    <a href="?pages=danh-muc"
       class="btn btn-outline-dark mb-4">

        ← Quay lại

    </a>

    <div class="row g-5 align-items-center">

        <!-- IMAGE -->

        <div class="col-lg-6">

            <img
                id="mainImage"
                src="<?= htmlspecialchars($colors[0]['image'] ?? $product['image_main']) ?>"
                class="detail-image"
                alt="<?= htmlspecialchars($product['name']) ?>"
            >

        </div>

        <!-- INFO -->

        <div class="col-lg-6">

            <h2 class="fw-bold mb-3">

                <?= htmlspecialchars($product['name']) ?>

            </h2>

            <div class="price mb-3">

                <?= number_format($product['price']) ?> ₫

            </div>

            <p class="text-muted fs-5">

                <?= nl2br(htmlspecialchars($product['description'])) ?>

            </p>

            <p>

                <strong>Danh mục:</strong>

                <?= htmlspecialchars($product['category_name']) ?>

            </p>

            <!-- COLORS -->

            <?php if(count($colors) > 0): ?>

                <div class="mt-4">

                    <h5 class="mb-3">

                        Chọn màu

                    </h5>

                    <div class="d-flex gap-3 flex-wrap">

                        <?php foreach($colors as $index => $color): ?>

                            <img
                                src="<?= htmlspecialchars($color['image']) ?>"
                                class="color-image <?= $index === 0 ? 'active' : '' ?>"
                                data-image="<?= htmlspecialchars($color['image']) ?>"
                                alt=""
                            >

                        <?php endforeach; ?>

                    </div>

                </div>

            <?php endif; ?>

            <!-- BUTTON -->

            <button
                class="btn btn-dark btn-lg mt-4 px-5"
                onclick="addToCart()"
            >

                Thêm vào giỏ hàng

            </button>

        </div>

    </div>

</div>

</main>

<script>

// MAIN IMAGE
const mainImage =
document.getElementById('mainImage');

// COLOR ITEMS
const colorImages =
document.querySelectorAll('.color-image');

// CHANGE IMAGE
colorImages.forEach(item => {

    item.addEventListener('click', () => {

        // MAIN IMAGE
        mainImage.src =
        item.dataset.image;

        // REMOVE ACTIVE
        colorImages.forEach(img => {

            img.classList.remove('active');

        });

        // ACTIVE
        item.classList.add('active');

    });

});

// ADD CART
function addToCart(){

    let count =
    parseInt(
        localStorage.getItem('cartCount')
    ) || 0;

    count++;

    // SAVE
    localStorage.setItem(
        'cartCount',
        count
    );

    // FLOATING CART
    const floatingCart =
    document.getElementById(
        'floating-cart-count'
    );

    if(floatingCart){

        floatingCart.innerText = count;

    }

    alert(
        '✅ Đã thêm vào giỏ hàng!'
    );

}

</script>