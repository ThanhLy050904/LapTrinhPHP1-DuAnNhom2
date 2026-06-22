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
                <hr>

            <p>
                <strong>Trạng thái:</strong>

                <?= match ($order['status']) {
                    'cho_xac_nhan' => 'Chờ xác nhận',
                    'da_xac_nhan' => 'Đã xác nhận',
                    'dang_giao' => 'Đang giao',
                    'hoan_thanh' => 'Hoàn thành',
                    'da_huy' => 'Đã hủy',
                    default => $order['status']
                } ?>
            </p>

            <?php if (
                in_array(
                    $order['status'],
                    ['cho_xac_nhan', 'da_xac_nhan']
                )
            ): ?>

                <?php if (
                    in_array(
                        $order['status'],
                        ['cho_xac_nhan', 'da_xac_nhan']
                    )
                ): ?>

                    <div class="card mt-3">
                        <div class="card-body">

                            <h5>Hủy đơn hàng</h5>

                            <form method="POST" action="?pages=cancel-order">

                                <input type="hidden" name="id" value="<?= $order['id'] ?>">

                                <select name="cancel_reason" class="form-select" required>
                                    <option value="">
                                        -- Chọn lý do hủy --
                                    </option>

                                    <option value="Đặt nhầm sản phẩm">
                                        Đặt nhầm sản phẩm
                                    </option>

                                    <option value="Muốn thay đổi sản phẩm">
                                        Muốn thay đổi sản phẩm
                                    </option>

                                    <option value="Tìm được giá tốt hơn">
                                        Tìm được giá tốt hơn
                                    </option>

                                    <option value="Thời gian giao quá lâu">
                                        Thời gian giao quá lâu
                                    </option>

                                    <option value="Không còn nhu cầu">
                                        Không còn nhu cầu
                                    </option>
                                </select>

                                <button type="submit" class="btn btn-danger mt-3"
                                    onclick="return confirm('Bạn chắc chắn muốn hủy đơn?')">
                                    Xác nhận hủy đơn
                                </button>

                            </form>

                        </div>
                    </div>

                <?php endif; ?>

            <?php endif; ?>


            <?php if ($order['status'] == 'dang_giao'): ?>

                <a class="btn btn-success" href="?pages=complete-order&id=<?= $order['id'] ?>"
                    onclick="return confirm('Xác nhận đã nhận được hàng?')">
                    Đã nhận được hàng
                </a>

            <?php endif; ?>
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