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
    // ================= ADMIN FUNCTIONS =================

// Lấy tất cả user (admin)
public function getAllUsers()
{
    $sql = "SELECT * FROM users ORDER BY id DESC";
    return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

// Xóa user
public function deleteUser($id)
{
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([$id]);
}

// Cập nhật user (admin edit)
public function updateUser($id, $data)
{
    $sql = "
        UPDATE users
        SET full_name = :full_name,
            email = :email,
            phone = :phone,
            address = :address,
            role = :role,
            status = :status
        WHERE id = :id
    ";

    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([
        ':full_name' => $data['full_name'],
        ':email'     => $data['email'],
        ':phone'     => $data['phone'],
        ':address'   => $data['address'],
        ':role'      => $data['role'],
        ':status'    => $data['status'] ?? 'active',
        ':id'        => $id
    ]);
}

// Khóa / mở khóa user
public function toggleStatus($id)
{
    $user = $this->getUserById($id);

    $newStatus = ($user['status'] === 'locked') ? 'active' : 'locked';

    $sql = "UPDATE users SET status = ? WHERE id = ?";
    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([$newStatus, $id]);
}

// ================= ADMIN FUNCTIONS =================

// Lấy tất cả user
public function getAll()
{
    $sql = "SELECT * FROM users ORDER BY id DESC";
    return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

// Tạo user (admin add)
public function insert($data)
{
    $sql = "INSERT INTO users(full_name, email, password, role, created_at)
            VALUES(?,?,?,?,NOW())";

    $stmt = $this->conn->prepare($sql);

    $password = password_hash($data['password'], PASSWORD_DEFAULT);

    return $stmt->execute([
        $data['name'],
        $data['email'],
        $password,
        $data['role']
    ]);
}

// Update user
public function update($id, $data)
{
    $sql = "UPDATE users 
            SET full_name = ?, email = ?, role = ?, status = ?
            WHERE id = ?";

    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([
        $data['name'],
        $data['email'],
        $data['role'],
        $data['status'] ?? 'active',
        $id
    ]);
}

// Delete user
public function delete($id)
{
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([$id]);
}

// Lock / unlock
public function toggleLock($id)
{
    $user = $this->getUserById($id);

    $new = ($user['status'] ?? 'active') === 'locked' ? 'active' : 'locked';

    $sql = "UPDATE users SET status = ? WHERE id = ?";
    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([$new, $id]);
}
}