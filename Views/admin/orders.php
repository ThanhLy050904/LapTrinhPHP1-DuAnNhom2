<?php
$adminAction = $_GET['action'] ?? '';
$orderId = $_GET['id'] ?? null;
$orderView = null;

if ($adminAction === 'view' && $orderId) {
    foreach ($adminOrders as $o) {
        if ($o['id'] == $orderId) {
            $orderView = $o;
            break;
        }
    }
}
?>

<!-- <style>
    .admin-wrapper-center {
        display: flex;
        justify-content: flex-start;
        /* Thay đổi để nội dung căn trái khi full width */
        align-items: flex-start;
        background: #f1f5f9;
        min-height: 100vh;
        width: 100%;
        padding: 40px 20px;
    }

    .admin-box {
        width: 100%;
        max-width: 100%;
        /* Cho phép chiếm toàn bộ chiều rộng */
    }

    .admin-card {
        width: 100%;
        background: #fff;
        border-radius: 16px;
        padding: 20px;
    }

    .admin-header {
        margin-bottom: 24px;
    }

    .admin-header h2 {
        /* Thêm quy tắc này để định nghĩa style cho h2 */
        margin: 0;
        font-size: 32px;
        /* Tăng kích thước từ 28px để nổi bật hơn */
        font-weight: 700;
        /* Đảm bảo độ đậm */
        color: #1e2937;
        /* Giữ màu sắc nhất quán */
    }

    .search-box {
        display: flex;
        gap: 12px;
        margin-bottom: 28px;
        align-items: center;
        flex-wrap: wrap;
    }

    .search-box input {
        flex: 1;
        min-width: 320px;
        padding: 14px 20px;
        border: 1px solid #e2e8f0;
        border-radius: 999px;
        font-size: 15px;
    }

    .search-box select {
        padding: 14px 20px;
        border: 1px solid #e2e8f0;
        border-radius: 999px;
        min-width: 180px;
    }

    .search-box button {
        padding: 14px 32px;
        background: #000;
        color: white;
        border: none;
        border-radius: 999px;
        font-weight: 500;
        cursor: pointer;
        white-space: nowrap;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
        gap: 18px;
        margin-bottom: 32px;
    }

    .stat-card {
        background: #fff;
        padding: 22px 20px;
        border-radius: 14px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
        text-align: center;
        border: 1px solid #f1f5f9;
    }

    .stat-card strong {
        display: block;
        color: #64748b;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .stat-card h3 {
        margin: 0;
        font-size: 34px;
        font-weight: 700;
        color: #1e2937;
    }

    .table-admin .status-select {
        /* Thêm class mới cho select trạng thái */
        padding: 8px 12px;
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        font-size: 14px;
        /* Đảm bảo kích thước chữ nhất quán */
    }

    .table-admin {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    }

    .table-admin th {
        background: #f8fafc;
        padding: 16px 14px;
        text-align: left;
        font-weight: 600;
        color: #475569;
    }

    .table-admin td {
        padding: 16px 14px;
        border-top: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .btn {
        padding: 8px 18px;
        border-radius: 8px;
        font-size: 14px;
        text-decoration: none;
        display: inline-block;
        margin: 3px;
    }

    .btn-view {
        background: #3b82f6;
        color: white;
    }

    .btn-delete {
        background: #ef4444;
        color: white;
    }

    .order-detail {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 24px;
        margin-bottom: 28px;
    }

    @media (max-width: 768px) {
        .search-box {
            flex-direction: column;
            align-items: stretch;
        }

        .admin-wrapper-center {
            padding: 15px;
        }
    }

    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-confirmed {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .status-shipping {
        background: #ede9fe;
        color: #6d28d9;
    }

    .status-completed {
        background: #dcfce7;
        color: #15803d;
    }

    .status-cancelled {
        background: #fee2e2;
        color: #dc2626;
    }

    .status-select {
        font-weight: 600;
    }

    .badge-status {
        padding: 8px 14px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        display: inline-block;
    }

    .pending {
        background: #fef3c7;
        color: #92400e;
    }

    .confirmed {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .shipping {
        background: #ede9fe;
        color: #6d28d9;
    }

    .completed {
        background: #dcfce7;
        color: #15803d;
    }

    .cancelled {
        background: #fee2e2;
        color: #dc2626;
    }
</style> -->

<link rel="stylesheet" href="Views/css/admin.css">
<div class="admin-wrapper-center">
    <div class="admin-box">
        <div class="admin-card">

            <div class="admin-header">
                <h2>Quản lý đơn hàng</h2> <!-- Xóa inline style, sử dụng CSS class -->
            </div>


            <!-- SEARCH -->
            <form method="GET" class="search-box">
                <input type="hidden" name="pages" value="admin">
                <input type="hidden" name="section" value="orders">

                <input type="text" name="keyword" placeholder="Tìm khách hàng, mã đơn"
                    value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">

                <select name="status">

                    <option value="">Tất cả</option>

                    <option value="cho_xac_nhan" <?= ($_GET['status'] ?? '') == 'cho_xac_nhan' ? 'selected' : '' ?>>
                        Chờ xác nhận
                    </option>

                    <option value="da_xac_nhan" <?= ($_GET['status'] ?? '') == 'da_xac_nhan' ? 'selected' : '' ?>>
                        Đã xác nhận
                    </option>

                    <option value="dang_giao" <?= ($_GET['status'] ?? '') == 'dang_giao' ? 'selected' : '' ?>>
                        Đang giao
                    </option>

                    <option value="hoan_thanh" <?= ($_GET['status'] ?? '') == 'hoan_thanh' ? 'selected' : '' ?>>
                        Hoàn thành
                    </option>

                    <option value="da_huy" <?= ($_GET['status'] ?? '') == 'da_huy' ? 'selected' : '' ?>>
                        Đã hủy
                    </option>

                </select>

                <button type="submit">Tìm kiếm</button>
            </form>

            <!-- STATS -->
            <div class="stat-card">
                <strong>Doanh thu tháng</strong>
                <h3 style="font-size:24px">
                    <?= number_format($revenueMonth ?? 0) ?> đ
                </h3>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <strong>Tổng đơn</strong>
                    <h3><?= $stats['total'] ?? 9 ?></h3>
                </div>
                <div class="stat-card">
                    <strong>Chờ xác nhận</strong>
                    <h3><?= $stats['pending'] ?? 0 ?></h3>
                </div>
                <div class="stat-card">
                    <strong>Đã xác nhận</strong>
                    <h3><?= $stats['confirmed'] ?? 0 ?></h3>
                </div>
                <div class="stat-card">
                    <strong>Đang giao</strong>
                    <h3><?= $stats['shipping'] ?? 0 ?></h3>
                </div>
                <div class="stat-card">
                    <strong>Hoàn thành</strong>
                    <h3><?= $stats['completed'] ?? 0 ?></h3>
                </div>
                <div class="stat-card">
                    <strong>Đã hủy</strong>
                    <h3><?= $stats['cancelled'] ?? 0 ?></h3>
                </div>
            </div>



            <!-- TABLE -->
            <table class="table-admin">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Khách hàng</th>
                        <th>SĐT</th>
                        <th>Ngày đặt</th>
                        <th>Thanh toán</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($adminOrders as $o): ?>
                        <tr>
                            <td><strong>#<?= $o['id'] ?></strong></td>
                            <td><?= htmlspecialchars($o['full_name'] ?? '') ?></td>

                            <td>
                                <?= htmlspecialchars($o['phone'] ?? '') ?>
                            </td>

                            <td>
                                <?= date('d/m/Y H:i', strtotime($o['created_at'])) ?>
                            </td>

                            <td>
                                <?=
                                    match ($o['payment_method']) {
                                        'cod' => ' COD',
                                        'banking' => ' Chuyển khoản',
                                        default => $o['payment_method']
                                    };
                                ?>
                            </td>

                            <td>
                                <strong><?= number_format($o['total_price'] ?? 0) ?> đ</strong>
                            </td>
                            <td>
                                <form method="POST" action="?pages=admin&section=orders&action=updateStatus"
                                    style="margin:0;">

                                    <input type="hidden" name="id" value="<?= $o['id'] ?>">

                                    <select name="status" class="status-select <?= $o['status'] ?>"
                                        onchange="this.form.submit()" <?= in_array($o['status'], ['hoan_thanh', 'da_huy']) ? 'disabled' : '' ?>>
                                        <option value="cho_xac_nhan" <?= $o['status'] == 'cho_xac_nhan' ? 'selected' : '' ?>>
                                            Chờ xác nhận
                                        </option>

                                        <option value="da_xac_nhan" <?= $o['status'] == 'da_xac_nhan' ? 'selected' : '' ?>>
                                            Đã xác nhận
                                        </option>

                                        <option value="dang_giao" <?= $o['status'] == 'dang_giao' ? 'selected' : '' ?>>
                                            Đang giao
                                        </option>

                                        <option value="hoan_thanh" <?= $o['status'] == 'hoan_thanh' ? 'selected' : '' ?>>
                                            Hoàn thành
                                        </option>

                                        <option value="da_huy" <?= $o['status'] == 'da_huy' ? 'selected' : '' ?>>
                                            Đã hủy
                                        </option>

                                    </select>
                                </form>
                            </td>
                            <td>
                                <a class="btn btn-view"
                                    href="?pages=admin&section=orders&action=view&id=<?= $o['id'] ?>">Xem</a>
                                <a class="btn btn-delete" onclick="return confirm('Xóa đơn hàng này?')"
                                    href="?pages=admin&section=orders&action=delete&id=<?= $o['id'] ?>">Xóa</a>
                                <a class="btn btn-view"
                                    href="?pages=admin&section=orders&action=invoice&id=<?= $o['id'] ?>">
                                    PDF
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>