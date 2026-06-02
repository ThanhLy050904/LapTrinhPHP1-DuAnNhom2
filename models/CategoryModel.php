<?php

require_once __DIR__ . '/BaseModel.php';

class CategoryModel extends BaseModel
{
    public function getAll()
    {
        $conn = $this->connect();

        $sql = "SELECT * FROM categories";

        $stmt = $conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}