<style>
    .carousel-item img {
        height: 500px;
        object-fit: cover;
    }
</style>

<div id="carouselExampleCaptions" class="carousel slide">

    <div class="carousel-indicators">
        <button type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide-to="0"
            class="active">
        </button>

        <button type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide-to="1">
        </button>

        <button type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide-to="2">
        </button>
    </div>

    <div class="carousel-inner">

        <div class="carousel-item active">
            <img src="Views/image/banner.jpg"
                class="d-block w-100"
                alt="Slide 1">

            <div class="carousel-caption d-none d-md-block">
                <h5>First slide label</h5>
                <p>Some representative placeholder content.</p>
            </div>
        </div>

        <div class="carousel-item">
            <img src="Views/image/banner.jpg"
                class="d-block w-100"
                alt="Slide 2">

            <div class="carousel-caption d-none d-md-block">
                <h5>Second slide label</h5>
                <p>Some representative placeholder content.</p>
            </div>
        </div>

        <div class="carousel-item">
            <img src="Views/image/banner.jpg"
                class="d-block w-100"
                alt="Slide 3">

            <div class="carousel-caption d-none d-md-block">
                <h5>Third slide label</h5>
                <p>Some representative placeholder content.</p>
            </div>
        </div>

    </div>

    <button class="carousel-control-prev"
        type="button"
        data-bs-target="#carouselExampleCaptions"
        data-bs-slide="prev">

        <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next"
        type="button"
        data-bs-target="#carouselExampleCaptions"
        data-bs-slide="next">

        <span class="carousel-control-next-icon"></span>
    </button>

</div>