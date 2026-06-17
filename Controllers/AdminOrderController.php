<?php

require_once __DIR__ . '/../models/OrderModel.php';

class AdminOrderController
{
    private $model;

    public function __construct($pdo)
    {
        $this->model = new OrderModel($pdo);
    }

    public function index()
    {
        $adminOrders = $this->model->getAllOrders();

        require __DIR__ . '/../Views/admin/orders.php';
    }

    public function view($id)
    {
        $adminOrders = $this->model->getAllOrders();
        $adminOrderItems = $this->model->getOrderItems($id);

        require __DIR__ . '/../Views/admin/orders.php';
    }

    public function delete($id)
    {
        $this->model->deleteOrder($id);

        header("Location: ?pages=admin&section=orders");
        exit;
    }

    public function updateStatus($id, $status)
    {
        $this->model->updateStatus($id, $status);

        header("Location: ?pages=admin&section=orders");
        exit;
    }
}