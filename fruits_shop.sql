-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 27, 2024 lúc 04:31 AM
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
(13, 'test', 'df', 'df', '2024-08-25 19:52:56', 'pending', 385000.00, 'df@ut.edu.vn', 'ok'),
(14, 'test', 'df', 'df', '2024-08-26 13:59:12', 'pending', 210000.00, 'df@ut.edu.vn', 'd'),
(15, 'test', 'df', 'df', '2024-08-26 13:59:54', 'pending', 210000.00, 'df@ut.edu.vn', 'd'),
(16, 'test', 'df', 'df', '2024-08-26 14:01:07', 'pending', 85000.00, 'df@ut.edu.vn', ''),
(17, 'Duy Vo', '0399517567', '409/40/94/2', '2024-08-26 14:02:14', 'pending', 40000.00, '2251120143@ut.edu.vn', ''),
(18, 'Duy Vo', '0399517567', '409/40/94/2', '2024-08-26 17:44:37', 'pending', 110000.00, '2251120143@ut.edu.vn', '5:44'),
(19, 'Duy Vo', '0399517567', '409/40/94/2', '2024-08-26 17:47:23', 'pending', 110000.00, '2251120143@ut.edu.vn', '5:44'),
(20, 'Duy Vo', '0399517567', '409/40/94/2', '2024-08-26 17:48:41', 'pending', 85000.00, '2251120143@ut.edu.vn', ''),
(21, 'Duy Vo', '0399517567', '409/40/94/2', '2024-08-26 17:51:26', 'pending', 110000.00, '2251120143@ut.edu.vn', ''),
(22, 'Duy Vo', '0399517567', '409/40/94/2', '2024-08-26 17:54:58', 'pending', 80000.00, '2251120143@ut.edu.vn', ''),
(23, 'Duy Vo', '0399517567', '409/40/94/2', '2024-08-26 17:57:36', 'pending', 100000.00, '2251120143@ut.edu.vn', ''),
(24, 'Duy Vo', '0399517567', '409/40/94/2', '2024-08-26 18:00:40', 'pending', 105000.00, '2251120143@ut.edu.vn', ''),
(25, 'Duy Vo', '0399517567', '409/40/94/2', '2024-08-26 18:24:49', 'pending', 530000.00, '2251120143@ut.edu.vn', ''),
(26, 'Duy Vo', '0399517567', '409/40/94/2', '2024-08-26 18:29:06', 'pending', 500000.00, '2251120143@ut.edu.vn', ''),
(27, 'Duy Vo', '0399517567', '409/40/94/2', '2024-08-26 19:00:20', 'pending', 500000.00, '2251120143@ut.edu.vn', ''),
(28, 'Duy Vo', '0399517567', '409/40/94/2', '2024-08-26 19:03:11', 'pending', 100000.00, '2251120143@ut.edu.vn', ''),
(29, 'Duy Vo', '0399517567', '409/40/94/2', '2024-08-26 19:06:30', 'pending', 500000.00, '2251120143@ut.edu.vn', ''),
(30, 'Duy Vo', '0399517567', '409/40/94/2', '2024-08-26 19:25:19', 'pending', 40000000.00, '2251120143@ut.edu.vn', ''),
(31, 'Duy Vo', '0399517567', '409/40/94/2', '2024-08-26 19:30:45', 'pending', 2500000.00, '2251120143@ut.edu.vn', ''),
(32, 'Duy Vo', '0399517567', '409/40/94/2', '2024-08-26 19:33:29', 'pending', 75000.00, '2251120143@ut.edu.vn', ''),
(33, 'Duy Vo', '0399517567', '409/40/94/2', '2024-08-26 19:37:26', 'pending', 25000000.00, '2251120143@ut.edu.vn', ''),
(34, 'Duy Vo', '0399517567', '409/40/94/2', '2024-08-26 19:39:31', 'pending', 55000.00, '2251120143@ut.edu.vn', ''),
(35, 'Duy Vo', '0399517567', '409/40/94/2', '2024-08-26 19:41:29', 'pending', 55000.00, '2251120143@ut.edu.vn', ''),
(36, 'Duy Vo', '0399517567', '409/40/94/2', '2024-08-26 19:47:56', 'pending', 55000.00, '2251120143@ut.edu.vn', ''),
(37, 'Duy Vo', '0399517567', '409/40/94/2', '2024-08-26 19:58:04', 'pending', 60000.00, '2251120143@ut.edu.vn', '');

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
(22, 13, 17, 1, 25000.00),
(23, 14, 1, 2, 25000.00),
(24, 14, 3, 1, 40000.00),
(25, 14, 13, 3, 30000.00),
(26, 16, 4, 1, 55000.00),
(27, 17, 7, 1, 10000.00),
(28, 18, 1, 1, 25000.00),
(29, 18, 2, 1, 45000.00),
(30, 18, 7, 1, 10000.00),
(31, 20, 5, 2, 15000.00),
(32, 20, 10, 1, 25000.00),
(33, 21, 9, 1, 40000.00),
(34, 21, 11, 2, 20000.00),
(35, 22, 7, 1, 10000.00),
(36, 22, 9, 1, 40000.00),
(37, 23, 1, 1, 25000.00),
(38, 23, 2, 1, 45000.00),
(39, 24, 3, 1, 40000.00),
(40, 24, 8, 1, 35000.00),
(41, 25, 8, 10, 35000.00),
(42, 25, 12, 10, 15000.00),
(43, 26, 7, 50, 10000.00),
(44, 27, 7, 50, 10000.00),
(45, 28, 1, 1, 25000.00),
(46, 28, 2, 1, 45000.00),
(47, 29, 7, 50, 10000.00),
(48, 30, 3, 1000, 40000.00),
(49, 31, 17, 100, 25000.00),
(50, 32, 20, 1, 45000.00),
(51, 33, 17, 1000, 25000.00),
(52, 34, 1, 1, 25000.00),
(53, 35, 1, 1, 25000.00),
(54, 36, 1, 1, 25000.00),
(55, 37, 6, 1, 30000.00);

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
(1, 'Cam sành 1kg', 'Cam sành là loại trái cây phổ biến tại miền Tây Nam Bộ, nổi tiếng với vị ngọt đậm đà và hương thơm dễ chịu. Cam sành không chỉ mang lại giá trị dinh dưỡng cao mà còn chứa nhiều vitamin C, tốt cho sức khỏe và hệ miễn dịch. Với lớp vỏ dày màu xanh đậm, cam sành có thể bảo quản trong thời gian dài mà vẫn giữ được độ tươi ngon. Đây là loại trái cây lý tưởng cho những ngày nắng nóng, giúp giải nhiệt và cung cấp năng lượng. Cam sành thường được dùng để ép nước hoặc ăn trực tiếp, là món quà thiên nhiên tuyệt vời mà bạn không nên bỏ qua.', 1, 'uploads/products/cam-sanh.jpg', 30000.00, 25000.00),
(2, 'Táo Đà Lạt 1kg', 'Táo Đà Lạt là một trong những đặc sản nổi tiếng của vùng cao nguyên Lâm Đồng. Với khí hậu mát mẻ quanh năm, Đà Lạt là nơi lý tưởng để trồng táo với chất lượng tuyệt hảo. Táo Đà Lạt có vỏ mỏng, màu đỏ tươi, vị ngọt thanh, giòn tan trong miệng. Loại táo này không chỉ hấp dẫn bởi hương vị thơm ngon mà còn giàu dinh dưỡng, chứa nhiều vitamin A, C, và các chất chống oxy hóa có lợi cho sức khỏe. Táo Đà Lạt là lựa chọn hoàn hảo cho bữa ăn nhẹ hoặc làm quà biếu, đem lại sự tươi mát và dinh dưỡng cho mọi người.', 1, 'uploads/products/tao-da-lat.jpg', 50000.00, 45000.00),
(3, 'Xoài cát Hòa Lộc 1kg', 'Xoài cát Hòa Lộc là một loại trái cây nổi tiếng của miền Nam Việt Nam, được ưa chuộng bởi vị ngọt thanh, thịt quả mềm mại và hương thơm đặc trưng. Xoài cát Hòa Lộc không chỉ ngon mà còn giàu dinh dưỡng, chứa nhiều vitamin và khoáng chất cần thiết cho cơ thể. Với lớp vỏ mỏng, màu vàng óng ánh, xoài cát Hòa Lộc là sự lựa chọn hoàn hảo cho những ai yêu thích trái cây tươi ngon, bổ dưỡng. Đây cũng là loại trái cây thường được dùng để làm sinh tố, nước ép, hay ăn trực tiếp, mang lại sự tươi mát và hương vị độc đáo.', 1, 'uploads/products/xoai-cat-hoa-loc.jpg', 45000.00, 40000.00),
(4, 'Bưởi da xanh 1 trái', 'Bưởi da xanh là một loại trái cây có nguồn gốc từ tỉnh Bến Tre, nơi nổi tiếng với các loại trái cây chất lượng cao. Bưởi da xanh có lớp vỏ mỏng, màu xanh tươi mát, và thịt quả mọng nước, ngọt thanh. Đây là loại trái cây không chỉ có hương vị tuyệt vời mà còn chứa nhiều chất dinh dưỡng quan trọng, bao gồm vitamin C và chất xơ, tốt cho sức khỏe và hệ tiêu hóa. Bưởi da xanh thường được dùng trong các món salad, nước ép, hoặc ăn trực tiếp, mang lại sự tươi mát và dinh dưỡng cho cơ thể.', 1, 'uploads/products/buoi-da-xanh.jpg', 60000.00, 55000.00),
(5, 'Dưa hấu 1 trái', 'Dưa hấu là loại trái cây phổ biến tại Việt Nam, đặc biệt là trong những ngày hè nóng bức. Dưa hấu có lớp vỏ xanh mướt, thịt quả màu đỏ rực rỡ, mọng nước và vị ngọt thanh. Loại trái cây này không chỉ ngon mà còn chứa nhiều nước và vitamin, giúp giải khát và bổ sung năng lượng nhanh chóng. Dưa hấu thường được dùng để làm sinh tố, nước ép, hoặc ăn trực tiếp, là món tráng miệng lý tưởng cho mọi người. Với hương vị tươi mát và lợi ích sức khỏe, dưa hấu là lựa chọn hoàn hảo cho những ngày nắng nóng.', 1, 'uploads/products/dua-hau.jpg', 20000.00, 15000.00),
(6, 'Mít Thái 1kg', 'Mít Thái là loại trái cây đặc sản của vùng nhiệt đới, nổi bật với hương vị ngọt ngào và mùi thơm đặc trưng. Mít Thái có kích thước lớn, lớp vỏ dày màu vàng, chứa nhiều múi quả mọng nước và ngọt lịm. Mít Thái không chỉ hấp dẫn bởi hương vị mà còn giàu chất dinh dưỡng, bao gồm vitamin A, C, và các chất xơ có lợi cho hệ tiêu hóa. Loại trái cây này thường được ăn trực tiếp hoặc chế biến thành các món ăn vặt như mít sấy, chè mít, tạo nên sự đa dạng trong ẩm thực Việt Nam.', 1, 'uploads/products/mit-thai.jpg', 35000.00, 30000.00),
(7, 'Chuối tiêu 1 nải', 'Chuối tiêu là một loại trái cây quen thuộc với người Việt Nam, đặc biệt là tại các vùng quê. Chuối tiêu có vỏ mỏng, màu vàng tươi, và hương vị ngọt thanh, mềm mại. Đây là loại trái cây giàu dinh dưỡng, chứa nhiều kali, vitamin B6, và chất xơ, tốt cho hệ tiêu hóa và tim mạch. Chuối tiêu thường được dùng trong bữa sáng, làm món tráng miệng hoặc chế biến thành các món ăn như bánh chuối, chè chuối, tạo nên sự phong phú và đa dạng trong ẩm thực Việt Nam.', 1, 'uploads/products/chuoi-tieu.jpg', 15000.00, 10000.00),
(8, 'Nhãn lồng Hưng Yên 1kg', 'Nhãn lồng Hưng Yên là một trong những đặc sản nổi tiếng của vùng đồng bằng Bắc Bộ, Việt Nam. Nhãn lồng có lớp vỏ mỏng, màu nâu nhạt, và thịt quả trắng trong, giòn ngọt. Đây là loại trái cây được nhiều người yêu thích bởi hương vị thơm ngon, thanh mát và giá trị dinh dưỡng cao. Nhãn lồng chứa nhiều vitamin C và chất xơ, có lợi cho sức khỏe và hệ tiêu hóa. Nhãn lồng thường được dùng để ăn trực tiếp, làm mứt, hoặc chế biến thành các món tráng miệng, mang lại sự tươi mát và ngon miệng cho mọi người.', 1, 'uploads/products/nhan-long.jpg', 40000.00, 35000.00),
(9, 'Vải thiều Lục Ngạn 1kg', 'Vải thiều Lục Ngạn là loại trái cây đặc sản của vùng đất Lục Ngạn, tỉnh Bắc Giang. Vải thiều có vỏ mỏng, màu đỏ tươi, và thịt quả trắng ngà, mọng nước, ngọt lịm. Đây là loại trái cây không chỉ ngon mà còn giàu chất dinh dưỡng, đặc biệt là vitamin C, tốt cho sức khỏe và hệ miễn dịch. Vải thiều thường được dùng để ăn trực tiếp, làm mứt, hoặc chế biến thành các món ăn như chè, sinh tố, đem lại hương vị đặc trưng và hấp dẫn. Vải thiều Lục Ngạn là niềm tự hào của người dân nơi đây và là món quà thiên nhiên quý giá.', 1, 'uploads/products/vai-thieu.jpg', 45000.00, 40000.00),
(10, 'Mận hậu 1kg', 'Mận hậu là một loại trái cây đặc sản của vùng Sơn La, nơi có khí hậu mát mẻ quanh năm. Mận hậu có lớp vỏ mỏng, màu tím đậm, thịt quả giòn, ngọt thanh và hương thơm dễ chịu. Đây là loại trái cây giàu dinh dưỡng, chứa nhiều vitamin C và chất xơ, tốt cho sức khỏe và hệ tiêu hóa. Mận hậu thường được dùng để ăn trực tiếp, làm mứt, hoặc chế biến thành các món ăn nhẹ, mang lại sự tươi mát và bổ dưỡng cho cơ thể. Mận hậu là lựa chọn hoàn hảo cho những ai yêu thích trái cây giòn ngọt và giàu dinh dưỡng.', 1, 'uploads/products/man-hau.jpg', 30000.00, 25000.00),
(11, 'Dừa xiêm 1 trái', 'Dừa xiêm là loại trái cây đặc sản của tỉnh Bến Tre, nơi nổi tiếng với các loại dừa chất lượng cao. Dừa xiêm có kích thước nhỏ, lớp vỏ mỏng màu xanh tươi, nước dừa ngọt lịm và thơm mát. Đây là loại trái cây lý tưởng để giải khát trong những ngày hè nắng nóng, đồng thời cung cấp nhiều dưỡng chất cần thiết cho cơ thể như kali, vitamin C, và các chất điện giải. Dừa xiêm thường được dùng để uống trực tiếp hoặc chế biến thành các món ăn như thạch dừa, sinh tố, mang lại hương vị thơm ngon và bổ dưỡng.', 1, 'uploads/products/dua-xiem.jpg', 25000.00, 20000.00),
(12, 'Ổi lê 1kg', 'Ổi lê là một loại trái cây quen thuộc với người dân Việt Nam, đặc biệt là tại các vùng quê miền Bắc. Ổi lê có lớp vỏ mỏng màu xanh nhạt, thịt quả giòn, ngọt thanh và hương thơm dễ chịu. Đây là loại trái cây giàu dinh dưỡng, chứa nhiều vitamin C và chất xơ, tốt cho sức khỏe và hệ tiêu hóa. Ổi lê thường được dùng để ăn trực tiếp, làm sinh tố, hoặc chế biến thành các món ăn nhẹ, mang lại sự tươi mát và bổ dưỡng cho cơ thể. Ổi lê là lựa chọn hoàn hảo cho những ai yêu thích trái cây giòn ngọt và tươi mát.', 1, 'uploads/products/oi-le.jpg', 20000.00, 15000.00),
(13, 'Thanh long ruột đỏ 1kg', 'Thanh long ruột đỏ là một trong những loại trái cây đặc sản của Bình Thuận, nổi bật với hình dáng độc đáo và màu sắc bắt mắt. Thanh long có lớp vỏ màu đỏ tươi, thịt quả bên trong màu đỏ rực, hạt đen nhỏ li ti và có vị ngọt thanh, giòn mát. Đây là loại trái cây không chỉ ngon mà còn chứa nhiều vitamin C, chất chống oxy hóa và chất xơ, giúp cải thiện sức khỏe và tăng cường hệ miễn dịch. Thanh long ruột đỏ thường được ăn trực tiếp, làm sinh tố, hoặc chế biến thành các món tráng miệng hấp dẫn, mang lại sự tươi mới và bổ dưỡng.', 1, 'uploads/products/thanh-long.jpg', 35000.00, 30000.00),
(14, 'Chôm chôm 1kg', 'Chôm chôm là một loại trái cây đặc sản của miền Tây Nam Bộ, nổi bật với lớp vỏ đỏ tươi và các sợi nhỏ nhô ra giống như tóc. Chôm chôm có thịt quả màu trắng, giòn ngọt, và hương thơm dễ chịu. Đây là loại trái cây không chỉ hấp dẫn về mặt hình thức mà còn giàu dinh dưỡng, chứa nhiều vitamin C và các khoáng chất cần thiết cho cơ thể. Chôm chôm thường được dùng để ăn trực tiếp hoặc làm mứt, tạo nên món quà thiên nhiên tuyệt vời cho những ai yêu thích trái cây ngọt mát và bổ dưỡng.', 1, 'uploads/products/chom-chom.jpg', 30000.00, 25000.00),
(15, 'Mãng cầu xiêm 1kg', 'Mãng cầu xiêm là một loại trái cây đặc sản của miền Nam, nổi bật với vị ngọt thanh và hương thơm quyến rũ. Mãng cầu xiêm có lớp vỏ màu xanh nhạt, thịt quả bên trong màu trắng, mềm mại và mọng nước. Đây là loại trái cây giàu vitamin C, chất xơ và các khoáng chất quan trọng, có lợi cho sức khỏe và hệ tiêu hóa. Mãng cầu xiêm thường được ăn trực tiếp, làm sinh tố, hoặc chế biến thành các món ăn nhẹ, mang lại sự tươi mát và dinh dưỡng cho cơ thể. Đây là lựa chọn tuyệt vời cho những ai yêu thích trái cây ngọt và bổ dưỡng.', 1, 'uploads/products/mang-cau-xiem.jpg', 40000.00, 35000.00),
(16, 'Dâu tây Đà Lạt 1kg', 'Dâu tây Đà Lạt là một trong những loại trái cây nổi tiếng của vùng cao nguyên Lâm Đồng, được ưa chuộng bởi hương vị ngọt ngào và màu sắc bắt mắt. Dâu tây Đà Lạt có lớp vỏ màu đỏ tươi, thịt quả ngọt thanh và mọng nước, là món quà thiên nhiên lý tưởng cho những ai yêu thích trái cây tươi ngon và bổ dưỡng. Đây là loại trái cây chứa nhiều vitamin C và chất chống oxy hóa, có lợi cho sức khỏe và hệ miễn dịch. Dâu tây Đà Lạt thường được dùng để ăn trực tiếp, làm sinh tố, hoặc chế biến thành các món tráng miệng hấp dẫn.', 1, 'uploads/products/dau-tay.jpg', 60000.00, 55000.00),
(17, 'Quýt đường 1kg', 'Quýt đường là loại trái cây đặc sản của miền Tây Nam Bộ, nổi bật với vị ngọt thanh và hương thơm dễ chịu. Quýt đường có lớp vỏ màu vàng sáng, thịt quả mọng nước và hương vị tươi mát, mang lại cảm giác giải khát tuyệt vời. Đây là loại trái cây giàu vitamin C và chất xơ, tốt cho sức khỏe và hệ tiêu hóa. Quýt đường thường được dùng để ăn trực tiếp, làm nước ép, hoặc chế biến thành các món tráng miệng, là lựa chọn hoàn hảo cho những ngày hè nóng bức.', 1, 'uploads/products/quyt-duong.jpg', 30000.00, 25000.00),
(18, 'Lê ki ma 1kg', 'Lê ki ma là một loại trái cây đặc sản của miền Nam Việt Nam, nổi bật với vị ngọt thanh và hương thơm dễ chịu. Lê ki ma có lớp vỏ mỏng màu vàng nhạt, thịt quả giòn và mọng nước. Đây là loại trái cây giàu vitamin C và chất xơ, tốt cho sức khỏe và hệ tiêu hóa. Lê ki ma thường được ăn trực tiếp hoặc chế biến thành các món ăn nhẹ, đem lại sự tươi mát và dinh dưỡng cho cơ thể. Đây là lựa chọn lý tưởng cho những ai yêu thích trái cây giòn ngọt và bổ dưỡng.', 1, 'uploads/products/le-ki-ma.jpg', 35000.00, 30000.00),
(19, 'Sầu riêng 1kg', 'Sầu riêng là một trong những loại trái cây nổi tiếng và đặc biệt của miền Tây Nam Bộ, nổi bật với mùi thơm mạnh mẽ và vị ngọt béo. Sầu riêng có lớp vỏ dày, màu xanh nâu, và thịt quả vàng óng ánh, mềm mại, có hương vị ngọt lịm và béo ngậy. Đây là loại trái cây chứa nhiều vitamin C, chất xơ, và các khoáng chất cần thiết cho cơ thể. Sầu riêng thường được ăn trực tiếp hoặc chế biến thành các món ăn như kem sầu riêng, chè sầu riêng, mang lại sự phong phú và độc đáo trong ẩm thực.', 1, 'uploads/products/sau-rieng.jpg', 70000.00, 65000.00),
(20, 'Măng cụt 1kg', 'Măng cụt là loại trái cây đặc sản của miền Tây Nam Bộ, nổi bật với lớp vỏ màu tím đậm và thịt quả trắng ngọt. Măng cụt có hương vị ngọt thanh, mềm mại và hơi chua nhẹ, đem lại cảm giác tươi mát và bổ dưỡng. Đây là loại trái cây chứa nhiều vitamin C và chất chống oxy hóa, tốt cho sức khỏe và hệ miễn dịch. Măng cụt thường được ăn trực tiếp hoặc chế biến thành các món tráng miệng, mang lại sự tươi mới và hương vị đặc trưng cho ẩm thực Việt Nam.', 1, 'uploads/products/mang-cut.jpg', 50000.00, 45000.00);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

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
