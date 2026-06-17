<?php


class AdminProductController
{
    private $productModel;
    private $categoryModel;

    public function __construct($pdo)
    {
        $this->productModel = new ProductModel($pdo);
        $this->categoryModel = new CategoryModel($pdo);
    }

    // ================= LIST =================
    public function index()
    {
        $keyword = $_GET['q'] ?? '';

        $adminProducts = $keyword
            ? $this->productModel->search($keyword)
            : $this->productModel->getAll();

        $adminCategories = $this->categoryModel->getAll();

        // CHỈ INCLUDE VIEW (KHÔNG layout)
        require __DIR__ . '/../Views/admin/products.php';
    }

    // ================= CREATE =================
    public function store()
    {
        $data = [
            'name' => $_POST['name'],
            'slug' => $this->slug($_POST['name']),
            'price' => $_POST['price'],
            'old_price' => $_POST['old_price'] ?? null,
            'description' => $_POST['description'],
            'category_id' => $_POST['category_id'],
            'image_main' => $this->uploadImage(),
            'is_sale' => isset($_POST['is_sale']) ? 1 : 0,
            'is_hot' => isset($_POST['is_hot']) ? 1 : 0,
        ];

        $this->productModel->insert($data);

        header("Location: ?pages=admin&section=products");
        exit;
    }

    // ================= UPDATE =================
    public function update($id)
    {
        $data = [
            'name' => $_POST['name'],
            'slug' => $this->slug($_POST['name']),
            'price' => $_POST['price'],
            'old_price' => $_POST['old_price'] ?? null,
            'description' => $_POST['description'],
            'category_id' => $_POST['category_id'],
            'image_main' => $this->uploadImage(),
            'is_sale' => isset($_POST['is_sale']) ? 1 : 0,
            'is_hot' => isset($_POST['is_hot']) ? 1 : 0,
        ];

        $this->productModel->update($id, $data);

        header("Location: ?pages=admin&section=products");
        exit;
    }

    // ================= DELETE =================
    public function delete($id)
    {
        $this->productModel->delete($id);

        header("Location: ?pages=admin&section=products");
        exit;
    }

    // ================= SLUG =================
    private function slug($text)
    {
        $text = strtolower($text);
        $text = preg_replace('/[^a-z0-9]+/', '-', $text);
        return trim($text, '-');
    }

    // ================= UPLOAD =================
    private function uploadImage()
    {
        if (!empty($_FILES['image']['name'])) {

            $fileName = time() . '_' . $_FILES['image']['name'];
            $path = "Views/image/" . $fileName;

            move_uploaded_file($_FILES['image']['tmp_name'], $path);

            return $path;
        }

        return $_POST['old_image'] ?? null;
    }
}