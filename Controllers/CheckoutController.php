<?php

class CheckoutController
{
    private $cartModel;

    public function __construct($pdo)
    {
        $this->cartModel = new CartModel($pdo);
    }

    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header("Location:?pages=dang-nhap");
            exit;
        }

        $cart = $this->getCart();
        $user = $_SESSION['user'];

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        require "Views/pages/thanh-toan.php";
    }

    public function placeOrder()
    {
        if (!isset($_SESSION['user'])) {
            header("Location:?pages=dang-nhap");
            exit;
        }

        $cart = $this->getCart();

        if (empty($cart)) {
            header("Location:?pages=gio-hang");
            exit;
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $_SESSION['order'] = [
            'code' => 'ORDER-' . rand(10000, 99999),
            'name' => $_POST['full_name'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'email' => $_POST['email'] ?? '',
            'address' => $_POST['address'] ?? '',
            'payment' => $_POST['payment_method'] ?? '',
            'items' => $cart,
            'total' => $total
        ];

        $this->cartModel->clearCart($_SESSION['user']['id']);

        header("Location: ?pages=thank-you");
        exit;
    }

    private function getCart()
    {
        if (!isset($_SESSION['user'])) {
            return [];
        }

        return $this->cartModel->getCartItems($_SESSION['user']['id']);
    }
}