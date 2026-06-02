<?php

require_once __DIR__ . '/BaseModel.php';

class ProductModel extends BaseModel
{
    public function getAll()
    {
        $conn = $this->connect();

        $sql = "
            SELECT products.*,
                   categories.name AS category_name
            FROM products
            LEFT JOIN categories
            ON products.category_id = categories.id
        ";

        $stmt = $conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $conn = $this->connect();

        $sql = "
            SELECT products.*,
                   categories.name AS category_name,
                   categories.slug AS category_slug
            FROM products
            LEFT JOIN categories
            ON products.category_id = categories.id
            WHERE products.id = ?
        ";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByCategory($slug)
    {
        $conn = $this->connect();

        $sql = "
            SELECT products.*,
                   categories.name AS category_name
            FROM products
            JOIN categories
            ON products.category_id = categories.id
            WHERE categories.slug = ?
        ";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$slug]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFeaturedProducts()
    {
        $conn = $this->connect();

        $sql = "
            SELECT products.*,
                   categories.name AS category_name
            FROM products
            LEFT JOIN categories
            ON products.category_id = categories.id
            WHERE products.is_hot = 1
        ";

        $stmt = $conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}