<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hóa đơn #<?= $order['id'] ?></title>
    <style>
        body {
            font-family: Arial;
            padding: 30px;
        }

        .box {
            max-width: 800px;
            margin: auto;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #f3f4f6;
        }

        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="box">

    <h2>HÓA ĐƠN BÁN HÀNG</h2>

    <p><b>Mã đơn:</b> #<?= $order['id'] ?></p>
    <p><b>Khách hàng:</b> <?= htmlspecialchars($order['full_name']) ?></p>
    <p><b>SĐT:</b> <?= htmlspecialchars($order['phone']) ?></p>
    <p><b>Địa chỉ:</b> <?= htmlspecialchars($order['address']) ?></p>
    <p><b>Thanh toán:</b> <?= $order['payment_method'] ?></p>

    <table>
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Size</th>
                <th>Số lượng</th>
                <th>Giá</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($items as $i): ?>
                <tr>
                    <td><?= htmlspecialchars($i['product_name']) ?></td>
                    <td><?= $i['size'] ?></td>
                    <td><?= $i['quantity'] ?></td>
                    <td><?= number_format($i['price']) ?> đ</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="total">
        Tổng tiền: <?= number_format($order['total_price']) ?> đ
    </div>

</div>

</body>
</html>