<?php

$cart = $cart ?? [];
$user = $user ?? [];

$cartTotal = 0;

foreach ($cart as $item) {
    $cartTotal += $item['price'] * $item['quantity'];
}

?>

<style>
    body {
        background: #f5f5f5;
    }

    .checkout-box {
        border: none;
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
    }

    .product-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 12px;
    }

    .form-control,
    .form-select {
        border-radius: 12px;
        padding: 12px 16px;
    }

    .btn-dark {
        border-radius: 12px;
        padding: 14px;
        font-weight: 600;
    }

    .total-price {
        font-size: 32px;
        color: #ee4d2d;
        font-weight: 700;
    }

    .qr-box {
        background: #fafafa;
        border: 1px solid #eee;
        border-radius: 16px;
        padding: 20px;
    }
</style>

<main>

    <div class="container py-5">

        <h2 class="fw-bold mb-5">
            💳 Thanh toán đơn hàng
        </h2>

        <div class="row g-4">

            <!-- FORM THANH TOÁN -->
            <div class="col-lg-7">

                <div class="card checkout-box">

                    <div class="card-body p-5">

                        <h4 class="fw-bold mb-4">
                            Thông tin nhận hàng
                        </h4>

                        <form
                            method="POST"
                            action="?pages=thanh-toan&action=place-order">

                            <div class="mb-3">

                                <label class="form-label">
                                    Họ và tên
                                </label>

                                <input
                                    type="text"
                                    name="full_name"
                                    class="form-control"
                                    value="<?= htmlspecialchars($user['full_name'] ?? '') ?>"
                                    required>

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    Số điện thoại
                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    class="form-control"
                                    value="<?= htmlspecialchars($user['phone'] ?? '') ?>"
                                    required>

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    value="<?= htmlspecialchars($user['email'] ?? '') ?>">

                            </div>

                            <div class="mb-4">

                                <label class="form-label">
                                    Địa chỉ nhận hàng
                                </label>

                                <textarea
                                    name="address"
                                    rows="4"
                                    class="form-control"
                                    required><?= htmlspecialchars($user['address'] ?? '') ?></textarea>

                            </div>

                            <div class="mb-4">

                                <label class="form-label">
                                    Phương thức thanh toán
                                </label>

                                <select
                                    name="payment_method"
                                    class="form-select"
                                    id="paymentMethod">

                                    <option value="cod">
                                        Thanh toán khi nhận hàng (COD)
                                    </option>

                                    <option value="bank">
                                        Chuyển khoản ngân hàng
                                    </option>

                                </select>

                            </div>

                            <!-- QR -->
                            <div
                                id="bank-box"
                                class="qr-box text-center mb-4"
                                style="display:none;">

                                <h5 class="mb-3">
                                    Quét mã QR VietinBank
                                </h5>

                                <img
                                    src="https://img.vietqr.io/image/970415-108876898350-compact2.png?amount=<?= $cartTotal ?>&addInfo=THANHTOAN"
                                    class="img-fluid rounded shadow">

                                <p class="mt-3 mb-1">
                                    Ngân hàng: VietinBank
                                </p>

                                <p class="mb-1">
                                    STK: 108876898350
                                </p>

                                <p class="text-muted">
                                    Nội dung: THANHTOAN
                                </p>

                            </div>

                            <button
                                type="submit"
                                class="btn btn-dark w-100">

                                Đặt hàng

                            </button>

                        </form>

                    </div>

                </div>

            </div>

            <!-- ĐƠN HÀNG -->
            <div class="col-lg-5">

                <div class="card checkout-box">

                    <div class="card-body p-4">

                        <h4 class="fw-bold mb-4">
                            Đơn hàng của bạn
                        </h4>

                        <?php foreach ($cart as $item): ?>

                            <?php
                            $subTotal =
                                $item['price']
                                * $item['quantity'];
                            ?>

                            <div
                                class="d-flex align-items-center mb-4">

                                <img
                                    src="Views/image/<?= htmlspecialchars($item['image_main']) ?>"
                                    class="product-image">

                                <div class="ms-3 flex-grow-1">

                                    <h6 class="fw-bold mb-1">
                                        <?= htmlspecialchars($item['name']) ?>
                                    </h6>

                                    <small class="text-muted">
                                        Size:
                                        <?= htmlspecialchars($item['size']) ?>
                                    </small>

                                    <br>

                                    <small class="text-muted">
                                        Số lượng:
                                        <?= $item['quantity'] ?>
                                    </small>

                                </div>

                                <strong>
                                    <?= number_format($subTotal) ?> ₫
                                </strong>

                            </div>

                        <?php endforeach; ?>

                        <hr>

                        <div class="d-flex justify-content-between mb-3">

                            <span>Tạm tính</span>

                            <strong>
                                <?= number_format($cartTotal) ?> ₫
                            </strong>

                        </div>

                        <div class="d-flex justify-content-between mb-3">

                            <span>Phí vận chuyển</span>

                            <strong>
                                Miễn phí
                            </strong>

                        </div>

                        <hr>

                        <div
                            class="d-flex justify-content-between align-items-center">

                            <span class="fw-bold fs-4">
                                Tổng cộng
                            </span>

                            <span class="total-price">
                                <?= number_format($cartTotal) ?> ₫
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>

<script>
    const paymentMethod =
        document.getElementById("paymentMethod");

    const bankBox =
        document.getElementById("bank-box");

    paymentMethod.addEventListener("change", function() {

        if (this.value === "bank") {
            bankBox.style.display = "block";
        } else {
            bankBox.style.display = "none";
        }

    });
</script>