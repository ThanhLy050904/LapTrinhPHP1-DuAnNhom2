<?php

$order = $order ?? null; 
// $order có thể gồm: name, total, items (nếu bạn truyền từ checkout)

?>

<style>
.thank-box{
    max-width:700px;
    margin:auto;
    text-align:center;
    padding:40px;
    background:#fff;
    border-radius:20px;
    box-shadow:0 5px 20px rgba(0,0,0,0.08);
}

.check-icon{
    font-size:70px;
    color:#28a745;
    margin-bottom:20px;
}

.order-summary{
    text-align:left;
    margin-top:30px;
    background:#f8f9fa;
    padding:20px;
    border-radius:12px;
}

.btn-home{
    margin-top:25px;
    padding:12px 30px;
    border-radius:30px;
}
</style>

<main>

<div class="container py-5">

    <div class="thank-box">

        <!-- ICON -->
        <div class="check-icon">
            ✔
        </div>

        <!-- TITLE -->
        <h2 class="fw-bold text-success">
            Đặt hàng thành công!
        </h2>

        <p class="text-muted mt-2">
            Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi.
        </p>

        <!-- ORDER INFO -->
        <?php if($order): ?>

        <div class="order-summary">

            <h5 class="fw-bold mb-3">🧾 Thông tin đơn hàng</h5>

            <p><strong>Người nhận:</strong> <?= htmlspecialchars($order['name'] ?? '---') ?></p>

            <p><strong>Tổng tiền:</strong>
                <span class="text-danger fw-bold">
                    <?= number_format($order['total'] ?? 0) ?> ₫
                </span>
            </p>

            <?php if(!empty($order['items'])): ?>
                <hr>
                <h6>Sản phẩm:</h6>

                <ul>
                    <?php foreach($order['items'] as $item): ?>
                        <li>
                            <?= htmlspecialchars($item['name']) ?> 
                            (x<?= $item['quantity'] ?>)
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

        </div>

        <?php endif; ?>

        <!-- BUTTON -->
        <a href="?pages=danh-muc" class="btn btn-dark btn-home">
            ← Tiếp tục mua sắm
        </a>

    </div>

</div>

</main>