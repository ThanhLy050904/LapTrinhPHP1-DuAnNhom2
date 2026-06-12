<?php

class OrderModel
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function createOrder(
        $userId,
        $fullName,
        $email,
        $phone,
        $address,
        $paymentMethod,
        $totalPrice
    ) {
        $sql = "
            INSERT INTO orders(
                user_id,
                full_name,
                email,
                phone,
                address,
                payment_method,
                total_price
            )
            VALUES(?,?,?,?,?,?,?)
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            $userId,
            $fullName,
            $email,
            $phone,
            $address,
            $paymentMethod,
            $totalPrice
        ]);

        return $this->conn->lastInsertId();
    }

    public function addOrderDetail(
        $orderId,
        $productId,
        $size,
        $quantity,
        $price
    ) {
        $sql = "
        INSERT INTO order_items(
            order_id,
            product_id,
            size,
            quantity,
            price
        )
        VALUES(?,?,?,?,?)
    ";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $orderId,
            $productId,
            $size,
            $quantity,
            $price
        ]);
    }
    public function getOrdersByUser($userId)
    {
        $sql = "
        SELECT *
        FROM orders
        WHERE user_id = ?
        ORDER BY id DESC
    ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$userId]);

        return $stmt->fetchAll();
    }
}
