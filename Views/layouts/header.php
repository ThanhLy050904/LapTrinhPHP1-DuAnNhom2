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

                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= ($_GET['pages'] ?? 'home') == 'home' ? 'active' : '' ?>"
                           href="?pages=home">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= ($_GET['pages'] ?? '') == 'danh-muc' ? 'active' : '' ?>"
                           href="?pages=danh-muc">Sản phẩm</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= ($_GET['pages'] ?? '') == 'lien-he' ? 'active' : '' ?>"
                           href="?pages=lien-he">Liên hệ</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-3">

                    <form class="search-box">
                        <input class="form-control search-input" type="search" placeholder="Tìm sản phẩm...">
                        <button class="search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>

                    <a href="?pages=dang-nhap" class="btn btn-login">Đăng nhập</a>
                    <a href="?pages=dang-ky" class="btn btn-register">Đăng ký</a>

                </div>

            </div>
        </div>
    </nav>
</header>

<div class="floating-cart">
    <a href="?pages=gio-hang" class="cart-btn">
        <i class="fas fa-shopping-bag"></i>
        <span id="floating-cart-count">0</span>
    </a>
</div>