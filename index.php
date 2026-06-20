<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
ob_start();

session_start();

function checkAdmin()
{
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
        die("<h1>403 - Truy cập bị từ chối! Bạn không có quyền truy cập trang này.</h1>");
    }
}

$page = $_GET['pages'] ?? 'home';
$action = $_GET['action'] ?? null;

// ================= CSS =================
$cssFiles = [
    'home' => 'home.css',
    'home1' => 'home.css',
    'danh-muc' => 'danh-muc.css',
    'chi-tiet-san-pham' => 'chi-tiet-san-pham.css',
    'gio-hang' => 'gio-hang.css',
    'thanh-toan' => 'thanh-toan.css',
    'lien-he' => 'lien-he.css',
    'dang-nhap' => 'auth.css',
    'dang-ky' => 'auth.css',
    'admin' => 'admin.css',
    'quen-mat-khau' => 'auth.css',
    'tai-khoan-cua-toi' => 'tai-khoan-cua-toi.css',
    'gioi-thieu' => 'gioi-thieu.css',
    'tin-tuc' => 'tin-tuc.css',
    'tin-tuc-detail' => 'tin-tuc.css',
];

// ================= HELPERS =================
require_once "helpers/AuthHelper.php";

// ================= MODELS =================
require_once "models/Database.php";
require_once "models/ProductModel.php";
require_once "models/CategoryModel.php";
require_once "models/UserModel.php";
require_once "Models/CartModel.php";
require_once "Models/OrderModel.php";
require_once "Models/AdminProductModel.php";
require_once "Models/AdminCategoryModel.php";


// ================= PDO =================
$db = new Database();
$pdo = $db->connect();

// ================= CONTROLLERS =================
require_once "controllers/HomeController.php";
require_once "controllers/ProductController.php";
require_once "controllers/CategoryController.php";
require_once "controllers/CartController.php";
require_once "controllers/CheckoutController.php";
require_once "controllers/AuthController.php";
require_once "controllers/AccountController.php";
require_once "Controllers/OrderController.php";


// ================= CHECK USER LOCK =================
if (isset($_SESSION['user']['id'])) {

    $userModel = new UserModel($pdo);

    $currentUser = $userModel->getUserById($_SESSION['user']['id']);

    if ($currentUser && isset($currentUser['status']) && $currentUser['status'] === 'locked') {
        session_unset();
        session_destroy();
        header('Location: ?pages=dang-nhap&locked=1');
        exit();
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KENZIE</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="Views/css/header.css">

    <?php if (isset($cssFiles[$page])): ?>
        <link rel="stylesheet" href="Views/css/<?= $cssFiles[$page] ?>">
    <?php endif; ?>

</head>

<body>

    <?php if ($page !== 'admin'): ?>
        <?php include "Views/layouts/header.php"; ?>
    <?php endif; ?>

    <?php

    switch ($page) {

        case "home":
            $controller = new HomeController($pdo);
            $controller->index();
            break;

        case "chi-tiet-san-pham":
            $controller = new ProductController($pdo);
            $controller->show();
            break;

        case 'danh-muc':
            $controller = new ProductController($pdo);
            $controller->category();
            break;

        // ================= CART =================
        case "gio-hang":
            $controller = new CartController($pdo);

            $action = $_GET['action'] ?? '';

            if ($action === 'update-quantity') {
                $controller->updateQuantity();
            } elseif ($action === 'remove') {
                $controller->remove();
            } else {
                $controller->index();
            }
            break;

        case "cart-add":
            $controller = new CartController($pdo);
            $controller->add();
            break;

        case "cart-remove":
            $controller = new CartController($pdo);
            $controller->remove();
            break;

        // ================= CHECKOUT =================
        case 'thanh-toan':

            $controller = new OrderController($pdo);

            if (isset($_GET['action']) && $_GET['action'] == 'place-order') {
                $controller->placeOrder();
            } else {
                $controller->checkout();
            }

            break;

        // ================= ORDERS =================
        case 'don-hang-cua-toi':
            $controller = new OrderController($pdo);
            $controller->myOrders();
            break;
        case 'chi-tiet-don-hang':
    $controller = new OrderController($pdo);
    $controller->detail();
    break;

        case 'dat-hang-thanh-cong':
            require 'Views/pages/dat-hang-thanh-cong.php';
            break;

        case "thank-you":
            $order = $_SESSION['order'] ?? null;
            require "Views/pages/thank-you.php";
            break;

        // ================= AUTH =================
        case "dang-nhap":
            $auth = new AuthController($pdo);
            if ($action === 'login') {
                $auth->login();
            } elseif ($action === 'logout') {
                $auth->logout();
            } else {
                $auth->showLoginForm();
            }
            break;

        case "dang-ky":
            $controller = new AuthController($pdo);
            $controller->register();
            break;

        case "quen-mat-khau":
            $auth = new AuthController($pdo);
            $auth->forgotPassword();
            break;

        case "reset-password":
            $auth = new AuthController($pdo);
            $auth->resetPassword();
            break;

        case "tai-khoan-cua-toi":
            $controller = new AccountController($pdo);
            $controller->profile();
            break;

        case 'doi-avatar':
            $controller = new AccountController($pdo);
            $controller->changeAvatar();
            break;

        // ================= STATIC PAGES =================
        case "lien-he":
            require "Views/pages/lien-he.php";
            break;

        case "tin-tuc":
            require "Views/pages/tin-tuc.php";
            break;

        case "tin-tuc-detail":
            require "Views/pages/tin-tuc-detail.php";
            break;

        case "gioi-thieu":
            require "Views/pages/gioi-thieu.php";
            break;

        // ================= ADMIN =================
        case "admin":
            checkAdmin();

            $section = $_GET['section'] ?? 'dashboard';
            $action = $_GET['action'] ?? null;
            $id = $_GET['id'] ?? null;
            ?>

            <style>
                .admin-wrapper {
                    display: flex;
                    min-height: 100vh;
                    background: #f4f6fb;
                }

                .sidebar {
                    width: 250px;
                    position: fixed;
                    left: 0;
                    top: 0;
                    bottom: 0;
                    background: #fff;
                    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
                    z-index: 1000;
                }

                /* MAIN CONTENT - FULL WIDTH */
                .main-content {
                    margin-left: 250px;
                    width: calc(100% - 250px);
                    padding: 24px 32px;
                    background: #f4f6fb;
                    min-height: 100vh;
                }

                /* Fix các phần nội dung bên trong */
                .admin-center,
                .admin-box,
                .admin-card,
                .card,
                .table-responsive {
                    width: 100% !important;
                    max-width: none !important;
                    margin: 0 !important;
                }

                .admin-card {
                    padding: 20px;
                }
            </style>

            <div class="admin-wrapper">
                <!-- SIDEBAR -->
                <aside class="sidebar">
                    <?php include "Views/admin/sidebar.php"; ?>
                </aside>

                <!-- MAIN CONTENT -->
                <main class="main-content">
                    <?php

                    // ================= PRODUCT ADMIN =================
                    if ($section === 'products') {
                        require_once "controllers/AdminProductController.php";
                        $controller = new AdminProductController($pdo);

                        if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                            $controller->store();
                        } elseif ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                            $controller->update($id);
                        } elseif ($action === 'delete') {
                            $controller->delete($id);
                        } else {
                            $controller->index();
                        }
                    }

                    // ================= CATEGORY ADMIN =================
                    elseif ($section === 'categories') {
                        require_once "controllers/AdminCategoryController.php";
                        $controller = new AdminCategoryController($pdo);

                        if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                            $controller->store();
                        } elseif ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                            $controller->update($id);
                        } elseif ($action === 'delete') {
                            $controller->delete($id);
                        } else {
                            $controller->index();
                        }
                    }

                    // ================= ORDER ADMIN =================
                    elseif ($section === 'orders') {

                        require_once "Controllers/AdminOrderController.php";
                        $orderController = new AdminOrderController($pdo);

                        if ($action === 'view') {

                            $orderController->view($id);

                        } elseif ($action === 'updateStatus' && $_SERVER['REQUEST_METHOD'] === 'POST') {

                            $id = $_POST['id'] ?? 0;
                            $status = $_POST['status'] ?? '';

                            $orderController->updateStatus($id, $status);

                        } elseif ($action === 'delete') {

                            $orderController->delete($id);

                        } elseif ($action === 'invoice') {
                            $orderController->invoice($id);
                        } else {

                            $orderController->index();
                        }

                    }

                    // ================= ACCOUNT ADMIN =================
                    elseif ($section === 'accounts') {
                        require_once "controllers/AdminAccountController.php";
                        $controller = new AdminAccountController($pdo);

                        if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                            $controller->store();
                        } elseif ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                            $controller->update($id);
                        } elseif ($action === 'delete') {
                            $controller->delete($id);
                        } elseif ($action === 'lock') {
                            $controller->lock($id);
                        } else {
                            $controller->index();
                        }
                    }

                    // elseif ($section === 'dashboard') {
                    //     require_once "controllers/AdminAccountController.php";
                    //     $controller = new AdminAccountController($pdo);

                    //     if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                    //         $controller->store();
                    //     } elseif ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                    //         $controller->update($id);
                    //     } elseif ($action === 'delete') {
                    //         $controller->delete($id);
                    //     } elseif ($action === 'lock') {
                    //         $controller->lock($id);
                    //     } else {
                    //         $controller->index();
                    //     }
                    // }

                    // ================= DASHBOARD =================
                    else {
                        echo "<h2>📊 Dashboard Admin</h2>";
                        echo "<p>Chào mừng bạn đến trang quản trị KENZIE</p>";
                    }

                    ?>
                </main>
            </div>


            <?php
            break;


        default:
            echo "<h1>404 NOT FOUND</h1>";
            break;
    }

if ($page !== 'admin') {
    include "Views/layouts/footer.php";
}    ?>

</body>

</html>