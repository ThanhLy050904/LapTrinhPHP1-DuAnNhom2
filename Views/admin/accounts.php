<?php
$adminAction = $_GET['action'] ?? '';
$accountEdit = null;

if ($adminAction === 'edit' && isset($_GET['id'])) {
    foreach ($adminAccounts as $account) {
        if ($account['id'] == $_GET['id']) {
            $accountEdit = $account;
            break;
        }
    }
}
?>

<!-- <style>
.admin-center {
    display:flex;
    justify-content:center;
    padding:30px;
}

.admin-box {
    width:100%;
    max-width:1100px;
}

.card {
    background:#fff;
    padding:20px;
    border-radius:16px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
}

.header {
    display:flex;
    justify-content:space-between;
    margin-bottom:20px;
}

.btn {
    padding:8px 12px;
    border-radius:8px;
    text-decoration:none;
}

.btn-primary { background:#3b82f6; color:#fff; }
.btn-danger { background:#ef4444; color:#fff; }
.btn-secondary { background:#e2e8f0; color:#111; }

table {
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
}

th {
    background:#f1f5f9;
    padding:12px;
}

td {
    padding:12px;
    border-top:1px solid #eee;
}

.form-grid {
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:10px;
    margin-bottom:10px;
}

input, select {
    padding:10px;
    border:1px solid #ddd;
    border-radius:8px;
}
</style> -->
<link rel="stylesheet" href="Views/css/admin.css">
<div class="admin-center">
    <div class="admin-box">
        <div class="card">

            <!-- HEADER -->
            <div class="header">
                <h2>Quản lý tài khoản</h2>
                <a class="btn btn-primary" href="?pages=admin&section=accounts&action=add">+ Thêm</a>
            </div>

            <!-- FORM -->
            <?php if ($adminAction === 'add' || $adminAction === 'edit'): ?>
                <form method="post">
                    <input type="hidden" name="admin_form" value="accounts">
                    <input type="hidden" name="id" value="<?= $accountEdit['id'] ?? '' ?>">

                    <div class="form-grid">
                        <input name="name" placeholder="Tên" value="<?= $accountEdit['full_name'] ?? '' ?>">

                        <input name="email" placeholder="Email" value="<?= $accountEdit['email'] ?? '' ?>">

                        <select name="role">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>

                        <input type="password" name="password" placeholder="Mật khẩu (khi thêm)">
                    </div>

                    <button class="btn btn-primary">Lưu</button>
                    <a class="btn btn-secondary" href="?pages=admin&section=accounts">Hủy</a>
                </form>
            <?php endif; ?>

            <!-- TABLE -->
            <table>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Trạng thái</th>
                    <th>Action</th>
                </tr>

                <?php foreach ($adminAccounts as $a): ?>
                    <tr>
                        <td>#<?= $a['id'] ?></td>
                        <td><?= $a['full_name'] ?></td>
                        <td><?= $a['email'] ?></td>
                        <td><?= $a['role'] ?></td>
                        <td class="<?= ($a['status'] ?? 'active') === 'active' ? 'status-active' : 'status-block' ?>">
                            <?= $a['status'] ?>
                        </td>
                        <td>
                            <a class="btn btn-secondary"
                                href="?pages=admin&section=accounts&action=edit&id=<?= $a['id'] ?>">
                                Sửa
                            </a>

                            <?php if (($a['status'] ?? 'active') === 'active'): ?>
                                <a class="btn btn-primary" href="?pages=admin&section=accounts&action=lock&id=<?= $a['id'] ?>">
                                    Lock
                                </a>
                            <?php else: ?>
                                <a class="btn btn-secondary"
                                    href="?pages=admin&section=accounts&action=lock&id=<?= $a['id'] ?>">
                                    Unlock
                                </a>
                            <?php endif; ?>

                            <a class="btn btn-danger" onclick="return confirm('Xóa?')"
                                href="?pages=admin&section=accounts&action=delete&id=<?= $a['id'] ?>">
                                Xóa
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</div>