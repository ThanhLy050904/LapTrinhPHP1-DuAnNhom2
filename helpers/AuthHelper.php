<?php

function isLoggedIn()
{
    return isset($_SESSION['user']);
}

function isAdmin()
{
    return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
}

function requireLogin()
{
    if (!isLoggedIn()) {
        header("Location: ?pages=dang-nhap");
        exit();
    }
}

function requireAdmin()
{
    if (!isAdmin()) {
        die("403 - Bạn không có quyền truy cập!");
    }
}