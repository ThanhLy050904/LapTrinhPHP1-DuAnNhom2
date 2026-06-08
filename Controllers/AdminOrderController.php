<?php

class AdminOrderController
{
    public function handle()
    {
        // Load admin order data and render the admin dashboard view.
        require_once __DIR__ . '/../Views/admin/admin-data.php';
        require_once __DIR__ . '/../Views/admin/dashboard.php';
    }
}
