<?php

class AuthController
{
    private $userModel;

    public function __construct($pdo)
    {
        $this->userModel = new UserModel($pdo);
    }

    public function register()
    {
        $userModel = $this->userModel;
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $fullname = trim($_POST['fullname'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            $phone = trim($_POST['phone'] ?? '');
            $address = trim($_POST['address'] ?? '');

            if (empty($fullname)) {
                $errors['fullname'] = "Vui lòng nhập họ tên.";
            }

            if (empty($email)) {
                $errors['email'] = "Vui lòng nhập email.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Email không hợp lệ.";
            } elseif ($userModel->isEmailExists($email)) {
                $errors['email'] = "Email đã tồn tại.";
            }

            if (empty($password)) {
                $errors['password'] = "Vui lòng nhập mật khẩu.";
            } elseif (strlen($password) < 6) {
                $errors['password'] = "Mật khẩu phải từ 6 ký tự trở lên.";
            }

            if ($password !== $confirmPassword) {
                $errors['confirm_password'] = "Mật khẩu xác nhận không khớp.";
            }

            if (empty($phone)) {
                $errors['phone'] = "Vui lòng nhập số điện thoại.";
            }

            if (empty($address)) {
                $errors['address'] = "Vui lòng nhập địa chỉ.";
            }

            $avatar = 'uploads/avatar/default.png';

            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {

                $uploadDir = 'uploads/avatar/';

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $extension = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                if (in_array($extension, $allowed)) {

                    $fileName = time() . '_' . uniqid() . '.' . $extension;
                    $targetFile = $uploadDir . $fileName;

                    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetFile)) {
                        $avatar = $targetFile;
                    }
                }
            }

            if (empty($errors)) {

                $result = $userModel->register(
                    $fullname,
                    $email,
                    $password,
                    $phone,
                    $address,
                    $avatar
                );

                if ($result) {
                    header("Location: ?pages=dang-nhap");
                    exit();
                } else {
                    $errors['register'] = "Đăng ký thất bại.";
                }
            }
        }

        require "Views/pages/dang-ky.php";
    }

    public function login()
    {
        $userModel = $this->userModel;
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($email)) {
                $errors['email'] = "Vui lòng nhập email.";
            }

            if (empty($password)) {
                $errors['password'] = "Vui lòng nhập mật khẩu.";
            }

            if (empty($errors)) {

                $user = $userModel->getUserByEmail($email);

                if ($user && isset($user['status']) && $user['status'] === 'locked') {
                    $errors['login'] = "Tài khoản đang bị khóa.";
                } elseif ($user && password_verify($password, $user['password'])) {

                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'full_name' => $user['full_name'],
                        'email' => $user['email'],
                        'role' => $user['role'],
                        'avatar' => $user['avatar']
                    ];

                    header("Location: ?pages=home");
                    exit();
                } else {
                    $errors['login'] = "Email hoặc mật khẩu không chính xác.";
                }
            }
        }

        require "Views/pages/dang-nhap.php";
    }

    public function forgotPassword()
    {
        $userModel = $this->userModel;
      
    }

    public function resetPassword()
    {
        $userModel = $this->userModel;
   
    }

    public function showLoginForm()
    {
        require "Views/pages/dang-nhap.php";
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        header("Location: ?pages=home");
        exit();
    }
}
