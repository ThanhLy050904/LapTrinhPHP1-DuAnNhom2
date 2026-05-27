<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$page = $_GET['pages'] ?? 'home';

$cssFiles = [
    'home' => 'home.css',
    'danh-muc' => 'danh-muc.css',
    'chi-tiet-san-pham' => 'chi-tiet-san-pham.css',
    'gio-hang' => 'gio-hang.css',
    'thanh-toan' => 'thanh-toan.css',
    'lien-he' => 'lien-he.css',
    'dang-nhap' => 'auth.css',
    'dang-ky' => 'auth.css',
];

// ================= MODELS =================
require_once "models/BaseModel.php";
require_once "models/ProductModel.php";
require_once "models/CategoryModel.php";

// ================= CONTROLLERS =================
require_once "controllers/HomeController.php";
require_once "controllers/ProductController.php";
require_once "controllers/CategoryController.php";
require_once "controllers/CartController.php";
require_once "controllers/CheckoutController.php";

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KENZIE</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS chung -->
    <link rel="stylesheet" href="Views/css/header.css">

    <!-- CSS theo trang -->
    <?php if (isset($cssFiles[$page])): ?>
        <link rel="stylesheet" href="Views/css/<?= $cssFiles[$page] ?>">
    <?php endif; ?>

</head>

<body>

<?php include "Views/layouts/header.php"; ?>

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

    case "thanh-toan":
        $controller = new CheckoutController();
        $controller->index();
        break;

    case "dang-nhap":
        require "Views/pages/dang-nhap.php";
        break;

    case "dang-ky":
        require "Views/pages/dang-ky.php";
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