<?php

class ProductModel extends BaseModel {

    // ALL PRODUCTS
    public function getAll()
    {
        $sql = "
            SELECT products.*,
                   categories.name AS category_name
            FROM products
            LEFT JOIN categories
            ON products.category_id = categories.id
        ";

        $result = $this->conn->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // FIND PRODUCT + lấy slug category
    public function find($id)
    {
        $sql = "
            SELECT products.*,
                   categories.name AS category_name,
                   categories.slug AS category_slug
            FROM products
            LEFT JOIN categories
            ON products.category_id = categories.id
            WHERE products.id = $id
        ";

        $result = $this->conn->query($sql);

        return $result->fetch_assoc();
    }

    // SẢN PHẨM CÙNG DANH MỤC
    public function getByCategory($slug)
    {
        $sql = "
            SELECT products.*,
                   categories.name AS category_name
            FROM products
            JOIN categories
            ON products.category_id = categories.id
            WHERE categories.slug = '$slug'
        ";

        $result = $this->conn->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
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
    ";

    $result = $this->conn->query($sql);

    return $result->fetch_all(MYSQLI_ASSOC);
}
}