<?php

require_once __DIR__ . '/../models/CategoryModel.php';

class AdminCategoryController
{
    private $categoryModel;

    public function __construct($pdo)
    {
        $this->categoryModel = new CategoryModel($pdo);
    }

    // ================= LIST =================
    public function index()
    {
        $keyword = $_GET['q'] ?? '';

        if ($keyword) {
            $adminCategories = $this->categoryModel->search($keyword);
        } else {
            $adminCategories = $this->categoryModel->getAll();
        }

        require __DIR__ . '/../Views/admin/categories.php';
    }

    // ================= CREATE =================
    public function store()
    {
        $data = [
            'name' => $_POST['name'],
            'slug' => $this->slug($_POST['name'])
        ];

        $this->categoryModel->insert($data);

        header("Location: ?pages=admin&section=categories");
        exit;
    }

    // ================= UPDATE =================
    public function update($id)
    {
        $data = [
            'name' => $_POST['name'],
            'slug' => $this->slug($_POST['name'])
        ];

        $this->categoryModel->update($id, $data);

        header("Location: ?pages=admin&section=categories");
        exit;
    }

    // ================= DELETE =================
    public function delete($id)
    {
        $this->categoryModel->delete($id);

        header("Location: ?pages=admin&section=categories");
        exit;
    }

    // ================= SLUG =================
    private function slug($text)
    {
        $text = strtolower($text);
        $text = preg_replace('/[^a-z0-9]+/', '-', $text);
        return trim($text, '-');
    }
}