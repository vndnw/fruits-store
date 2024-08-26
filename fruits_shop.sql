-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 26, 2024 lúc 08:23 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `fruits_shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `email`, `phone`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'admin@example.com', '0123456789');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Trái cây nội địa', 'Trái cây tươi từ các vùng miền trong nước');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `customer_address` text NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','processed','shipped','delivered','canceled') NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `email` varchar(255) NOT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `customer_phone`, `customer_address`, `order_date`, `status`, `total_amount`, `email`, `note`) VALUES
(1, 'Nguyễn Văn A', '0987654321', '123 Đường ABC, TP.HCM', '2024-08-01 10:00:00', 'delivered', 75000.00, 'nguyenvana@gmail.com', 'Cho tôi cái non'),
(2, 'Võ Ngọc Duy', '0123456789', '70 Tô Ký, Phường Tân Chánh Hiệp, Quận 12, Tp.HCM', '0000-00-00 00:00:00', 'pending', 390.00, '', 'giao sớm cho em nha'),
(3, 'Võ Ngọc Duy', '0123456789', '70 Tô Ký, Phường Tân Chánh Hiệp, Quận 12, Tp.HCM', '0000-00-00 00:00:00', 'pending', 390.00, '2251120143@ut.edu.vn', 'Ghi chú gì đó'),
(4, 'Võ Ngọc Duy', '0123456789', '70 Tô Ký, Phường Tân Chánh Hiệp, Quận 12, Tp.HCM', '0000-00-00 00:00:00', 'pending', 390.00, '2251120143@ut.edu.vn', 'Ghi chú gì đó'),
(5, 'Duy Vo', '0123456789', '70 Tô Ký, Phường Tân Chánh Hiệp, Quận 12, Tp.HCM', '0000-00-00 00:00:00', 'pending', 45000.00, '2251120143@ut.edu.vn', 'Ok rồi'),
(6, 'dsfas', '0123456789', '70 Tô Ký, Phường Tân Chánh Hiệp, Quận 12, Tp.HCM', '2024-08-12 15:08:47', 'pending', 225000.00, '2251120143@ut.edu.vn', ''),
(7, 'Duy Vo', '0399517567', '409/40/94/2', '2024-08-12 15:31:38', 'pending', 70000.00, '2251120143@ut.edu.vn', '4324234'),
(8, 'Duy Vo', '54353453245', 'gsdgfs', '2024-08-12 16:53:04', 'pending', 70000.00, '2251120143@ut.edu.vn', ''),
(9, 'Duy Vo', '54353453245', 'gsdgfs', '2024-08-12 21:29:06', 'pending', 275000.00, '2251120143@ut.edu.vn', 'fsdafdsfasdasdsdf'),
(10, '', '', '', '2024-08-25 16:48:25', 'pending', 150000.00, '', ''),
(11, '', '', '', '2024-08-25 16:56:19', 'pending', 150000.00, '', ''),
(12, 'fd', 'df', 'df', '2024-08-25 16:59:39', 'pending', 60000.00, 'df@ut.edu.vn', ''),
(13, 'test', 'df', 'df', '2024-08-25 19:52:56', 'pending', 385000.00, 'df@ut.edu.vn', 'ok');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 1, 2, 60000.00),
(2, 1, 2, 1, 50000.00),
(3, 4, 3, 1, 40000.00),
(4, 4, 9, 6, 40000.00),
(5, 4, 7, 8, 10000.00),
(6, 5, 5, 1, 15000.00),
(7, 6, 5, 1, 15000.00),
(8, 6, 6, 6, 30000.00),
(9, 7, 9, 1, 40000.00),
(10, 8, 3, 1, 40000.00),
(11, 9, 2, 1, 45000.00),
(12, 9, 9, 5, 40000.00),
(13, 11, 5, 1, 15000.00),
(14, 11, 8, 3, 35000.00),
(15, 12, 5, 2, 15000.00),
(16, 13, 8, 1, 35000.00),
(17, 13, 9, 1, 40000.00),
(18, 13, 12, 2, 15000.00),
(19, 13, 14, 1, 25000.00),
(20, 13, 15, 1, 35000.00),
(21, 13, 16, 3, 55000.00),
(22, 13, 17, 1, 25000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_vouchers`
--

CREATE TABLE `order_vouchers` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `voucher_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_vouchers`
--

INSERT INTO `order_vouchers` (`id`, `order_id`, `voucher_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `old_price` decimal(10,2) DEFAULT NULL,
  `current_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `image`, `old_price`, `current_price`) VALUES
(1, 'Cam sành', 'Cam tươi ngon từ miền Tây', 1, 'uploads/products/cam-sanh.jpg', 30000.00, 25000.00),
(2, 'Táo Đà Lạt', 'Táo được trồng ở Đà Lạt, giòn và ngọt', 1, 'uploads/products/tao-da-lat.jpg', 50000.00, 45000.00),
(3, 'Xoài cát Hòa Lộc', 'Xoài cát Hòa Lộc thơm ngon, ngọt lịm', 1, 'uploads/products/xoai-cat-hoa-loc.jpg', 45000.00, 40000.00),
(4, 'Bưởi da xanh', 'Bưởi da xanh từ Bến Tre, mọng nước', 1, 'uploads/products/buoi-da-xanh.jpg', 60000.00, 55000.00),
(5, 'Dưa hấu', 'Dưa hấu ngọt mát từ Long An', 1, 'uploads/products/dua-hau.jpg', 20000.00, 15000.00),
(6, 'Mít Thái', 'Mít Thái thơm ngon, ngọt lịm', 1, 'uploads/products/mit-thai.jpg', 35000.00, 30000.00),
(7, 'Chuối tiêu', 'Chuối tiêu từ miền Nam, ngọt và thơm', 1, 'uploads/products/chuoi-tieu.jpg', 15000.00, 10000.00),
(8, 'Nhãn lồng Hưng Yên', 'Nhãn lồng Hưng Yên, ngọt và thơm', 1, 'uploads/products/nhan-long.jpg', 40000.00, 35000.00),
(9, 'Vải thiều Lục Ngạn', 'Vải thiều Lục Ngạn, ngọt và mọng nước', 1, 'uploads/products/vai-thieu.jpg', 45000.00, 40000.00),
(10, 'Mận hậu', 'Mận hậu từ Sơn La, giòn và ngọt', 1, 'uploads/products/man-hau.jpg', 30000.00, 25000.00),
(11, 'Dừa xiêm', 'Dừa xiêm từ Bến Tre, nước ngọt và thơm', 1, 'uploads/products/dua-xiem.jpg', 25000.00, 20000.00),
(12, 'Ổi lê', 'Ổi lê từ miền Bắc, giòn và ngọt', 1, 'uploads/products/oi-le.jpg', 20000.00, 15000.00),
(13, 'Thanh long', 'Thanh long ruột đỏ từ Bình Thuận', 1, 'uploads/products/thanh-long.jpg', 35000.00, 30000.00),
(14, 'Chôm chôm', 'Chôm chôm từ miền Tây, ngọt và mọng nước', 1, 'uploads/products/chom-chom.jpg', 30000.00, 25000.00),
(15, 'Mãng cầu xiêm', 'Mãng cầu xiêm từ miền Nam, ngọt và thơm', 1, 'uploads/products/mang-cau-xiem.jpg', 40000.00, 35000.00),
(16, 'Dâu tây Đà Lạt', 'Dâu tây Đà Lạt, ngọt và mọng nước', 1, 'uploads/products/dau-tay.jpg', 60000.00, 55000.00),
(17, 'Quýt đường', 'Quýt đường từ miền Tây, ngọt và thơm', 1, 'uploads/products/quyt-duong.jpg', 30000.00, 25000.00),
(18, 'Lê ki ma', 'Lê ki ma từ miền Nam, ngọt và thơm', 1, 'uploads/products/le-ki-ma.jpg', 35000.00, 30000.00),
(19, 'Sầu riêng', 'Sầu riêng từ miền Tây, thơm và béo', 1, 'uploads/products/sau-rieng.jpg', 70000.00, 65000.00),
(20, 'Măng cụt', 'Măng cụt từ miền Tây, ngọt và thơm', 1, 'uploads/products/mang-cut.jpg', 50000.00, 45000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vouchers`
--

CREATE TABLE `vouchers` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `discount_percentage` decimal(5,2) NOT NULL,
  `valid_from` datetime NOT NULL,
  `valid_to` datetime NOT NULL,
  `status` enum('active','expired','used') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `vouchers`
--

INSERT INTO `vouchers` (`id`, `code`, `description`, `discount_percentage`, `valid_from`, `valid_to`, `status`) VALUES
(1, 'SUMMER2024', 'Giảm giá 10% cho đơn hàng trong mùa hè', 10.00, '2024-06-01 00:00:00', '2024-08-31 00:00:00', 'active'),
(2, 'WELCOME', 'Giảm giá 15% cho đơn hàng đầu tiên', 15.00, '2024-01-01 00:00:00', '2024-12-31 00:00:00', 'active');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `order_vouchers`
--
ALTER TABLE `order_vouchers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `voucher_id` (`voucher_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `order_vouchers`
--
ALTER TABLE `order_vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `order_vouchers`
--
ALTER TABLE `order_vouchers`
  ADD CONSTRAINT `order_vouchers_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_vouchers_ibfk_2` FOREIGN KEY (`voucher_id`) REFERENCES `vouchers` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
