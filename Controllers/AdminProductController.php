<?php


class AdminProductController
{
    private $productModel;
    private $categoryModel;

    public function __construct($pdo)
    {
        $this->productModel = new AdminProductModel($pdo);
        $this->categoryModel = new AdminCategoryModel($pdo);
    }

    // ================= LIST =================
    public function index()
    {
        $keyword = $_GET['q'] ?? '';
        $action = $_GET['action'] ?? '';
        $id = $_GET['id'] ?? null;

        // Lấy danh sách sản phẩm
        $adminProducts = $keyword
            ? $this->productModel->search($keyword)
            : $this->productModel->getAll();

        $adminCategories = $this->categoryModel->getAll();

        // Lấy thông tin sản phẩm để edit
        $productEdit = null;
        if ($action === 'edit' && $id) {
            $productEdit = $this->productModel->getById($id);
        }

        // INCLUDE VIEW
        require_once __DIR__ . '/../Views/admin/products.php';
    }

    // ================= CREATE =================
    public function store()
    {
        // Validate
        $errors = $this->validateProduct($_POST);
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header("Location: ?pages=admin&section=products&action=add");
            exit;
        }

        // Xử lý slug
        $slug = $this->slug(trim($_POST['name']));
        
        if ($this->productModel->checkSlugExists($slug)) {
            $_SESSION['errors'][] = "Slug đã tồn tại";
            header("Location: ?pages=admin&section=products&action=add");
            exit;
        }

        // Upload ảnh
        $imagePath = $this->uploadImage($_FILES['image']);

        $data = [
            'name' => trim($_POST['name']),
            'slug' => $slug,
            'price' => (float)$_POST['price'],
            'old_price' => !empty($_POST['old_price']) ? (float)$_POST['old_price'] : null,
            'description' => trim($_POST['description']),
            'category_id' => (int)$_POST['category_id'],
            'image_main' => $imagePath,
            'is_sale' => isset($_POST['is_sale']) ? 1 : 0,
            'is_hot' => isset($_POST['is_hot']) ? 1 : 0,
        ];

        if ($this->productModel->insert($data)) {
            $_SESSION['success'] = "Thêm sản phẩm thành công!";
        } else {
            $_SESSION['error'] = "Thêm sản phẩm thất bại!";
        }

        header("Location: ?pages=admin&section=products");
        exit;
    }

    // ================= UPDATE =================
    public function update($id)
    {
        // Validate
        $errors = $this->validateProduct($_POST);
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header("Location: ?pages=admin&section=products&action=edit&id=" . $id);
            exit;
        }

        $oldProduct = $this->productModel->getById($id);
        
        // Xử lý slug
        $slug = $this->slug(trim($_POST['name']));
        
        if ($this->productModel->checkSlugExists($slug, $id)) {
            $_SESSION['errors'][] = "Slug đã tồn tại";
            header("Location: ?pages=admin&section=products&action=edit&id=" . $id);
            exit;
        }

        // Xử lý ảnh
        $imagePath = $this->uploadImage($_FILES['image']);
        if (empty($imagePath)) {
            $imagePath = $_POST['old_image'] ?? $oldProduct['image_main'];
        } else {
            if (!empty($oldProduct['image_main']) && file_exists($oldProduct['image_main'])) {
                unlink($oldProduct['image_main']);
            }
        }

        $data = [
            'name' => trim($_POST['name']),
            'slug' => $slug,
            'price' => (float)$_POST['price'],
            'old_price' => !empty($_POST['old_price']) ? (float)$_POST['old_price'] : null,
            'description' => trim($_POST['description']),
            'category_id' => (int)$_POST['category_id'],
            'image_main' => $imagePath,
            'is_sale' => isset($_POST['is_sale']) ? 1 : 0,
            'is_hot' => isset($_POST['is_hot']) ? 1 : 0,
        ];

        if ($this->productModel->update($id, $data)) {
            $_SESSION['success'] = "Cập nhật sản phẩm thành công!";
        } else {
            $_SESSION['error'] = "Cập nhật sản phẩm thất bại!";
        }

        header("Location: ?pages=admin&section=products");
        exit;
    }

    // ================= DELETE =================
    public function delete($id)
    {
        $product = $this->productModel->getById($id);
        
        if ($this->productModel->delete($id)) {
            if (!empty($product['image_main']) && file_exists($product['image_main'])) {
                unlink($product['image_main']);
            }
            $_SESSION['success'] = "Xóa sản phẩm thành công!";
        } else {
            $_SESSION['error'] = "Xóa sản phẩm thất bại!";
        }

        header("Location: ?pages=admin&section=products");
        exit;
    }

    // ================= VALIDATION =================
    private function validateProduct($data)
    {
        $errors = [];

        if (empty(trim($data['name'] ?? ''))) {
            $errors[] = "Tên sản phẩm không được để trống";
        }

        if (empty($data['price']) || $data['price'] <= 0) {
            $errors[] = "Giá sản phẩm phải lớn hơn 0";
        }

        if (empty($data['category_id'])) {
            $errors[] = "Vui lòng chọn danh mục";
        }

        return $errors;
    }

    // ================= SLUG =================
    private function slug($text)
    {
        $text = strtolower($text);
        $text = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $text);
        $text = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $text);
        $text = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $text);
        $text = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $text);
        $text = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $text);
        $text = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $text);
        $text = preg_replace("/(đ)/", 'd', $text);
        $text = preg_replace('/[^a-z0-9-]/', '-', $text);
        $text = preg_replace('/-+/', '-', $text);
        return trim($text, '-');
    }

    // ================= UPLOAD =================
private function uploadImage($file)
{
    if (!empty($file['name']) && $file['error'] === UPLOAD_ERR_OK) {

        $allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/webp'
        ];

        if (!in_array($file['type'], $allowedTypes)) {
            $_SESSION['errors'][] = "Chỉ chấp nhận file JPG, PNG, GIF, WEBP";
            return null;
        }

        if ($file['size'] > 2 * 1024 * 1024) {
            $_SESSION['errors'][] = "File ảnh không được vượt quá 2MB";
            return null;
        }

        // Thư mục lưu ảnh
        $uploadDir = "Views/image/";

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = time() . "_" . uniqid() . "_" . basename($file['name']);

        $fullPath = $uploadDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $fullPath)) {

            // Lưu đường dẫn vào DB
            return $fullPath;
        }
    }

    return null;
}
}