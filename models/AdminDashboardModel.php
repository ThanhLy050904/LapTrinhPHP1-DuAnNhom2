<?php

class AdminDashboardModel
{
    private $conn;

    public function __construct($pdo)
    {
        $this->conn = $pdo;
    }

    public function getStats()
    {
        return [
            'users' => $this->conn
                ->query("SELECT COUNT(*) FROM users")
                ->fetchColumn(),

            'products' => $this->conn
                ->query("SELECT COUNT(*) FROM products")
                ->fetchColumn(),

            'orders' => $this->conn
                ->query("SELECT COUNT(*) FROM orders")
                ->fetchColumn(),

            'revenue' => $this->conn
                ->query("
                    SELECT COALESCE(
                        SUM(total_price),
                        0
                    )
                    FROM orders
                    WHERE status='hoan_thanh'
                ")
                ->fetchColumn()
        ];
    }
}