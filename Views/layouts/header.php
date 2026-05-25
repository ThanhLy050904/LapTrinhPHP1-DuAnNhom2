<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>KENZIE</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body>

<!-- HEADER -->
<header class="header">

    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">

        <div class="container">

            <!-- Logo -->
            <a class="navbar-brand fw-bold"
               href="?pages=home">

                <img src="Views/image/th.webp"
                     alt="Logo"
                     width="30"
                     height="24"
                     class="d-inline-block align-text-top">

                KENZIE

            </a>

            <!-- Toggle -->
            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent">

                <span class="navbar-toggler-icon"></span>

            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse"
                 id="navbarSupportedContent">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">

                        <a class="nav-link active"
                           href="?pages=home">

                            Home

                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link"
                           href="?pages=danh-muc">

                            Sản phẩm

                        </a>

                    </li>

                </ul>

                <!-- Right -->
                <div class="d-flex align-items-center gap-2">

                    <!-- Search -->
                    <form class="d-flex me-2">

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

<!-- GIỎ HÀNG NỔI -->
<div class="floating-cart">

    <a href="?pages=gio-hang"
       class="cart-btn">

        🛒

        <span id="floating-cart-count">

            0

        </span>

    </a>

</div>

<style>

.floating-cart{

    position:fixed;

    right:25px;

    bottom:25px;

    z-index:9999;

}

.cart-btn{

    width:70px;

    height:70px;

    background:#000;

    color:#fff;

    border-radius:50%;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:30px;

    text-decoration:none;

    position:relative;

    box-shadow:0 8px 25px rgba(0,0,0,0.3);

    transition:0.3s;

}

.cart-btn:hover{

    transform:scale(1.1);

    background:#222;

    color:#fff;

}

#floating-cart-count{

    position:absolute;

    top:-5px;

    right:-5px;

    width:28px;

    height:28px;

    background:red;

    color:white;

    border-radius:50%;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:14px;

    font-weight:bold;

}

</style>