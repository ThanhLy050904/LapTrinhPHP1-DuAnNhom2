<div class="container py-5">

    <h2 class="mb-4">
        Chi tiết đơn hàng #<?= $order['id'] ?>
    </h2>

    <div class="card mb-4">
        <div class="card-body">

            <p>
                <strong>Khách hàng:</strong>
                <?= htmlspecialchars($order['full_name']) ?>
            </p>

            <p>
                <strong>Số điện thoại:</strong>
                <?= htmlspecialchars($order['phone']) ?>
            </p>

            <p>
                <strong>Địa chỉ:</strong>
                <?= htmlspecialchars($order['address']) ?>
            </p>

            <p>
                <strong>Tổng tiền:</strong>
                <span class="text-danger fw-bold">
                    <?= number_format($order['total_price']) ?> ₫
                </span>
            </p>

        </div>
    </div>

    <div class="card">

        <div class="card-header">
            Sản phẩm đã đặt
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Size</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($items as $item): ?>

                        <tr>

                            <td><?= $item['product_name'] ?></td>

                            <td><?= $item['size'] ?></td>

                            <td><?= $item['quantity'] ?></td>

                            <td>
                                <?= number_format($item['price']) ?> ₫
                            </td>

                            <td>
                                <?= number_format(
                                    $item['price'] * $item['quantity']
                                ) ?> ₫
                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>