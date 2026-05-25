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

        // COLORS
        $colors =
            $this->productModel->getColors($id);

        // VIEW
        require "Views/layouts/header.php";

        require "Views/pages/chi-tiet-san-pham.php";

        require "Views/layouts/footer.php";
    }
}
