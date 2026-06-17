<main class="login-wrapper">

    <div class="login-card">

        <div class="login-header">
            <h2>Chào mừng trở lại</h2>
            <p>Đăng nhập để tiếp tục mua sắm</p>
        </div>

        <form action="?pages=dang-nhap&action=login" method="POST">

            <?php if (isset($_GET['locked']) && $_GET['locked'] == '1'): ?>
                <div class="alert alert-danger p-2 small">
                    Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên.
                </div>
            <?php endif; ?>

            <?php if (isset($errors['login'])): ?>
                <div class="alert alert-danger p-2 small">
                    <?= $errors['login'] ?>
                </div>
            <?php endif; ?>


            <div class="mb-3">
                <label>Email</label>

                <input 
                    type="email" 
                    name="email"
                    class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                    placeholder="Nhập email của bạn"
                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">

                <?php if (isset($errors['email'])): ?>
                    <div class="text-danger small mt-1">
                        <?= $errors['email'] ?>
                    </div>
                <?php endif; ?>
            </div>


            <div class="mb-3">
                <label>Mật khẩu</label>

                <input 
                    type="password" 
                    name="password"
                    class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                    placeholder="Nhập mật khẩu">

                <?php if (isset($errors['password'])): ?>
                    <div class="text-danger small mt-1">
                        <?= $errors['password'] ?>
                    </div>
                <?php endif; ?>
            </div>


            <button type="submit" class="login-btn">
                Đăng nhập
            </button>

        </form>


        <div class="login-footer">

            <a href="?pages=quen-mat-khau">
                Quên mật khẩu?
            </a>

            <p>
                Chưa có tài khoản?
                <a href="?pages=dang-ky">
                    Đăng ký ngay
                </a>
            </p>

        </div>

    </div>

</main>