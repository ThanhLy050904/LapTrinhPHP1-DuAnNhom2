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

    public function addOrderDetail($orderId, $productId, $size, $quantity, $price)
    {
        $sql = "INSERT INTO order_items(order_id, product_id, size, quantity, price)
                VALUES(?,?,?,?,?)";

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
    $stmt = $this->conn->prepare("
        SELECT *
        FROM orders
        WHERE user_id = ?
        ORDER BY id DESC
    ");

    $stmt->execute([$userId]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        $stmt = $this->conn->prepare(
            "SELECT status FROM orders WHERE id=?"
        );

        $stmt->execute([$id]);

        $current = $stmt->fetchColumn();

        if (!$current) {
            return false;
        }

        // Đơn hoàn thành hoặc đã hủy thì khóa luôn
        if (
            $current == 'hoan_thanh' ||
            $current == 'da_huy'
        ) {
            return false;
        }

        return $this->conn
            ->prepare("UPDATE orders SET status=? WHERE id=?")
            ->execute([$status, $id]);
    }
    public function searchOrders($keyword = '', $status = '')
    {
        $sql = "SELECT * FROM orders WHERE 1";

        $params = [];

        if (!empty($keyword)) {
            $sql .= " AND (
            id LIKE ?
            OR full_name LIKE ?
            OR phone LIKE ?
        )";

            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
        }

        if (!empty($status)) {
            $sql .= " AND status = ?";
            $params[] = $status;
        }

        $sql .= " ORDER BY id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderStats()
    {
        return [
            'total' => $this->conn->query(
                "SELECT COUNT(*) FROM orders"
            )->fetchColumn(),

            'pending' => $this->conn->query(
                "SELECT COUNT(*) FROM orders
             WHERE status='cho_xac_nhan'"
            )->fetchColumn(),

            'confirmed' => $this->conn->query(
                "SELECT COUNT(*) FROM orders
             WHERE status='da_xac_nhan'"
            )->fetchColumn(),

            'shipping' => $this->conn->query(
                "SELECT COUNT(*) FROM orders
             WHERE status='dang_giao'"
            )->fetchColumn(),

            'completed' => $this->conn->query(
                "SELECT COUNT(*) FROM orders
             WHERE status='hoan_thanh'"
            )->fetchColumn(),

            'cancelled' => $this->conn->query(
                "SELECT COUNT(*) FROM orders
             WHERE status='da_huy'"
            )->fetchColumn(),
        ];
    }
    public function getRevenue()
    {
        return $this->conn
            ->query("
            SELECT SUM(total_price)
            FROM orders
            WHERE status='hoan_thanh'
        ")
            ->fetchColumn();
    }
    public function getRevenueMonth()
    {
        return $this->conn
            ->query("
            SELECT SUM(total_price)
            FROM orders
            WHERE status='hoan_thanh'
            AND MONTH(created_at)=MONTH(CURRENT_DATE())
            AND YEAR(created_at)=YEAR(CURRENT_DATE())
        ")
            ->fetchColumn();
    }
    public function getOrderById($id)
    {
        $stmt = $this->conn->prepare("
        SELECT *
        FROM orders
        WHERE id = ?
        LIMIT 1
    ");

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}