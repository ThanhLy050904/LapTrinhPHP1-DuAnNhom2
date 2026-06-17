<?php

class UserModel
{
    private $conn;

    public function __construct($pdo)
    {
        $this->conn = $pdo;
    }

    public function register($fullname, $email, $password, $phone, $address, $avatar)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users
        (
            full_name,
            email,
            password,
            phone,
            address,
            avatar,
            role,
            created_at
        )
        VALUES
        (
            :fullname,
            :email,
            :password,
            :phone,
            :address,
            :avatar,
            'user',
            NOW()
        )";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':fullname' => $fullname,
            ':email'    => $email,
            ':password' => $hashedPassword,
            ':phone'    => $phone,
            ':address'  => $address,
            ':avatar'   => $avatar
        ]);
    }

    public function isEmailExists($email)
    {
        $sql = "SELECT id FROM users WHERE email = :email LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);

        return $stmt->fetch() ? true : false;
    }

    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByEmailOnly($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePasswordById($id, $password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE users SET password = :password WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':password' => $hash,
            ':id' => $id
        ]);
    }

    public function updateAvatar($id, $avatar)
    {
        $sql = "UPDATE users SET avatar = :avatar WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':avatar' => $avatar,
            ':id' => $id
        ]);
    }
}