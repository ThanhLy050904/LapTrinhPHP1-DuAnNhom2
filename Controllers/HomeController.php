<?php

class HomeController
{
    protected $productModel;
    protected $categoryModel;

    public function __construct($pdo)
{
    $this->productModel = new ProductModel($pdo);
    $this->categoryModel = new CategoryModel($pdo);
}

    public function index()
    {
        // ================= DANH MỤC (LẤY DB) =================
        $categories = $this->categoryModel->getAll();

        // ================= SẢN PHẨM NỔI BẬT =================
        $featured_products = $this->productModel->getFeaturedProducts();

        // ================= REVIEW (tạm giữ nguyên) =================
        $reviews = [
            [
                'name' => 'Nguyễn Minh',
                'content' => 'Chất lượng sản phẩm cực tốt và form rất đẹp.',
                'avatar' => 'https://randomuser.me/api/portraits/men/32.jpg'
            ],
            [
                'name' => 'Trần Khang',
                'content' => 'Giao hàng nhanh, đóng gói cẩn thận.',
                'avatar' => 'https://randomuser.me/api/portraits/men/45.jpg'
            ],
            [
                'name' => 'Lê Hoàng',
                'content' => 'Mặc lên rất đẹp, đúng style streetwear.',
                'avatar' => 'https://randomuser.me/api/portraits/men/67.jpg'
            ]
        ];

        // ================= TIN TỨC =================
        $news = [
            [
                'title' => 'Xu hướng Local Brand 2026',
                'excerpt' => 'Những phong cách local brand đang hot hiện nay.',
                'image' => 'https://images.unsplash.com/photo-1496747611176-843222e1e57c?q=80&w=1200',
                'date' => '27/05/2026'
            ],
            [
                'title' => '5 cách phối Hoodie cực chất',
                'excerpt' => 'Mix hoodie theo phong cách Hàn Quốc đơn giản.',
                'image' => 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=1200',
                'date' => '25/05/2026'
            ],
            [
                'title' => 'Streetwear đang quay trở lại',
                'excerpt' => 'Phong cách rộng rãi tiếp tục dẫn đầu xu hướng.',
                'image' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?q=80&w=1200',
                'date' => '20/05/2026'
            ]
        ];


        require "Views/pages/home.php";

    }

}