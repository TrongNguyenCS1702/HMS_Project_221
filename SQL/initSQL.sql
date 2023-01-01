-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 31, 2022 at 11:25 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ktx`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user_id`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `title` varchar(300) NOT NULL,
  `time` varchar(5000) NOT NULL,
  `bill` int(12) NOT NULL,
  `note` varchar(5000) NOT NULL,
  `status` varchar(5000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `manager_id`, `room_id`, `student_id`, `title`, `time`, `bill`, `note`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 6, NULL, 'Tiền điện nước T.12', 'sfsdf', 235000, '', 'Chưa thanh toán', '2022-12-31 21:16:10', '2022-12-31 22:09:37');

-- --------------------------------------------------------

--
-- Table structure for table `courts`
--

CREATE TABLE `courts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `courts`
--

INSERT INTO `courts` (`id`, `name`, `type`, `status`) VALUES
(1, 'AG3', 'Nữ', 'Hoạt động'),
(2, 'AG4', 'Nam', 'Hoạt động'),
(3, 'A18', 'Nữ', 'Hoạt động'),
(4, 'AH2', 'Nam', 'Hoạt động'),
(5, 'A07', 'Nữ', 'Hoạt động'),
(6, 'AH1', 'Nam', 'Hoạt động');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `room_id`, `student_id`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 3, 'Quạt trần bị hỏng', 'Đã tiếp nhận', '2022-12-31 05:17:29', '2022-12-31 05:17:29'),
(4, 1, 2, 'sfsfsf', 'Đã tiếp nhận', '2022-12-31 14:14:35', '2022-12-31 14:14:35'),
(13, 6, 7, 'Cửa chính bị kẹt', 'Đã tiếp nhận', '2022-12-31 16:23:02', '2022-12-31 16:23:02'),
(25, 6, 7, 'Mất nước phòng tắm', 'Đã tiếp nhận', '2022-12-31 18:01:33', '2022-12-31 18:01:33');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `manager_id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Thông báo gia hạn phòng ở', 'Sinh viên vào phần gia hạn để gia hạn phòng ở từ ngày 30/12/2022 đến ngày 5/1/2022', '2022-12-31 05:17:29', '2022-12-31 05:17:29'),
(2, 2, 'Thông báo làm khảo sát nghỉ Tết', 'Sinh viên vào forms.office.com/r/0000000 để làm khảo sát nghỉ Tết Âm lịch', '2022-12-31 05:17:29', '2022-12-31 05:17:29'),
(3, 2, 'Thông báo lịch cúp điện', 'Ký túc xá đại học Quốc gia thông báo với sinh viên ngày 3/1/2022 cúp điện từ 7h00 đến 11h00', '2022-12-31 05:17:29', '2022-12-31 05:17:29'),
(4, 2, 'Thông báo lịch cúp nước', 'Ký túc xá đại học Quốc gia thông báo với sinh viên ngày 4/1/2022 cúp điện từ 17h00 đến 19h00', '2022-12-31 05:17:29', '2022-12-31 05:17:29');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `court_id` int(11) NOT NULL,
  `slot` int(11) NOT NULL,
  `fee` int(12) NOT NULL,
  `room_number` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `court_id`, `slot`, `fee`, `room_number`, `type`, `status`, `updated_at`) VALUES
(1, 1, 2, 1000000, '101', 'Phòng 2', 'Còn 2 giường', '2022-12-31 05:17:29'),
(2, 1, 4, 750000, '102', 'Phòng 4', 'Còn 4 giường', '2022-12-31 05:17:29'),
(3, 1, 6, 500000, '201', 'Phòng 6', 'Còn 3 giường', '2022-12-31 05:17:29'),
(4, 1, 0, 0, '202', 'Phòng Kho', 'Kho', '2022-12-31 05:17:29'),
(5, 2, 2, 1000000, '101', 'Phòng 2', 'Còn 0 giường', '2022-12-31 05:17:29'),
(6, 2, 4, 750000, '620', 'Phòng 4', 'Còn 3 giường', '2022-12-31 08:49:49'),
(7, 2, 6, 500000, '201', 'Phòng 6', 'Còn 6 giường', '2022-12-31 05:17:29'),
(8, 2, 0, 0, '202', 'Phòng Kho', 'Kho', '2022-12-31 05:17:29'),
(9, 3, 2, 1000000, '101', 'Phòng 2', 'Còn 2 giường', '2022-12-31 05:17:29'),
(10, 3, 4, 750000, '102', 'Phòng 4', 'Còn 4 giường', '2022-12-31 05:17:29'),
(11, 3, 6, 500000, '201', 'Phòng 6', 'Còn 6 giường', '2022-12-31 05:17:29'),
(12, 3, 0, 0, '202', 'Phòng Kho', 'Kho', '2022-12-31 05:17:29'),
(13, 4, 2, 1000000, '101', 'Phòng 2', 'Còn 2 giường', '2022-12-31 05:17:29'),
(14, 4, 4, 750000, '102', 'Phòng 4', 'Còn 4 giường', '2022-12-31 05:17:29'),
(15, 4, 6, 500000, '201', 'Phòng 6', 'Còn 6 giường', '2022-12-31 05:17:29'),
(16, 4, 0, 0, '202', 'Phòng Kho', 'Kho', '2022-12-31 05:17:29');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `year` varchar(100) NOT NULL,
  `university` varchar(100) NOT NULL,
  `student_id` varchar(100) NOT NULL,
  `start_date` varchar(100),
  `end_date` varchar(100),
  `status` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `room_id`, `year`, `university`, `student_id`, `start_date`, `end_date`, `status`, `updated_at`) VALUES
(1, 7, 1, '3', 'Đại học Bách Khoa', '2012000', '10/10/2022', '10/8/2023', 'Gia hạn', '2022-12-31 13:05:10'),
(2, 8, 1, '3', 'Đại học Bách Khoa', '2012001', '10/10/2022', '10/8/2023', 'Gia hạn', '2022-12-31 13:05:13'),
(3, 9, 3, '3', 'Đại học Khoa học tự nhiên', '2012002', '10/10/2022', '10/3/2022', 'Gia hạn', '2022-12-31 13:05:18'),
(4, 3, 6, '3', 'Đại học Bách Khoa', '2012003', '10/10/2022', '10/8/2022', 'Gia hạn', '2022-12-31 13:04:23'),
(5, 4, 6, '3', 'Đại học Bách Khoa', '2012004', '10/10/2022', '10/3/2022', 'Gia hạn', '2022-12-31 13:04:27'),
(6, 5, 15, '3', 'Đại học Bách Khoa', '2012005', '10/10/2022', '10/3/2022', 'Gia hạn', '2022-12-31 13:04:30'),
(7, 6, 6, '1', 'Đại học Bách Khoa', '2012006', '10/10/2022', '10/8/2022', 'Gia hạn', '2022-12-31 13:04:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `ssn` varchar(100) NOT NULL,
  `firstname` varchar(300) NOT NULL,
  `lastname` varchar(300) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `birthday` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(1000) DEFAULT "https://png.pngtree.com/png-vector/20190704/ourlarge/pngtree-businessman-user-avatar-free-vector-png-image_1538405.jpg",
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ssn`, `firstname`, `lastname`, `gender`, `birthday`, `country`, `phone`, `email`, `role`, `address`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, '099999999999', 'Tín', 'Lý Chánh', 'Nam', '2002-1-1', 'Việt Nam', '0999999999', 'admin1@gmail.com', 'admin', 'Dĩ An, Bình Dương', 'admin1', '123456', '2022-12-31 05:17:29', '2022-12-31 20:07:34'),
(2, '099999999998', 'Trọng', 'Nguyễn Văn', 'Nam', '2002-2-2', 'Việt Nam', '0999999998', 'admin2@gmail.com', 'admin', 'Dĩ An, Bình Dương', 'admin2', '123456', '2022-12-31 05:17:29', '2022-12-31 20:07:34'),
(3, '012345678901', 'Hùng', 'Nguyễn Hữu', 'Nam', '2002-12-12', 'Việt Nam', '0123456789', 'nguyenhuuhung@gmail.com', 'student', 'Quận 1, Thành phố HCM', '012345678901', '123456', '2022-12-31 05:17:29', '2022-12-31 20:07:34'),
(4, '012345678902', 'Nguyên', 'Nguyễn Chí', 'Nam', '2002-1-1', 'Việt Nam', '0223456789', 'nguyenchinguyen@gmail.com', 'student', 'Quận 7, Thành phố HCM', '012345678902', '123456', '2022-12-31 05:17:29', '2022-12-31 20:07:34'),
(5, '012345678903', 'Tín', 'Nguyễn Trung', 'Nam', '2002-12-1', 'Việt Nam', '0323456789', 'nguyentrungtin@gmail.com', 'student', 'Quận 3, Thành phố HCM', '012345678903', '123456', '2022-12-31 05:17:29', '2022-12-31 20:07:34'),
(6, '012345678904', 'Nam', 'Nguyễn Hoài', 'Nam', '2002-1-12', 'Việt Nam', '0423456789', 'namnguyenhoai@gmail.com', 'student', 'Quận 3, Thành phố HCM', 'namnguyen02', '12345', '2022-12-31 05:17:29', '2022-12-31 20:48:51'),
(7, '012345678905', 'Dung', 'Nguyễn Thị', 'Nữ', '2001-2-2', 'Việt Nam', '0523456789', 'nguyenthidung@gmail.com', 'student', 'Quận 4, Thành phố HCM', '012345678905', '123456', '2022-12-31 05:17:29', '2022-12-31 20:07:34'),
(8, '012345678906', 'Hân', 'Nguyễn Ngọc', 'Nữ', '2001-3-3', 'Việt Nam', '0623456789', 'nguyenngochan@gmail.com', 'student', 'Quận 6, Thành phố HCM', '012345678906', '123456', '2022-12-31 05:17:29', '2022-12-31 20:07:34'),
(9, '012345678907', 'Dung', 'Trần Kim', 'Nữ', '2003-2-3', 'Việt Nam', '0723456789', 'trankimdung@gmail.com', 'student', 'Quận 1, Thành phố HCM', '012345678907', '123456', '2022-12-31 05:17:29', '2022-12-31 20:07:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manager_id` (`manager_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `courts`
--
ALTER TABLE `courts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manager_id` (`manager_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `court_id` (`court_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courts`
--
ALTER TABLE `courts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bills_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bills_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `facilities`
--
ALTER TABLE `facilities`
  ADD CONSTRAINT `facilities_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `facilities_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`court_id`) REFERENCES `courts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
