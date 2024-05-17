-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 15, 2024 lúc 11:12 AM
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
-- Cơ sở dữ liệu: `be2_group7`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `abouts`
--

CREATE TABLE `abouts` (
  `id_about` int(11) NOT NULL,
  `question` varchar(250) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `abouts`
--

INSERT INTO `abouts` (`id_about`, `question`, `description`) VALUES
(1, 'Về chúng tôi', 'Thông tin về cửa hàng...'),
(2, 'Liên hệ', 'Thông tin liên hệ...');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `login_time` datetime DEFAULT NULL,
  `logout_time` datetime DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `role`, `created_at`, `updated_at`, `login_time`, `logout_time`, `email`) VALUES
(1, 'user1', 'pass1', 1, '2024-04-04 07:42:32', '2024-04-04 07:42:32', NULL, NULL, NULL),
(2, 'user2', 'pass2', 2, '2024-04-04 07:42:32', '2024-04-04 07:42:32', NULL, NULL, NULL),
(9, 'nguyenanhtuan', '123', 0, '2024-04-08 02:34:42', '2024-04-08 02:34:42', NULL, NULL, 'hoanganhtuan39x@gmail.com'),
(10, 'obito39x', '$2y$10$eBPZKp2L.SL4f2VUK6LoRuyAUYlbx2mviHaZ4qXbqv8aik1Le9U4S', 0, '2024-04-08 09:32:33', '2024-04-08 09:32:33', NULL, NULL, 'hoanganhtuan39x@gmail.com'),
(11, 'nguyenanhtuan', '$2y$10$czhY.hUkmjTLz0ruVETzIedOVLFRRPmfJu.BarAq5SoLDjvuxw5K6', 0, '2024-04-11 22:58:55', '2024-04-11 22:58:55', NULL, NULL, 'nguyenhoangtuananh039@gmail.com'),
(12, 'obito39x', '$2y$10$vP.59kk4lotsZ8iMMEPoAuY1gvW.2D2syja.mZknHfK9PnuSgZbJa', 0, '2024-04-11 23:03:15', '2024-04-11 23:03:15', NULL, NULL, 'Lamvufc37@gmail.com'),
(14, 'Tienduy06112004', '$2y$10$NafRKwD5wsFCH4KuCM0dwOEDdcw12wvexI8XJKkLxSjyzRzCryWPS', 0, '2024-04-14 01:55:00', '2024-05-14 00:42:19', NULL, NULL, 'duyphung344@gmail.com'),
(15, 'Tienduy06112004', '$2y$10$y1WSmPGGS8p30Ud/s.mnBesN4/3OR6UZUY5zYYJXnBM4NHJOrAzVG', 0, '2024-04-14 02:07:45', '2024-04-14 02:07:45', NULL, NULL, 'duyphung344@gmail.com'),
(16, 'Tienduy06112004', '$2y$10$EgzjfKFIKI77GYqVCGZfvOgyrRAjSwCbFgzbjzefLuCcchVrsU3Tm', 0, '2024-04-14 02:09:42', '2024-04-14 02:09:42', NULL, NULL, 'duyphung344@gmail.com'),
(17, 'Tienduy06112004', '$2y$10$dhNCJTaH0TNx2uFMqeFhh.GdnxzDYzL3bqafBV.9XSx3ZY.Q2BO62', 0, '2024-04-14 02:09:45', '2024-04-14 02:09:45', NULL, NULL, 'duyphung344@gmail.com'),
(18, 'Tienduy06112004', '$2y$10$Z638wBIurbOlCbf388yYi.KbrFBCmxI2I1fzlkC85NUa/W6CTe2FC', 0, '2024-04-14 02:10:36', '2024-04-14 02:10:36', NULL, NULL, 'duyphung344@gmail.com'),
(19, 'Tienduy06112004', '$2y$10$PNZSoRSVEhXSc89WVrNiWO47O.WX6VhtGWARjc71GE9fVzD30IyzC', 0, '2024-04-14 02:10:52', '2024-04-14 02:10:52', NULL, NULL, 'duyphung344@gmail.com'),
(20, 'Tienduy06112004', '$2y$10$.dCOn8Do09jG.wZtbdiNW.bJ1f5Y87YiFPlcvJrB.ucV5MumAo4Qa', 0, '2024-04-14 02:11:46', '2024-04-14 02:11:46', NULL, NULL, 'duyphung344@gmail.com'),
(21, 'Tienduy06112004', '$2y$10$.XnkysMgtRv0YaAdRLzeSuuWnbyXNZaKJGFlihVVie6Ht8.NRq90m', 0, '2024-04-14 02:11:53', '2024-04-14 02:11:53', NULL, NULL, 'duyphung344@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blogs`
--

CREATE TABLE `blogs` (
  `id_blog` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `id_user` int(11) NOT NULL,
  `content` varchar(1000) DEFAULT NULL,
  `date_start` datetime DEFAULT current_timestamp(),
  `date_update` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `view_count` int(11) DEFAULT 0,
  `like_count` int(11) DEFAULT 0,
  `comment` varchar(1000) DEFAULT NULL,
  `img` varchar(250) DEFAULT NULL,
  `status` enum('Draft','Published','Archived') DEFAULT 'Draft'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `blogs`
--

INSERT INTO `blogs` (`id_blog`, `title`, `id_user`, `content`, `date_start`, `date_update`, `view_count`, `like_count`, `comment`, `img`, `status`) VALUES
(1, 'Cách làm bánh mỳ', 1, 'Nội dung hướng dẫn cách làm bánh mỳ...', '2024-04-04 14:42:32', '2024-04-04 14:42:32', 100, 10, 'Bài viết rất hay', 'banh_my.jpg', 'Published');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id_category`, `name`) VALUES
(1, 'Food'),
(2, 'Drink'),
(9, 'Hamburger'),
(10, 'Pizza'),
(11, 'Sandwich'),
(12, 'Snack'),
(13, 'Rice'),
(14, 'Dessert'),
(15, 'Noodle'),
(16, 'Side dishes');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `galleries`
--

CREATE TABLE `galleries` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `galleries`
--

INSERT INTO `galleries` (`id`, `image_path`) VALUES
(1, 'image/gallery_1.jpg'),
(2, 'image/gallery_2.jpg'),
(3, 'image/gallery_3.webp'),
(4, 'image/gallery_4.jpg'),
(5, 'image/gallery_5.jpg'),
(6, 'image/gallery_6.jpg'),
(7, 'image/gallery_7.jpg'),
(8, 'image/gallery_8.jpg'),
(9, 'image/gallery_9.webp'),
(10, 'image/gallery_10.jpg'),
(11, 'image/gallery_11.jpg'),
(12, 'image/gallery_12.jpg'),
(13, 'image/gallery_13.jpg'),
(14, 'image/gallery_14.jpg'),
(15, 'image/gallery_15.webp'),
(16, 'image/gallery_16.jpg'),
(17, 'image/gallery_17.jpg'),
(18, 'image/gallery_18.jpg'),
(19, 'image/gallery_19.jpg'),
(20, 'image/gallery_20.jpg'),
(21, 'image/gallery_21.jpg'),
(22, 'image/gallery_22.jpg'),
(23, 'image/gallery_23.jpg'),
(24, 'image/gallery_24.jpg'),
(25, 'image/gallery_25.jpg'),
(26, 'image/gallery_26.jpg'),
(27, 'image/gallery_27.jpg'),
(28, 'image/gallery_28.jpg'),
(29, 'image/gallery_29.jpg'),
(30, 'image/gallery_30.jpg'),
(31, 'image/gallery_31.webp'),
(32, 'image/gallery_32.jpg'),
(33, 'image/gallery_33.jpg'),
(34, 'image/gallery_34.jpg'),
(35, 'image/gallery_35.jpg'),
(36, 'image/gallery_36.jpg'),
(37, 'image/gallery_37.jpg'),
(38, 'image/gallery_38.jpg'),
(39, 'image/gallery_39.jpg'),
(40, 'image/gallery_40.webp'),
(41, 'image/gallery_41.jpg'),
(42, 'image/gallery_42.webp'),
(43, 'image/gallery_43.jpg'),
(44, 'image/gallery_44.webp'),
(45, 'image/gallery_45.jpg'),
(46, 'image/gallery_46.jpg'),
(47, 'image/gallery_47.jpg'),
(48, 'image/gallery_48.jpg'),
(49, 'image/gallery_49.jpg'),
(50, 'image/gallery_50.jpg'),
(51, 'image/gallery_51.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `ward` varchar(100) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_user` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `date_order` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `email`, `fullname`, `phone`, `address`, `city`, `district`, `ward`, `payment_method`, `total_amount`, `created_at`, `id_user`, `status_id`, `date_order`) VALUES
(16, 'duyphung344@gmail.com', 'Phùng Trần Tiến Duy', '0327171253', 'Vĩnh phú 42', 'Tỉnh Bắc Giang', 'Huyện Lục Ngạn', 'Xã Giáp Sơn', 'COD', 360.00, '2024-05-09 13:56:35', NULL, 1, '2024-05-11 08:32:07'),
(17, 'akamary344@gmail.com', 'Phùng Trần Tiến Duy', '0327171253', 'dấdasdsa', 'Tỉnh Hưng Yên', 'Huyện Kim Động', 'Xã Ngọc Thanh', 'COD', 340.00, '2024-05-10 05:40:22', NULL, 1, '2024-05-11 08:32:07'),
(18, 'Duyphung344@gmail.com', 'Phùng Trần Tiến Duy', '0327171253', 'Vĩnh phú 42', 'Tỉnh Bắc Ninh', 'Huyện Gia Bình', 'Xã Đông Cứu', 'COD', 300.00, '2024-05-10 05:48:54', NULL, 3, '2024-05-11 08:32:07'),
(19, 'duyphung344@gmail.com', 'Phùng Trần Tiến Duy', '0327171253', 'Vĩnh phú 42', 'Tỉnh Bình Dương', 'Thành phố Thuận An', 'Phường Vĩnh Phú', 'COD', 406.00, '2024-05-10 06:39:58', 3, 1, '2024-05-11 08:32:07'),
(20, 'akamary344@gmail.com', 'Phùng Trần Tiến Duy', '0327171253', 'Vĩnh phú 42', 'Thành phố Hà Nội', 'Quận Cầu Giấy', 'Phường Mai Dịch', 'COD', 100.00, '2024-05-11 08:03:12', NULL, 3, '2024-05-11 08:32:07'),
(21, 'duyphung344@gmail.com', 'Phùng Trần Tiến Duy', '0327171253', 'Vĩnh phú 42', 'Tỉnh Vĩnh Phúc', 'Huyện Vĩnh Tường', 'Xã Lý Nhân', 'COD', 41.00, '2024-05-11 08:32:38', NULL, 3, '2024-05-11 08:32:38'),
(22, 'duyphung344@gmail.com', 'adadsada', '0327171253', 'dấdasdsa', 'Tỉnh Bắc Ninh', 'Huyện Lương Tài', 'Xã Bình Định', 'COD', 240.00, '2024-05-11 08:39:34', NULL, 3, '2024-05-11 08:39:34'),
(23, 'akamary344@gmail.com', 'Phùng Trần Tiến Duy', '0327171253', 'Vĩnh phú 42', 'Tỉnh Lai Châu', 'Huyện Than Uyên', 'Xã Tà Gia', 'COD', 330.00, '2024-05-11 09:20:20', NULL, 3, '2024-05-11 09:20:20'),
(24, '22211tt2279@mail.tdc.edu.vn', 'Phùng Trần Tiến Duy', '0327171253', 'Vĩnh phú 42', 'Thành phố Hải Phòng', 'Huyện Vĩnh Bảo', 'Xã Vinh Quang', 'COD', 225.00, '2024-05-11 09:23:10', NULL, 3, '2024-05-11 09:23:10'),
(25, 'duyphung344@gmail.com', 'Phùng Trần Tiến Duy', '0327171253', 'Vĩnh phú 42', 'Tỉnh Bắc Ninh', 'Thị xã Từ Sơn', 'Phường Tân Hồng', 'COD', 907.00, '2024-05-14 04:32:27', NULL, 2, '2024-05-14 04:32:27'),
(26, 'duyphung344@gmail.com', 'Phùng Trần Tiến Duy', '0327171253', 'Vĩnh phú 42', 'Tỉnh Bắc Ninh', 'Huyện Lương Tài', 'Xã Phú Lương', 'COD', 41.00, '2024-05-14 04:43:31', NULL, 2, '2024-05-14 04:43:31'),
(27, 'duyphung344@gmail.com', 'Phùng Trần Tiến Duy', '0327171253', 'Vĩnh phú 42', 'Tỉnh Phú Thọ', 'Huyện Thanh Thuỷ', 'Xã Đồng Trung', 'COD', 100.00, '2024-05-14 04:50:53', 3, 1, '2024-05-14 04:50:53'),
(28, 'duyphung344@gmail.com', 'Phùng Trần Tiến Duy', '0327171253', 'Vĩnh phú 42', 'Tỉnh Bắc Ninh', 'Huyện Gia Bình', 'Xã Đông Cứu', 'COD', 170.00, '2024-05-14 04:51:10', 3, 1, '2024-05-14 04:51:10'),
(29, 'duyphung344@gmail.com', 'Phùng Trần Tiến Duy', '0327171253', 'Vĩnh phú 42', 'Tỉnh Bắc Ninh', 'Huyện Yên Phong', 'Xã Long Châu', 'COD', 450.00, '2024-05-14 06:15:38', 3, 1, '2024-05-14 06:15:38'),
(33, 'duyphung344@gmail.com', 'Phùng Trần Tiến Duy', '0327171253', 'Vĩnh phú 42', 'Tỉnh Bắc Ninh', 'Huyện Lương Tài', 'Xã Phú Lương', 'COD', 70.00, '2024-05-14 07:40:29', 3, 1, '2024-05-14 07:40:29'),
(35, 'duyphung344@gmail.com', 'Phùng Trần Tiến Duy', '0327171253', 'Vĩnh phú 42', 'Tỉnh Bắc Ninh', 'Huyện Gia Bình', 'Xã Xuân Lai', 'COD', 170.00, '2024-05-14 07:49:24', 3, 1, '2024-05-14 07:49:24'),
(36, 'duyphung344@gmail.com', 'Phùng Trần Tiến Duy', '0327171253', 'Vĩnh phú 42', 'Tỉnh Bắc Ninh', 'Huyện Yên Phong', 'Xã Văn Môn', 'COD', 170.00, '2024-05-14 08:44:03', 3, 1, '2024-05-14 08:44:03'),
(37, 'duyphung344@gmail.com', 'Phùng Trần Tiến Duy', '0327171253', 'Vĩnh phú 42', 'Tỉnh Bắc Ninh', 'Huyện Quế Võ', 'Xã Chi Lăng', 'COD', 41.00, '2024-05-14 14:02:13', 3, 1, '2024-05-14 14:02:13'),
(38, 'duyphung344@gmail.com', 'Phùng Trần Tiến Duy', '0327171253', 'Vĩnh phú 42', 'Tỉnh Vĩnh Phúc', 'Huyện Yên Lạc', 'Xã Hồng Châu', 'COD', 41.00, '2024-05-14 14:18:08', 3, 1, '2024-05-14 14:18:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(30, 16, 10, 1, 80.00),
(31, 16, 13, 1, 70.00),
(32, 16, 14, 1, 40.00),
(33, 16, 16, 1, 90.00),
(34, 16, 17, 1, 80.00),
(35, 17, 3, 1, 100.00),
(36, 17, 7, 1, 160.00),
(37, 17, 10, 1, 80.00),
(38, 18, 11, 3, 100.00),
(39, 19, 3, 1, 100.00),
(40, 19, 4, 1, 70.00),
(41, 19, 2, 1, 41.00),
(42, 19, 6, 1, 35.00),
(43, 19, 10, 2, 80.00),
(44, 20, 3, 1, 100.00),
(45, 21, 2, 1, 41.00),
(46, 22, 7, 1, 160.00),
(47, 22, 10, 1, 80.00),
(48, 23, 3, 1, 100.00),
(49, 23, 4, 1, 70.00),
(50, 23, 7, 1, 160.00),
(51, 24, 6, 1, 35.00),
(52, 24, 10, 1, 80.00),
(53, 24, 9, 1, 60.00),
(54, 24, 8, 1, 50.00),
(55, 25, 2, 2, 41.00),
(56, 25, 3, 2, 100.00),
(57, 25, 4, 1, 70.00),
(58, 25, 5, 1, 130.00),
(59, 25, 6, 3, 35.00),
(60, 25, 7, 2, 160.00),
(61, 26, 2, 1, 41.00),
(62, 27, 3, 1, 100.00),
(63, 28, 3, 1, 100.00),
(64, 28, 4, 1, 70.00),
(65, 29, 3, 1, 100.00),
(66, 29, 7, 1, 160.00),
(67, 29, 10, 1, 80.00),
(68, 29, 9, 1, 60.00),
(69, 29, 8, 1, 50.00),
(73, 33, 4, 1, 70.00),
(75, 35, 3, 1, 100.00),
(76, 35, 4, 1, 70.00),
(77, 36, 3, 1, 100.00),
(78, 36, 4, 1, 70.00),
(79, 37, 2, 1, 41.00),
(80, 38, 2, 1, 41.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `old_price` decimal(10,2) DEFAULT NULL,
  `new_price` decimal(10,2) DEFAULT NULL,
  `rating` int(3) DEFAULT 1,
  `id_categories` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image_url`, `old_price`, `new_price`, `rating`, `id_categories`) VALUES
(2, 'Drink', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_2.jpg', 50.00, 41.00, 4, 2),
(3, 'Pizza', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_3.png', 120.00, 100.00, 5, 10),
(4, 'Onion Ring', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_4.jpg', 80.00, 70.00, 3, 12),
(5, 'Biryani', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_5.webp', 150.00, 130.00, 4, 13),
(6, 'Potato Chips', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_6.jpg', 40.00, 35.00, 4, 12),
(7, 'Ni', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_7.webp', 180.00, 160.00, 5, 11),
(8, 'Nike', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_8.jpg', 60.00, 50.00, 4, 14),
(9, 'Chocolate', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_9.jpg', 70.00, 60.00, 4, 14),
(10, 'Pasta', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_10.jpg', 90.00, 80.00, 4, 15),
(11, 'Starbucks', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_11.jpg', 110.00, 100.00, 4, 2),
(12, 'Hot Dog', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_12.jpg', 70.00, 60.00, 3, 9),
(13, 'Sandwich', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_13.jpg', 80.00, 70.00, 4, 11),
(14, 'Muffin', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_14.jpg', 50.00, 40.00, 4, 14),
(15, 'Sausage', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_15.jpg', 70.00, 60.00, 3, 14),
(16, 'Cake', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_16.jpg', 100.00, 90.00, 5, 14),
(17, 'Burrito', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_17.jpg', 90.00, 80.00, 4, 11),
(18, 'Bacon', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_18.webp', 80.00, 70.00, 3, 12),
(19, 'Donuts', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_19.jpg', 60.00, 50.00, 4, 14),
(20, 'Noodle', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_20.jpg', 80.00, 70.00, 4, 15),
(21, 'Pancake', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_21.jpg', 60.00, 50.00, 4, 14),
(22, 'Pretzel', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_22.jpg', 40.00, 35.00, 3, 14),
(23, 'Taco', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_23.jpg', 90.00, 80.00, 4, 11),
(24, 'Kottu', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_24.jpg', 70.00, 60.00, 3, 16),
(31, 'dsad', 'dsadas', 'image/blog_3.jpg', 1.00, 1.00, 5, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `reviews`
--

INSERT INTO `reviews` (`id`, `order_id`, `comment`, `rating`, `created_at`, `updated_at`) VALUES
(1, 35, 'ngon', 3, '2024-05-14 01:27:54', '2024-05-14 01:27:54'),
(2, 36, 'tệ', 1, '2024-05-14 01:44:28', '2024-05-14 01:44:28'),
(3, 37, 'tuyệt vời', 4, '2024-05-14 07:02:54', '2024-05-14 07:02:54'),
(4, 38, 'tệ', 1, '2024-05-14 07:18:27', '2024-05-14 07:18:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Completed'),
(2, 'Pending'),
(3, 'Process');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `id_account` int(11) NOT NULL,
  `username` varchar(250) DEFAULT NULL,
  `fullname` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `gender` varchar(3) DEFAULT NULL,
  `date_user` date DEFAULT NULL,
  `img` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `id_account`, `username`, `fullname`, `email`, `phone_number`, `gender`, `date_user`, `img`) VALUES
(1, 1, '', 'Nguyen Van A', 'a@example.com', '0123456789', 'M', '1990-01-01', 'avatar_a.jpg'),
(2, 2, '', 'Tran Thi B', 'b@example.com', '0987654321', 'F', '1992-02-02', 'avatar_b.jpg'),
(3, 14, 'Tienduy06112004', 'Phùng Trần Tiến Duy', 'duyphung344@gmail.com', '0327171253', 'nam', NULL, '/img_profile/1715659700.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id_about`);

--
-- Chỉ mục cho bảng `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id_blog`),
  ADD KEY `id_user` (`id_user`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Chỉ mục cho bảng `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `fk_status_id` (`status_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_categories` (`id_categories`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Chỉ mục cho bảng `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_account` (`id_account`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id_about` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id_blog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_status_id` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_id_categories` FOREIGN KEY (`id_categories`) REFERENCES `categories` (`id_category`);

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_account`) REFERENCES `accounts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
