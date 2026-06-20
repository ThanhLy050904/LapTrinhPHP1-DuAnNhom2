<main class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header text-center">
                    <h3>Đăng ký</h3>
                </div>

                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" name="fullname"
                                class="form-control <?= isset($errors['fullname']) ? 'is-invalid' : '' ?>"
                                placeholder="Nhập họ tên" 
                                value="<?= htmlspecialchars($_POST['fullname'] ?? '') ?>"> <?php if (isset($errors['fullname'])): ?>
                                <div class="text-danger small mt-1"><?= $errors['fullname'] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email"
                                class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                                placeholder="Nhập email"
                                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"> <?php if (isset($errors['email'])): ?>
                                <div class="text-danger small mt-1"><?= $errors['email'] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" name="phone"
                                class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>"
                                placeholder="Nhập số điện thoại" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                            <?php if (isset($errors['phone'])): ?>
                                <div class="text-danger small mt-1"><?= $errors['phone'] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Địa chỉ</label>
                            <textarea name="address"
                                class="form-control <?= isset($errors['address']) ? 'is-invalid' : '' ?>" rows="3"
                                placeholder="Nhập địa chỉ"><?= htmlspecialchars($_POST['address'] ?? '') ?></textarea>
                            <?php if (isset($errors['address'])): ?>
                                <div class="text-danger small mt-1"><?= $errors['address'] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mật khẩu</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password"
                                    class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                                    placeholder="Nhập mật khẩu">
                                    <div class="input-group-text">
                                    <input class="form-check-input mt-0" type="checkbox" title="Hiển thị mật khẩu"
                                        onclick="document.getElementById('password').type = this.checked ? 'text' : 'password'">
                                </div>
                            </div>
                            <?php if (isset($errors['password'])): ?>
                                <div class="text-danger small mt-1"><?= $errors['password'] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Xác nhận mật khẩu</label>
                            <div class="input-group">
                                <input type="password" name="confirm_password" id="confirm_password"
                                    class="form-control <?= isset($errors['confirm_password']) ? 'is-invalid' : '' ?>"
                                    placeholder="Nhập lại mật khẩu">
                                    <div class="input-group-text">
                                    <input class="form-check-input mt-0" type="checkbox" title="Hiển thị mật khẩu"
                                        onclick="document.getElementById('confirm_password').type = this.checked ? 'text' : 'password'">
                                </div>
                            </div>
                            <?php if (isset($errors['confirm_password'])): ?>
                                <div class="text-danger small mt-1"><?= $errors['confirm_password'] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ảnh đại diện</label>
                            <input type="file" name="avatar" class="form-control" accept="image/*">
                            <small class="text-muted">Không chọn ảnh sẽ dùng ảnh mặc định.</small>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Đăng ký</button>
                    </form>

                    <div class="text-center mt-3">
                        Đã có tài khoản?
                        <a href="?pages=dang-nhap">Đăng nhập</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.querySelectorAll('.toggle-password').forEach(button => {
    button.addEventListener('click', function () {
        const targetId = this.getAttribute('data-target');
        const input = document.getElementById(targetId);
        
        if (input.type === 'password') {
            input.type = 'text';
            this.textContent = '🙈'; 
        } else {
            input.type = 'password';
            this.textContent = '👁️'; 
        }
    });
});
</script>