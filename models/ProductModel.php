<?php

class ProductModel
{
    private $conn;

    public function __construct($pdo)
    {
        $this->conn = $pdo;
    }

    // ================= CLIENT =================

    public function getAll()
    {
        $sql = "
            SELECT products.*,
                   categories.name AS category_name
            FROM products
            LEFT JOIN categories
            ON products.category_id = categories.id
        ";

        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
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

    public function search($keyword)
    {
        $sql = "
            SELECT products.*,
                   categories.name AS category_name
            FROM products
            LEFT JOIN categories
            ON products.category_id = categories.id
            WHERE products.name LIKE ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["%$keyword%"]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllPaginated($limit, $offset)
    {
        $sql = "
            SELECT products.*,
                   categories.name AS category_name
            FROM products
            LEFT JOIN categories
            ON products.category_id = categories.id
            LIMIT ? OFFSET ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(2, (int)$offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll()
    {
        return $this->conn->query("SELECT COUNT(*) FROM products")->fetchColumn();
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
            ORDER BY products.id DESC
            LIMIT 8
        ";

        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // ================= ADMIN (CRUD) =================

    public function insert($data)
    {
        $sql = "
            INSERT INTO products
            (name, price, description, category_id, image, is_sale, is_hot)
            VALUES
            (:name, :price, :description, :category_id, :image, :is_sale, :is_hot)
        ";

        return $this->conn->prepare($sql)->execute($data);
    }

    public function update($id, $data)
    {
        $data['id'] = $id;

        $sql = "
            UPDATE products SET
                name = :name,
                price = :price,
                description = :description,
                category_id = :category_id,
                image = :image,
                is_sale = :is_sale,
                is_hot = :is_hot
            WHERE id = :id
        ";

        return $this->conn->prepare($sql)->execute($data);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }
}