<?php

require_once "Models/AdminDashboardModel.php";

class AdminDashboardController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $adminStats = [
            'users' => $this->pdo->query("SELECT COUNT(*) FROM users")->fetchColumn(),
            'products' => $this->pdo->query("SELECT COUNT(*) FROM products")->fetchColumn(),
            'orders' => $this->pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn(),
            'revenue' => $this->pdo->query("
                SELECT IFNULL(SUM(total_price),0)
                FROM orders
                WHERE status='hoan_thanh'
            ")->fetchColumn()
        ];

        require "Views/admin/dashboard.php";
    }
}