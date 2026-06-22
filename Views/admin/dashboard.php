<?php
$section = $_GET['section'] ?? 'dashboard';
?>

<link rel="stylesheet" href="Views/css/admin.css">

<div class="admin-wrapper">

	<div class="admin-main">
		<div class="admin-top">
			<h1>Admin Dashboard</h1>
			<div class="admin-actions">
				<!-- <a href="#">↻ Cập nhật</a>
				<a href="?pages=logout">⇦ Đăng xuất</a> -->
			</div>
		</div>

		<?php
		switch ($section) {
			case 'dashboard':
				?>
				<div class="dashboard-container">

					```
					<!-- HERO -->
					<div class="dashboard-hero">
						<div>
							<h2>Xin chào Admin 👋</h2>
							<p>Chào mừng quay lại hệ thống quản lý KENZIE</p>
						</div>

						<div class="today-box">
							<span><?= date('d/m/Y') ?></span>
						</div>
					</div>

					<!-- THỐNG KÊ -->
					<div class="dashboard-stats">

						<div class="dashboard-card blue">
							<div class="card-icon">
								<i class="fas fa-users"></i>
							</div>

							<div>
								<h3><?= $adminStats['users'] ?></h3>
								<p>Người dùng</p>
							</div>
						</div>

						<div class="dashboard-card purple">
							<div class="card-icon">
								<i class="fas fa-gem"></i>
							</div>

							<div>
								<h3><?= $adminStats['products'] ?></h3>
								<p>Sản phẩm</p>
							</div>
						</div>

						<div class="dashboard-card orange">
							<div class="card-icon">
								<i class="fas fa-shopping-bag"></i>
							</div>

							<div>
								<h3><?= $adminStats['orders'] ?></h3>
								<p>Đơn hàng</p>
							</div>
						</div>

						<div class="dashboard-card green">
							<div class="card-icon">
								<i class="fas fa-money-bill-wave"></i>
							</div>

							<div>
								<h3><?= number_format($adminStats['revenue']) ?> đ</h3>
								<p>Doanh thu</p>
							</div>
						</div>

					</div>

					<!-- NỘI DUNG -->
					<div class="dashboard-grid">

						<div class="dashboard-box">

							<h3>Tổng quan hệ thống</h3>

							<ul class="system-list">
								<li>✔ Tổng tài khoản: <?= $adminStats['users'] ?></li>
								<li>✔ Tổng sản phẩm: <?= $adminStats['products'] ?></li>
								<li>✔ Tổng đơn hàng: <?= $adminStats['orders'] ?></li>
								<li>✔ Doanh thu: <?= number_format($adminStats['revenue']) ?> đ</li>
							</ul>

						</div>

						<div class="dashboard-box">

							<h3>Trạng thái hoạt động</h3>

							<div class="progress-item">
								<span>Đơn hàng</span>
								<div class="progress">
									<div class="progress-bar" style="width:85%"></div>
								</div>
							</div>

							<div class="progress-item">
								<span>Sản phẩm</span>
								<div class="progress">
									<div class="progress-bar purple-bar" style="width:70%"></div>
								</div>
							</div>

						</div>

					</div>
					```

				</div>

				<?php
				break;

			case 'products':
				include __DIR__ . '/products.php';
				break;

			case 'orders':
				include __DIR__ . '/orders.php';
				break;

			case 'categories':
				include __DIR__ . '/categories.php';
				break;

			case 'accounts':
				include __DIR__ . '/accounts.php';
				break;

			default:
				echo '<div class="admin-card"><h3>Không tìm thấy mục</h3></div>';
				break;
		}
		?>
	</div>
</div>