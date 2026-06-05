<?php
require_once "models/UserModel.php";

class AuthController {
    public function register() {
        $userModel = new UserModel(); // Không cần tham số
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fullname = trim($_POST['fullname']);
            $email    = trim($_POST['email']);
            $password = $_POST['password'];
            $confirm  = $_POST['confirm_password'];


            if (empty($fullname)) $errors['fullname'] = "Vui lòng nhập họ tên.";
            if (empty($email)) $errors['email'] = "Vui lòng nhập email.";
            if ($userModel->isEmailExists($email)) $errors['email'] = "Email đã tồn tại.";
            if ($password !== $confirm) $errors['confirm_password'] = "Mật khẩu không khớp.";

            if (empty($errors)) {
                $userModel->register($fullname, $email, $password);
                header("Location: ?pages=dang-nhap");
                exit();
            }
        }
        require "Views/pages/dang-ky.php";
    }
    public function showLoginForm() {
        require "Views/pages/dang-nhap.php";
    }
}