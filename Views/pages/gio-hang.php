<?php

$cart = $cart ?? [];

$total = 0;

?>

<style>

.cart-image{

    width:100px;
    height:100px;
    object-fit:cover;
    border-radius:16px;

}

.quantity-input{

    width:80px;

}

.cart-total{

    font-size:2rem;
    font-weight:bold;
    color:#dc3545;

}

</style>

<main>

<div class="container py-5">

    <h2 class="fw-bold mb-5">

        🛒 Giỏ hàng của bạn

    </h2>

    <?php if(empty($cart)): ?>

        <div class="alert alert-warning text-center p-5">

            <h4>

                Giỏ hàng đang trống!

            </h4>

            <a
                href="?pages=danh-muc"
                class="btn btn-dark mt-3"
            >

                ← Tiếp tục mua sắm

            </a>

        </div>

    <?php else: ?>

        <div class="table-responsive">

            <table class="table align-middle">

                <thead class="table-light">

                    <tr>

                        <th>Ảnh</th>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                        <th></th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach($cart as $item): ?>

                        <?php

                        $subTotal =
                        $item['price'] *
                        $item['quantity'];

                        $total += $subTotal;

                        ?>

                        <tr>

                            <!-- IMAGE -->
                            <td>

                                <img
                                    src="<?= htmlspecialchars($item['image']) ?>"
                                    class="cart-image"
                                    alt=""
                                >

                            </td>

                            <!-- NAME -->
                            <td>

                                <h5 class="fw-bold">

                                    <?= htmlspecialchars($item['name']) ?>

                                </h5>

                            </td>

                            <!-- PRICE -->
                            <td>

                                <span class="fw-bold text-danger">

                                    <?= number_format($item['price']) ?> ₫

                                </span>

                            </td>

                            <!-- QUANTITY -->
                            <td>

                                <input
                                    type="number"
                                    value="<?= $item['quantity'] ?>"
                                    min="1"
                                    class="form-control quantity-input"
                                >

                            </td>

                            <!-- TOTAL -->
                            <td>

                                <span class="fw-bold">

                                    <?= number_format($subTotal) ?> ₫

                                </span>

                            </td>

                            <!-- REMOVE -->
                            <td>

                                <button
                                    class="btn btn-danger"
                                >

                                    Xóa

                                </button>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

        <!-- TOTAL -->

        <div class="row mt-5">

            <div class="col-lg-4 ms-auto">

                <div class="card border-0 shadow-lg rounded-4">

                    <div class="card-body p-4">

                        <h4 class="fw-bold mb-4">

                            Tổng đơn hàng

                        </h4>

                        <div class="d-flex justify-content-between mb-3">

                            <span>Tạm tính:</span>

                            <strong>

                                <?= number_format($total) ?> ₫

                            </strong>

                        </div>

                        <div class="d-flex justify-content-between mb-4">

                            <span>Phí vận chuyển:</span>

                            <strong>

                                Miễn phí

                            </strong>

                        </div>

                        <hr>

                        <div
                            class="d-flex justify-content-between align-items-center mt-4"
                        >

                            <span class="fw-bold fs-4">

                                Tổng cộng:

                            </span>

                            <span class="cart-total">

                                <?= number_format($total) ?> ₫

                            </span>

                        </div>

                      <a
    href="?pages=thanh-toan"
    class="btn btn-dark w-100 btn-lg mt-4"
>

    Thanh toán

</a>
                    </div>

                </div>

            </div>

        </div>

    <?php endif; ?>

</div>

</main>