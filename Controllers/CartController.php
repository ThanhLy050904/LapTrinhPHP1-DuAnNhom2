<?php

class CartController
{
    private $cartModel;

    public function __construct($pdo)
    {
        $this->cartModel = new CartModel($pdo);
    }

    // Hiển thị giỏ hàng
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

    // Thêm vào giỏ (từ trang sản phẩm)
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

        $item = $this->cartModel->getCartItem($cartId, $productId, $size);

        if ($item) {
            // Đang thêm từ trang sản phẩm → cộng dồn
            $newQty = $item['quantity'] + $qty;
            $this->cartModel->setQty($item['id'], $newQty);
        } else {
            $this->cartModel->addItem($cartId, $productId, $size, $qty);
        }

        header("Location:?pages=gio-hang");
        exit;
    }

    // Cập nhật số lượng (từ trang giỏ hàng)
    public function updateQuantity()
    {
        if (!isset($_SESSION['user'])) {
            header("Location:?pages=dang-nhap");
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $itemId = $_POST['item_id'] ?? null;
        $newQty = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

        if (!$itemId || $newQty < 1) {
            header("Location:?pages=gio-hang");
            exit;
        }

        // Kiểm tra quyền sở hữu
        $item = $this->cartModel->getCartItemById($itemId);
        if (!$item || $item['user_id'] != $userId) {
            header("Location:?pages=gio-hang");
            exit;
        }

        $this->cartModel->setQty($itemId, $newQty);

        header("Location:?pages=gio-hang");
        exit;
    }

    // Xóa item
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