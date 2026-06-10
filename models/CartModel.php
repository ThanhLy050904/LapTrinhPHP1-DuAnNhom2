<?php


class CartModel
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // lấy cart của user
    public function getCartByUser($userId)
    {
        $sql = "SELECT * FROM carts WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$userId]);

        return $stmt->fetch();
    }

    // tạo cart mới
    public function createCart($userId)
    {
        $sql = "INSERT INTO carts(user_id,created_at)
                VALUES(?,NOW())";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$userId]);

        return $this->conn->lastInsertId();
    }

    // kiểm tra sản phẩm đã tồn tại chưa
    public function getCartItem($cartId,$productId,$size)
    {
        $sql = "SELECT * FROM cart_items
                WHERE cart_id=? AND product_id=? AND size=?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$cartId,$productId,$size]);

        return $stmt->fetch();
    }

    // thêm sản phẩm
    public function addItem($cartId,$productId,$size,$qty)
    {
        $sql = "INSERT INTO cart_items
                (cart_id,product_id,size,quantity,created_at)
                VALUES(?,?,?,?,NOW())";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $cartId,
            $productId,
            $size,
            $qty
        ]);
    }

    // tăng số lượng
    public function updateQty($id,$qty)
    {
        $sql = "UPDATE cart_items
                SET quantity = quantity + ?
                WHERE id=?";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $qty,
            $id
        ]);
    }

    // danh sách giỏ hàng
    public function getCartItems($userId)
    {
        $sql = "
            SELECT
                ci.*,
                p.name,
                p.price,
                p.image_main
            FROM cart_items ci
            JOIN carts c ON c.id = ci.cart_id
            JOIN products p ON p.id = ci.product_id
            WHERE c.user_id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$userId]);

        return $stmt->fetchAll();
    }

    public function deleteItem($id)
    {
        $sql = "DELETE FROM cart_items WHERE id=?";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([$id]);
    }
}