<style>
    /* Bo góc và làm nổi bật carousel */
    .carousel-inner {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }

    .carousel-item img {
        height: 500px;
        object-fit: cover;
        filter: brightness(0.8); /* Làm tối ảnh một chút để chữ nổi bật */
        transition: transform 0.5s ease;
    }

    /* Hiệu ứng chữ đẹp hơn */
    .carousel-caption {
        background: rgba(0, 0, 0, 0.4); /* Nền mờ cho chữ */
        padding: 20px;
        border-radius: 10px;
    }

    .carousel-caption h5 {
        font-size: 2.5rem;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
</style>

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></button>
    </div>

    <div class="carousel-inner">
        <!-- Slide 1 -->
        <div class="carousel-item active">
            <img src="Views/image/38f822d4-762a-44c9-9612-38359ee6bbd5.jpg" class="d-block w-100" alt="Bộ sưu tập mới">
            <div class="carousel-caption">
                <h5>Bộ sưu tập mới</h5>
                <p>Khám phá phong cách thời thượng nhất mùa này.</p>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
            <img src="Views/image/bannerhoodie.png" class="d-block w-100" alt="Hoodie cá tính">
            <div class="carousel-caption">
                <h5>Hoodie Cá Tính</h5>
                <p>Chất liệu nỉ cao cấp, giữ ấm cực phong cách.</p>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item">
            <img src="Views/image/banner jean.png" class="d-block w-100" alt="Jeans đẳng cấp">
            <div class="carousel-caption">
                <h5>Jeans Đẳng Cấp</h5>
                <p>Form chuẩn, tôn dáng, bền bỉ cùng thời gian.</p>
            </div>
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>