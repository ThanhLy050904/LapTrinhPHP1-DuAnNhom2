<main class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card shadow">
                <div class="card-header text-center">
                    <h3>Quên mật khẩu</h3>
                </div>

                <div class="card-body">

                    <form method="POST">

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control">
                            <?php if (isset($errors['email'])): ?>
                                <small class="text-danger"><?= $errors['email'] ?></small>
                            <?php endif; ?>
                        </div>

                        <button class="btn btn-primary w-100">
                            Gửi link reset
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</main>