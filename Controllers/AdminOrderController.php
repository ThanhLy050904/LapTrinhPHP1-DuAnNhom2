<?php



class AdminOrderController
{
    private $model;

    public function __construct($pdo)
    {
        $this->model = new OrderModel($pdo);
    }

    // public function index()
    // {
    //     $adminOrders = $this->model->getAllOrders();

    //     require __DIR__ . '/../Views/admin/orders.php';
    // }
    public function index()
    {
        $keyword = $_GET['keyword'] ?? '';
        $status = $_GET['status'] ?? '';

        $adminOrders = $this->model->searchOrders(
            $keyword,
            $status
        );

        $stats = $this->model->getOrderStats();
        $revenue = $this->model->getRevenue();
        $revenueMonth = $this->model->getRevenueMonth();

        require __DIR__ . '/../Views/admin/orders.php';
    }
    public function view($id)
    {
        $adminOrders = $this->model->getAllOrders();

        $orderView = null;

        foreach ($adminOrders as $order) {
            if ($order['id'] == $id) {
                $orderView = $order;
                break;
            }
        }

        $adminOrderItems = $this->model->getOrderItems($id);

        require __DIR__ . '/../Views/admin/order-detail.php';
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
    public function invoice($id)
    {
        $order = $this->model->getOrderById($id);
        $items = $this->model->getOrderItems($id);

        require __DIR__ . '/../Views/admin/invoice.php';
    }
}