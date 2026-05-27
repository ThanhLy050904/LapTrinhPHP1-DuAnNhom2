<?php
class CategoryController
{
    protected $categoryModel;
    protected $productModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        // ================= CATEGORY =================
        $categories = $this->categoryModel->getAll();

        // ================= CURRENT CATEGORY =================
        $current_category = $_GET['category'] ?? 'all';

        // ================= PRODUCTS =================
        if ($current_category === 'all') {
            $products = $this->productModel->getAll();
        } else {
            $products = $this->productModel->getByCategory($current_category);
        }


        require "Views/pages/danh-muc.php";
  
    }
}