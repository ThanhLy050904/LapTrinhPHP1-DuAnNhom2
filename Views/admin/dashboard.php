<?php
$section = $_GET['section'] ?? 'dashboard';
include __DIR__ . '/admin-data.php';
?>

<link rel="stylesheet" href="Views/css/admin.css">

<div class="admin-wrapper">
	<?php include __DIR__ . '/sidebar.php'; ?>

	<div class="admin-main">
		<div class="admin-top">
			<h1>Admin Dashboard</h1>
			<div class="admin-actions">
				<a href="#">↻ Cập nhật</a>
				<a href="?pages=logout">⇦ Đăng xuất</a>
			</div>
		</div>

		<?php
		switch ($section) {
			case 'dashboard':
				?>
				<div class="panel">
					<div class="stats-row">
						<div class="stat-card">
							<div class="icon users"><i class="fas fa-user"></i></div>
							<div>
								<div class="value"><?= $adminStats['users'] ?></div>
								<div class="label">Người dùng</div>
							</div>
						</div>
						<div class="stat-card">
							<div class="icon products"><i class="fas fa-box"></i></div>
							<div>
								<div class="value"><?= $adminStats['products'] ?></div>
								<div class="label">Sản phẩm</div>
							</div>
						</div>
						<div class="stat-card">
							<div class="icon orders"><i class="fas fa-shopping-cart"></i></div>
							<div>
								<div class="value"><?= $adminStats['orders'] ?></div>
								<div class="label">Đơn hàng</div>
							</div>
						</div>
						<div class="stat-card">
							<div class="icon revenue"><i class="fas fa-dollar-sign"></i></div>
							<div>
								<div class="value"><?= $adminStats['revenue'] ?></div>
								<div class="label">Doanh thu</div>
							</div>
						</div>
					</div>

					<div class="content-grid">
						<div class="chart-box">
							<!-- Placeholder for activity chart -->
						</div>

						<div class="side-cards">
							<div class="mini-card">
								<div class="label">Online Orders</div>
								<div class="num">8540</div>
							</div>
							<div class="mini-card">
								<div class="label">Pending Orders</div>
								<div class="num">100</div>
							</div>
							<div class="mini-card">
								<div class="label">Total Shop</div>
								<div class="num">656</div>
							</div>
						</div>
					</div>
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