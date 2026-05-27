<?php
$adminAction = $_GET['action'] ?? '';
$orderEdit = null;
if ($adminAction === 'edit' && isset($_GET['code'])) {
    foreach ($adminOrders as $order) {
        if (($order['code'] ?? '') === $_GET['code']) {
            $orderEdit = $order;
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
            <form class="search-box" action="?pages=admin&section=orders" method="get">
                <input type="hidden" name="pages" value="admin">
                <input type="hidden" name="section" value="orders">
                <input type="text" name="q" placeholder="Tìm kiếm đơn hàng...">
                <button type="submit">Tìm</button>
            </form>
        </div>
    </div>

    <?php if ($adminAction === 'edit' && $orderEdit): ?>
        <div class="admin-card" style="margin-bottom:24px; padding:24px;">
            <h3>Chỉnh sửa đơn hàng <?= htmlspecialchars($orderEdit['code'], ENT_QUOTES) ?></h3>
            <form method="post">
                <input type="hidden" name="admin_form" value="orders">
                <input type="hidden" name="code" value="<?= htmlspecialchars($orderEdit['code'], ENT_QUOTES) ?>">
                <div style="display:grid;grid-template-columns:1fr 1fr; gap:16px; margin-top:18px;">
                    <input name="customer" placeholder="Tên khách hàng" value="<?= htmlspecialchars($orderEdit['customer'] ?? '', ENT_QUOTES) ?>" required>
                    <input name="total" placeholder="Tổng tiền" value="<?= htmlspecialchars($orderEdit['total'] ?? '', ENT_QUOTES) ?>" required>
                    <select name="status" required>
                        <option value="Đang chờ" <?= ($orderEdit['status'] ?? '') === 'Đang chờ' ? 'selected' : '' ?>>Đang chờ</option>
                        <option value="Đang giao" <?= ($orderEdit['status'] ?? '') === 'Đang giao' ? 'selected' : '' ?>>Đang giao</option>
                        <option value="Hoàn thành" <?= ($orderEdit['status'] ?? '') === 'Hoàn thành' ? 'selected' : '' ?>>Hoàn thành</option>
                    </select>
                </div>
                <div style="margin-top:16px; display:flex; gap:12px; flex-wrap:wrap;">
                    <button class="btn-primary" type="submit">Lưu</button>
                    <a class="btn-secondary" href="?pages=admin&section=orders">Hủy</a>
                </div>
            </form>
        </div>
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
                    <tr>
                        <td><?= htmlspecialchars($order['code'], ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($order['customer'], ENT_QUOTES) ?></td>
                        <td><span class="badge <?= $order['status'] === 'Hoàn thành' ? 'success' : ($order['status'] === 'Đang chờ' ? 'warning' : 'primary') ?>"><?= htmlspecialchars($order['status'], ENT_QUOTES) ?></span></td>
                        <td><?= htmlspecialchars($order['total'], ENT_QUOTES) ?></td>
                        <td>
                            <a class="btn-secondary" href="?pages=admin&section=orders&action=edit&code=<?= urlencode($order['code']) ?>">Sửa</a>
                            <a class="btn-danger" href="?pages=admin&section=orders&action=delete&code=<?= urlencode($order['code']) ?>">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Chưa có đơn hàng</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
