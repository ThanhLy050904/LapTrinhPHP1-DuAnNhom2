<?php
$adminAction = $_GET['action'] ?? '';
$accountEdit = null;
if ($adminAction === 'edit' && isset($_GET['id'])) {
    foreach ($adminAccounts as $account) {
        if (intval($account['id']) === intval($_GET['id'])) {
            $accountEdit = $account;
            break;
        }
    }
}
?>

<div class="admin-card">
    <div class="page-header">
        <div>
            <h2 class="page-title">Quản lý tài khoản</h2>
            <p class="page-subtitle">Xem và quản lý các thành viên hệ thống.</p>
        </div>
        <div class="page-actions">
            <form class="search-box" action="?pages=admin&section=accounts" method="get">
                <input type="hidden" name="pages" value="admin">
                <input type="hidden" name="section" value="accounts">
                <input type="text" name="q" placeholder="Tìm kiếm tài khoản...">
                <button type="submit">Tìm</button>
            </form>
            <a class="btn-primary" href="?pages=admin&section=accounts&action=add">+ Thêm tài khoản</a>
        </div>
    </div>

    <?php if ($adminAction === 'add' || $adminAction === 'edit'): ?>
        <div class="admin-form-card">
            <h3><?= $adminAction === 'edit' ? 'Chỉnh sửa tài khoản' : 'Thêm tài khoản mới' ?></h3>
            <form method="post">
                <input type="hidden" name="admin_form" value="accounts">
                <input type="hidden" name="id" value="<?= $accountEdit['id'] ?? '' ?>">
                <div class="form-grid">
                    <input class="form-control" name="name" placeholder="Tên người dùng" value="<?= htmlspecialchars($accountEdit['name'] ?? '', ENT_QUOTES) ?>" required>
                    <input class="form-control" name="email" type="email" placeholder="Email" value="<?= htmlspecialchars($accountEdit['email'] ?? '', ENT_QUOTES) ?>" required>
                    <input class="form-control span-full" name="role" placeholder="Vai trò" value="<?= htmlspecialchars($accountEdit['role'] ?? '', ENT_QUOTES) ?>" required>
                </div>
                <div class="form-actions">
                    <button class="btn-primary" type="submit">Lưu</button>
                    <a class="btn-secondary" href="?pages=admin&section=accounts">Hủy</a>
                </div>
            </form>
        </div>
    <?php endif; ?>

    <table class="table-admin">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Vai trò</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($adminAccounts)): ?>
                <?php foreach ($adminAccounts as $account): ?>
                    <tr>
                        <td><?= $account['id'] ?></td>
                        <td><?= htmlspecialchars($account['name'], ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($account['email'], ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($account['role'], ENT_QUOTES) ?></td>
                        <td>
                            <a class="btn-secondary" href="?pages=admin&section=accounts&action=edit&id=<?= $account['id'] ?>">Sửa</a>
                            <a class="btn-danger" href="?pages=admin&section=accounts&action=delete&id=<?= $account['id'] ?>">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Chưa có dữ liệu</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
