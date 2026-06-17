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

<style>
.admin-wrapper-center{
    display:flex;
    justify-content:center;
    padding:30px;
}

.admin-box{
    width:100%;
    max-width:1100px;
}

.admin-card{
    background:#fff;
    border-radius:16px;
    padding:20px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
}

/* HEADER */
.admin-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.admin-header h2{
    margin:0;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    margin-top:15px;
    background:#fff;
    border-radius:12px;
    overflow:hidden;
}

th{
    background:#f1f5f9;
    padding:12px;
    text-align:left;
    font-size:14px;
}

td{
    padding:12px;
    border-top:1px solid #eee;
    font-size:14px;
}

/* BUTTON */
a{
    text-decoration:none;
}

.btn{
    padding:6px 10px;
    border-radius:8px;
    font-size:13px;
    display:inline-block;
}

.btn-view{
    background:#3b82f6;
    color:#fff;
}

.btn-delete{
    background:#ef4444;
    color:#fff;
}

/* ORDER DETAIL */
.order-box{
    padding:15px;
    border:1px solid #e5e7eb;
    border-radius:12px;
    margin-bottom:20px;
    background:#fafafa;
}

.badge{
    display:inline-block;
    padding:4px 10px;
    border-radius:20px;
    font-size:12px;
    background:#e2e8f0;
}
</style>

<div class="admin-wrapper-center">
<div class="admin-box">

<div class="admin-card">

    <div class="admin-header">
        <h2>Quản lý đơn hàng</h2>
    </div>

    <!-- DETAIL -->
    <?php if ($orderView): ?>
        <div class="order-box">
            <h3>Đơn #<?= $orderView['id'] ?></h3>
            <p>Khách: <b><?= $orderView['full_name'] ?? '' ?></b></p>
            <p>Email: <?= $orderView['email'] ?? '' ?></p>
            <p>Tổng tiền: <b><?= number_format($orderView['total_price'] ?? 0) ?> đ</b></p>
        </div>

        <h3>Chi tiết sản phẩm</h3>

        <?php if (!empty($adminOrderItems)): ?>
        <table>
            <tr>
                <th>Sản phẩm</th>
                <th>Size</th>
                <th>SL</th>
                <th>Giá</th>
            </tr>

            <?php foreach ($adminOrderItems as $item): ?>
            <tr>
                <td><?= $item['product_name'] ?></td>
                <td><?= $item['size'] ?></td>
                <td><?= $item['quantity'] ?></td>
                <td><?= number_format($item['price']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>

        <hr>
    <?php endif; ?>

    <!-- LIST -->
    <table>
        <tr>
            <th>ID</th>
            <th>Khách</th>
            <th>Tổng</th>
            <th>Trạng thái</th>
            <th>Action</th>
        </tr>

        <?php foreach ($adminOrders as $o): ?>
        <tr>
            <td>#<?= $o['id'] ?></td>
            <td><?= $o['full_name'] ?? '' ?></td>
            <td><?= number_format($o['total_price'] ?? 0) ?> đ</td>
            <td>
                <span class="badge">
                    <?= $o['status'] ?? 'pending' ?>
                </span>
            </td>
            <td>
                <a class="btn btn-view"
                   href="?pages=admin&section=orders&action=view&id=<?= $o['id'] ?>">
                   Xem
                </a>

                <a class="btn btn-delete"
                   onclick="return confirm('Xóa?')"
                   href="?pages=admin&section=orders&action=delete&id=<?= $o['id'] ?>">
                   Xóa
                </a>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>

</div>

</div>
</div>