<?php
require_once "BaseModel.php";

class UserModel extends BaseModel {
    private $conn;

    public function __construct() {
        // Gọi hàm connect() từ BaseModel để lấy đối tượng PDO
        $this->conn = $this->connect();
    }

    public function register($fullname, $email, $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (full_name, email, password) VALUES (:fullname, :email, :password)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':fullname' => $fullname,
            ':email'    => $email,
            ':password' => $hashed_password
        ]);
    }

    public function isEmailExists($email) {
        $sql = "SELECT id FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch() ? true : false;
    }
}