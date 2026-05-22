<?php
require "Views/layouts/aside.php";
?>
<style>
    .product-card {
        border: none;
        transition: all 0.3s ease;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 30px rgba(0, 0, 0, 0.1);
    }

    .product-img {
        height: 350px;
        object-fit: cover;
    }

    .btn-navy {
        background-color: #0d1b2a;
        color: white;
        border-radius: 0;
        padding: 10px 30px;
    }

    .btn-navy:hover {
        background-color: #1b263b;
        color: white;
    }


    .category-box {
        padding: 20px;
        border: 1px solid #eee;
        transition: 0.3s;
        border-radius: 10px;
    }

    .category-box:hover {
        background: #f8f9fa;
        cursor: pointer;
        border-color: #0d1b2a;
    }

    .border-navy {
        border-color: #0d1b2a !important;
    }

    .text-navy {
        color: #0d1b2a;
    }

    .category-box {
        background: #fff;
        transition: 0.3s;
        cursor: pointer;
    }

    .category-box:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }
</style>

<main>
    <div class="container my-5 text-center">
        <h3 class="fw-bold mb-4">DANH MỤC SẢN PHẨM</h3>

        <div class="row justify-content-center">

            <div class="col-md-2 col-6 mb-3">
                <div class="category-box p-4 shadow-sm rounded">
                    <h5 class="fw-bold">Áo Thun</h5>
                </div>
            </div>

            <div class="col-md-2 col-6 mb-3">
                <div class="category-box p-4 shadow-sm rounded">
                    <h5 class="fw-bold">Quần Jeans</h5>
                </div>
            </div>

            <div class="col-md-2 col-6 mb-3">
                <div class="category-box p-4 shadow-sm rounded">
                    <h5 class="fw-bold">Quần Short</h5>
                </div>
            </div>

            <div class="col-md-2 col-6 mb-3">
                <div class="category-box p-4 shadow-sm rounded">
                    <h5 class="fw-bold">Áo Khoác</h5>
                </div>
            </div>

            <div class="col-md-2 col-6 mb-3">
                <div class="category-box p-4 shadow-sm rounded">
                    <h5 class="fw-bold">Áo Hoodie</h5>
                </div>
            </div>

        </div>
    </div>

    <div class="container mb-5">
        <h3 class="text-center fw-bold mb-4">SẢN PHẨM NỔI BẬT</h3>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card product-card">
                    <img src="Views/image/banner hoodie.png" class="card-img-top product-img" alt="Hoodie">
                    <div class="card-body text-center">
                        <h5 class="card-title">Hoodie Signature</h5>
                        <p class="text-secondary">499.000 VNĐ</p>
                        <a href="?pages=chi-tiet-san-pham" class="btn btn-outline-dark">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card product-card">
                    <img src="Views/image/banner jean.png" class="card-img-top product-img" alt="Jeans">
                    <div class="card-body text-center">
                        <h5 class="card-title">Denim Raw Edge</h5>
                        <p class="text-secondary">650.000 VNĐ</p>
                        <a href="?pages=chi-tiet-san-pham" class="btn btn-outline-dark">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card product-card">
                    <img src="Views/image/38f822d4-762a-44c9-9612-38359ee6bbd5.jpg" class="card-img-top product-img"
                        alt="Áo">
                    <div class="card-body text-center">
                        <h5 class="card-title">Minimalist Tee</h5>
                        <p class="text-secondary">299.000 VNĐ</p>
                        <a href="?pages=chi-tiet-san-pham" class="btn btn-outline-dark">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <h3 class="text-center fw-bold mb-4">KENZIE LUÔN SẴN SÀNG HỖ TRỢ</h3>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="p-3 border-start border-4 border-navy bg-light h-100">
                    <h6><i class="fas fa-shipping-fast text-navy"></i> Giao hàng & Vận chuyển</h6>
                    <p class="small text-muted mb-0">"Đơn hàng của Kenzie thường được xử lý và giao đến tay khách hàng
                        trong vòng 2-4 ngày làm việc. Bạn sẽ sớm nhận được mã vận đơn để theo dõi hành trình đơn hàng
                        nhé!"</p>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="p-3 border-start border-4 border-navy bg-light h-100">
                    <h6><i class="fas fa-undo text-navy"></i> Chính sách đổi trả</h6>
                    <p class="small text-muted mb-0">"Kenzie hỗ trợ đổi size hoặc đổi mẫu trong vòng 30 ngày (sản phẩm
                        còn nguyên tem mác). Nếu hàng lỗi, Kenzie cam kết đổi mới 1-1 và chịu toàn bộ phí ship ạ."</p>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="p-3 border-start border-4 border-navy bg-light h-100">
                    <h6><i class="fas fa-ruler-combined text-navy"></i> Tư vấn chọn size</h6>
                    <p class="small text-muted mb-0">"Chào bạn, hãy nhắn cho Kenzie chiều cao và cân nặng nhé! Kenzie sẽ
                        tư vấn size vừa vặn nhất với form người của bạn để mặc lên đẹp nhất ạ."</p>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="p-3 border-start border-4 border-navy bg-light h-100">
                    <h6><i class="fas fa-check-circle text-navy"></i> Cam kết chất lượng</h6>
                    <p class="small text-muted mb-0">"Sản phẩm tại Kenzie luôn đảm bảo vải bền, không xù lông và đúng
                        hình ảnh 100%. Nếu không hài lòng về chất lượng, Kenzie cam kết hỗ trợ hoàn tiền cho bạn."</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5">

        <h3 class="text-center fw-bold mb-4">KHÁCH HÀNG NÓI VỀ KENZIE</h3>
        <div class="row">

            <div class="col-md-4 mb-3">
                <div class="card p-4 h-100 border-0 shadow-sm text-center">

                    <img src="data:image/jpeg;base64,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"
                        class="rounded-circle mx-auto mb-3" width="80" height="80" style="object-fit: cover;"
                        alt="Minh Tuấn">

                    <div class="mb-2 text-warning">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>

                    <p class="card-text small text-muted">
                        "Hoodie bên shop chất vải dày dặn, mặc lên form cực đẹp luôn. Ship hàng cũng nhanh nữa, sẽ ủng
                        hộ shop dài dài!"
                    </p>

                    <h6 class="fw-bold">- Minh Tuấn -</h6>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card p-4 h-100 border-0 shadow-sm text-center">

                    <img src="data:image/jpeg;base64,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"
                        class="rounded-circle mx-auto mb-3" width="80" height="80" style="object-fit: cover;"
                        alt="Lan Anh">

                    <div class="mb-2 text-warning">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>

                    <p class="card-text small text-muted">
                        "Quần Jeans rất ưng ý, vải không bị xù lông sau khi giặt. Shop tư vấn size cực chuẩn, mình mặc
                        vừa vặn không cần sửa lại."
                    </p>

                    <h6 class="fw-bold">- Lan Anh -</h6>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card p-4 h-100 border-0 shadow-sm text-center">

                    <img src="data:image/jpeg;base64,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"
                        class="rounded-circle mx-auto mb-3" width="80" height="80" style="object-fit: cover;"
                        alt="Hoàng Nam">

                    <div class="mb-2 text-warning">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>

                    <p class="card-text small text-muted">
                        "Lần đầu mua hàng mà thấy hài lòng quá. Shop hỗ trợ nhiệt tình, đổi trả nhanh chóng. Chất lượng
                        thực tế còn đẹp hơn cả hình!"
                    </p>

                    <h6 class="fw-bold">- Hoàng Nam -</h6>
                </div>
            </div>

        </div>
        <div class="container my-5">
            <h3 class="text-center fw-bold mb-4">TIN TỨC & XU HƯỚNG</h3>

            <div class="row">

                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden">

                        <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxISEhAQEhAVFRUXFRUYFRUVFRUVFRAVFRUWFhcVFRUYHSggGBolHRUVITEhJSkrLi4uFx8zODMtNygtLisBCgoKDg0OFxAPFy0dHR0tLS0tLSstKy0tLi0tLi0tKy0tLS0tNzctLS0tLy0tKys3LTEtLS4tLTcrNy0tKy0rL//AABEIAOEA4QMBIgACEQEDEQH/xAAbAAABBQEBAAAAAAAAAAAAAAAFAAIDBAYBB//EAEUQAAEDAgMEBwUEBwcEAwAAAAEAAhEDBAUSITFBUXEGImGBkbHBEzJSodEjQmKSM1NyosLh8BQVQ4Ky0vE0c3STJCVj/8QAFwEBAQEBAAAAAAAAAAAAAAAAAAECA//EACQRAQEAAgICAQQDAQAAAAAAAAABAhExQRIhAyJRodEyQrEE/9oADAMBAAIRAxEAPwD0p+xBsSPU70ZrbCgmLHQDmt1iM1ebe5QsCluPeKawLm6JaYUzQmMCmARHWhPASATwEHF2F0BdQNhKE5cQNSXSkg4uLq4gS4lK4g4VxdKagS4kkgS4UlyUCTSukppQcSSXECXEkkG9uNnegWLnUDsR25OxZ/FT1j3LpWYz9XaeaTAkd6ivLn2TWnLme+RTYNM0aFzjuYOO0nQarm2t+0a3aQPPwTf7xpDa+OYcPRV6Fk93Wq1DPwtgNbyGzz5ogyjAyh7o5j6IIxiNH9YPn9E5uJUf1rfFObZN4nwb/tULsJafvv8ACn/sQ9LAvqX61n5m/VO/tdP9az8zfqqBwNnxu8GegCgr4G3qgO2uA1HYTx7EBj2rfiHiE4FBXdHmcW/kP+5MPR9u5w8CPVTZodIXEAOAu3VPNMOD1t1b98/7EGhKaVnjhdyNlf8Aed9E3+w3g/xz+c+qbNNFK4Vnha3o/wAY/I/xKWra3jWU3ioSXZpHV6sOgbXaps0NLizzn342Cf8A1/VMN1fj/Cn8nortGjKUrNnEL4f4E9w9E04xdjbau/IfqpsaRJZoY/cDbaP/ACO+qR6SVRttn/lcg0ZK4s/S6T6w63ePEHuBGqLWeIU6s5Haja06OHMKiySuJFNQdXU1JBvrnaOSzmJu1ce0rR1/eKy1+73jzW8mYFU6ckDiQPFVrZ4q3FxV3NcKVP8ACymI07yT3olhzftWT8U+AnXwQvo6z7Kfie93iVhsWapmhRtUgQPaCdAJ5JrKrTscD3otgdvr7V273Rx3Eqv0jwWT7akNfvAaSeMcVLSRUKbWoVJZDT72uzZld6xsUGFMg53ugDcdNRx5Ii/EGyIkjedmnYDt+Snktn2VKgI0Ijmoy5FakPEtIJCa+qKdMVCesSYbEbOKbJAslcJVZtZxc4v+8ZlSFybNHyuZkwuTBUHFNmkpKfUqksa3KYaXS6REviGxtnquPD1fhduXvByy0anTTTcjft2s2NjkAFUZuVzMruIhrnlwkTEjTUjSfCEIr1i2YCbXS1mXMyhZUkSF2URLmSzKKUkD6gDhBAI4HUIdXw+mCHEua0febq+h+Nu9zRvbwmFeSQR0KjwX0qke0ZGaNWva4Syow72uGqkVa/qBpsHjbNa2ceLGxUp8yM7RyU5KqHJJuZJFb65d757CsvfHQrS3p6jz/WpWZvvVazZxQWjsvtH/AAUqrvBhHqqOBU4oURvyieasXbstreu//HKOb3NATrNkMYPwjyXPppYCnt6WZzW8SNeA3lRAIu2j7Ojm+86CewaQPCfHsTai7GMiGkDsPYo6mZmsSN/AqGzdLS78J+ijsqxbpOnBTa6Csdwxrx7anMj3mjf3eqHWFEE68Dt0I12ELai1BMjQ8R9FnL6ypit7VznwHucGsdAqHMRlfH3Z8lLCXpet7djGZjoOOwvPBv1VWtbmoc7jyHBWbx7ajQ92paRlEe7IOg4bPkgeKYhVBa1jY0LiTsgR1Z49YE8ApbI6fH8dzuos1LbcqFxQc3WDHHcieFuzNqOI1gGJmJE7URbTD6JBG2Ae/RWXbGU1dGdGKNOrSLalNjocQMzZOoB9UbZhFBuraFIf5B9FlOjl17Kq6k7YT8/unvBW1bU0SVLLFWvTgCTpoIGgg6IJdW4GYDlzhGcQYS0ncqlVgJL3bNo7xKqRm6gIOqHXYzE8kWxN4JgIfUpbVGg61YZgb1M9pESCJ2SNvJT2tHracPNaerZNdQyRsAjsOyVZUsZAOXcyjeCCQVyVrbKWV0FRSugoIcYH/wAWq4baVxbVRyIex3+hilbOsxt0gzAgb4HauVmZ6d1S/WW7/Gk5tUfJr/FQ2VXPTpv4sae8gSqLC6mpIN3iRhnMrNXpWixU6NHNZu7Oq1mziqYoYtKv461uz98uPyCt0mwAOACq4v8AobVnx3Lz3MokeZVxi51pfwq2zvE+63V3oETxF0sJ4n+fqn2ND2VIz7zhJ79gUN8fs2/1pu+UKXhY5hTppVO4eP8AwoGv1TbCqRb1AzV8k9wACG4ZVqFz88xIidJ46LON9GWc8/FsrZ8hqA4pSh3e4+LifVFsLfJVbGWarXROVazZLe8eTkzFbBhpPkTrm7wI8hHJT2AhrfxPI5ZWz6qbF3AUqk7xHjpPdt7ks9N4XLyniAYbWa1z2nQEaHcRGmvy7kYsP0dUcI9UCsSWuAPCDzC0GFCW1u71WYuXbOY23K9tUcde/UefyWowLExUYNesPmg2I0MzSOY5EbD8x4ILh9y6k6QYg6hZ3qrPqj0mr1gQgeJ1CGtH4Y8NPRWMMxYPA1181WxVsye0xyOv1W3PWgRyYQpsqloWxeco7+xRUFk3rcvNaRmrHD8JQ02eTYiGGmSR+EoVmMetI64HHwJkfKEEDltLmlOZp/ra3+ELH31D2by3duWmTAU4FQhydKu0WbQj2tAHY5/sz+zVaaZ/1IZgpIpBp2sc9p7IcYHgQrFw8hpcNrYcObSHeia4BtzesGz2vtG/s1Rmb8oVFiUkyUlNptucWdqB2LP3HvI5ip6x7vJAax1K1kRBimr8PZwZXqeNRjZ8JRrBLYPqa7GjNzO4H+tyDX//AFVMfBa0h3vdUcfILV4NRyUs295n/KNB6nvUVYu3SO9V8SH2bRHAKav90dqixYw1vipVhlnbBluHb3AnuJJHohQd1kfv25KTG8GNHgAs246qa4NTdaHBTvXcWUWDvgSm3lxmMAad0+a1JbGblJZKdhjwQ1sahxdPNoH9dyvXduHDrCefKPIlDcIPWRy5cANm5Z9dt+9+mHu+rV7ytBgWra3MeSA42IqT28ka6Ov6lTmPJZnLV/irXLffCzl7Tg5uOh5rTXW0oJfUpkcdnNMomF1UdjVLTIKOurOczUd+1Ze0qLT2D5YFnFvJWcx0SBCv4U0BduB1VQs70hxAG/0XTHG3hxz+SYz20VelLVBhreuR2H0Vu2dLRIXKNGHk9h9EsWX0HXAIq66j/j6fNBOktmD1gEexIdYFVsQp5mIMFKcCpcTo5H9h1VVrlBM4SCOII8VXfUmtRf8ArbSn+ai72P8AAVMCqlw6BaO+CtXpf5XAOaPF7lqIISkm5kk9I2eIO6zuZQR+pPNFbp21DrVsvYOLm+YVyWGij7S+uGj4qVIdmSkwnwzuWwqwIaNggDsA0Wf6L081a8uDs9rVyntNR9Mfu0x4hGg6SlDiJe0dihxMS5je0DxICs0x11DWbNemO0fLX0Uqzk/HHaFZlxR/H37Qsdjz6opOdSJDxB0aHEidQBB8tymV038ePlZPu1lg4Cm4uMCNSnYi0s6rROkieIP80GpUaxZSaC90VaZcWktkBwDiR8MSYUPSSyuTdMqUw72ealmhwAhrpdIJ7PmsT5d48V1+P/lxz+T3lJru/wCCmCXE1CDoRHzR61rmo1zwAQS9oIkaNdlk6dny4LJWtg8VnOAEHYZA+HYO47Voei2H1aNMsqFph5y5STLSBqZ3kyVZLJq++Pz+nCZbu9a5/H7BOk1OD/KN6tdF3y2oP2fIp/SqkqXRKprVHY31TjKNc41fvBqhd4zSUUvDqqdVssPMrTEYjGMYbb1hTLHOzDOS0CGMmC49gM+C1mF3xDYA+fasv0uwP+0Cm4VCwtzNcQCc1N8ZmnUcB4lFsEqN1brppt3Du7Fw+SZep8fLvhlhN35OFzEekgp3DaBp9U5Mzi4gtzmAYiIG0yQiFs4Agga5h36/zKqYp0ft7gtfUYZEj3iJEzlPZt8VbosAIjduXa7kx1z24yY5XLfHTTWh0CsgbT2IfYP0CJNVQKvRKqjUQrt0FRCDP9ILSWEjaNVmQVvrqlmaQsLd0cj3N4H5IE1yp4iYpVz8FShW5BsscfFzVYaVHXZm9qz47eqP/XFb+CO9Bc04pLEf31V/opLWkex3Z0PJV8KH21PsM+AJ9FLeHQp+AUs1YA7MrieUQfNLyCWFUPZW1Np0c4e0f+28An0U9vtSvasuKVqpRapDrFQ0RNw3sk/ukeqs0NpVaw1ru/Zd6JVgfjx6yz9Zjy7SY5x6o/0hPXCEB2qm/ZrcaHCxopb1R4eNAprhqCpQb1loaB0CB0G6o5bN0GqsKBdJ6encgHRZ0VXjs8itP0jEtnmCslgbstyRxB9CsZ8xvDijmIFQ0xLSpMSKZZnaFpgIvqMyOKrYC/K8govfUkE9ys08f6Kxl69umHuaaytsVIbVba6WhU3bVqsdi2HvRmmVnrJ+qO27tEiVUugqFNEb8bUPbtVI49qzHSey/wAQbtvJa2s1UcQtw5hB4IPPgU+mftKM7C8NP7L+q75FKvSyOc3gVDdzkMbRBHZB2oRn/wC6KvwnwSXoH99234fAJK+S+NErw+aIdHKcCtV7AwczqfIeKG3R2I/SpezoU2byMzubtfKB3K9soajtVatAqYV22UFyhsJVXCtazz+E/Mj6K4wQw8lUwX36p7B5uSkCukXvlZ7pLdOpRkMOc5omAcoMSYPd4rRY8JqQst0ta51VrWiRLuO5zYiOXkpLPL6uG9Za+nlrejlbPSYcxcYEkgAyNDIGgMyiFwgXRGk9rXB7Y1BBnbIg6TpsHijdyVctbvjwzrL+3KK295HbbYgVptR222KRaE4sZZU/7jvILG2py3LO0nyK2WJDS4HB4P5mj6LFVnRWpu/EPMfVZz4aw5aDEzqmWK7iR2LmGiStMJa7JWexOlpPAytPVbtQjEqSlm4uN1VrDKuZgXK41VPA6mhbw0V+5GxScLlyfbOR6zfos3RcjeHvSJVjEEMZ6opiHuhC6OpIWkXC2QoKlPRT27pEJ5pojAdJbTK8PGw7eaDPbLSOII8Qt10lsc1N2mo1HcsQ1FAo7Pkuol/YAks6b824o0faVabOLgDynX5Sjl7VzOKHYI2axPwscR4Bv8StXNMsjiV0rmcxitU9AqdN6tNdsWRff+jPJVcBGlU/iHyA+qnruikVHgQ+zJ4uPy09Fe16D7/9NPwyT/lE+iz9390o/jBj2nF5gfsjU/OB4oBd/d5rFaxaDCB1VPclQ4R7qfXV6O3bTajtvsCzTL2mww50cTubOyTuWkYdGpLEyDcSH2lQfFTaRzaSD5hYTENHA8Hev8l6BjjY9lU4HK7k/TzhYPFW6uHBTPhrDkaxE9VpXLF8KO+qfZsPYPJQ275V2zoUqVdVHcUcwXaVKSD2KYVmsc1p3qoAWJy1XBGKokIdilMMuBG8IozZKkavClMFFbCrsQy6EEEKezqKdnQ/dmWShDDqEUzTSPP0CFLTK3SKt0TKqUGq21kapErmIUJYvMbyhkqPbwJ8F6nRrAy0rBdK7bJXn4hPgrSAsJJ0LimhuuiwmvU/7Z/1MRa9tpdKCdF6sV4+Jrh5O/hWrrNlbQDqWvBRskGCFcv7gMgIa++G5x7lmrBC9eRS2FTYTpRZy80HfeQHNzEyDpB3hR4Jiji4Ui0QA45gdgDiBI5DbxU37bmFsuukuLtl5PZI7tD6eKC3Z93mtFjVOIP9Q7+YCzdxtCmRi0GDHRSXJ1VfBjsU977ydHbJ4llZXJc+CS52UiXVCQ0MDRwhoE7jO3QL0HDGObRoNd7wYwHmGgHyVCxYCQY5dnJGKg2KzLLx8bfTGWE8/Kc2T8O3zA5ha7YRB7O1ef4kz7R4K394eqBx8tp9B3rCYx+kcUy4ax5FbWgHU6ZIB6gBB4pz7HSWiO5KjRhsxtC7Z3cEsJ5SpCoXPc1C7qoXEFaO8oDLKA3lGBKqRBd1s9Vh4CEVc+GIJYslwKL1/dWZy3eErKWeiTvCrWz4IVzBX6Fqr31DI4HcVakHLJ0seOR81Rd70J9i4+zlu0kg8hB9VcbbsiYIdvRCpuDQJU4rgt0Vc0gT3KOscrSqyrmtD5QTpc8ONM7xI7j/AMK4LjMShePjRh4n0QBIST4XUB/DKhbWpEfG3wJg/Ilb24dDSVhMIZNekPxT4An0RnA8f9vQa6JLdHciAWu7wfELcRHiJFQHXUKKysYElX4YToDKZcPOzy1WWgu9HWHHZ46BXqVg2k/K3MZiSdYgbAeclQi2lwJGwgydxnRG/YgmYU7a8rJr7oMbpyyeAie6R8wslWEkELT4o4kZZ0Py7VmgpUxFsK0hWrzU6KnZDYiYp70U+xYZH80VcDoqdk3VEGhVmql87Vo7Fj8SAc98bp7VscSZoXbwFkXEudlO8weRMJVx5H8PYKlFhiDlCC4jRLHTsRy2fk6vDRQXVZlTQonYfaVy/QlLHCBTDBtJgKq6kaFWZlp1niEodUcausTDO0byi6K0t4gcB81ZuWdVSWjOxPu29UrMaqlhz4cjGJW+enI2wgNo7rLVU9WDkqzVTo/Tmk7jn8NApq1y5pgiQpcLohrXRvcfILt00bHBDtEHA6j/AIUFw2WuSeC2XN1AieyVbtstQA7OKqVlcuR0FD8ar5nNaPujzRzpdSFPIQdSYWWdqSTvVkRGkpMqSugcwx+Vz3/BSqO8GlAuh1dzaFOo06mTzGyDxGiJ16mS1v6nC3ePz6Id0cpZbagPwD56q9DXYXdio4tdAcfd4H8P0RFluNXHdtWWar9xiT3saw7tp3v4SppV81BUd7Nned2hRSpdU26ZxyBnyWSATgpo2MXdcGSDuQEsIMRsVgLqWLKmt6sEawIV0XTdmcIZC5CaNtHZXLZ/SN4bQiDah7CFjIT6VVzDLXEciiNZdVm5CC4A9pjnHFZmvT+0NSnB1EAa7Nmi7Wv3vAD4Mb41+SipXBbOUDwlSyrNHm8c7NmGV/DUB0jt2FCKty7MBvmOSu1XFxLjtJkqNwV0bXbJrXgA6xtBM6xt71fDNyAEKaldvbsd3HUKXE2O0ae9Q3Y3Krb4zHvs72/Q/Vdu8SYdRPgmjaNtLXRXre5MZTtCEi97CpP7ew6yQeW3wTQ0NpdMAazN1tdDtdv04p1ausVfkve0zIGs9u5WrfFXgZX9Ybj94d+/vV0laa3umw5piDt7FVq3zKAMcwspUqOMy4wTMTp4JkmInThu8FdImxW+dXfmdsHujgqeVSwmkKhkJJ8JIF0kflwy+PxGkz96VNYU8tOm3g1o+QVTpgf/AK+mz9ZdMHcBHnCJMGiIeE9qYntRTwnBNCc1A8JLgTghtxdSSQJJdhKEDYSToXEDCEwhSkLhCCEhcIUhC4QgiITSFLC4WoIoTSFIQuQgiITSFK4JmVAyFwsUkJEIiEtXCFNCa5qoihdToSUFXph/0th/5Y/1BEmpJKqcntXUlA8JwSSQOCcupIEkkkiHBJJJFcTUkkHCuFdSQNKaUkkDVwrqSBpTEkkDVwpJIOJFJJVHE0pJIGpJJIP/2Q=="
                            class="card-img-top" style="height: 230px; object-fit: cover;" alt="Tin tức 1">

                        <div class="card-body">
                            <small class="text-muted">
                                <i class="fas fa-calendar-alt me-1"></i>
                                22/05/2026
                            </small>

                            <h5 class="fw-bold mt-2">
                                Top Hoodie Hot Nhất Mùa Hè 2026
                            </h5>

                            <p class="text-muted small">
                                Những mẫu hoodie local brand đang được giới trẻ yêu thích với thiết kế oversize và tone
                                màu cực trendy.
                            </p>

                            <a href="#" class="text-dark fw-bold text-decoration-none">
                                Xem thêm <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden">

                        <img src="data:image/jpeg;base64,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"
                            class="card-img-top" style="height: 230px; object-fit: cover;" alt="Tin tức 2">

                        <div class="card-body">
                            <small class="text-muted">
                                <i class="fas fa-calendar-alt me-1"></i>
                                20/05/2026
                            </small>

                            <h5 class="fw-bold mt-2">
                                Cách Phối Jeans Theo Style Streetwear
                            </h5>

                            <p class="text-muted small">
                                Gợi ý các outfit đơn giản nhưng cực chất giúp bạn phối quần jeans với hoodie và sneaker
                                chuẩn fashion.
                            </p>

                            <a href="#" class="text-dark fw-bold text-decoration-none">
                                Xem thêm <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden">

                        <img src="data:image/jpeg;base64,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"
                            class="card-img-top" style="height: 230px; object-fit: cover;" alt="Tin tức 3">

                        <div class="card-body">
                            <small class="text-muted">
                                <i class="fas fa-calendar-alt me-1"></i>
                                18/05/2026
                            </small>

                            <h5 class="fw-bold mt-2">
                                Những Mẫu Áo Thun Được Giới Trẻ Săn Đón
                            </h5>

                            <p class="text-muted small">
                                Áo thun form rộng với thiết kế basic đang trở thành xu hướng thời trang được nhiều bạn
                                trẻ yêu thích hiện nay.
                            </p>

                            <a href="#" class="text-dark fw-bold text-decoration-none">
                                Xem thêm <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>