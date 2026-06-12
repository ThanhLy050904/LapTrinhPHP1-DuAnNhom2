<div class="container py-5">

    <h2 class="fw-bold mb-4">
        📦 Đơn hàng của tôi
    </h2>

    <?php if (empty($orders)): ?>

        <div class="alert alert-warning">

            Bạn chưa có đơn hàng nào.

        </div>

    <?php else: ?>

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>Mã đơn</th>

                        <th>Tổng tiền</th>

                        <th>Thanh toán</th>

                        <th>Trạng thái</th>

                        <th>Ngày đặt</th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($orders as $order): ?>

                        <tr>

                            <td>
                                #<?= $order['id'] ?>
                            </td>

                            <td class="fw-bold text-danger">

                                <?= number_format(
                                    $order['total_price']
                                ) ?>

                                ₫

                            </td>

                            <td>

                                <?php

                                $paymentText = [
                                    'cod' => 'COD',
                                    'bank' => 'Chuyển khoản'
                                ];

                                echo
                                $paymentText[$order['payment_method']] ?? $order['payment_method'];

                                ?>

                            </td>

                            <td>

                                <span class="badge bg-<?= $statusClass[$order['status']] ?? 'secondary' ?>">
                                    <?= $statusText[$order['status']] ?? $order['status'] ?>
                                </span>

                            </td>

                            <td>

                                <?= date(
                                    'd/m/Y H:i',
                                    strtotime(
                                        $order['created_at']
                                    )
                                ) ?>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    <?php endif; ?>

</div>