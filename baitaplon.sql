-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2024 at 07:47 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baitaplon`
--

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `exam_id` int(11) NOT NULL,
  `exam_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `time_limit` int(11) NOT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `class` varchar(255) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`exam_id`, `exam_name`, `password`, `time_limit`, `start_time`, `end_time`, `class`, `subject_id`, `created_at`) VALUES
(36, 'test', '123', 12, '2024-07-03 23:29:00', '2024-07-31 23:29:00', '73DCTT23', 0, '2024-07-03 16:31:58'),
(45, 'test1', '123', 15, '2024-07-04 02:02:00', '2024-07-31 02:10:00', '73DCTT23', 2, '2024-07-03 19:11:02'),
(46, 'ktra15p', '123', 15, '2024-07-04 02:11:00', '2024-07-18 02:11:00', 'PHP', 2, '2024-07-03 19:11:53'),
(47, 'test2', '123', 25, '2024-07-04 02:35:00', '2024-07-04 02:36:00', '73DCTT23', 2, '2024-07-03 19:36:18'),
(48, 'test3', '123', 45, '2024-07-31 02:38:00', '2024-08-13 02:38:00', '73DCTT23', 1, '2024-07-03 19:38:50'),
(49, 'test2', '123', 15, '2024-07-09 18:28:00', '2024-07-09 19:00:00', 'PHP', 2, '2024-07-09 11:26:37'),
(50, 'test3', '123', 15, '2024-07-09 17:00:00', '2024-07-09 19:00:00', 'PHP', 1, '2024-07-09 11:36:04'),
(51, 'test4', '123', 15, '2024-07-09 17:00:00', '2024-07-09 19:00:00', 'PHP', 2, '2024-07-09 11:39:39'),
(52, 'test5', '123', 15, '2024-07-09 17:00:00', '2024-07-09 19:00:00', 'PHP', 2, '2024-07-09 11:43:26'),
(53, 'test6', '123', 1, '2024-07-09 17:00:00', '2024-07-09 18:48:00', 'PHP', 1, '2024-07-09 11:46:48'),
(54, 'test7', '123', 5, '2024-07-09 18:00:00', '2024-07-09 20:00:00', '73DCTT23', 1, '2024-07-09 12:01:29'),
(55, 'test8', '123', 15, '2024-07-09 18:00:00', '2024-07-09 20:00:00', 'Java', 1, '2024-07-09 12:03:20'),
(56, 'test9', '123', 1, '2024-07-09 18:00:00', '2024-07-09 20:00:00', 'PHP', 2, '2024-07-09 12:04:31'),
(57, 'test10', '123', 1, '2024-07-09 18:00:00', '2024-07-09 20:00:00', 'PHP', 1, '2024-07-09 12:09:12'),
(58, 'test11', '123', 1, '2024-07-09 18:00:00', '2024-07-09 12:00:00', 'PHP', 1, '2024-07-09 12:14:25'),
(59, 'test12', '123', 15, '2024-07-09 18:00:00', '2024-07-09 21:00:00', 'PHP', 1, '2024-07-09 12:16:11'),
(60, 'bai1', '123', 1, '2024-07-09 21:00:00', '2024-07-09 22:00:00', 'PHP', 2, '2024-07-09 13:32:09'),
(62, 'bai2', '123', 1, '2024-07-09 20:30:00', '2024-07-09 21:00:00', 'PHP', 1, '2024-07-09 13:33:11'),
(63, 'bai3', '123', 1, '2024-07-09 22:00:00', '2024-07-09 23:00:00', 'PHP', 2, '2024-07-09 14:03:52'),
(69, 'testthi', '123', 10, '2024-07-10 13:56:00', '2024-07-11 13:56:00', '73DCTT23', 1, '2024-07-10 06:57:01'),
(70, 'baithi1', '123', 1, '2024-10-07 14:00:00', '2024-10-07 15:00:00', 'PHP', 1, '2024-07-10 07:09:14'),
(71, 'baitest1', '1', 1, '2024-09-07 10:00:00', '2024-11-07 10:00:00', 'PHP', 2, '2024-07-10 07:12:42');

-- --------------------------------------------------------

--
-- Table structure for table `exam_questions`
--

CREATE TABLE `exam_questions` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `exam_questions`
--

INSERT INTO `exam_questions` (`id`, `exam_id`, `question_id`) VALUES
(208, 36, 65),
(209, 36, 62),
(210, 36, 63),
(211, 36, 60),
(212, 36, 64),
(213, 36, 61),
(248, 45, 71),
(249, 45, 69),
(250, 45, 66),
(251, 45, 72),
(252, 45, 67),
(253, 45, 70),
(254, 46, 71),
(255, 46, 66),
(256, 46, 69),
(257, 46, 67),
(258, 47, 71),
(259, 47, 66),
(260, 47, 69),
(261, 47, 72),
(262, 47, 67),
(263, 47, 70),
(264, 48, 62),
(265, 48, 65),
(266, 48, 60),
(267, 48, 63),
(268, 48, 64),
(269, 48, 61),
(270, 49, 71),
(271, 49, 66),
(272, 49, 70),
(273, 49, 67),
(274, 50, 62),
(275, 50, 65),
(276, 50, 63),
(277, 50, 64),
(278, 51, 71),
(279, 51, 69),
(280, 51, 66),
(281, 51, 72),
(282, 52, 71),
(283, 52, 69),
(284, 52, 66),
(285, 52, 70),
(286, 52, 67),
(287, 53, 65),
(288, 54, 65),
(289, 55, 65),
(290, 56, 71),
(291, 57, 62),
(292, 58, 65),
(293, 59, 65),
(294, 60, 66),
(296, 62, 64),
(297, 63, 71),
(308, 69, 65),
(309, 69, 62),
(310, 69, 60),
(311, 69, 64),
(312, 69, 61),
(313, 70, 65),
(314, 71, 71);

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `result_id` int(11) NOT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `user_name` varchar(100) NOT NULL,
  `score` decimal(5,2) DEFAULT NULL,
  `submission_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `exam_results`
--

INSERT INTO `exam_results` (`result_id`, `exam_id`, `user_name`, `score`, `submission_time`) VALUES
(39, 47, 'Hoàng Minh Châu', 8.33, '2024-07-03 19:40:25'),
(40, 45, 'Lê Thị Kim Chi', 8.33, '2024-07-03 19:42:58'),
(41, 45, 'Lê Thanh Hưng', 10.00, '2024-07-03 19:44:14'),
(42, 46, 'Lê Thanh Hà', 2.50, '2024-07-09 11:25:36'),
(43, 49, 'Lê Thanh Hà', 5.00, '2024-07-09 11:28:16'),
(44, 50, 'Lê Thanh Hà', 5.00, '2024-07-09 11:37:06'),
(45, 52, 'Lê Thanh Hà', 0.00, '2024-07-09 11:44:42'),
(46, 54, 'Lê Thanh Hưng', 0.00, '2024-07-09 12:02:27'),
(47, 55, 'Trương Thu Nguyên', 0.00, '2024-07-09 12:03:37'),
(48, 56, 'Lê Thanh Hà', 0.00, '2024-07-09 12:04:44'),
(49, 57, 'Lê Thanh Hà', 10.00, '2024-07-09 12:10:21'),
(50, 59, 'Lê Thanh Hà', 0.00, '2024-07-09 12:16:31');

-- --------------------------------------------------------

--
-- Table structure for table `giaovien`
--

CREATE TABLE `giaovien` (
  `ID` int(11) NOT NULL,
  `Hoten` varchar(50) NOT NULL,
  `Ngaysinh` date NOT NULL,
  `Diachi` varchar(50) NOT NULL,
  `Dienthoai` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Gioitinh` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `giaovien`
--

INSERT INTO `giaovien` (`ID`, `Hoten`, `Ngaysinh`, `Diachi`, `Dienthoai`, `Email`, `Gioitinh`) VALUES
(344, 'Dương Ngọc Hiếu', '2024-06-04', 'Hòa lạc', 98543233, 'hieungoc@gmial.com', 'Nam'),
(2, 'Nguyễn Công Tráng', '2024-07-09', 'Gia lai', 965432312, 'trangngoc@gmail.com', 'Nam'),
(89, 'nguyễn minh', '2024-06-04', 'Hà Nội', 2147483647, 'a@gmail.com', 'Nam '),
(43, 'ánh sứ', '2024-06-15', 'Nghệ An', 978987654, 'axxx@gmail.com', 'Nam');

-- --------------------------------------------------------

--
-- Table structure for table `hocsinh`
--

CREATE TABLE `hocsinh` (
  `Mahs` int(11) NOT NULL,
  `Hoten` varchar(20) NOT NULL,
  `Ngaysinh` date NOT NULL,
  `Diachi` varchar(50) NOT NULL,
  `Dienthoai` int(10) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Gioitinh` text NOT NULL,
  `Tenlop` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hocsinh`
--

INSERT INTO `hocsinh` (`Mahs`, `Hoten`, `Ngaysinh`, `Diachi`, `Dienthoai`, `Email`, `Gioitinh`, `Tenlop`) VALUES
(34, 'Lê Thanh Hà', '2024-06-11', 'Hà đông', 654323, 'halee@gmail.com', 'Nam', 'PHP'),
(32, 'Lê Thanh Hưng', '2024-06-05', 'Hà đông', 2147483647, 'hungle@gmail.com', 'Nam', '73DCTT23'),
(235, 'Hoàng Minh Châu', '2024-06-10', 'Gia lai', 987566, 'minhchau@gmail.com', 'Nữ', '73DCTT23'),
(2411, 'Hồ Văn Đạt', '2024-06-05', 'Hà đông', 2147483647, 'hungle@gmail.com', 'Nam', 'PHP'),
(2532, 'Quang axa', '2024-06-06', 'Thanh Xuân', 8564423, 'quangaxa@gmail.com', 'Nam', 'PHP'),
(3412, 'Lê Thị Kim Chi', '2024-06-05', 'Hà đông', 2147483647, 'chile@gmail.com', 'Nữ', '73DCTT23'),
(8643, 'Trần Thị Lan Anh', '2024-06-06', 'Đà nẵng', 8564423, 'lananh@gmail.com', 'Nữ', 'Java'),
(231, 'Võ Văn Tuấn', '2023-06-04', 'HCM', 976545, 'vantuan@gmail.com', 'Nam', 'Java'),
(2356, 'Trương Thu Nguyên', '2024-07-07', 'thủ đức', 943353523, 'nguyenthu@gmail.com', 'Nữ', 'Java'),
(12, 'dungx', '2024-06-05', 'ha noi', 5653231, 'dung@gmail.com', 'Nam', '73DCTT23');

-- --------------------------------------------------------

--
-- Table structure for table `lophoc`
--

CREATE TABLE `lophoc` (
  `ID` int(100) NOT NULL,
  `Tenlop` varchar(50) NOT NULL,
  `Giaovien` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lophoc`
--

INSERT INTO `lophoc` (`ID`, `Tenlop`, `Giaovien`) VALUES
(22, '73DCTT23', 'Dương Ngọc Hiếu'),
(2, 'PHP', 'ánh sứ'),
(356, 'Java', 'nguyễn minh');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `question_content` text NOT NULL,
  `answer_a` text NOT NULL,
  `answer_b` text NOT NULL,
  `answer_c` text NOT NULL,
  `answer_d` text NOT NULL,
  `correct_answer` char(1) NOT NULL,
  `difficulty` varchar(20) NOT NULL,
  `subject_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `question_content`, `answer_a`, `answer_b`, `answer_c`, `answer_d`, `correct_answer`, `difficulty`, `subject_id`) VALUES
(60, 'OOP là viết tắt của:', 'Object Open Programming', 'Open Object Programming', ' Object Oriented Programming.', 'Object Oriented Proccessing.', 'C', 'tb', 1),
(61, ' Đặc điểm cơ bản của lập trình hướng đối tượng thể hiện ở:', 'Tính đóng gói, tính kế thừa, tính đa hình, tính đặc biệt hóa.', 'Tính đóng gói, tính kế thừa, tính đa hình, tính trừu tượng.', 'Tính chia nhỏ, tính kế thừa.', 'Tính đóng gói, tính trừu tượng.', 'B', 'khó', 1),
(62, ' Lập trình hướng đối tượng là:', '. Lập trình hướng đối tượng là phương pháp đặt trọng tâm vào các đối tượng, nó không cho phép dữ liệu chuyển động một cách tự do trong hệ thống.', ' Lập trình hướng đối tượng là phương pháp lập trình cơ bản gần với mã máy', 'Lập trình hướng đối tượng là phương pháp mới của lập trình máy tính, chia chương trình thành các hàm; quan tâm đến chức năng của hệ thống.', ' Lập trình hướng đối tượng là phương pháp đặt trọng tâm vào các chức năng, cấu trúc chương trình được xây dựng theo cách tiếp cận hướng chức năng.', 'A', 'dễ', 1),
(63, 'Thế nào được gọi là hiện tượng nạp chồng ? ', 'Hiện tượng lớp con kế thừa định nghĩa một hàm hoàn toàn giống lớp cha.', 'Hiện tượng lớp con kế thừa định nghĩa một hàm cùng tên nhưng khác kiểu với một hàm ở lớp cha.', ' Hiện tượng lớp con kế thừa định nghĩa một hàm cùng tên, cùng kiểu với một hàm ở lớp cha nhưng khác đối số', 'Hiện tượng lớp con kế thừa định nghĩa một hàm cùng tên, cùng các đối số nhưng khác kiểu với một hàm ở lớp cha.', 'A', 'tb', 1),
(64, 'Trong java, khi khai báo một thuộc tính hoặc một hàm của một lớp mà không có từ khóa quyền truy cập thì mặc định quyền truy cập là gì?', ' public.', 'protected.', ' friendly.', 'private', 'C', 'khó', 1),
(65, 'Đối với quyền truy cập nào thì cho phép truy cập các lớp con trong cùng gói với lớp cha ?', 'private, friendly, protected.', 'friendly, public.', 'friendly, protected, public.', 'public, protected', 'C', 'dễ', 1),
(66, 'Chọn kết quả đúng điền vào ô trồng: 1; 3; 5; 7; 9; .....97; ☐; ☐; ...', 'A. 98; 100', '99; 101', ' 99; 100', '100; 101', 'B', 'tb', 2),
(67, 'Điền dấu thích hợp vào ô trống: 24601 ☐ 2461', '>', '<', '=', 'Không có dấu nào', 'A', 'khó', 2),
(69, 'Số chia hết cho 3 là các số: ................', '301; 541', '781; 451', '731; 631', '300; 360', 'D', 'tb', 2),
(70, 'Lan có một cái bánh ít hơn 30 và nhiều hơn 12 cái. Nếu chia đều số bánh đó cho 2 bạn hoặc 5 bạn thì vừa hết. Hỏi lan có bao nhiêu cái bánh?', '15 cái', '20 cái', '25 cái', '28 cái', 'B', 'khó', 2),
(71, 'Tính giá trị của x biết: x+216=570', 'x=352', 'x=354', 'x=356', 'x=358', 'B', 'dễ', 2),
(72, 'Một tấm vài dài 25m. Đã may quần áo hết 4/5 tấm vải đó. Số vải còn lại người ta đem may túi, mỗi túi hết 5/8m vải. Hỏi may được tất cả bao nhiêu cái túi?', '8 túi', '7 túi', '5 túi', '17 túi', 'A', 'khó', 2);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_title`) VALUES
(1, 'Lập trình web'),
(2, 'Giải tích'),
(3, 'Lịch sử đảng');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Ngaysinh` date DEFAULT NULL,
  `Address` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `User` varchar(20) NOT NULL,
  `Pass` varchar(20) NOT NULL,
  `Role` tinyint(1) NOT NULL DEFAULT 0,
  `Tenlop` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`Id`, `Name`, `Ngaysinh`, `Address`, `Email`, `User`, `Pass`, `Role`, `Tenlop`) VALUES
(1, 'GiaoVien', NULL, 'NgheAn', 'Admin_Giaovien@gmail.com', 'admin_GiaoVien', '12345', 1, ''),
(12, 'dungx', '2024-06-05', 'ha noi', 'dung@gmail.com', 'dung', '123', 0, ''),
(32, 'Lê Thanh Hưng', '2024-06-05', 'Hà đông', 'hungle@gmail.com', 'hungle', '123', 0, '73DCTT23'),
(34, 'Lê Thanh Hà', '2024-06-11', 'Hà đông', 'halee@gmail.com', 'thanhha', '123', 0, 'PHP'),
(231, 'Võ Văn Tuấn', '2023-06-04', 'HCM', 'vantuan@gmail.com', 'votuan', '123', 0, 'Java'),
(235, 'Hoàng Minh Châu', '2024-06-10', 'Gia lai', 'minhchau@gmail.com', 'minhchau', '123', 0, '73DCTT23'),
(2356, 'Trương Thu Nguyên', '2024-07-07', 'thủ đức', 'nguyenthu@gmail.com', 'nguyenthu', '123', 0, 'Java'),
(2411, 'Hồ Văn Đạt', '2024-06-05', 'Hà đông', 'hungle@gmail.com', 'vandat', '123', 0, 'PHP'),
(2532, 'Quang axa', '2024-06-06', 'Thanh Xuân', 'quangaxa@gmail.com', 'quang', '123', 0, 'PHP'),
(3412, 'Lê Thị Kim Chi', '2024-06-05', 'Hà đông', 'chile@gmail.com', 'kimchi', '123', 0, '73DCTT23'),
(8643, 'Trần Thị Lan Anh', '2024-06-06', 'Đà nẵng', 'lananh@gmail.com', 'lananh', '123', 0, 'Java');

-- --------------------------------------------------------

--
-- Table structure for table `thongbao`
--

CREATE TABLE `thongbao` (
  `ID` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Tieude` varchar(255) NOT NULL,
  `Noidung` varchar(200) NOT NULL,
  `Tenlop` varchar(50) NOT NULL,
  `Thoigian` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `thongbao`
--

INSERT INTO `thongbao` (`ID`, `Name`, `Tieude`, `Noidung`, `Tenlop`, `Thoigian`) VALUES
(2, 'GiaoVien', 'thong bao', 'Thẻ  là một thẻ HTML được sử dụng để chèn ảnh vào trang web. Nó là một thẻ rỗng, có nghĩa là không có thẻ đóng tương ứng, và chỉ chứa các thuộc tính để cung cấp thông tin về ảnh như đường dẫn và mô tả', 'PHP', '2024-07-09 12:46:48'),
(22, 'GiaoVien', 'ua alo', 'Trong đó, thuộc tính src chứa đường dẫn tới tệp ảnh. Nếu tệp ảnh nằm trong cùng thư mục với tệp HTML của bạn, bạn chỉ cần cung cấp tên tệp ảnh. Nếu ảnh nằm ở một thư mục khác, bạn cần cung cấp đường d', '73DCTT23', '2024-07-09 12:47:02'),
(357, 'GiaoVien', 'thong bao 2', 'khong co chi', 'PHP', '2024-07-09 12:57:40'),
(359, 'GiaoVien', 'tiêu đê', 'jshfdhg', 'Java', '2024-07-10 06:58:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_id` (`exam_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `exam_id` (`exam_id`),
  ADD KEY `user_name` (`user_name`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Name` (`Name`);

--
-- Indexes for table `thongbao`
--
ALTER TABLE `thongbao`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `exam_questions`
--
ALTER TABLE `exam_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=315;

--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9876544;

--
-- AUTO_INCREMENT for table `thongbao`
--
ALTER TABLE `thongbao`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=360;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD CONSTRAINT `exam_questions_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`exam_id`),
  ADD CONSTRAINT `exam_questions_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`);

--
-- Constraints for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD CONSTRAINT `exam_results_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`exam_id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
