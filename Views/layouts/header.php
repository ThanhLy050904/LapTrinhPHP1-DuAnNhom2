<header class="header">
    <nav class="navbar navbar-expand-lg">
        <div class="container">

            <a class="navbar-brand d-flex align-items-center" href="?pages=home">
                <img src="Views/image/Kenzie.png" alt="KENZIE Logo">
                KENZIE
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav ms-auto me-auto">

                    <li class="nav-item">
                        <a class="nav-link <?= ($_GET['pages'] ?? 'home') == 'home' ? 'active' : '' ?>"
                            href="?pages=home">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($_GET['pages'] ?? '') == 'danh-muc' ? 'active' : '' ?>"
                            href="?pages=danh-muc">
                            Sản phẩm
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($_GET['pages'] ?? '') == 'gioi-thieu' ? 'active' : '' ?>"
                            href="?pages=gioi-thieu">
                            Giới thiệu
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= ($_GET['pages'] ?? '') == 'tin-tuc' ? 'active' : '' ?>"
                            href="?pages=tin-tuc">
                            Tin tức
                        </a>
                    </li>



                    <li class="nav-item">
                        <a class="nav-link <?= ($_GET['pages'] ?? '') == 'lien-he' ? 'active' : '' ?>"
                            href="?pages=lien-he">
                            Liên hệ
                        </a>
                    </li>

                </ul>

                <div class="d-flex align-items-center gap-3">



                    <!-- USER -->
                    <?php if (isset($_SESSION['user'])): ?>

                        <div class="dropdown">

                            <a href="#" class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                                data-bs-toggle="dropdown">

                                <img src="<?= !empty($_SESSION['user']['avatar'])
                                                ? htmlspecialchars($_SESSION['user']['avatar'])
                                                : 'Views/image/default-avatar.png' ?>" class="header-avatar" alt="Avatar">

                                <span><?= htmlspecialchars($_SESSION['user']['full_name']) ?></span>

                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">

                                <li>
                                    <a class="dropdown-item" href="?pages=tai-khoan-cua-toi">

                                        <i class="fas fa-user me-2"></i>
                                        Tài khoản của tôi

                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="?pages=don-hang-cua-toi">

                                        <i class="fas fa-box me-2"></i>
                                        Đơn hàng của tôi

                                    </a>
                                </li>

                                <?php if (
                                    isset($_SESSION['user']['role']) &&
                                    $_SESSION['user']['role'] === 'admin'
                                ): ?>

                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>

                                    <li>
                                        <a class="dropdown-item text-primary" href="?pages=admin">

                                            <i class="fas fa-cogs me-2"></i>
                                            Trang quản trị

                                        </a>
                                    </li>

                                <?php endif; ?>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <a class="dropdown-item text-danger" href="?pages=dang-nhap&action=logout">

                                        <i class="fas fa-sign-out-alt me-2"></i>
                                        Đăng xuất

                                    </a>
                                </li>

                            </ul>

                        </div>

                    <?php else: ?>

                        <a href="?pages=dang-nhap" class="btn btn-login">

                            Đăng nhập

                        </a>

                        <a href="?pages=dang-ky" class="btn btn-register">

                            Đăng ký

                        </a>

                    <?php endif; ?>

                </div>

            </div>

        </div>
    </nav>
</header>

<!-- Floating Cart -->
<div class="floating-cart">
    <a href="?pages=gio-hang" class="cart-btn">
        <i class="fas fa-shopping-bag"></i>
    </a>
</div>