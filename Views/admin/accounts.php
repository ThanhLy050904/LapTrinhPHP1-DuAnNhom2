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

<?php
$filterVisible = !empty($_GET['q']) || !empty($_GET['role']) || !empty($_GET['status']) || !empty($_GET['date_from']) || !empty($_GET['date_to']);
?>

<div class="admin-card">
    <div class="page-header">
        <div>
            <h2 class="page-title">Quản lý tài khoản</h2>
            <p class="page-subtitle">Xem và quản lý các thành viên hệ thống.</p>
        </div>
        <div class="page-actions">
            <button type="button" class="btn-secondary" id="toggle-account-filter"><?= $filterVisible ? 'Ẩn bộ lọc' : 'Bộ lọc' ?></button>
            <a class="btn-primary" href="?pages=admin&section=accounts&action=add">+ Thêm tài khoản</a>
        </div>
    </div>

    <form class="account-filter-form" action="?pages=admin&section=accounts" method="get" id="account-search-form">
        <input type="hidden" name="pages" value="admin">
        <input type="hidden" name="section" value="accounts">

        <div id="account-filter-panel" class="panel account-filter-panel<?= $filterVisible ? ' active' : '' ?>">
            <div class="account-filter-grid">
                <input id="account-search" class="admin-form-input search-field" type="text" name="q" placeholder="Gõ để lọc theo tên, email, vai trò..." value="<?= htmlspecialchars($_GET['q'] ?? '', ENT_QUOTES) ?>">
                <select class="admin-form-select" name="role">
                    <option value="">Tất cả vai trò</option>
                    <option value="admin" <?= (isset($_GET['role']) && $_GET['role'] === 'admin') ? 'selected' : '' ?>>Admin</option>
                    <option value="user" <?= (isset($_GET['role']) && $_GET['role'] === 'user') ? 'selected' : '' ?>>Khách hàng</option>
                </select>
                <select class="admin-form-select" name="status">
                    <option value="">Tất cả trạng thái</option>
                    <option value="active" <?= (isset($_GET['status']) && $_GET['status'] === 'active') ? 'selected' : '' ?>>Hoạt động</option>
                    <option value="locked" <?= (isset($_GET['status']) && $_GET['status'] === 'locked') ? 'selected' : '' ?>>Khóa</option>
                </select>
                <input class="admin-form-input" type="date" name="date_from" value="<?= htmlspecialchars($_GET['date_from'] ?? '', ENT_QUOTES) ?>" placeholder="Từ ngày">
                <input class="admin-form-input" type="date" name="date_to" value="<?= htmlspecialchars($_GET['date_to'] ?? '', ENT_QUOTES) ?>" placeholder="Đến ngày">
                <select class="admin-form-select" name="sort">
                    <option value="newest" <?= (!isset($_GET['sort']) || $_GET['sort'] === 'newest') ? 'selected' : '' ?>>Mới nhất</option>
                    <option value="oldest" <?= (isset($_GET['sort']) && $_GET['sort'] === 'oldest') ? 'selected' : '' ?>>Cũ nhất</option>
                </select>
                <div class="filter-actions">
                    <button class="btn-primary" type="submit">Lọc</button>
                    <a class="btn-secondary" href="?pages=admin&section=accounts">Xóa lọc</a>
                </div>
            </div>
        </div>
    </form>

    <?php if (!empty($_SESSION['admin_flash'])): ?>
        <div class="admin-card" style="margin-bottom:12px; padding:12px; background:#eef6ff; border-left:4px solid #3b82f6;">
            <?= htmlspecialchars($_SESSION['admin_flash'], ENT_QUOTES) ?>
        </div>
        <?php unset($_SESSION['admin_flash']); ?>
    <?php endif; ?>

    <?php if ($adminAction === 'add' || $adminAction === 'edit'): ?>
<<<<<<< HEAD
        <div class="admin-card admin-form-card">
            <div class="admin-form-header">
                <div>
                    <h3 class="admin-form-heading"><?= $adminAction === 'edit' ? 'Chỉnh sửa tài khoản' : 'Thêm tài khoản mới' ?></h3>
                    <p class="admin-form-subtitle">Điền thông tin tài khoản và chọn vai trò để quản lý quyền truy cập.</p>
                </div>
            </div>
            <form method="post" class="admin-form-body">
                <input type="hidden" name="admin_form" value="accounts">
                <input type="hidden" name="id" value="<?= $accountEdit['id'] ?? '' ?>">
                <div class="admin-form-grid">
                    <input class="admin-form-input" name="name" placeholder="Tên người dùng" value="<?= htmlspecialchars($accountEdit['name'] ?? '', ENT_QUOTES) ?>" required>
                    <input class="admin-form-input" name="email" type="email" placeholder="Email" value="<?= htmlspecialchars($accountEdit['email'] ?? '', ENT_QUOTES) ?>" required>
                    <select class="admin-form-select" name="role" required>
                        <option value="user" <?= (($accountEdit['role'] ?? 'user') === 'user') ? 'selected' : '' ?>>User</option>
                        <option value="admin" <?= ($accountEdit['role'] ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
                    </select>
                    <div>
                        <input class="admin-form-input" name="password" type="password" placeholder="<?= $adminAction === 'edit' ? 'Để trống nếu không đổi mật khẩu' : 'Mật khẩu' ?>" <?= $adminAction === 'add' ? 'required' : '' ?> autocomplete="new-password">
                        <?php if ($adminAction === 'edit'): ?>
                            <p class="admin-form-note">Để trống nếu không muốn thay đổi mật khẩu.</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="admin-form-actions">
=======
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
>>>>>>> 5e65d85fd2d5d5ccb45e481e044a54de37b3ec9e
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
                <th>Trạng thái</th>
                <th>Ngày đăng ký</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($adminAccounts)): ?>
                <?php foreach ($adminAccounts as $account): ?>
                    <tr class="account-row" data-search="<?= htmlspecialchars($account['id'] . ' ' . $account['name'] . ' ' . $account['email'] . ' ' . $account['role'] . ' ' . $account['status'], ENT_QUOTES) ?>">
                        <td><?= $account['id'] ?></td>
                        <td><?= htmlspecialchars($account['name'], ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($account['email'], ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($account['role'], ENT_QUOTES) ?></td>
                        <td>
                            <span class="badge <?= ($account['status'] ?? 'active') === 'locked' ? 'danger' : 'success' ?>"><?= ($account['status'] ?? 'active') === 'locked' ? 'Khóa' : 'Hoạt động' ?></span>
                        </td>
                        <td><?= !empty($account['created_at']) ? date('d/m/Y', strtotime($account['created_at'])) : '' ?></td>
                        <td>
                            <a class="btn-secondary" href="?pages=admin&section=accounts&action=edit&id=<?= $account['id'] ?>">Sửa</a>
<<<<<<< HEAD
                            <a class="btn-secondary" href="?pages=admin&section=accounts&action=lock&id=<?= $account['id'] ?>" onclick="return confirm('Xác nhận <?= ($account['status'] ?? 'active') === 'locked' ? 'mở khóa' : 'khóa' ?> tài khoản này?')"><?= ($account['status'] ?? 'active') === 'locked' ? 'Mở khóa' : 'Khóa' ?></a>
                            <a class="btn-danger" href="?pages=admin&section=accounts&action=delete&id=<?= $account['id'] ?>" onclick="return confirm('Xác nhận xóa tài khoản này?')">Xóa</a>
=======
                            <a class="btn-danger" href="?pages=admin&section=accounts&action=delete&id=<?= $account['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?');">Xóa</a>
>>>>>>> 5e65d85fd2d5d5ccb45e481e044a54de37b3ec9e
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr id="account-no-results" style="display:none;">
                    <td colspan="7" style="text-align:center; padding:24px; color:#475569;">Không tìm thấy tài khoản phù hợp.</td>
                </tr>
            <?php else: ?>
                <tr>
                    <td colspan="7">Chưa có dữ liệu</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <script>
        (function() {
            const toggleButton = document.getElementById('toggle-account-filter');
            const filterPanel = document.getElementById('account-filter-panel');

            if (!toggleButton || !filterPanel) return;

            toggleButton.addEventListener('click', function() {
                filterPanel.classList.toggle('active');
                if (filterPanel.classList.contains('active')) {
                    toggleButton.textContent = 'Ẩn bộ lọc';
                } else {
                    toggleButton.textContent = 'Lọc người dùng';
                }
            });
        })();
    </script>
</div>
