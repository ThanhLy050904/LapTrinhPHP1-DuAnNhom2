<?php

class ProductController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    // CHI TIẾT SẢN PHẨM
    public function show()
    {
        $id = $_GET['id'] ?? 0;

        // PRODUCT
        $product = $this->productModel->find($id);

        // RELATED PRODUCTS
        $relatedProducts = [];

        if ($product) {
            $relatedProducts =
                $this->productModel->getByCategory(
                    $product['category_slug']
                );
        }

        require "Views/pages/chi-tiet-san-pham.php";

    }
}