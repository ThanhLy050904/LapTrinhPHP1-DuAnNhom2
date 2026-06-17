<?php

class ProductController
{
    protected $productModel;
    protected $categoryModel;

    public function __construct($pdo)
    {
        $this->productModel = new ProductModel($pdo);
        $this->categoryModel = new CategoryModel($pdo);
    }

    public function category()
    {
        $categories = $this->categoryModel->getAll();

        $current_category = $_GET['category'] ?? 'all';

        // ===== PHÂN TRANG =====
        $limit = 8;
        $page = isset($_GET['page_number']) ? (int)$_GET['page_number'] : 1;
        if ($page < 1) $page = 1;

        $offset = ($page - 1) * $limit;

        // ===== SEARCH =====
        if (!empty($_GET['keyword'])) {

            $keyword = trim($_GET['keyword']);

            $allProducts = $this->productModel->search($keyword);

        } else {

            if ($current_category == 'all') {
                $allProducts = $this->productModel->getAll();
            } else {
                $allProducts = $this->productModel->getByCategory($current_category);
            }
        }

        // ===== TỔNG SỐ =====
        $totalProducts = count($allProducts);
        $totalPages = ceil($totalProducts / $limit);

        // ===== CẮT DATA THEO PAGE =====
        $products = array_slice($allProducts, $offset, $limit);

        require "Views/pages/danh-muc.php";
    }

    public function show()
    {
        $id = $_GET['id'] ?? 0;

        $product = $this->productModel->find($id);

        $relatedProducts = [];

        if ($product) {
            $relatedProducts = $this->productModel->getByCategory(
                $product['category_slug']
            );
        }

        require "Views/pages/chi-tiet-san-pham.php";
    }
}