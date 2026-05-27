<footer class="footer bg-dark text-white pt-5 pb-3 mt-5">

    <div class="container">

        <!-- ROW -->
        <div class="row g-4 align-items-stretch">

            <!-- ================= LOGO ================= -->
            <div class="col-lg-4 d-flex">

                <div class="footer-box w-100">

                    <div class="mb-3 d-flex align-items-center">

                        <img src="Views/image/Kenzie.png"
                             alt="Kenzie Logo"
                             class="footer-logo me-3">

                        <h3 class="fw-bold mb-0">
                            KENZIE
                        </h3>

                    </div>

                    <p class="footer-desc">

                        KENZIE là local brand theo phong cách streetwear,
                        mang đến những sản phẩm trẻ trung,
                        hiện đại và cá tính cho giới trẻ.

                    </p>

                    <!-- SOCIAL -->
                    <div class="d-flex gap-3 mt-4">

                        <a href="#"
                           class="social-icon">

                            <i class="fab fa-facebook-f"></i>

                        </a>

                        <a href="#"
                           class="social-icon">

                            <i class="fab fa-instagram"></i>

                        </a>

                        <a href="#"
                           class="social-icon">

                            <i class="fab fa-tiktok"></i>

                        </a>

                        <a href="#"
                           class="social-icon">

                            <i class="fab fa-youtube"></i>

                        </a>

                    </div>

                </div>

            </div>

            <!-- ================= MAP ================= -->
            <div class="col-lg-4 d-flex">

                <div class="footer-box w-100">

                    <h5 class="footer-title mb-4">

                        Bản đồ

                    </h5>

                    <div class="map-box">

                        <iframe
                            src="https://www.google.com/maps?q=Toà%20nhà%20FPT%20Polytechnic,%20Đ.%20Số%2022,%20Cái%20Răng,%20Cần%20Thơ,%20Vietnam&output=embed"
                            width="100%"
                            height="250"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy">

                        </iframe>

                    </div>

                </div>

            </div>

            <!-- ================= CONTACT ================= -->
            <div class="col-lg-4 d-flex">

                <div class="footer-box w-100">

                    <h5 class="footer-title mb-4">

                        Liên hệ

                    </h5>

                    <div class="footer-contact">

                        <p>
                            <i class="fas fa-envelope me-2"></i>

                            support@kenzie.com
                        </p>

                        <p>
                            <i class="fas fa-phone-alt me-2"></i>

                            0329 890 373
                        </p>

                        <p>
                            <i class="fas fa-map-marker-alt me-2"></i>

                            Toà nhà FPT Polytechnic,
                            Đ. Số 22,
                            Cái Răng,
                            Cần Thơ,
                            Vietnam
                        </p>

                    </div>

                </div>

            </div>

        </div>

        <!-- COPYRIGHT -->
        <hr class="border-secondary my-4">

        <div class="text-center">

            <p class="mb-0 text-light small">

                © 2026 KENZIE Fashion.
                All Rights Reserved.

            </p>

        </div>

    </div>

</footer>

<!-- ================= STYLE ================= -->

<style>

.footer{
    background:#0f0f0f;
}

.footer-box{
    background:#151515;
    border-radius:20px;
    padding:28px;
    height:100%;
    border:1px solid #222;
}

.footer-logo{
    width:55px;
    height:55px;
    object-fit:cover;
    border-radius:50%;
    background:#fff;
    padding:3px;
}

.footer-desc{
    color:#bdbdbd;
    line-height:1.8;
}

.footer-title{
    font-weight:700;
    position:relative;
    padding-bottom:10px;
}

.footer-title::after{
    content:'';
    position:absolute;
    left:0;
    bottom:0;
    width:60px;
    height:2px;
    background:#fff;
}

.footer-contact p{
    color:#bdbdbd;
    margin-bottom:18px;
    line-height:1.8;
}

.social-icon{
    width:42px;
    height:42px;
    border-radius:50%;
    background:#1f1f1f;
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    text-decoration:none;
    transition:0.3s;
}

.social-icon:hover{
    background:#fff;
    color:#000;
    transform:translateY(-5px);
}

.map-box{
    overflow:hidden;
    border-radius:16px;
    border:1px solid #222;
}

.map-box iframe{
    display:block;
}

</style>

<!-- ================= JS ================= -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>