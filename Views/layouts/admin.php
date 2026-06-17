<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>

    <!-- FIX PATH CHUẨN -->
    <link rel="stylesheet" href="/Views/css/admin.css">
</head>
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
}

/* MAIN - KHÔNG DÍNH SIDEBAR */
.main-content {
    margin-left: 250px;   /* QUAN TRỌNG */
    width: calc(100% - 250px);

    display: flex;
    justify-content: center;  /* center dashboard */
    padding: 30px;
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