<?php

class ProductModel
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAll()
    {
        $sql = "
            SELECT products.*,
                   categories.name AS category_name
            FROM products
            LEFT JOIN categories
            ON products.category_id = categories.id
        ";

        $stmt = $this->conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $sql = "
            SELECT products.*,
                   categories.name AS category_name,
                   categories.slug AS category_slug
            FROM products
            LEFT JOIN categories
            ON products.category_id = categories.id
            WHERE products.id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByCategory($category)
    {
        $sql = "
            SELECT products.*,
                   categories.name AS category_name
            FROM products
            LEFT JOIN categories
            ON products.category_id = categories.id
            WHERE categories.id = ?
               OR categories.slug = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$category, $category]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFeaturedProducts()
    {
        $sql = "
            SELECT products.*,
                   categories.name AS category_name
            FROM products
            LEFT JOIN categories
            ON products.category_id = categories.id
            WHERE products.is_hot = 1
            LIMIT 6
        ";

        $stmt = $this->conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function search($keyword)
    {
        $keyword = "%$keyword%";

        $sql = "
        SELECT products.*,
               categories.name AS category_name
        FROM products
        LEFT JOIN categories
        ON products.category_id = categories.id
        WHERE products.name LIKE ?
    ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$keyword]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
