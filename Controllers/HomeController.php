<?php

class HomeController {

    public function index()
    {
        require "Views/layouts/header.php";

        require "Views/pages/home.php";

        require "Views/layouts/footer.php";
    }
}