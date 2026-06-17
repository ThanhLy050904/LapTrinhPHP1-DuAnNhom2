<?php

class CartController
{
    private $cartModel;

    public function __construct($pdo)
    {
        $this->cartModel = new CartModel($pdo);
    }

    // hiển thị giỏ hàng
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header("Location:?pages=dang-nhap");
            exit;
        }

        $userId = $_SESSION['user']['id'];

        $cart = $this->cartModel->getCartItems($userId);

        require "Views/pages/gio-hang.php";
    }

    // thêm vào giỏ
    public function add()
    {
        if (!isset($_SESSION['user'])) {
            header("Location:?pages=dang-nhap");
            exit;
        }

        $userId = $_SESSION['user']['id'];

        $productId = $_POST['product_id'] ?? null;
        $size = $_POST['size'] ?? null;
        $qty = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

        if (!$productId || !$size) {
            header("Location:?pages=gio-hang");
            exit;
        }

        $cart = $this->cartModel->getCartByUser($userId);

        if (!$cart) {
            $cartId = $this->cartModel->createCart($userId);
        } else {
            $cartId = $cart['id'];
        }

        $item = $this->cartModel->getCartItem(
            $cartId,
            $productId,
            $size
        );

        // ✅ FIX QUAN TRỌNG Ở ĐÂY
        if ($item) {

            $newQty = $item['quantity'] + $qty;

            $this->cartModel->setQty($item['id'], $newQty);

        } else {

            $this->cartModel->addItem(
                $cartId,
                $productId,
                $size,
                $qty
            );
        }

        header("Location:?pages=gio-hang");
        exit;
    }

    // xóa item
    public function remove()
    {
        if (!isset($_GET['id'])) {
            header("Location:?pages=gio-hang");
            exit;
        }

        $this->cartModel->deleteItem($_GET['id']);

        header("Location:?pages=gio-hang");
        exit;
    }
}