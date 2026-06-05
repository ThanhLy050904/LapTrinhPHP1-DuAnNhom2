<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
ob_start();

session_start(); 

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

// ================= MODELS =================
require_once "models/Database.php";
require_once "models/ProductModel.php";
require_once "models/CategoryModel.php";
require_once "models/UserModel.php";

// ================= CONTROLLERS =================
require_once "controllers/HomeController.php";
require_once "controllers/ProductController.php";
require_once "controllers/CategoryController.php";
require_once "controllers/CartController.php";
require_once "controllers/CheckoutController.php";
require_once "controllers/AuthController.php";

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

        case "danh-muc":
            $controller = new CategoryController();
            $controller->index();
            break;

        case "gio-hang":
            $controller = new CartController();
            $controller->index();
            break;

        // ================= THANH TOÁN =================
        case "thanh-toan":

            $controller = new CheckoutController();

            if ($action === "place-order") {
                $controller->placeOrder(); // ✅ bấm đặt hàng
            } else {
                $controller->index(); // xem trang thanh toán
            }

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
            } else {
                $auth->showLoginForm();
            }
            break;

        case "dang-ky":
            $controller = new AuthController();
            $controller->register();
            break;

        case "quen-mat-khau":
            require "Views/pages/quen-mat-khau.php";
            break;

        case "tai-khoan-cua-toi":
            require "Views/pages/tai-khoan-cua-toi.php";
            break;

        case "lien-he":
            require "Views/pages/lien-he.php";
            break;

        case "admin":
            require "Views/admin/dashboard.php";
            break;

        default:
            echo "<h1>404 NOT FOUND</h1>";
            break;
    }

    include "Views/layouts/footer.php";
    ?>

</body>

</html>