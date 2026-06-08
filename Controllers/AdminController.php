<?php

class AdminController
{
    public function index()
    {
        $section = $_GET['section'] ?? 'dashboard';

        // Load helpers and data
        require_once __DIR__ . '/../models/Database.php';
        require_once __DIR__ . '/../Views/admin/admin-data.php';

        $db = new Database();
        $pdo = $db->connect();

        // Handle POST actions (create/update)
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['admin_form'])) {
            $form = $_POST['admin_form'];

            if ($form === 'categories') {
                $id = $_POST['id'] ?? '';
                $name = trim($_POST['name'] ?? '');
                if ($name !== '') {
                    if (!empty($id)) {
                        $stmt = $pdo->prepare('UPDATE categories SET name = :name WHERE id = :id');
                        $stmt->execute(['name' => $name, 'id' => $id]);
                    } else {
                        $stmt = $pdo->prepare('INSERT INTO categories (name) VALUES (:name)');
                        $stmt->execute(['name' => $name]);
                    }
                }

            } elseif ($form === 'accounts') {
                $id = $_POST['id'] ?? '';
                $name = trim($_POST['name'] ?? '');
                $email = trim($_POST['email'] ?? '');
                $role = trim($_POST['role'] ?? 'user');
                $passwordInput = trim($_POST['password'] ?? '');
                if ($email !== '') {
                    if (!empty($id)) {
                        if ($passwordInput !== '') {
                            $password = password_hash($passwordInput, PASSWORD_DEFAULT);
                            $stmt = $pdo->prepare('UPDATE users SET full_name = :name, email = :email, role = :role, password = :password WHERE id = :id');
                            $stmt->execute(['name' => $name, 'email' => $email, 'role' => $role, 'password' => $password, 'id' => $id]);
                        } else {
                            $stmt = $pdo->prepare('UPDATE users SET full_name = :name, email = :email, role = :role WHERE id = :id');
                            $stmt->execute(['name' => $name, 'email' => $email, 'role' => $role, 'id' => $id]);
                        }
                        $_SESSION['admin_flash'] = 'Tài khoản đã được cập nhật.';
                    } else {
                        $password = $passwordInput !== '' ? password_hash($passwordInput, PASSWORD_DEFAULT) : password_hash('password123', PASSWORD_DEFAULT);
                        $stmt = $pdo->prepare('INSERT INTO users (full_name, email, password, role, created_at) VALUES (:name, :email, :password, :role, NOW())');
                        $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password, 'role' => $role]);
                        $_SESSION['admin_flash'] = 'Tài khoản đã được tạo thành công.';
                    }
                }

            } elseif ($form === 'orders') {
                $id = $_POST['id'] ?? '';
                $status = $_POST['status'] ?? '';
                $total = $_POST['total'] ?? null;
                $customer = trim($_POST['customer'] ?? '');
                if ($id !== '') {
                    $orderId = intval($id);
                    $params = ['status' => $status, 'id' => $orderId];
                    $sql = 'UPDATE orders SET status = :status';
                    if ($total !== null) {
                        $sql .= ', total_price = :total_price';
                        $params['total_price'] = intval($total);
                    }
                    $sql .= ' WHERE id = :id';
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute($params);

                    // update customer name if order linked to a user
                    if (!empty($customer)) {
                        $s = $pdo->prepare('SELECT user_id FROM orders WHERE id = :id LIMIT 1');
                        $s->execute(['id' => $orderId]);
                        $or = $s->fetch(PDO::FETCH_ASSOC);
                        if ($or && !empty($or['user_id'])) {
                            $u = $pdo->prepare('UPDATE users SET full_name = :name WHERE id = :id');
                            $u->execute(['name' => $customer, 'id' => $or['user_id']]);
                        }
                    }
                    $_SESSION['admin_flash'] = 'Cập nhật đơn hàng thành công.';
                }

            } elseif ($form === 'products') {
                $id = $_POST['id'] ?? '';
                $name = trim($_POST['name'] ?? '');
                $price = intval($_POST['price'] ?? 0);
                $old_price = intval($_POST['old_price'] ?? 0);
                $description = trim($_POST['description'] ?? '');
                $category_id = !empty($_POST['category_id']) ? intval($_POST['category_id']) : null;
                $is_sale = !empty($_POST['is_sale']) ? 1 : 0;
                $is_hot = !empty($_POST['is_hot']) ? 1 : 0;

                // Determine existing image (for update)
                $existingImage = null;
                if (!empty($id)) {
                    $s = $pdo->prepare('SELECT image_main FROM products WHERE id = :id');
                    $s->execute(['id' => $id]);
                    $r = $s->fetch(PDO::FETCH_ASSOC);
                    $existingImage = $r['image_main'] ?? null;
                }

                // Handle uploaded image
                $imageName = $existingImage;
                if (!empty($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
                    $orig = $_FILES['image']['name'];
                    $ext = pathinfo($orig, PATHINFO_EXTENSION);
                    $imageName = time() . '_' . bin2hex(random_bytes(6)) . ($ext ? '.' . $ext : '');
                    $destDir = __DIR__ . '/../Views/image/';
                    if (!is_dir($destDir)) mkdir($destDir, 0755, true);
                    move_uploaded_file($_FILES['image']['tmp_name'], $destDir . $imageName);
                }

                // generate slug
                $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));

                if (!empty($id)) {
                    $sql = 'UPDATE products SET name = :name, slug = :slug, price = :price, old_price = :old_price, description = :description, category_id = :category_id, is_sale = :is_sale, is_hot = :is_hot, image_main = :image_main WHERE id = :id';
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([
                        'name' => $name,
                        'slug' => $slug,
                        'price' => $price,
                        'old_price' => $old_price,
                        'description' => $description,
                        'category_id' => $category_id,
                        'is_sale' => $is_sale,
                        'is_hot' => $is_hot,
                        'image_main' => $imageName,
                        'id' => $id,
                    ]);
                } else {
                    $sql = 'INSERT INTO products (name, slug, price, old_price, description, category_id, is_sale, is_hot, image_main, created_at) VALUES (:name, :slug, :price, :old_price, :description, :category_id, :is_sale, :is_hot, :image_main, NOW())';
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([
                        'name' => $name,
                        'slug' => $slug,
                        'price' => $price,
                        'old_price' => $old_price,
                        'description' => $description,
                        'category_id' => $category_id,
                        'is_sale' => $is_sale,
                        'is_hot' => $is_hot,
                        'image_main' => $imageName,
                    ]);
                }
            }

            // After handling POST, redirect to avoid form resubmission
            $redirect = '?pages=admin' . (!empty($section) ? '&section=' . urlencode($section) : '');
            header('Location: ' . $redirect);
            exit;
        }

        // Handle GET lock/delete actions
        if (isset($_GET['action']) && in_array($_GET['action'], ['lock', 'delete'], true)) {
            $target = $section;
            if ($_GET['action'] === 'lock' && $target === 'accounts' && isset($_GET['id'])) {
                $userId = intval($_GET['id']);
                $stmt = $pdo->prepare('SELECT status FROM users WHERE id = :id LIMIT 1');
                $stmt->execute(['id' => $userId]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($user) {
                    $newStatus = ($user['status'] === 'locked') ? 'active' : 'locked';
                    $stmt = $pdo->prepare('UPDATE users SET status = :status WHERE id = :id');
                    $stmt->execute(['status' => $newStatus, 'id' => $userId]);
                    $_SESSION['admin_flash'] = $newStatus === 'locked' ? 'Tài khoản đã được khóa.' : 'Tài khoản đã được mở khóa.';
                }
            } elseif ($_GET['action'] === 'delete') {
                if ($target === 'products' && isset($_GET['id'])) {
                    $stmt = $pdo->prepare('DELETE FROM products WHERE id = :id');
                    $stmt->execute(['id' => intval($_GET['id'])]);
                    $_SESSION['admin_flash'] = 'Sản phẩm đã được xóa.';
                } elseif ($target === 'categories' && isset($_GET['id'])) {
                    $stmt = $pdo->prepare('DELETE FROM categories WHERE id = :id');
                    $stmt->execute(['id' => intval($_GET['id'])]);
                    $_SESSION['admin_flash'] = 'Danh mục đã được xóa.';
                } elseif ($target === 'accounts' && isset($_GET['id'])) {
                    $stmt = $pdo->prepare('DELETE FROM users WHERE id = :id');
                    $stmt->execute(['id' => intval($_GET['id'])]);
                    $_SESSION['admin_flash'] = 'Tài khoản đã được xóa.';
                } elseif ($target === 'orders' && (isset($_GET['id']) || isset($_GET['code']))) {
                    $orderId = isset($_GET['id']) ? intval($_GET['id']) : (is_numeric($_GET['code']) ? intval($_GET['code']) : null);
                    if ($orderId !== null) {
                        $stmt = $pdo->prepare('DELETE FROM orders WHERE id = :id');
                        $stmt->execute(['id' => $orderId]);
                        $_SESSION['admin_flash'] = 'Đơn hàng đã được xóa.';
                    }
                }
            }

            $redirect = '?pages=admin' . (!empty($section) ? '&section=' . urlencode($section) : '');
            header('Location: ' . $redirect);
            exit;
        }

        // Render the admin dashboard and section view.
        require_once __DIR__ . '/../Views/admin/dashboard.php';
    }
}
