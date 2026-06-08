<main class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card">
                <div class="card-header text-center">
                    <h3>Đổi mật khẩu</h3>
                </div>

                <div class="card-body">

                    <form method="POST">

                        <label>Mật khẩu mới</label>
                        <input type="password" name="password" class="form-control">

                        <label class="mt-2">Nhập lại mật khẩu</label>
                        <input type="password" name="confirm_password" class="form-control">

                        <?php if (!empty($errors)): ?>
                            <div class="text-danger mt-2">
                                <?= implode("<br>", $errors) ?>
                            </div>
                        <?php endif; ?>

                        <button class="btn btn-success w-100 mt-3">
                            Đổi mật khẩu
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</main>