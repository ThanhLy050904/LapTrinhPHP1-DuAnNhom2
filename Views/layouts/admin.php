<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <!-- CSS chính -->
    <link rel="stylesheet" href="/Views/css/admin.css">
</head>
<body>

<style>
    .admin-wrapper {
        display: flex;
        min-height: 100vh;
        background: #f4f6fb;
    }

    /* SIDEBAR */
    .sidebar {
        width: 250px;
        position: fixed;
        left: 0;
        top: 0;
        bottom: 0;
        background: #fff;
        box-shadow: 2px 0 10px rgba(0,0,0,0.05);
        z-index: 1000;
    }

    /* MAIN CONTENT - ĐÃ SỬA FULL WIDTH */
    .main-content {
        margin-left: 250px;
        width: calc(100% - 250px);
        padding: 24px 32px;           /* Giảm padding cho rộng hơn */
        background: #f4f6fb;
        min-height: 100vh;
    }

    /* Fix thêm cho các nội dung bên trong */
    .admin-center,
    .admin-box,
    .admin-card {
        width: 100% !important;
        max-width: none !important;
        margin: 0;
    }
</style>

<div class="admin-wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <?php include __DIR__ . '/../admin/sidebar.php'; ?>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">
        <?php echo $content ?? ''; ?>
    </main>

</div>

</body>
</html>