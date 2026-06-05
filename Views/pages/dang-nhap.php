<main class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-header text-center">
                    <h3>Đăng nhập</h3>
                </div>

                <div class="card-body">

                    <form action="?pages=dang-nhap&action=login" method="POST">

                        <?php if (isset($errors['login'])): ?>
                            <div class="alert alert-danger p-2 small"><?= $errors['login'] ?></div>
                        <?php endif; ?>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email"
                                class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                                placeholder="Nhập email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">

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

                        <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                    </form>

                    <div class="text-center mt-3">

                        Chưa có tài khoản?
                        <a href="?pages=dang-ky">
                            Đăng ký
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>