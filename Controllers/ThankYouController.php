<?php

class ThankYouController
{
    public function index()
    {
        session_start();

        $order = $_SESSION['order'] ?? null;

        require "Views/pages/thank-you.php";
    }
}