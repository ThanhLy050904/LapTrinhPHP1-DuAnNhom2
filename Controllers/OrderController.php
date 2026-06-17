<?php

class OrderController
{
    private $cartModel;
    private $orderModel;

   public function __construct($pdo)
{
    $this->cartModel = new CartModel($pdo);
    $this->orderModel = new OrderModel($pdo);
}

    // Trang thanh toán
    public function checkout()
    {
        if (!isset($_SESSION['user'])) {
            header("Location:?pages=login");
            exit;
        }

        $user = $_SESSION['user'];

        $cart = $this->cartModel->getCartItems(
            $user['id']
        );

        require "Views/pages/thanh-toan.php";
    }

    // Đặt hàng
    public function placeOrder()
    {
        if (!isset($_SESSION['user'])) {
            header("Location:?pages=login");
            exit;
        }

        $user = $_SESSION['user'];

        $cart = $this->cartModel->getCartItems(
            $user['id']
        );

        if (empty($cart)) {
            header("Location:?pages=gio-hang");
            exit;
        }

        $total = 0;

        foreach ($cart as $item) {

            $total +=
                $item['price']
                * $item['quantity'];
        }

        $orderId =
            $this->orderModel->createOrder(
                $user['id'],
                $_POST['full_name'],
                $_POST['email'],
                $_POST['phone'],
                $_POST['address'],
                $_POST['payment_method'],
                $total
            );

        foreach ($cart as $item) {

            $this->orderModel->addOrderDetail(
                $orderId,
                $item['product_id'],
                $item['size'],
                $item['quantity'],
                $item['price']
            );
        }

        $this->cartModel->clearCart(
            $user['id']
        );

        header(
            "Location:?pages=dat-hang-thanh-cong&id=" . $orderId
        );
        exit;
    }

    // Đơn hàng của tôi
    public function myOrders()
    {
        if (!isset($_SESSION['user'])) {

            header("Location:?pages=login");
            exit;
        }

        $userId = $_SESSION['user']['id'];

        $orders =
            $this->orderModel
            ->getOrdersByUser($userId);

        $statusText = [
            'cho_xac_nhan' => 'Chờ xác nhận',
            'da_thanh_toan' => 'Đã thanh toán',
            'da_xac_nhan' => 'Đã xác nhận',
            'dang_giao' => 'Đang giao',
            'hoan_thanh' => 'Hoàn thành',
            'da_huy' => 'Đã hủy'
        ];

        $statusClass = [
            'cho_xac_nhan' => 'warning',
            'da_thanh_toan' => 'success',
            'da_xac_nhan' => 'primary',
            'dang_giao' => 'info',
            'hoan_thanh' => 'dark',
            'da_huy' => 'danger'
        ];

        require
            "Views/pages/don-hang-cua-toi.php";
    }
}
