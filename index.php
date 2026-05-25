<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// ================= MODELS =================
require_once "models/BaseModel.php";
require_once "models/ProductModel.php";
require_once "models/CategoryModel.php";

// ================= CONTROLLERS =================
require_once "controllers/HomeController.php";
require_once "controllers/ProductController.php";
require_once "controllers/CategoryController.php";

// ================= GET PAGE =================
$page = $_GET['pages'] ?? 'home';

// ================= ROUTER =================
switch ($page) {

    case "home":

        $controller =
        new HomeController();

        $controller->index();

        break;

    case "chi-tiet-san-pham":

        $controller =
        new ProductController();

        $controller->show();

        break;

    case "danh-muc":

        $controller =
        new CategoryController();

        $controller->index();

        break;

    case "gio-hang":

        require "Views/layouts/header.php";

        require "Views/pages/car.php";

        require "Views/layouts/footer.php";

        break;

    case "dang-nhap":

        require "Views/layouts/header.php";

        require "Views/pages/dang-nhap.php";

        require "Views/layouts/footer.php";

        break;

    case "dang-ky":

        require "Views/layouts/header.php";

        require "Views/pages/dang-ky.php";

        require "Views/layouts/footer.php";

        break;

    case "admin":

        require "Views/admin/dashboard.php";

        break;

    default:

        echo "<h1>404 NOT FOUND</h1>";

        break;
}