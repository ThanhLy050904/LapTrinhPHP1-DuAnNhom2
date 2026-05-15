<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require "Views/layouts/header.php";

if(isset($_GET['pages']) && !empty($_GET['pages'])){

    switch($_GET['pages']){

        case "home":
            require "Views/pages/home.php";
            break;

        case "chi-tiet-san-pham":
            require "Views/pages/chi-tiet-san-pham.php";
            break;

        case "san-pham":
            require "Views/pages/san-pham.php";
            break;

        case "car":
            require "Views/pages/car.php";
            break;

        case "dang-nhap":
            require "Views/pages/dang-nhap.php";
            break;

        case "dang-ky":
            require "Views/pages/dang-ky.php";
            break;

        case "admin":
            require "Views/admin/dashboard.php";
            break;

        default:
            echo "404";
            break;
    }

}else{
    require "Views/pages/home.php";
}

require "Views/layouts/footer.php";
?>