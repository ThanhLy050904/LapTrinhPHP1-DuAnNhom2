<?php
// Prepare admin data used by admin dashboard and subpages.
// This file is included from Controllers and Views; use robust DB access.

<<<<<<< HEAD
require_once __DIR__ . '/../../models/Database.php';
require_once __DIR__ . '/../../models/ProductModel.php';
require_once __DIR__ . '/../../models/CategoryModel.php';

$db = new Database();
$pdo = $db->connect();

$adminProducts = [];
$adminCategories = [];
$adminAccounts = [];
$adminOrders = [];
$adminStats = [
    'users' => 0,
    'products' => 0,
    'orders' => 0,
    'revenue' => 0,
];

// Load products
try {
    $productModel = new ProductModel();
    $products = $productModel->getAll();
    foreach ($products as $p) {
        $img = $p['image_main'] ?? $p['image'] ?? '';
        if (!empty($img) && strpos($img, 'Views/') === false) {
            $img = 'Views/image/' . $img;
=======
$defaultAdminData = [
    'products' => [
        [
            'id' => 1,
            'name' => 'Giày thể thao Kenzie',
            'price' => '1.250.000 đ',
            'category' => 'Thể thao',
            'image' => 'https://via.placeholder.com/80x80?text=Giày',
        ],
        [
            'id' => 2,
            'name' => 'Áo khoác nam',
            'price' => '850.000 đ',
            'category' => 'Thời trang',
            'image' => 'https://via.placeholder.com/80x80?text=Áo',
        ],
        [
            'id' => 3,
            'name' => 'Balo chống nước',
            'price' => '420.000 đ',
            'category' => 'Phụ kiện',
            'image' => 'https://via.placeholder.com/80x80?text=Balo',
        ],
    ],
    'orders' => [
        [
            'code' => 'DH001',
            'customer' => 'Nguyễn Văn A',
            'status' => 'Đang chờ',
            'total' => '2.350.000 đ',
        ],
        [
            'code' => 'DH002',
            'customer' => 'Trần Thị B',
            'status' => 'Hoàn thành',
            'total' => '1.070.000 đ',
        ],
        [
            'code' => 'DH003',
            'customer' => 'Lê Văn C',
            'status' => 'Đang giao',
            'total' => '3.600.000 đ',
        ],
        [
            'code' => 'DH004',
            'customer' => 'Phạm Thị D',
            'status' => 'Đang chờ',
            'total' => '750.000 đ',
        ],
        [
            'code' => 'DH005',
            'customer' => 'Trần Văn E',
            'status' => 'Đang giao',
            'total' => '1.980.000 đ',
        ],
        [
            'code' => 'DH006',
            'customer' => 'Ngô Thị F',
            'status' => 'Hoàn thành',
            'total' => '420.000 đ',
        ],
    ],
    'categories' => [
        ['id' => 1, 'name' => 'Thời trang'],
        ['id' => 2, 'name' => 'Thể thao'],
        ['id' => 3, 'name' => 'Phụ kiện'],
    ],
    'accounts' => [
        ['id' => 1, 'name' => 'Admin Kenzie', 'email' => 'admin@kenzie.vn', 'role' => 'Quản trị viên'],
        ['id' => 2, 'name' => 'Nguyễn Thị D', 'email' => 'd.n@kenzie.vn', 'role' => 'Khách hàng'],
        ['id' => 3, 'name' => 'Hoàng M', 'email' => 'm.h@kenzie.vn', 'role' => 'Khách hàng'],
    ],
];

if (!isset($_SESSION['adminData'])) {
    $_SESSION['adminData'] = $defaultAdminData;
}

$adminData = &$_SESSION['adminData'];
$adminProducts = &$adminData['products'];
$adminOrders = &$adminData['orders'];
$adminCategories = &$adminData['categories'];
$adminAccounts = &$adminData['accounts'];
$adminStats = &$adminData['stats'];

// If session already existed but has few orders, append sample orders so tests immediately show data
$sampleOrders = [
    ['code' => 'DH004', 'customer' => 'Phạm Thị D', 'status' => 'Đang chờ', 'total' => '750.000 đ'],
    ['code' => 'DH005', 'customer' => 'Trần Văn E', 'status' => 'Đang giao', 'total' => '1.980.000 đ'],
    ['code' => 'DH006', 'customer' => 'Ngô Thị F', 'status' => 'Hoàn thành', 'total' => '420.000 đ'],
];
foreach ($sampleOrders as $s) {
    if (admin_get_order_index($adminOrders, $s['code']) === -1) {
        $adminOrders[] = $s;
    }
}

function admin_get_next_id(array $items): int
{
    $max = 0;
    foreach ($items as $item) {
        if (!empty($item['id']) && intval($item['id']) > $max) {
            $max = intval($item['id']);
>>>>>>> 5e65d85fd2d5d5ccb45e481e044a54de37b3ec9e
        }
        $adminProducts[] = [
            'id' => $p['id'] ?? null,
            'image' => $img,
            'name' => $p['name'] ?? '',
            'price' => $p['price'] ?? 0,
            'category' => $p['category_name'] ?? '',
            'description' => $p['description'] ?? '',
            'category_id' => $p['category_id'] ?? null,
            'is_sale' => $p['is_sale'] ?? 0,
            'is_hot' => $p['is_hot'] ?? 0,
            'slug' => $p['slug'] ?? '',
        ];
    }
} catch (Exception $e) {
    $adminProducts = [];
}

// Load categories
try {
    $categoryModel = new CategoryModel();
    $adminCategories = $categoryModel->getAll();
} catch (Exception $e) {
    $adminCategories = [];
}

// Load users/accounts
try {
    $roleFilter = trim($_GET['role'] ?? '');
    $statusFilter = trim($_GET['status'] ?? '');
    $dateFrom = trim($_GET['date_from'] ?? '');
    $dateTo = trim($_GET['date_to'] ?? '');
    $sortDir = isset($_GET['sort']) && $_GET['sort'] === 'oldest' ? 'ASC' : 'DESC';

    $conditions = [];
    $params = [];

    if (isset($_GET['section']) && $_GET['section'] === 'accounts') {
        if (!empty($_GET['q'])) {
            $query = trim($_GET['q']);
            $q = '%'.str_replace('%','', $query).'%';
            $conditions[] = '(id LIKE :q OR full_name LIKE :q OR email LIKE :q OR role LIKE :q)';
            $params['q'] = $q;
        }
        if ($roleFilter !== '') {
            $conditions[] = 'role = :role';
            $params['role'] = $roleFilter;
        }
        if ($statusFilter !== '') {
            $conditions[] = 'status = :status';
            $params['status'] = $statusFilter;
        }
        if ($dateFrom !== '') {
            $conditions[] = 'created_at >= :date_from';
            $params['date_from'] = $dateFrom . ' 00:00:00';
        }
        if ($dateTo !== '') {
            $conditions[] = 'created_at <= :date_to';
            $params['date_to'] = $dateTo . ' 23:59:59';
        }
    }

    $sql = 'SELECT id, full_name, email, role, status, created_at FROM users';
    if (!empty($conditions)) {
        $sql .= ' WHERE ' . implode(' AND ', $conditions);
    }
    $sql .= ' ORDER BY created_at ' . $sortDir;

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($users as $u) {
        $adminAccounts[] = [
            'id' => $u['id'],
            'name' => $u['full_name'] ?? $u['name'] ?? '',
            'email' => $u['email'] ?? '',
            'role' => $u['role'] ?? 'user',
            'status' => $u['status'] ?? 'active',
            'created_at' => $u['created_at'] ?? null,
        ];
    }
} catch (Exception $e) {
    $adminAccounts = [];
}

// Load orders (avoid using OrderModel which depends on missing BaseModel)
try {
    // Allow searching orders via ?q=term when in admin orders section
    $ordersSql = 'SELECT o.*, u.full_name FROM orders o LEFT JOIN users u ON o.user_id = u.id';
    if (isset($_GET['section']) && $_GET['section'] === 'orders' && !empty($_GET['q'])) {
        $query = trim($_GET['q']);
        $q = '%'.str_replace('%','', $query).'%';
        $ordersSql .= " WHERE o.id LIKE :q OR u.full_name LIKE :q OR o.status LIKE :q OR o.total_price LIKE :q";
        $stmt = $pdo->prepare($ordersSql . ' ORDER BY o.created_at DESC');
        $stmt->execute(['q' => $q]);
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $stmt = $pdo->query($ordersSql . ' ORDER BY o.created_at DESC');
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    $revenue = 0;
    foreach ($orders as $o) {
        $adminOrders[] = [
            'id' => $o['id'] ?? null,
            'customer' => $o['full_name'] ?? $o['customer'] ?? '',
            'status' => $o['status'] ?? '',
            'total' => $o['total_price'] ?? $o['total'] ?? 0,
            'created_at' => $o['created_at'] ?? null,
            'user_id' => $o['user_id'] ?? null,
        ];
        $revenue += intval($o['total_price'] ?? $o['total'] ?? 0);
    }
    $adminStats['revenue'] = $revenue;
} catch (Exception $e) {
    $adminOrders = [];
}

// If viewing a specific order, load its items for the detail page
$adminOrderItems = [];
$orderViewId = $_GET['id'] ?? null;
if (isset($_GET['section']) && $_GET['section'] === 'orders' && isset($_GET['action']) && $_GET['action'] === 'view' && $orderViewId !== null) {
    $orderId = intval($orderViewId);
    $stmt = $pdo->prepare('SELECT oi.*, p.name AS product_name, p.image_main FROM order_items oi LEFT JOIN products p ON oi.product_id = p.id WHERE oi.order_id = :order_id');
    $stmt->execute(['order_id' => $orderId]);
    $adminOrderItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Final counts
$adminStats['users'] = count($adminAccounts);
$adminStats['products'] = count($adminProducts);
$adminStats['orders'] = count($adminOrders);

?>
