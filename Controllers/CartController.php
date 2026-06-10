<?php

require_once "Models/CartModel.php";

class CartController
{
    private $cartModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
    }

    // hiển thị giỏ hàng
    public function index()
    {
        if(!isset($_SESSION['user']))
        {
            header("Location:?pages=login");
            exit;
        }

        $userId = $_SESSION['user']['id'];

        $cart = $this->cartModel->getCartItems($userId);

        require "Views/pages/gio-hang.php";
    }

    // thêm vào giỏ
    public function add()
    {
        if(!isset($_SESSION['user']))
        {
            header("Location:?pages=login");
            exit;
        }

        $userId = $_SESSION['user']['id'];

        $productId = $_POST['product_id'];
        $size = $_POST['size'];
        $qty = $_POST['quantity'];

        $cart = $this->cartModel->getCartByUser($userId);

        if(!$cart)
        {
            $cartId = $this->cartModel->createCart($userId);
        }
        else
        {
            $cartId = $cart['id'];
        }

        $item = $this->cartModel->getCartItem(
            $cartId,
            $productId,
            $size
        );

        if($item)
        {
            $this->cartModel->updateQty(
                $item['id'],
                $qty
            );
        }
        else
        {
            $this->cartModel->addItem(
                $cartId,
                $productId,
                $size,
                $qty
            );
        }

        header("Location:?pages=gio-hang");
    }

    public function remove()
    {
        $id = $_GET['id'];

        $this->cartModel->deleteItem($id);

        header("Location:?pages=gio-hang");
    }
}