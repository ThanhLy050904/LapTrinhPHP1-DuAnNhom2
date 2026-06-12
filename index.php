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

// ================= helpers =================
require_once "helpers/AuthHelper.php";
// ================= MODELS =================
require_once "models/Database.php";
require_once "models/ProductModel.php";
require_once "models/CategoryModel.php";
require_once "models/UserModel.php";
require_once "Models/CartModel.php";
require_once "Models/OrderModel.php";

// ================= CONTROLLERS =================
require_once "controllers/HomeController.php";
require_once "controllers/ProductController.php";
require_once "controllers/CategoryController.php";
require_once "controllers/CartController.php";
require_once "controllers/CheckoutController.php";
require_once "controllers/AuthController.php";
require_once "controllers/AccountController.php";
require_once "Controllers/OrderController.php";

// Nếu user đã login nhưng tài khoản đã bị khóa, buộc đăng xuất và chuyển sang trang login
if (isset($_SESSION['user']['id'])) {
    $userModel = new UserModel();
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
            $controller = new HomeController();
            $controller->index();
            break;

        case "chi-tiet-san-pham":
            $controller = new ProductController();
            $controller->show();
            break;

        case 'danh-muc':

            $controller = new ProductController();
            $controller->category();

            break;

        case "gio-hang":

            require_once "Controllers/CartController.php";

            $controller = new CartController();

            $controller->index();

            break;

        case "cart-add":

            require_once "Controllers/CartController.php";

            $controller = new CartController();

            $controller->add();

            break;

        case "cart-remove":

            require_once "Controllers/CartController.php";

            $controller = new CartController();

            $controller->remove();

            break;

        // ================= THANH TOÁN =================
        case 'thanh-toan':

            $controller =
                new OrderController();

            if (
                isset($_GET['action'])
                &&
                $_GET['action'] == 'place-order'
            ) {
                $controller->placeOrder();
            } else {
                $controller->checkout();
            }

            break;



        case 'don-hang-cua-toi':

            $controller = new OrderController();
            $controller->myOrders();

            break;
        case 'dat-hang-thanh-cong':

            require 'Views/pages/dat-hang-thanh-cong.php';

            break;
        // ================= THANK YOU =================
        case "thank-you":
            $order = $_SESSION['order'] ?? null;
            require "Views/pages/thank-you.php";
            break;

        case "dang-nhap":
            $auth = new AuthController();
            if ($action === 'login') {
                $auth->login();
            } elseif ($action === 'logout') {
                $auth->logout();
            } else {
                $auth->showLoginForm();
            }
            break;

        case "dang-ky":
            $controller = new AuthController();
            $controller->register();
            break;

        case "quen-mat-khau":
            $auth = new AuthController();
            $auth->forgotPassword();
            break;

        case "reset-password":
            $auth = new AuthController();
            $auth->resetPassword();
            break;
        case "tai-khoan-cua-toi":

            $controller = new AccountController();
            $controller->profile();

            break;
        case 'doi-avatar':
            $controller = new AccountController();
            $controller->changeAvatar();
            break;

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

        case "admin":
            checkAdmin();
            require_once "Controllers/AdminController.php";
            $admin = new AdminController();
            $admin->index();
            break;

        default:
            echo "<h1>404 NOT FOUND</h1>";
            break;
    }

    include "Views/layouts/footer.php";
    ?>

</body>

</html>