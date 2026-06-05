<div class="tin-tuc-container container my-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Tin tức Kenzie</h1>
        <p class="text-muted">Cập nhật những xu hướng công nghệ và sản phẩm mới nhất tại TechStore</p>
    </div>

    <!-- Bài viết nổi bật nhất -->
    <div class="row mb-5">
        <div class="col-lg-8">
            <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&q=80&w=1200" class="img-fluid rounded shadow" alt="Tin nổi bật">
        </div>
        <div class="col-lg-4 d-flex flex-column justify-content-center">
            <span class="badge bg-primary text-white w-25 mb-2">Mới nhất</span>
            <h2 class="fw-bold">Xu hướng Gaming Gear 2026: Những lựa chọn không thể bỏ qua</h2>
            <p>Khám phá những công nghệ phím cơ và chuột gaming mới nhất mà Kenzie vừa cập bến. Đừng bỏ lỡ bài phân tích chuyên sâu...</p>
            <a href="?pages=tin-tuc-detail&id=1" class="btn btn-dark">Đọc tiếp</a>        </div>
    </div>

    <!-- Danh sách tin tức -->
    <div class="row">
        <?php for($i = 1; $i <= 6; $i++): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <img src="https://images.unsplash.com/photo-1593642634367-d91a135587b5?auto=format&fit=crop&q=80&w=600" class="card-img-top" alt="Tin tức">
                <div class="card-body">
                    <span class="text-muted small">03/06/2026</span>
                    <h5 class="card-title fw-bold mt-2">Đánh giá chi tiết mẫu bàn phím cơ Akko mới nhất</h5>
                    <p class="card-text text-truncate">Trải nghiệm thực tế về cảm giác gõ, độ bền và thiết kế của dòng bàn phím đang làm mưa làm gió tại TechStore.</p>
                    <a href="?pages=tin-tuc-detail&id=1" class="text-decoration-none fw-bold text-primary">Xem chi tiết &rarr;</a>                </div>
            </div>
        </div>
        <?php endfor; ?>
    </div>
</div>