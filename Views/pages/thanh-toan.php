<?php

$cart = $cart ?? [];

$total = 0;

foreach($cart as $item){

    $total +=
    $item['price'] *
    $item['quantity'];

}

?>

<style>

.checkout-box{

    border-radius:24px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);

}

.product-image{

    width:70px;
    height:70px;
    object-fit:cover;
    border-radius:12px;

}

.total-price{

    font-size:2rem;
    font-weight:bold;
    color:#dc3545;

}

</style>

<main>

<div class="container py-5">

    <h2 class="fw-bold mb-5">

        💳 Thanh toán

    </h2>

    <div class="row g-5">

        <!-- FORM -->

        <div class="col-lg-7">

            <div class="card border-0 checkout-box">

                <div class="card-body p-5">

                    <h4 class="fw-bold mb-4">

                        Thông tin khách hàng

                    </h4>

                    <form>

                        <!-- NAME -->

                        <div class="mb-4">

                            <label class="form-label">

                                Họ và tên

                            </label>

                            <input
                                type="text"
                                class="form-control form-control-lg"
                                placeholder="Nhập họ tên"
                            >

                        </div>

                        <!-- PHONE -->

                        <div class="mb-4">

                            <label class="form-label">

                                Số điện thoại

                            </label>

                            <input
                                type="text"
                                class="form-control form-control-lg"
                                placeholder="Nhập số điện thoại"
                            >

                        </div>

                        <!-- EMAIL -->

                        <div class="mb-4">

                            <label class="form-label">

                                Email

                            </label>

                            <input
                                type="email"
                                class="form-control form-control-lg"
                                placeholder="Nhập email"
                            >

                        </div>

                        <!-- ADDRESS -->

                        <div class="mb-4">

                            <label class="form-label">

                                Địa chỉ nhận hàng

                            </label>

                            <textarea
                                class="form-control"
                                rows="4"
                                placeholder="Nhập địa chỉ"
                            ></textarea>

                        </div>

                        <!-- PAYMENT -->

                        <div class="mb-4">

                            <label class="form-label">

                                Phương thức thanh toán

                            </label>

                            <select
                                class="form-select form-select-lg"
                            >

                                <option>

                                    Thanh toán khi nhận hàng

                                </option>

                                <option>

                                    Chuyển khoản ngân hàng

                                </option>

                                <option>

                                    Ví điện tử

                                </option>

                            </select>

                        </div>

                        <!-- BUTTON -->

                        <button
                            type="submit"
                            class="btn btn-dark btn-lg w-100"
                        >

                            Đặt hàng

                        </button>

                    </form>

                </div>

            </div>

        </div>

        <!-- ORDER -->

        <div class="col-lg-5">

            <div class="card border-0 checkout-box">

                <div class="card-body p-4">

                    <h4 class="fw-bold mb-4">

                        Đơn hàng của bạn

                    </h4>

                    <?php foreach($cart as $item): ?>

                        <?php

                        $subTotal =
                        $item['price'] *
                        $item['quantity'];

                        ?>

                        <div
                            class="d-flex align-items-center mb-4"
                        >

                            <!-- IMAGE -->

                            <img
                                src="<?= htmlspecialchars($item['image']) ?>"
                                class="product-image"
                                alt=""
                            >

                            <!-- INFO -->

                            <div class="ms-3 flex-grow-1">

                                <h6 class="fw-bold mb-1">

                                    <?= htmlspecialchars($item['name']) ?>

                                </h6>

                                <small class="text-muted">

                                    SL:
                                    <?= $item['quantity'] ?>

                                </small>

                            </div>

                            <!-- PRICE -->

                            <strong>

                                <?= number_format($subTotal) ?> ₫

                            </strong>

                        </div>

                    <?php endforeach; ?>

                    <hr>

                    <div
                        class="d-flex justify-content-between mb-3"
                    >

                        <span>Tạm tính</span>

                        <strong>

                            <?= number_format($total) ?> ₫

                        </strong>

                    </div>

                    <div
                        class="d-flex justify-content-between mb-3"
                    >

                        <span>Phí vận chuyển</span>

                        <strong>

                            Miễn phí

                        </strong>

                    </div>

                    <hr>

                    <div
                        class="d-flex justify-content-between align-items-center"
                    >

                        <span class="fw-bold fs-4">

                            Tổng cộng

                        </span>

                        <span class="total-price">

                            <?= number_format($total) ?> ₫

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</main>