<?php

class AccountController
{
    private $userModel;

    public function __construct($pdo)
    {
        $this->userModel = new UserModel($pdo);
    }

    public function profile()
    {
        if (!isset($_SESSION['user'])) {

            header("Location: ?pages=dang-nhap");
            exit();
        }

        $userModel = $this->userModel;

        // Đổi avatar
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST' &&
            isset($_FILES['avatar']) &&
            $_FILES['avatar']['error'] === 0
        ) {

            $uploadDir = 'uploads/avatar/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $extension = strtolower(
                pathinfo(
                    $_FILES['avatar']['name'],
                    PATHINFO_EXTENSION
                )
            );

            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            if (in_array($extension, $allowed)) {

                $fileName =
                    time() . '_' . uniqid() . '.' . $extension;

                $avatarPath =
                    $uploadDir . $fileName;

                if (
                    move_uploaded_file(
                        $_FILES['avatar']['tmp_name'],
                        $avatarPath
                    )
                ) {

                    $userModel->updateAvatar(
                        $_SESSION['user']['id'],
                        $avatarPath
                    );

                    $_SESSION['user']['avatar'] =
                        $avatarPath;
                }
            }

            header("Location: ?pages=tai-khoan-cua-toi");
            exit();
        }

        $user = $userModel->getUserById(
            $_SESSION['user']['id']
        );

        require "Views/pages/tai-khoan-cua-toi.php";
    }

    public function changeAvatar()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: ?pages=dang-nhap");
            exit();
        }

        $userModel = $this->userModel;

        if (
            isset($_FILES['avatar']) &&
            $_FILES['avatar']['error'] === 0
        ) {

            $uploadDir = 'uploads/avatar/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $extension = strtolower(
                pathinfo(
                    $_FILES['avatar']['name'],
                    PATHINFO_EXTENSION
                )
            );

            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            if (in_array($extension, $allowed)) {

                $fileName =
                    time() . '_' . uniqid() . '.' . $extension;

                $avatarPath =
                    $uploadDir . $fileName;

                if (
                    move_uploaded_file(
                        $_FILES['avatar']['tmp_name'],
                        $avatarPath
                    )
                ) {

                    $userModel->updateAvatar(
                        $_SESSION['user']['id'],
                        $avatarPath
                    );

                    $_SESSION['user']['avatar'] =
                        $avatarPath;
                }
            }
        }

        header("Location: ?pages=tai-khoan-cua-toi");
        exit();
    }
}