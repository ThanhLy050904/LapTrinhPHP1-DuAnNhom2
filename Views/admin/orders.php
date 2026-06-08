<?php
$adminAction = $_GET['action'] ?? '';
$orderView = null;
$orderId = $_GET['id'] ?? null;
if ($adminAction === 'view' && $orderId !== null) {
    foreach ($adminOrders as $order) {
        if (intval($order['id']) === intval($orderId)) {
            $orderView = $order;
            break;
        }
    }
}
?>

<div class="admin-card">
    <div class="page-header">
        <div>
            <h2 class="page-title">Quản lý đơn hàng</h2>
            <p class="page-subtitle">Theo dõi trạng thái và chi tiết các đơn hàng.</p>
        </div>
        <div class="page-actions">
            <form class="search-box" action="?pages=admin&section=orders" method="get" id="order-search-form">
                <input type="hidden" name="pages" value="admin">
                <input type="hidden" name="section" value="orders">
                <input id="order-search" type="text" name="q" placeholder="Gõ để lọc theo mã, tên, trạng thái..." value="<?= htmlspecialchars($_GET['q'] ?? '', ENT_QUOTES) ?>">
                <button type="submit">Tìm</button>
            </form>
        </div>
    </div>

<<<<<<< HEAD
    <?php if ($adminAction === 'view' && $orderView): ?>
        <div class="order-detail-card">
            <div class="order-detail-header">
                <div>
                    <h3>Chi tiết đơn hàng #<?= htmlspecialchars($orderView['id'] ?? '', ENT_QUOTES) ?></h3>
                    <p class="order-detail-meta">Khách hàng: <strong><?= htmlspecialchars($orderView['customer'] ?? 'Không rõ', ENT_QUOTES) ?></strong></p>
                    <p class="order-detail-meta">Ngày tạo: <strong><?= htmlspecialchars($orderView['created_at'] ?? '-', ENT_QUOTES) ?></strong></p>
                    <p class="order-detail-meta">Tổng tiền: <strong><?= htmlspecialchars($orderView['total'] ?? 0, ENT_QUOTES) ?></strong></p>
                </div>
                <div style="display:flex; gap:8px; flex-wrap:wrap; align-items:center;">
                    <?php
                        $detailStatus = strtolower($orderView['status'] ?? 'pending');
                        $detailLabel = 'Chưa xác định';
                        if (in_array($detailStatus, ['pending', 'đang chờ'], true)) {
                            $detailLabel = 'Đang chờ';
                        } elseif (in_array($detailStatus, ['shipping', 'đang giao'], true)) {
                            $detailLabel = 'Đang giao';
                        } elseif (in_array($detailStatus, ['completed', 'hoàn thành'], true)) {
                            $detailLabel = 'Hoàn thành';
                        } elseif (in_array($detailStatus, ['cancelled', 'cancel', 'hủy', 'huy'], true)) {
                            $detailLabel = 'Hủy';
                        }
                    ?>
                    <span class="order-detail-badge <?= $detailStatus ?>"><?= $detailLabel ?></span>
                    <a class="btn-secondary" href="?pages=admin&section=orders">Quay lại</a>
=======
    <?php if ($adminAction === 'edit' && $orderEdit): ?>
        <div class="admin-form-card">
            <h3>Chỉnh sửa đơn hàng <?= htmlspecialchars($orderEdit['code'], ENT_QUOTES) ?></h3>
            <form method="post">
                <input type="hidden" name="admin_form" value="orders">
                <input type="hidden" name="code" value="<?= htmlspecialchars($orderEdit['code'], ENT_QUOTES) ?>">

                <div class="form-grid">
                    <input class="form-control" name="customer" placeholder="Tên khách hàng" value="<?= htmlspecialchars($orderEdit['customer'] ?? '', ENT_QUOTES) ?>" required>
                    <input class="form-control" name="total" placeholder="Tổng tiền" value="<?= htmlspecialchars($orderEdit['total'] ?? '', ENT_QUOTES) ?>" required>
                    <select class="form-control span-full" name="status" required>
                        <option value="Đang chờ" <?= ($orderEdit['status'] ?? '') === 'Đang chờ' ? 'selected' : '' ?>>Đang chờ</option>
                        <option value="Đang giao" <?= ($orderEdit['status'] ?? '') === 'Đang giao' ? 'selected' : '' ?>>Đang giao</option>
                        <option value="Hoàn thành" <?= ($orderEdit['status'] ?? '') === 'Hoàn thành' ? 'selected' : '' ?>>Hoàn thành</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button class="btn-primary" type="submit">Lưu</button>
                    <a class="btn-secondary" href="?pages=admin&section=orders">Hủy</a>
>>>>>>> 5e65d85fd2d5d5ccb45e481e044a54de37b3ec9e
                </div>
            </div>
            <?php if (!empty($adminOrderItems)): ?>
                <div style="margin-top:24px;">
                    <h4 style="margin-bottom:16px;">Các mặt hàng trong đơn</h4>
                    <table class="table-admin" style="width:100%; border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th style="text-align:left; padding:12px;">Sản phẩm</th>
                                <th style="padding:12px;">Size</th>
                                <th style="padding:12px;">Số lượng</th>
                                <th style="padding:12px;">Giá</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($adminOrderItems as $it): ?>
                                <tr style="border-top:1px solid #e2e8f0;">
                                    <td style="padding:12px;"><?= htmlspecialchars($it['product_name'] ?? 'N/A', ENT_QUOTES) ?></td>
                                    <td style="padding:12px; text-align:center;"><?= htmlspecialchars($it['size'] ?? '-', ENT_QUOTES) ?></td>
                                    <td style="padding:12px; text-align:center;"><?= intval($it['quantity'] ?? 0) ?></td>
                                    <td style="padding:12px; text-align:right;"><?= number_format(intval($it['price'] ?? 0), 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p style="margin-top:24px; color:#64748b;">Không tìm thấy chi tiết sản phẩm cho đơn hàng này.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['admin_flash'])): ?>
        <div class="admin-card" style="margin-bottom:12px; padding:12px; background:#eef6ff; border-left:4px solid #3b82f6;"><?= htmlspecialchars($_SESSION['admin_flash']) ?></div>
        <?php unset($_SESSION['admin_flash']); ?>
    <?php endif; ?>

    <table class="table-admin">
        <thead>
            <tr>
                <th>Mã đơn</th>
                <th>Khách hàng</th>
                <th>Trạng thái</th>
                <th>Tổng tiền</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($adminOrders)): ?>
                <?php foreach ($adminOrders as $order): ?>
                    <tr class="order-main-row" data-search="<?= htmlspecialchars($order['id'] . ' ' . $order['customer'] . ' ' . $order['status'] . ' ' . $order['total'], ENT_QUOTES) ?>">
                        <td>#<?= htmlspecialchars($order['id'], ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($order['customer'], ENT_QUOTES) ?></td>
                        <td>
                        <?php
                            $statusValue = strtolower($order['status'] ?? 'pending');
                            $statusClass = 'pending';
                            $statusLabel = 'Đang chờ';
                            if (in_array($statusValue, ['shipping', 'đang giao'], true)) {
                                $statusClass = 'shipping';
                                $statusLabel = 'Đang giao';
                            } elseif (in_array($statusValue, ['completed', 'hoàn thành'], true)) {
                                $statusClass = 'completed';
                                $statusLabel = 'Hoàn thành';
                            } elseif (in_array($statusValue, ['cancelled', 'cancel', 'hủy', 'huy'], true)) {
                                $statusClass = 'cancelled';
                                $statusLabel = 'Hủy';
                            }
                        ?>
                        <div class="status-row">
                            <span class="status-pill <?= $statusClass ?>"><?= $statusLabel ?></span>
                            <button type="button" class="btn-open-status-form" data-order-id="<?= htmlspecialchars($order['id'], ENT_QUOTES) ?>">Cập nhật</button>
                        </div>
                    </td>
                        <td><?= htmlspecialchars($order['total'], ENT_QUOTES) ?></td>
                        <td>
<<<<<<< HEAD
                            <div style="display:flex; gap:10px; flex-wrap:wrap; align-items:center;">
                                <a class="btn-detail" href="?pages=admin&section=orders&action=view&id=<?= urlencode($order['id']) ?>">Xem chi tiết</a>
                                <a class="btn-danger" href="?pages=admin&section=orders&action=delete&id=<?= urlencode($order['id']) ?>" onclick="return confirm('Xóa đơn hàng này?')">Xóa</a>
                            </div>
                        </td>
                    </tr>
                    <tr id="order-status-row-<?= htmlspecialchars($order['id'], ENT_QUOTES) ?>" class="status-row-tr">
                        <td colspan="5" class="status-row-cell">
                            <div class="status-update-panel">
                                <form method="post" class="status-update-form">
                                    <input type="hidden" name="admin_form" value="orders">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($order['id'], ENT_QUOTES) ?>">
                                    <div class="status-update-inner">
                                        <select class="status-select" name="status">
                                            <option value="pending" <?= $statusClass === 'pending' ? 'selected' : '' ?>>Đang chờ</option>
                                            <option value="shipping" <?= $statusClass === 'shipping' ? 'selected' : '' ?>>Đang giao</option>
                                            <option value="completed" <?= $statusClass === 'completed' ? 'selected' : '' ?>>Hoàn thành</option>
                                            <option value="cancelled" <?= $statusClass === 'cancelled' ? 'selected' : '' ?>>Hủy</option>
                                        </select>
                                        <div class="update-actions">
                                            <button class="btn-primary btn-sm" type="submit">Lưu</button>
                                            <button type="button" class="btn-cancel-update" data-order-id="<?= htmlspecialchars($order['id'], ENT_QUOTES) ?>">Đóng</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
=======
                            <a class="btn-secondary" href="?pages=admin&section=orders&action=edit&code=<?= urlencode($order['code']) ?>">Sửa</a>
                            <a class="btn-danger" href="?pages=admin&section=orders&action=delete&code=<?= urlencode($order['code']) ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?');">Xóa</a>
>>>>>>> 5e65d85fd2d5d5ccb45e481e044a54de37b3ec9e
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr id="order-no-results" style="display:none;">
                    <td colspan="5" style="text-align:center; padding:24px; color:#475569;">Không tìm thấy đơn hàng phù hợp.</td>
                </tr>
            <?php else: ?>
                <tr>
                    <td colspan="5">Chưa có đơn hàng</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const openButtons = document.querySelectorAll('.btn-open-status-form');
            const closeButtons = document.querySelectorAll('.btn-cancel-update');
            const searchInput = document.getElementById('order-search');
            const searchForm = document.getElementById('order-search-form');
            const rows = Array.from(document.querySelectorAll('.order-main-row'));
            const noResults = document.getElementById('order-no-results');

            function filterOrders() {
                const value = searchInput.value.trim().toLowerCase();
                let visible = 0;
                rows.forEach(row => {
                    const text = row.dataset.search.toLowerCase();
                    const match = value === '' || text.includes(value);
                    row.style.display = match ? '' : 'none';
                    const statusRow = document.getElementById('order-status-row-' + row.querySelector('.btn-open-status-form').dataset.orderId);
                    if (statusRow) {
                        statusRow.style.display = match ? (statusRow.classList.contains('active') ? 'table-row' : 'none') : 'none';
                    }
                    if (match) visible += 1;
                });
                noResults.style.display = visible === 0 ? '' : 'none';
            }

            openButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const orderId = this.dataset.orderId;
                    const row = document.getElementById('order-status-row-' + orderId);
                    if (row) {
                        row.classList.toggle('active');
                        row.style.display = row.classList.contains('active') ? 'table-row' : 'none';
                    }
                });
            });

            closeButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const orderId = this.dataset.orderId;
                    const row = document.getElementById('order-status-row-' + orderId);
                    if (row) {
                        row.classList.remove('active');
                        row.style.display = 'none';
                    }
                });
            });

            if (searchInput) {
                searchInput.addEventListener('input', filterOrders);
                searchForm.addEventListener('submit', function(event) {
                    event.preventDefault();
                });
                if (searchInput.value.trim() !== '') {
                    filterOrders();
                }
            }
        });
    </script>
</div>
