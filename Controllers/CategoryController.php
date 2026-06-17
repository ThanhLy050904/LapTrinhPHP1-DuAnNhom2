<?php

class CategoryController
{
    protected $categoryModel;
    protected $productModel;

    public function __construct($pdo)
    {
        $this->categoryModel = new CategoryModel($pdo);
        $this->productModel = new ProductModel($pdo);
    }

    public function index()
    {
        $categories = $this->categoryModel->getAll();

        $current_category = $_GET['category'] ?? 'all';

        if ($current_category === 'all') {
            $products = $this->productModel->getAll();
        } else {
            $products = $this->productModel->getByCategory($current_category);
        }

        require "Views/pages/danh-muc.php";
    }
}