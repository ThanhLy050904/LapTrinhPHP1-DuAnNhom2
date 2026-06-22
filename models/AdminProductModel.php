<?php

class AdminProductModel
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    // Lấy tất cả sản phẩm
    public function getAll()
    {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                ORDER BY p.id DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tìm kiếm sản phẩm
    public function search($keyword)
    {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                WHERE p.name LIKE :keyword 
                OR p.description LIKE :keyword 
                OR p.slug LIKE :keyword
                ORDER BY p.id DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':keyword' => '%' . $keyword . '%']);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy sản phẩm theo ID
    public function getById($id)
    {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                WHERE p.id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Kiểm tra slug
    public function checkSlugExists($slug, $excludeId = null)
    {
        $sql = "SELECT COUNT(*) as count FROM products WHERE slug = :slug";
        $params = [':slug' => $slug];

        if ($excludeId) {
            $sql .= " AND id != :id";
            $params[':id'] = $excludeId;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }

    // Thêm sản phẩm
    public function insert($data)
    {
        $sql = "INSERT INTO products (
                    name, slug, price, old_price, description, 
                    category_id, image_main, is_sale, is_hot
                ) VALUES (
                    :name, :slug, :price, :old_price, :description,
                    :category_id, :image_main, :is_sale, :is_hot
                )";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':name' => $data['name'],
            ':slug' => $data['slug'],
            ':price' => $data['price'],
            ':old_price' => $data['old_price'],
            ':description' => $data['description'],
            ':category_id' => $data['category_id'],
            ':image_main' => $data['image_main'],
            ':is_sale' => $data['is_sale'],
            ':is_hot' => $data['is_hot']
        ]);
    }

    // Cập nhật sản phẩm
    public function update($id, $data)
    {
        $sql = "UPDATE products SET 
                    name = :name,
                    slug = :slug,
                    price = :price,
                    old_price = :old_price,
                    description = :description,
                    category_id = :category_id,
                    image_main = :image_main,
                    is_sale = :is_sale,
                    is_hot = :is_hot
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':name' => $data['name'],
            ':slug' => $data['slug'],
            ':price' => $data['price'],
            ':old_price' => $data['old_price'],
            ':description' => $data['description'],
            ':category_id' => $data['category_id'],
            ':image_main' => $data['image_main'],
            ':is_sale' => $data['is_sale'],
            ':is_hot' => $data['is_hot']
        ]);
    }

    // Xóa sản phẩm
    public function delete($id)
    {
        $sql = "DELETE FROM products WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([':id' => $id]);
    }
    // Đếm tổng số sản phẩm
    public function countProducts()
    {
        return $this->conn
            ->query("SELECT COUNT(*) FROM products")
            ->fetchColumn();
    }
}