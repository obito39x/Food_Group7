-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 16, 2024 lúc 09:38 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

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
(14, 'Tienduy06112004', '$2y$10$NafRKwD5wsFCH4KuCM0dwOEDdcw12wvexI8XJKkLxSjyzRzCryWPS', 0, '2024-04-14 01:55:00', '2024-04-14 01:55:00', NULL, NULL, 'duyphung344@gmail.com'),
(15, 'Tienduy06112004', '$2y$10$y1WSmPGGS8p30Ud/s.mnBesN4/3OR6UZUY5zYYJXnBM4NHJOrAzVG', 0, '2024-04-14 02:07:45', '2024-04-14 02:07:45', NULL, NULL, 'duyphung344@gmail.com'),
(16, 'Tienduy06112004', '$2y$10$EgzjfKFIKI77GYqVCGZfvOgyrRAjSwCbFgzbjzefLuCcchVrsU3Tm', 0, '2024-04-14 02:09:42', '2024-04-14 02:09:42', NULL, NULL, 'duyphung344@gmail.com'),
(17, 'Tienduy06112004', '$2y$10$dhNCJTaH0TNx2uFMqeFhh.GdnxzDYzL3bqafBV.9XSx3ZY.Q2BO62', 0, '2024-04-14 02:09:45', '2024-04-14 02:09:45', NULL, NULL, 'duyphung344@gmail.com'),
(18, 'Tienduy06112004', '$2y$10$Z638wBIurbOlCbf388yYi.KbrFBCmxI2I1fzlkC85NUa/W6CTe2FC', 0, '2024-04-14 02:10:36', '2024-04-14 02:10:36', NULL, NULL, 'duyphung344@gmail.com'),
(19, 'Tienduy06112004', '$2y$10$PNZSoRSVEhXSc89WVrNiWO47O.WX6VhtGWARjc71GE9fVzD30IyzC', 0, '2024-04-14 02:10:52', '2024-04-14 02:10:52', NULL, NULL, 'duyphung344@gmail.com'),
(20, 'Tienduy06112004', '$2y$10$.dCOn8Do09jG.wZtbdiNW.bJ1f5Y87YiFPlcvJrB.ucV5MumAo4Qa', 0, '2024-04-14 02:11:46', '2024-04-14 02:11:46', NULL, NULL, 'duyphung344@gmail.com'),
(21, 'Tienduy06112004', '$2y$10$.XnkysMgtRv0YaAdRLzeSuuWnbyXNZaKJGFlihVVie6Ht8.NRq90m', 0, '2024-04-14 02:11:53', '2024-04-14 02:11:53', NULL, NULL, 'duyphung344@gmail.com'),
(22, 'nguyenanhtuan', '$2y$10$KOzIORoLKXm6fmxp/7kZXOjWXn3jSXomBXI6Qn8iRgwKlmfyUltM6', 0, '2024-05-10 01:19:18', '2024-05-10 01:19:18', NULL, NULL, 'hoanganhtuan39x@gmail.com'),
(23, 'nguyenanhtuanq', '$2y$10$LSB9c5qreUXH3GqeGMtmZe63Rm2njBDHbXu6.ZmHhTcLRGyT.1eQW', 0, '2024-05-10 01:20:42', '2024-05-10 01:50:47', NULL, NULL, 'hoanganhtuan@gmail.com'),
(24, 'anhtuan', '$2y$10$ggLPw4wXogQMTbpxKZZKeOQK5IVc0oWo6XvBS/TLhk0E2jj1F3.Cm', 0, '2024-05-10 03:06:28', '2024-05-10 03:21:55', NULL, NULL, 'nguyenhoangtuananh039@gmail.com'),
(25, 'hoanganhtuan', '$2y$10$JibcB6Bod813S2iM0Jj2DembrqNfkLrfOohC/QZI/kTGxsQ.MwYO2', 0, '2024-05-13 10:40:32', '2024-05-13 10:40:32', NULL, NULL, 'nguyenhoangtuananh@gmail.com'),
(26, 'ng_atuan.04', '$2y$10$O.1e8fMwrIB3o321MmNpke44kcROjiKxZz3rXtXlOdmY8F042rA.i', 0, '2024-05-15 09:10:48', '2024-05-15 09:10:48', NULL, NULL, 'a12345@aa.aaa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blogs`
--

CREATE TABLE `blogs` (
  `id_blog` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `id_user` int(11) NOT NULL,
  `content` varchar(1000) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `view_count` int(11) DEFAULT 0,
  `like_count` int(11) DEFAULT 0,
  `comment_count` int(11) DEFAULT 0,
  `img` varchar(250) DEFAULT NULL,
  `status` enum('Draft','Published','Archived') DEFAULT 'Draft'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `blogs`
--

INSERT INTO `blogs` (`id_blog`, `title`, `id_user`, `content`, `created_at`, `updated_at`, `view_count`, `like_count`, `comment_count`, `img`, `status`) VALUES
(21, 'Cách top 1 đấu trường chân lý', 7, 'Cập nhật view_count mỗi khi xem chi tiết bài viết có thể không phải lúc nào cũng là ý tưởng tốt nếu bạn muốn theo dõi chính xác số lượt xem duy nhất từ các người dùng khác nhau, vì một người dùng có thể làm tăng số này nhiều lần bằng cách tải lại trang nhiều lần. Trong trường hợp đó, bạn có thể cần xem xét thêm các biện pháp để chỉ đếm một lượt xem cho mỗi người dùng duy nhất, có thể thông qua việc sử dụng cookies hoặc phiên làm việc.', '2024-05-13 22:06:42', '2024-05-14 23:07:13', 253, 2, 31, '/img_blog/1715612802.png', 'Draft'),
(23, 'Mit hao kjasdhkas', 7, 'hahahahahahahah', '2024-05-14 14:41:41', '2024-05-16 13:59:33', 96, 1, 1, '/img_blog/1715672501.png', 'Draft'),
(24, 'gggggg', 8, 'hhhhhhhh', '2024-05-15 16:11:08', '2024-05-16 14:20:21', 11, 0, 3, '/img_blog/1715764268.png', 'Draft');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog_likes`
--

CREATE TABLE `blog_likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `blog_likes`
--

INSERT INTO `blog_likes` (`id`, `user_id`, `blog_id`) VALUES
(64, 6, 23);

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
(1, 'Đồ ăn'),
(2, 'Đồ uống');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `blog_id`, `comment`, `created_at`, `updated_at`) VALUES
(66, 6, 21, 'a', '2024-05-14 06:30:59', '2024-05-14 06:30:59'),
(67, 6, 21, 'ádasd', '2024-05-14 06:31:59', '2024-05-14 06:31:59'),
(68, 6, 21, 'ádassdada', '2024-05-14 06:33:14', '2024-05-14 06:33:14'),
(70, 6, 21, 'ádasd', '2024-05-14 06:43:42', '2024-05-14 06:43:42'),
(72, 6, 21, 'hahahahhaa', '2024-05-14 06:51:33', '2024-05-14 13:12:36'),
(74, 7, 21, 'hahahaha', '2024-05-14 07:34:28', '2024-05-14 15:02:15'),
(76, 7, 23, 'ádad', '2024-05-14 16:07:49', '2024-05-14 16:07:49'),
(77, 6, 24, 'asdasd', '2024-05-16 07:18:30', '2024-05-16 07:18:30'),
(78, 6, 24, 'sadsd', '2024-05-16 07:18:31', '2024-05-16 07:18:31'),
(79, 6, 24, 'asdasd', '2024-05-16 07:18:33', '2024-05-16 07:18:33');

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
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `email`, `fullname`, `phone`, `address`, `city`, `district`, `ward`, `payment_method`, `total_amount`, `created_at`, `id_user`) VALUES
(16, 'duyphung344@gmail.com', 'Phùng Trần Tiến Duy', '0327171253', 'Vĩnh phú 42', 'Tỉnh Bắc Giang', 'Huyện Lục Ngạn', 'Xã Giáp Sơn', 'COD', 360.00, '2024-05-09 13:56:35', NULL),
(17, 'akamary344@gmail.com', 'Phùng Trần Tiến Duy', '0327171253', 'dấdasdsa', 'Tỉnh Hưng Yên', 'Huyện Kim Động', 'Xã Ngọc Thanh', 'COD', 340.00, '2024-05-10 05:40:22', NULL),
(18, 'Duyphung344@gmail.com', 'Phùng Trần Tiến Duy', '0327171253', 'Vĩnh phú 42', 'Tỉnh Bắc Ninh', 'Huyện Gia Bình', 'Xã Đông Cứu', 'COD', 300.00, '2024-05-10 05:48:54', NULL),
(19, 'duyphung344@gmail.com', 'Phùng Trần Tiến Duy', '0327171253', 'Vĩnh phú 42', 'Tỉnh Bình Dương', 'Thành phố Thuận An', 'Phường Vĩnh Phú', 'COD', 406.00, '2024-05-10 06:39:58', 3);

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
(43, 19, 10, 2, 80.00);

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
  `rating` decimal(3,2) DEFAULT 1.00,
  `id_categories` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image_url`, `old_price`, `new_price`, `rating`, `id_categories`) VALUES
(2, 'Drink', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_2.jpg', 50.00, 41.00, 4.00, 2),
(3, 'Pizza', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_3.png', 120.00, 100.00, 5.00, 1),
(4, 'Onion Ring', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_4.jpg', 80.00, 70.00, 3.00, 1),
(5, 'Biryani', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_5.webp', 150.00, 130.00, 4.00, 1),
(6, 'Potato Chips', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_6.jpg', 40.00, 35.00, 4.00, 1),
(7, 'Lasagna', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_7.webp', 180.00, 160.00, 5.00, 1),
(8, 'Ice-Cream', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_8.jpg', 60.00, 50.00, 4.00, 1),
(9, 'Chocolate', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_9.jpg', 70.00, 60.00, 4.00, 1),
(10, 'Pasta', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_10.jpg', 90.00, 80.00, 4.00, 1),
(11, 'Starbucks', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_11.jpg', 110.00, 100.00, 4.00, 2),
(12, 'Hot Dog', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_12.jpg', 70.00, 60.00, 3.00, 1),
(13, 'Sandwich', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_13.jpg', 80.00, 70.00, 4.00, 1),
(14, 'Muffin', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_14.jpg', 50.00, 40.00, 4.00, 1),
(15, 'Sausage', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_15.jpg', 70.00, 60.00, 3.00, 1),
(16, 'Cake', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_16.jpg', 100.00, 90.00, 5.00, 1),
(17, 'Burrito', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_17.jpg', 90.00, 80.00, 4.00, 1),
(18, 'Bacon', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_18.webp', 80.00, 70.00, 3.00, 1),
(19, 'Donuts', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_19.jpg', 60.00, 50.00, 4.00, 1),
(20, 'Noodle', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_20.jpg', 80.00, 70.00, 4.00, 1),
(21, 'Pancake', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_21.jpg', 60.00, 50.00, 4.00, 1),
(22, 'Pretzel', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_22.jpg', 40.00, 35.00, 3.00, 1),
(23, 'Taco', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_23.jpg', 90.00, 80.00, 4.00, 1),
(24, 'Kottu', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, animi nesciunt magni molestiae', 'image/menu_24.jpg', 70.00, 60.00, 3.00, 1),
(31, 'dsad', 'dsadas', 'image/blog_3.jpg', 1.00, 1.00, 5.00, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
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

INSERT INTO `users` (`id_user`, `id_account`, `username`, `fullname`, `email`, `phone_number`, `gender`, `date_user`, `img`) VALUES
(1, 1, '', 'Nguyen Van A', 'a@example.com', '0123456789', 'M', '1990-01-01', 'avatar_a.jpg'),
(2, 2, '', 'Tran Thi B', 'b@example.com', '0987654321', 'F', '1992-02-02', 'avatar_b.jpg'),
(3, 14, 'Tienduy06112004', NULL, 'duyphung344@gmail.com', NULL, NULL, NULL, NULL),
(4, 22, 'nguyenanhtuan', NULL, 'hoanganhtuan39x@gmail.com', NULL, NULL, NULL, NULL),
(5, 23, 'nguyenanhtuanq', 'Nguyễn Anh Tuấn', 'hoanganhtuan@gmail.com', '0436734764', 'nam', '2004-02-03', '/img_profile/1715331387.jpg'),
(6, 24, 'anhtuan', 'Nguyễn Anh Tuấn', 'nguyenhoangtuananh039@gmail.com', '0436734764', 'nam', NULL, '/img_profile/1715419098.jpg'),
(7, 25, 'hoanganhtuan', NULL, 'nguyenhoangtuananh@gmail.com', NULL, NULL, NULL, NULL),
(8, 26, 'ng_atuan.04', NULL, 'a12345@aa.aaa', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_follows`
--

CREATE TABLE `user_follows` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `following_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_follows`
--

INSERT INTO `user_follows` (`id`, `user_id`, `following_user_id`, `created_at`) VALUES
(25, 6, 7, '2024-05-15 08:23:31'),
(27, 7, 8, '2024-05-15 17:05:26'),
(28, 6, 8, '2024-05-16 07:20:24');

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
-- Chỉ mục cho bảng `blog_likes`
--
ALTER TABLE `blog_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `blog_id` (`blog_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `blog_id` (`blog_id`);

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
  ADD KEY `id_user` (`id_user`);

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
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_account` (`id_account`);

--
-- Chỉ mục cho bảng `user_follows`
--
ALTER TABLE `user_follows`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_follow` (`user_id`,`following_user_id`),
  ADD KEY `following_user_id` (`following_user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id_blog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `blog_likes`
--
ALTER TABLE `blog_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT cho bảng `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `user_follows`
--
ALTER TABLE `user_follows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Các ràng buộc cho bảng `blog_likes`
--
ALTER TABLE `blog_likes`
  ADD CONSTRAINT `blog_likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `blog_likes_ibfk_2` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id_blog`);

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id_blog`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

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
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_account`) REFERENCES `accounts` (`id`);

--
-- Các ràng buộc cho bảng `user_follows`
--
ALTER TABLE `user_follows`
  ADD CONSTRAINT `user_follows_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_follows_ibfk_2` FOREIGN KEY (`following_user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
