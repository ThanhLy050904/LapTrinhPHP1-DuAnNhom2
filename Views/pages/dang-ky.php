<main class="login-wrapper">

    <div class="login-card register-card">

        <div class="login-header">
            <h2>Tạo tài khoản mới</h2>
            <p>Tham gia cùng chúng tôi để mua sắm dễ dàng hơn</p>
        </div>

        <form action="" method="POST" enctype="multipart/form-data">

            <div class="mb-3">
                <label>Họ và tên</label>
                <input type="text"
                    name="fullname"
                    class="form-control <?= isset($errors['fullname']) ? 'is-invalid' : '' ?>"
                    placeholder="Nhập họ và tên"
                    value="<?= htmlspecialchars($_POST['fullname'] ?? '') ?>">

                <?php if (isset($errors['fullname'])): ?>
                    <div class="text-danger small mt-1">
                        <?= $errors['fullname'] ?>
                    </div>
                <?php endif; ?>
            </div>


            <div class="mb-3">
                <label>Email</label>
                <input type="email"
                    name="email"
                    class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                    placeholder="Nhập email"
                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">

                <?php if (isset($errors['email'])): ?>
                    <div class="text-danger small mt-1">
                        <?= $errors['email'] ?>
                    </div>
                <?php endif; ?>
            </div>


            <div class="mb-3">
                <label>Số điện thoại</label>
                <input type="text"
                    name="phone"
                    class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>"
                    placeholder="Nhập số điện thoại"
                    value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">

                <?php if (isset($errors['phone'])): ?>
                    <div class="text-danger small mt-1">
                        <?= $errors['phone'] ?>
                    </div>
                <?php endif; ?>
            </div>


            <div class="mb-3">
                <label>Địa chỉ</label>
                <textarea name="address"
                    rows="3"
                    class="form-control <?= isset($errors['address']) ? 'is-invalid' : '' ?>"
                    placeholder="Nhập địa chỉ"><?= htmlspecialchars($_POST['address'] ?? '') ?></textarea>

                <?php if (isset($errors['address'])): ?>
                    <div class="text-danger small mt-1">
                        <?= $errors['address'] ?>
                    </div>
                <?php endif; ?>
            </div>


            <div class="mb-3">
                <label>Mật khẩu</label>
                <input type="password"
                    name="password"
                    class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                    placeholder="Nhập mật khẩu">

                <?php if (isset($errors['password'])): ?>
                    <div class="text-danger small mt-1">
                        <?= $errors['password'] ?>
                    </div>
                <?php endif; ?>
            </div>


            <div class="mb-3">
                <label>Xác nhận mật khẩu</label>
                <input type="password"
                    name="confirm_password"
                    class="form-control <?= isset($errors['confirm_password']) ? 'is-invalid' : '' ?>"
                    placeholder="Nhập lại mật khẩu">

                <?php if (isset($errors['confirm_password'])): ?>
                    <div class="text-danger small mt-1">
                        <?= $errors['confirm_password'] ?>
                    </div>
                <?php endif; ?>
            </div>


            <div class="mb-3">
                <label>Ảnh đại diện</label>

                <div class="avatar-upload">
                    <input type="file"
                        name="avatar"
                        class="form-control"
                        accept="image/*">

                    <small>
                        Không chọn ảnh sẽ sử dụng ảnh mặc định.
                    </small>
                </div>
            </div>


            <button type="submit" class="login-btn">
                Đăng ký tài khoản
            </button>

        </form>


        <div class="login-footer">

            Đã có tài khoản?
            <a href="?pages=dang-nhap">
                Đăng nhập ngay
            </a>

        </div>

    </div>

</main>