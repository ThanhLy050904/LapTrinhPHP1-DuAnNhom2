<?php

class OrderModel
{
    private $conn;

    public function __construct($pdo)
    {
        $this->conn = $pdo;
    }

    /* ================= USER ORDER ================= */
    public function createOrder($userId, $fullName, $email, $phone, $address, $paymentMethod, $totalPrice)
    {
        $sql = "INSERT INTO orders(user_id, full_name, email, phone, address, payment_method, total_price)
                VALUES(?,?,?,?,?,?,?)";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            $userId, $fullName, $email, $phone, $address, $paymentMethod, $totalPrice
        ]);

        return $this->conn->lastInsertId();
    }

    public function addOrderDetail($orderId, $productId, $size, $quantity, $price)
    {
        $sql = "INSERT INTO order_items(order_id, product_id, size, quantity, price)
                VALUES(?,?,?,?,?)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $orderId, $productId, $size, $quantity, $price
        ]);
    }

    public function getOrdersByUser($userId)
    {
        return $this->conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY id DESC")
            ->execute([$userId]);
    }

    /* ================= ADMIN ================= */

    public function getAllOrders()
    {
        return $this->conn->query("SELECT * FROM orders ORDER BY id DESC")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderItems($orderId)
    {
        $sql = "
            SELECT oi.*, p.name AS product_name
            FROM order_items oi
            LEFT JOIN products p ON oi.product_id = p.id
            WHERE oi.order_id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$orderId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteOrder($id)
    {
        $this->conn->prepare("DELETE FROM order_items WHERE order_id=?")->execute([$id]);
        return $this->conn->prepare("DELETE FROM orders WHERE id=?")->execute([$id]);
    }

    public function updateStatus($id, $status)
    {
        return $this->conn->prepare("UPDATE orders SET status=? WHERE id=?")
            ->execute([$status, $id]);
    }
}