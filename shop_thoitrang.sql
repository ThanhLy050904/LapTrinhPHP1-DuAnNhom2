-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th6 01, 2026 lúc 06:10 AM
-- Phiên bản máy phục vụ: 8.0.44
-- Phiên bản PHP: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shop_thoitrang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int NOT NULL,
  `cart_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `size` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`) VALUES
(1, 'Áo Thun', 'ao-thun', '2026-05-18 12:31:04'),
(2, 'Quần Jeans', 'quan-jeans', '2026-05-18 12:31:04'),
(3, 'Hoodie', 'hoodie', '2026-05-18 12:31:04'),
(4, 'Áo Khoác', 'ao-khoac', '2026-05-18 12:31:04'),
(5, 'Quần Short', 'quan-short', '2026-05-18 12:31:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `total_price` int DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `size` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int DEFAULT NULL,
  `old_price` int DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `category_id` int DEFAULT NULL,
  `is_sale` tinyint DEFAULT '0',
  `is_hot` tinyint DEFAULT '0',
  `image_main` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `price`, `old_price`, `description`, `category_id`, `is_sale`, `is_hot`, `image_main`, `created_at`, `updated_at`) VALUES
(1, 'Áo Thun Đen', 'ao-thun-den', 350000, 450000, 'Áo thun local brand form rộng', 1, 1, 1, 'aothun1.webp', '2026-05-27 12:38:33', '2026-05-27 12:38:33'),
(2, 'Áo Thun Trắng', 'ao-thun-trang', 350000, 450000, 'Áo thun local brand form rộng', 1, 1, 0, 'aothuntrang.webp', '2026-05-27 12:38:33', '2026-05-27 12:38:33'),
(3, 'Áo Thun Xám', 'ao-thun-xam', 350000, 450000, 'Áo thun local brand form rộng', 1, 1, 0, 'aothunxamchi.webp', '2026-05-27 12:38:33', '2026-05-27 12:38:33'),
(7, 'Áo Khoác Jean Cổ Caro', 'ao-khoac-xanh', 750000, 900000, 'Áo khoác local brand cá tính', 4, 1, 0, 'jacket-blue.webp', '2026-05-27 12:38:33', '2026-05-27 12:51:43'),
(8, 'Quần Jeans Xanh', 'quan-jeans-xanh', 450000, 550000, 'Quần jeans form slim fit', 2, 1, 1, 'jeans-blue.webp', '2026-05-27 12:38:33', '2026-05-27 12:38:33'),
(9, 'Quần Jeans Đen', 'quan-jeans-den', 450000, 550000, 'Quần jeans form slim fit', 2, 1, 0, 'jeans-black.webp', '2026-05-27 12:38:33', '2026-05-27 12:38:33'),
(10, 'Quần Short Đen', 'quan-short-den', 250000, 300000, 'Quần short thoáng mát', 5, 1, 1, 'short-black.webp', '2026-05-27 12:38:33', '2026-05-27 12:46:36'),
(11, 'Quần sort nam cạp cúc', 'quan-short-xam', 250000, 300000, 'Quần short thoáng mát', 5, 1, 0, 'short-gray.webp', '2026-05-27 12:38:33', '2026-05-27 12:55:06'),
(12, 'Hoodie Đen', 'hoodie-den', 550000, 650000, 'Hoodie form rộng streetwear', 3, 1, 1, 'hoodie-black.webp', '2026-05-27 12:40:33', '2026-05-27 12:40:33'),
(13, 'Hoodie Trắng', 'hoodie-trang', 550000, 650000, 'Hoodie form rộng streetwear', 3, 1, 0, 'hoodie-white.webp', '2026-05-27 12:40:33', '2026-05-27 12:40:33'),
(14, 'Hoodie Xám', 'hoodie-xam', 550000, 650000, 'Hoodie form rộng streetwear', 3, 1, 0, 'hoodie-gray.webp', '2026-05-27 12:40:33', '2026-05-27 12:40:33'),
(15, 'Áo Hoodie Oversize Freedom', 'hoodie-oversize-freedom', 590000, 690000, 'Áo hoodie oversize form rộng streetwear cá tính', 3, 1, 1, 'hoodie-Freedom.webp', '2026-05-27 13:14:24', '2026-05-27 13:14:24'),
(16, 'Multi Camo Shark Full Zip Hoodie', 'multi-camo-shark-hoodie', 650000, 750000, 'Hoodie zip cá mập phong cách streetwear', 3, 1, 1, 'shark-1.webp', '2026-05-27 13:14:24', '2026-05-27 13:14:24'),
(17, 'Kids Baby Milo Mixed Fruit Tee', 'baby-milo-mixed-fruit-tee', 320000, 420000, 'Áo thun Baby Milo họa tiết trái cây trẻ trung', 1, 1, 0, 'kids-baby1.webp', '2026-05-27 13:14:24', '2026-05-27 13:14:24'),
(18, 'College Sweat Shorts', 'college-sweat-shorts', 290000, 390000, 'Quần short thể thao College thoải mái', 2, 1, 1, 'College-Sweat1.webp', '2026-05-27 13:14:24', '2026-05-27 13:14:24'),
(19, '1st Camo Shark Sweat Shorts', 'camo-shark-sweat-shorts', 310000, 420000, 'Quần short camo shark streetwear', 2, 1, 1, 'College-Sweat4.webp', '2026-05-27 13:14:24', '2026-05-27 13:14:24'),
(20, 'Áo Khoác Jean Basic', 'ao-khoac-jean-basic', 720000, 850000, 'Áo khoác jean phong cách basic dễ phối đồ', 4, 1, 1, 'khoac-jean1.webp', '2026-05-27 13:14:24', '2026-05-27 13:14:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `full_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `role` enum('user','admin') COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_carts_users` (`user_id`);

--
-- Chỉ mục cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cart_items_carts` (`cart_id`),
  ADD KEY `fk_cart_items_products` (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_users` (`user_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_items_orders` (`order_id`),
  ADD KEY `fk_order_items_products` (`product_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Ràng buộc đối với các bảng kết xuất
--

--
-- Ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `fk_carts_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ràng buộc cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `fk_cart_items_carts` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cart_items_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_order_items_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_order_items_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
