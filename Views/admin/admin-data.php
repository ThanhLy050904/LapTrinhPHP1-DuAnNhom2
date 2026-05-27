<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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

function admin_get_next_id(array $items): int
{
    $max = 0;
    foreach ($items as $item) {
        if (!empty($item['id']) && intval($item['id']) > $max) {
            $max = intval($item['id']);
        }
    }
    return $max + 1;
}

function admin_get_order_index(array $items, string $code): int
{
    foreach ($items as $index => $item) {
        if (($item['code'] ?? '') === $code) {
            return $index;
        }
    }
    return -1;
}

function admin_update_stats(): void
{
    global $adminData;
    $adminData['stats'] = [
        'users' => count($adminData['accounts']),
        'products' => count($adminData['products']),
        'orders' => count($adminData['orders']),
        'revenue' => '7.020.000 đ',
    ];
}

function admin_redirect(string $section): void
{
    header('Location:?pages=admin&section=' . urlencode($section));
    exit;
}

function admin_delete_item(array &$items, int $id): void
{
    foreach ($items as $index => $item) {
        if (!empty($item['id']) && intval($item['id']) === $id) {
            array_splice($items, $index, 1);
            return;
        }
    }
}

admin_update_stats();

$section = $_GET['section'] ?? 'dashboard';
$action = $_REQUEST['action'] ?? '';

if ($action === 'delete') {
    if ($section === 'products' && isset($_GET['id'])) {
        admin_delete_item($adminProducts, intval($_GET['id']));
        admin_update_stats();
        admin_redirect('products');
    }
    if ($section === 'categories' && isset($_GET['id'])) {
        admin_delete_item($adminCategories, intval($_GET['id']));
        admin_redirect('categories');
    }
    if ($section === 'accounts' && isset($_GET['id'])) {
        admin_delete_item($adminAccounts, intval($_GET['id']));
        admin_update_stats();
        admin_redirect('accounts');
    }
    if ($section === 'orders' && isset($_GET['code'])) {
        $idx = admin_get_order_index($adminOrders, $_GET['code']);
        if ($idx >= 0) {
            array_splice($adminOrders, $idx, 1);
        }
        admin_update_stats();
        admin_redirect('orders');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['admin_form'])) {
    $formSection = $_POST['admin_form'];

    if ($formSection === 'products') {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $item = [
            'id' => $id ?: admin_get_next_id($adminProducts),
            'name' => trim($_POST['name'] ?? ''),
            'price' => trim($_POST['price'] ?? ''),
            'category' => trim($_POST['category'] ?? ''),
            'image' => trim($_POST['image'] ?? ''),
        ];

        if ($id > 0) {
            foreach ($adminProducts as $index => $product) {
                if (intval($product['id']) === $id) {
                    $adminProducts[$index] = $item;
                    break;
                }
            }
        } else {
            $adminProducts[] = $item;
        }

        admin_update_stats();
        admin_redirect('products');
    }

    if ($formSection === 'categories') {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $item = [
            'id' => $id ?: admin_get_next_id($adminCategories),
            'name' => trim($_POST['name'] ?? ''),
        ];

        if ($id > 0) {
            foreach ($adminCategories as $index => $category) {
                if (intval($category['id']) === $id) {
                    $adminCategories[$index] = $item;
                    break;
                }
            }
        } else {
            $adminCategories[] = $item;
        }
        admin_redirect('categories');
    }

    if ($formSection === 'accounts') {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $item = [
            'id' => $id ?: admin_get_next_id($adminAccounts),
            'name' => trim($_POST['name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'role' => trim($_POST['role'] ?? ''),
        ];

        if ($id > 0) {
            foreach ($adminAccounts as $index => $account) {
                if (intval($account['id']) === $id) {
                    $adminAccounts[$index] = $item;
                    break;
                }
            }
        } else {
            $adminAccounts[] = $item;
        }
        admin_update_stats();
        admin_redirect('accounts');
    }

    if ($formSection === 'orders') {
        $code = trim($_POST['code'] ?? '');
        $item = [
            'code' => $code,
            'customer' => trim($_POST['customer'] ?? ''),
            'status' => trim($_POST['status'] ?? ''),
            'total' => trim($_POST['total'] ?? ''),
        ];

        $idx = admin_get_order_index($adminOrders, $code);
        if ($idx >= 0) {
            $adminOrders[$idx] = $item;
        }

        admin_update_stats();
        admin_redirect('orders');
    }
}
?>
