<main class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow p-4 text-center">
                <img src="Views/image/ava.jpg" class="avatar-style mb-3 border border-3" alt="Avatar">
                <h5>Nguyễn Văn A</h5>
                <hr>
                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action active">Thông tin chung</a>
                    <a href="#" class="list-group-item list-group-item-action">Lịch sử đơn hàng</a>
                    <a href="#" class="list-group-item list-group-item-action">Đổi mật khẩu</a>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="mb-4">Chi tiết thông tin cá nhân</h4>
                    <form action="update_profile.php" method="POST">
                        <h6 class="text-primary mb-3">Thông tin định danh</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Họ và tên</label>
                                <input type="text" name="fullname" class="form-control" value="Nguyễn Văn A">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ngày sinh</label>
                                <input type="date" name="dob" class="form-control">
                            </div>
                        </div>

                        <h6 class="text-primary mb-3 mt-4">Thông tin liên lạc</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email (Không thể thay đổi)</label>
                                <input type="email" class="form-control" value="nguyenvana@gmail.com" disabled>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Số điện thoại</label>
                                <input type="tel" name="phone" class="form-control" placeholder="0909xxxxxx">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Địa chỉ nhận hàng</label>
                            <textarea name="address" class="form-control" rows="2" placeholder="Số nhà, đường, quận/huyện, tỉnh/thành"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary px-4">Lưu thay đổi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>