<?php

$cart = $cart ?? [];
$total = 0;

?>

<style>
    .cart-image {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 16px;
    }

    .qty-box {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .qty-btn {
        width: 32px;
        height: 32px;
        border: 1px solid #ddd;
        background: #fff;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        border-radius: 6px;
    }

    .qty-input {
        width: 60px;
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 6px;
        height: 32px;
    }

    .cart-total {
        font-size: 2rem;
        font-weight: bold;
        color: #dc3545;
    }
</style>

<main>

    <div class="container py-5">

        <h2 class="fw-bold mb-5">
            🛒 Giỏ hàng của bạn
        </h2>

        <?php if (empty($cart)): ?>

            <div class="alert alert-warning text-center p-5">
                <h4>Giỏ hàng đang trống!</h4>
                <a href="?pages=danh-muc" class="btn btn-dark mt-3">
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

                        <?php foreach ($cart as $item): ?>

                            <?php
                            $subTotal = $item['price'] * $item['quantity'];
                            $total += $subTotal;
                            ?>

                            <tr class="cart-row">

                                <!-- IMAGE -->
                                <td>
                                    <img src="Views/image/<?= htmlspecialchars($item['image_main']) ?>" class="cart-image">
                                </td>

                                <td>
                                    <h5 class="fw-bold">
                                        <?= htmlspecialchars($item['name']) ?>
                                    </h5>

                                    <small class="text-muted">
                                        Size: <?= htmlspecialchars($item['size']) ?>
                                    </small>
                                </td>
                                <!-- PRICE -->
                                <td>
                                    <span class="fw-bold text-danger">
                                        <?= number_format($item['price']) ?> ₫
                                    </span>
                                </td>

                                <!-- QUANTITY + - -->
                            <!-- SỐ LƯỢNG -->
<!-- SỐ LƯỢNG -->
<td>
    <div class="qty-box">
        <button type="button" class="qty-btn minus" data-id="<?= $item['id'] ?>">-</button>
        
        <input 
            type="number" 
            value="<?= $item['quantity'] ?>" 
            min="1" 
            class="qty-input"
            data-id="<?= $item['id'] ?>"
            data-price="<?= $item['price'] ?>">
        
        <button type="button" class="qty-btn plus" data-id="<?= $item['id'] ?>">+</button>
    </div>
</td>

                                <!-- TOTAL -->
                                <td>
                                    <span class="fw-bold item-total">
                                        <?= number_format($subTotal) ?> ₫
                                    </span>
                                </td>

                                <!-- REMOVE -->
                                <td>
                                    <a href="?pages=gio-hang&action=remove&id=<?= $item['id'] ?>" 
   class="btn btn-danger btn-sm"
   onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
    Xóa
</a>
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
                                <strong id="cart-total">
                                    <?= number_format($total) ?> ₫
                                </strong>
                            </div>

                            <div class="d-flex justify-content-between mb-3">
                                <span>Phí vận chuyển:</span>
                                <strong>Miễn phí</strong>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between align-items-center mt-4">

                                <span class="fw-bold fs-4">
                                    Tổng cộng:
                                </span>

                                <span class="cart-total" id="cart-total-final">
                                    <?= number_format($total) ?> ₫
                                </span>

                            </div>

                            <a href="?pages=thanh-toan" class="btn btn-dark w-100 btn-lg mt-4">
                                Thanh toán
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        <?php endif; ?>

    </div>

</main>

<script>
    function formatVND(num) {
        return num.toLocaleString('vi-VN') + ' ₫';
    }

    function updateItemTotal(input) {
        const price = parseInt(input.dataset.price);
        const qty = parseInt(input.value) || 1;
        const subTotal = price * qty;
        
        // Cập nhật tổng của item đó
        const itemTotalEl = input.closest('tr').querySelector('.item-total');
        if (itemTotalEl) itemTotalEl.innerText = formatVND(subTotal);
    }

    function updateCartTotal() {
        let total = 0;
        document.querySelectorAll(".cart-row").forEach(row => {
            const input = row.querySelector(".qty-input");
            const price = parseInt(input.dataset.price);
            const qty = parseInt(input.value) || 1;
            total += price * qty;
        });

        document.getElementById("cart-total").innerText = formatVND(total);
        document.getElementById("cart-total-final").innerText = formatVND(total);
    }

    // Hàm cập nhật số lượng lên server qua AJAX
    function updateQuantityToServer(itemId, newQty) {
        fetch('?pages=gio-hang&action=update-quantity', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `item_id=${itemId}&quantity=${newQty}`
        })
        .then(response => {
            if (!response.ok) throw new Error('Lỗi server');
            return response.text();
        })
        .catch(error => {
            console.error('Lỗi cập nhật:', error);
            alert('Có lỗi khi cập nhật số lượng. Vui lòng thử lại!');
        });
    }

    // Xử lý nút +
    document.querySelectorAll(".plus").forEach(btn => {
        btn.addEventListener("click", function () {
            const input = this.parentElement.querySelector(".qty-input");
            let qty = parseInt(input.value) || 1;
            input.value = ++qty;

            updateItemTotal(input);
            updateCartTotal();
            updateQuantityToServer(input.dataset.id, qty);
        });
    });

    // Xử lý nút -
    document.querySelectorAll(".minus").forEach(btn => {
        btn.addEventListener("click", function () {
            const input = this.parentElement.querySelector(".qty-input");
            let qty = parseInt(input.value) || 1;
            if (qty > 1) {
                input.value = --qty;
                updateItemTotal(input);
                updateCartTotal();
                updateQuantityToServer(input.dataset.id, qty);
            }
        });
    });

    // Cập nhật khi người dùng gõ trực tiếp vào input
    document.querySelectorAll(".qty-input").forEach(input => {
        input.addEventListener("change", function () {
            let qty = parseInt(this.value) || 1;
            if (qty < 1) {
                qty = 1;
                this.value = 1;
            }
            updateItemTotal(this);
            updateCartTotal();
            updateQuantityToServer(this.dataset.id, qty);
        });
    });
</script>