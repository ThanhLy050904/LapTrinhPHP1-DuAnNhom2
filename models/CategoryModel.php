<?php

class CategoryModel
{
    private $conn;

    public function __construct($pdo)
    {
        $this->conn = $pdo;
    }

    // ================= GET ALL =================
    public function getAll()
    {
        $sql = "SELECT * FROM categories ORDER BY id DESC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // ================= SEARCH =================
    public function search($keyword)
    {
        $sql = "SELECT * FROM categories WHERE name LIKE ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["%$keyword%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ================= FIND ONE =================
    public function find($id)
    {
        $sql = "SELECT * FROM categories WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ================= INSERT =================
    public function insert($data)
    {
        $sql = "INSERT INTO categories (name, slug)
                VALUES (:name, :slug)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }

    // ================= UPDATE =================
    public function update($id, $data)
    {
        $sql = "UPDATE categories 
                SET name = :name,
                    slug = :slug
                WHERE id = :id";

        $data['id'] = $id;

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }

    // ================= DELETE =================
    public function delete($id)
    {
        $sql = "DELETE FROM categories WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
    }
}