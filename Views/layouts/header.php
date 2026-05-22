<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KENZIE -Quần Áo Thời trang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0d1b2a;
            --dark-color: #0d1b2a;
        }

        .navbar {
            padding: 1rem 0;
            background-color: #fff !important;
            border-bottom: 3px solid var(--primary-color);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--dark-color);
        }

        .navbar-brand span {
            color: var(--primary-color);
        }

        .nav-link {
            font-weight: 500;
            color: #333 !important;
            margin: 0 10px;
            transition: 0.3s;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 8px 20px;
            border-radius: 50px;
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            border-radius: 50px;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
        }
    </style>
</head>

<body>

    <header class="header">
        <nav class="navbar navbar-expand-lg shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="?pages=home">
                    <img src="Views/image/th.webp" width="35" class="d-inline-block align-text-top">
                    KENZIE<span>.</span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item"><a class="nav-link active" href="?pages=home">Trang chủ</a></li>
                        <li class="nav-item"><a class="nav-link" href="?pages=san-pham">Sản phẩm</a></li>
                        <li class="nav-item"><a class="nav-link" href="?pages=chi-tiet-san-pham">Bộ sưu tập</a></li>

                    </ul>

                    <div class="d-flex gap-2">
                        <a href="?pages=dang-nhap" class="btn btn-outline-primary">Đăng nhập</a>
                        <a href="?pages=dang-ky" class="btn btn-primary text-white">Đăng ký</a>
                    </div>
                    <li class="nav-item"><a class="nav-link" href="?pages=gio-hang"><i
                                class="fa-solid fa-cart-shopping"></i></a></li>
                </div>
            </div>
        </nav>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>