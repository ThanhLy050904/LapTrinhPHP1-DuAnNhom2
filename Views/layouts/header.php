<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KENZIE</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous">
</head>

<body>

    <!-- Header -->
    <header class="header">

        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">

            <div class="container">

                <!-- Logo -->
                <a class="navbar-brand fw-bold" href="?pages=home">

                    <img src="Views/image/th.webp"
                        alt="Logo"
                        width="30"
                        height="24"
                        class="d-inline-block align-text-top">

                    KENZIE
                </a>

                <!-- Toggle Button -->
                <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent">

                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Content -->
                <div class="collapse navbar-collapse"
                    id="navbarSupportedContent">

                    <!-- Menu -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                            <a class="nav-link active"
                                href="?pages=home">
                                Home
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                                href="?pages=san-pham">
                                Sản phẩm
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                                href="?pages=chi-tiet-san-pham">
                                Chi tiết sản phẩm
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                                href="?pages=gio-hang">
                                Giỏ hàng
                            </a>
                        </li>

                    </ul>

                    <!-- Search + Auth Buttons -->
                    <div class="d-flex align-items-center gap-2">

                        <!-- Search -->
                        <form class="d-flex me-2" role="search">

                            <input class="form-control me-2"
                                type="search"
                                placeholder="Search">

                            <button class="btn btn-outline-success"
                                type="submit">
                                Search
                            </button>

                        </form>

                        <!-- Login -->
                        <a href="?pages=dang-nhap"
                            class="btn btn-outline-primary">
                            Đăng nhập
                        </a>

                        <!-- Register -->
                        <a href="?pages=dang-ky"
                            class="btn btn-primary">
                            Đăng ký
                        </a>

                    </div>

                </div>

            </div>

        </nav>

    </header>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous">
    </script>

</body>

</html>