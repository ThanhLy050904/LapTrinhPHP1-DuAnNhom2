<?php

class AdminCategoryModel
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    // Lấy tất cả danh mục
    public function getAll()
    {
        $sql = "SELECT * FROM categories ORDER BY id DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tìm kiếm danh mục
    public function search($keyword)
    {
        $sql = "SELECT * FROM categories 
                WHERE name LIKE :keyword 
                OR slug LIKE :keyword 
                ORDER BY id DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':keyword' => '%' . $keyword . '%']);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy danh mục theo ID
    public function getById($id)
    {
        $sql = "SELECT * FROM categories WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Kiểm tra slug
    public function checkSlugExists($slug, $excludeId = null)
    {
        $sql = "SELECT COUNT(*) as count FROM categories WHERE slug = :slug";
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

    // Thêm danh mục
    public function insert($data)
    {
        $sql = "INSERT INTO categories (name, slug, description, status) 
                VALUES (:name, :slug, :description, :status)";
        
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':name' => $data['name'],
            ':slug' => $data['slug'],
            ':description' => $data['description'] ?? null,
            ':status' => $data['status'] ?? 1
        ]);
    }

    // Cập nhật danh mục
    public function update($id, $data)
    {
        $sql = "UPDATE categories SET 
                    name = :name,
                    slug = :slug,
                    description = :description,
                    status = :status
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':id' => $id,
            ':name' => $data['name'],
            ':slug' => $data['slug'],
            ':description' => $data['description'] ?? null,
            ':status' => $data['status'] ?? 1
        ]);
    }

    // Xóa danh mục
    public function delete($id)
    {
        $sql = "DELETE FROM categories WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([':id' => $id]);
    }

    // Đếm số sản phẩm trong danh mục
    public function countProducts($categoryId)
    {
        $sql = "SELECT COUNT(*) as total FROM products WHERE category_id = :category_id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':category_id' => $categoryId]);
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // Lấy danh mục theo slug
    public function getBySlug($slug)
    {
        $sql = "SELECT * FROM categories WHERE slug = :slug";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':slug' => $slug]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}