<?php

class CheckoutController
{
    public function index()
    {
        $cart = $this->getCart();

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        require "Views/pages/thanh-toan.php";
    }

    public function placeOrder()
    {
        session_start();

        $cart = $this->getCart();

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $_SESSION['order'] = [
            'code' => 'ORDER-' . rand(10000, 99999),
            'name' => $_POST['name'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'email' => $_POST['email'] ?? '',
            'address' => $_POST['address'] ?? '',
            'payment' => $_POST['payment'] ?? '',
            'items' => $cart,
            'total' => $total
        ];

        $_SESSION['cart'] = [];

        header("Location: ?pages=thank-you");
        exit;
    }

    private function getCart()
    {
        return [
            [
                'name' => 'Nike Air Force 1',
                'price' => 2500000,
                'quantity' => 1,
                'image' => 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/air-force-1-07-shoes-WrLlWX.png'
            ],
            [
                'name' => 'Adidas Ultraboost',
                'price' => 3200000,
                'quantity' => 2,
                'image' => 'https://assets.adidas.com/images/w_600,f_auto,q_auto/ultraboost-shoes.jpg'
            ]
        ];
    }
}