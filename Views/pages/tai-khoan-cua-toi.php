<?php
$user = $user ?? [];
?>
<main class="container mt-5">

    <div class="row">

        <div class="col-md-3">

            <div class="card shadow p-4 text-center">

                <img src="<?= htmlspecialchars($user['avatar']) ?>"
                    class="avatar-style mb-3 border border-3 rounded-circle"
                    alt="Avatar">
                <h5>
                    <?= htmlspecialchars($user['full_name']) ?>
                </h5>
                <form method="POST"
                    enctype="multipart/form-data">

                    <div class="mb-2">
                        <input type="file"
                            name="avatar"
                            class="form-control form-control-sm"
                            accept="image/*">
                    </div>


                    <button type="submit"
                        class="btn btn-primary btn-sm w-100">
                        Đổi ảnh đại diện
                    </button>

                </form>

                <div class="list-group list-group-flush">

                    <a href="#"
                        class="list-group-item list-group-item-action">
                        Lịch sử đơn hàng
                    </a>

                </div>

            </div>

        </div>

        <div class="col-md-9">

            <div class="card shadow">

                <div class="card-body">

                    <h4 class="mb-4">
                        Chi tiết thông tin cá nhân
                    </h4>

                    <form>

                        <h6 class="text-primary mb-3">
                            Thông tin định danh
                        </h6>

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Họ và tên
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    value="<?= htmlspecialchars($user['full_name']) ?>"
                                    readonly>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Vai trò
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    value="<?= htmlspecialchars($user['role']) ?>"
                                    readonly>

                            </div>

                        </div>

                        <h6 class="text-primary mb-3 mt-4">
                            Thông tin liên lạc
                        </h6>

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    class="form-control"
                                    value="<?= htmlspecialchars($user['email']) ?>"
                                    readonly>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Số điện thoại
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    value="<?= htmlspecialchars($user['phone'] ?? '') ?>"
                                    readonly>

                            </div>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Địa chỉ
                            </label>

                            <textarea
                                class="form-control"
                                rows="3"
                                readonly><?= htmlspecialchars($user['address'] ?? '') ?></textarea>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Ngày tạo tài khoản
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="<?= htmlspecialchars($user['created_at']) ?>"
                                readonly>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</main>