<?php

class ProductController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    // DANH MỤC + TÌM KIẾM
    public function category()
    {
        $categoryModel = new CategoryModel();

        $categories = $categoryModel->getAll();

        $current_category = $_GET['category'] ?? 'all';

        // TÌM KIẾM
        if (!empty($_GET['keyword'])) {

            $keyword = trim($_GET['keyword']);

            $products = $this->productModel->search($keyword);
        } else {

            if ($current_category == 'all') {

                $products = $this->productModel->getAll();
            } else {

                $products = $this->productModel->getByCategory(
                    $current_category
                );
            }
        }

        require "Views/pages/danh-muc.php";
    }

    // CHI TIẾT SẢN PHẨM
    public function show()
    {
        $id = $_GET['id'] ?? 0;

        $product = $this->productModel->find($id);

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
