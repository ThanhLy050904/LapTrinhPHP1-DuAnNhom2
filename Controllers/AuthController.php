<?php
require_once "models/UserModel.php";

class AuthController {
    public function register() {
        $userModel = new UserModel();
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

    public function login() {
        $userModel = new UserModel();
        $errors = [];
        $loginError = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            if (empty($email)) $errors['email'] = "Vui lòng nhập email.";
            if (empty($password)) $errors['password'] = "Vui lòng nhập mật khẩu.";

            if (empty($errors)) {
                $user = $userModel->getUserByEmail($email);
                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user'] = $user;
                    header("Location: ?pages=home");
                    exit();
                } else {
                    $loginError = "Email hoặc mật khẩu không chính xác.";
                }
            }
        }
        require "Views/pages/dang-nhap.php";
    }
    public function showLoginForm() {
        require "Views/pages/dang-nhap.php";
    }
    public function logout() {
        session_destroy();
        header("Location: ?pages=home");
        exit();
    }
}