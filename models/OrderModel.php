<?php

require_once __DIR__ . '/BaseModel.php';

class OrderModel extends BaseModel
{
    public function getAllOrders()
    {
        $pdo = $this->connect();

        $sql = "SELECT o.*, u.full_name
                FROM orders o
                LEFT JOIN users u ON o.user_id = u.id
                ORDER BY o.created_at DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderById(int $id)
    {
        $pdo = $this->connect();
        $stmt = $pdo->prepare('SELECT o.*, u.full_name FROM orders o LEFT JOIN users u ON o.user_id = u.id WHERE o.id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateOrder(int $id, array $data)
    {
        $pdo = $this->connect();
        $fields = [];
        $params = ['id' => $id];

        if (isset($data['status'])) {
            $fields[] = 'status = :status';
            $params['status'] = $data['status'];
        }
        if (isset($data['total_price'])) {
            $fields[] = 'total_price = :total_price';
            $params['total_price'] = intval($data['total_price']);
        }
        if (isset($data['user_id'])) {
            $fields[] = 'user_id = :user_id';
            $params['user_id'] = intval($data['user_id']);
        }

        if (empty($fields)) {
            return false;
        }

        $sql = 'UPDATE orders SET ' . implode(', ', $fields) . ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public function deleteOrder(int $id)
    {
        $pdo = $this->connect();
        $stmt = $pdo->prepare('DELETE FROM orders WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

    public function searchOrders(string $q)
    {
        $pdo = $this->connect();
        $like = '%' . $q . '%';
        $sql = "SELECT o.*, u.full_name
                FROM orders o
                LEFT JOIN users u ON o.user_id = u.id
                WHERE o.id LIKE :like OR u.full_name LIKE :like
                ORDER BY o.created_at DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['like' => $like]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createOrder(?int $userId, int $totalPrice, string $status = 'pending')
    {
        $pdo = $this->connect();
        $sql = 'INSERT INTO orders (user_id, total_price, status, created_at) VALUES (:user_id, :total_price, :status, NOW())';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'user_id' => $userId,
            'total_price' => $totalPrice,
            'status' => $status,
        ]);
        return intval($pdo->lastInsertId());
    }

    public function createOrderItems(int $orderId, array $items)
    {
        $pdo = $this->connect();
        $sql = 'INSERT INTO order_items (order_id, product_id, size, quantity, price, created_at) VALUES (:order_id, :product_id, :size, :quantity, :price, NOW())';
        $stmt = $pdo->prepare($sql);
        foreach ($items as $it) {
            $stmt->execute([
                'order_id' => $orderId,
                'product_id' => $it['product_id'] ?? null,
                'size' => $it['size'] ?? '',
                'quantity' => intval($it['quantity'] ?? 1),
                'price' => intval($it['price'] ?? 0),
            ]);
        }
        return true;
    }

    public function getOrderItems(int $orderId)
    {
        $pdo = $this->connect();
        $sql = 'SELECT oi.*, p.name AS product_name, p.image_main
                FROM order_items oi
                LEFT JOIN products p ON oi.product_id = p.id
                WHERE oi.order_id = :order_id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['order_id' => $orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Create order and items inside a transaction. Returns order id on success.
     */
    public function createFullOrder(?int $userId, int $totalPrice, string $status, array $items)
    {
        $pdo = $this->connect();
        try {
            $pdo->beginTransaction();

            $sql = 'INSERT INTO orders (user_id, total_price, status, created_at) VALUES (:user_id, :total_price, :status, NOW())';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'user_id' => $userId,
                'total_price' => $totalPrice,
                'status' => $status,
            ]);

            $orderId = intval($pdo->lastInsertId());

            if ($orderId <= 0) {
                $pdo->rollBack();
                return 0;
            }

            $sqlItem = 'INSERT INTO order_items (order_id, product_id, size, quantity, price, created_at) VALUES (:order_id, :product_id, :size, :quantity, :price, NOW())';
            $stmtItem = $pdo->prepare($sqlItem);
            foreach ($items as $it) {
                $stmtItem->execute([
                    'order_id' => $orderId,
                    'product_id' => $it['product_id'] ?? null,
                    'size' => $it['size'] ?? '',
                    'quantity' => intval($it['quantity'] ?? 1),
                    'price' => intval($it['price'] ?? 0),
                ]);
            }

            $pdo->commit();
            return $orderId;
        } catch (Exception $e) {
            if ($pdo->inTransaction()) $pdo->rollBack();
            throw $e;
        }
    }
}
