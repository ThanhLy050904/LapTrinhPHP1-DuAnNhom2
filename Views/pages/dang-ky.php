<!-- Đăng ký -->
<main class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-header text-center">
                    <h3>Đăng ký</h3>
                </div>

                <div class="card-body">

                    <form action="" method="POST">

                        <div class="mb-3">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" name="fullname"
                                class="form-control <?= isset($errors['fullname']) ? 'is-invalid' : '' ?>"
                                placeholder="Nhập họ tên">
                            <?php if (isset($errors['fullname'])): ?>
                                <div class="text-danger small mt-1"><?= $errors['fullname'] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email"
                                class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                                placeholder="Nhập email">
                            <?php if (isset($errors['email'])): ?>
                                <div class="text-danger small mt-1"><?= $errors['email'] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mật khẩu</label>
                            <input type="password" name="password"
                                class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                                placeholder="Nhập mật khẩu">
                            <?php if (isset($errors['password'])): ?>
                                <div class="text-danger small mt-1"><?= $errors['password'] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Xác nhận mật khẩu</label>
                            <input type="password" name="confirm_password"
                                class="form-control <?= isset($errors['confirm_password']) ? 'is-invalid' : '' ?>"
                                placeholder="Nhập lại mật khẩu">
                            <?php if (isset($errors['confirm_password'])): ?>
                                <div class="text-danger small mt-1"><?= $errors['confirm_password'] ?></div>
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            Đăng ký
                        </button>

                    </form>

                    <div class="text-center mt-3">

                        Đã có tài khoản?
                        <a href="?pages=dang-nhap">
                            Đăng nhập
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>
