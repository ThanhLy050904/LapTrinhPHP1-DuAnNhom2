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

        $result =
        $this->conn->query($sql);

        return
        $result->fetch_all(MYSQLI_ASSOC);
    }

    // FIND PRODUCT
    public function find($id)
    {
        $sql = "
            SELECT products.*,
                   categories.name AS category_name
            FROM products

            LEFT JOIN categories
            ON products.category_id = categories.id

            WHERE products.id = $id
        ";

        $result =
        $this->conn->query($sql);

        return
        $result->fetch_assoc();
    }

    // COLORS
    public function getColors($product_id)
    {
        $sql = "
            SELECT *
            FROM product_colors
            WHERE product_id = $product_id
        ";

        $result =
        $this->conn->query($sql);

        return
        $result->fetch_all(MYSQLI_ASSOC);
    }

    // FILTER CATEGORY
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

        $result =
        $this->conn->query($sql);

        return
        $result->fetch_all(MYSQLI_ASSOC);
    }
}