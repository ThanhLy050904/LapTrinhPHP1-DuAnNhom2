<?php if ($orderView): ?>

<div class="order-detail">

    <!-- ================= HEADER ================= -->
    <h3>Đơn hàng #<?= $orderView['id'] ?></h3>

    <!-- ================= CUSTOMER INFO ================= -->
    <p>
        <strong>Khách hàng:</strong>
        <?= htmlspecialchars($orderView['full_name'] ?? '') ?>
    </p>

    <p>
        <strong>Email:</strong>
        <?= htmlspecialchars($orderView['email'] ?? '') ?>
    </p>

    <p>
        <strong>SĐT:</strong>
        <?= htmlspecialchars($orderView['phone'] ?? '') ?>
    </p>

    <p>
        <strong>Địa chỉ:</strong>
        <?= htmlspecialchars($orderView['address'] ?? '') ?>
    </p>

    <p>
        <strong>Thanh toán:</strong>
        <?= match ($orderView['payment_method'] ?? '') {
            'cod' => 'Thanh toán khi nhận hàng',
            'banking' => 'Chuyển khoản ngân hàng',
            default => $orderView['payment_method']
        } ?>
    </p>

    <p>
        <strong>Tổng tiền đơn hàng:</strong>
        <b style="color:#0d6efd;">
            <?= number_format($orderView['total_price'] ?? 0) ?> đ
        </b>
    </p>

    <!-- ================= PRODUCTS ================= -->
    <?php if (!empty($adminOrderItems)): ?>

        <h4 style="margin-top:20px;">Chi tiết sản phẩm</h4>

        <table class="table-admin">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Size</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Tạm tính</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($adminOrderItems as $item): ?>

                    <?php
                        $quantity = (int)($item['quantity'] ?? 0);
                        $price = (int)($item['price'] ?? 0);
                        $subtotal = $quantity * $price;
                    ?>

                    <tr>
                        <td>
                            <?= htmlspecialchars($item['product_name'] ?? '') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($item['size'] ?? '') ?>
                        </td>

                        <td>
                            <?= $quantity ?>
                        </td>

                        <td>
                            <?= number_format($price) ?> đ
                        </td>

                        <td>
                            <b style="color:#16a34a;">
                                <?= number_format($subtotal) ?> đ
                            </b>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>

    <?php endif; ?>

    <!-- ================= ACTION ================= -->
    <div style="margin-top:20px;">
        <a href="?pages=admin&section=orders" class="btn btn-view">
            ← Quay lại
        </a>
    </div>

</div>

<?php endif; ?>