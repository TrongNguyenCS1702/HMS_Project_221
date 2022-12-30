--
-- Table structure fore table `users`
--
CREATE TABLE `users` (
`id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
`ssn` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
`firstname` varchar(300) COLLATE utf8mb4_vietnamese_ci NOT NULL,
`lastname` varchar(300) COLLATE utf8mb4_vietnamese_ci NOT NULL,
`gender` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
`birthday` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
`country` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
`phone` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
`email` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
`role` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
`address` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
`username` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
`password` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
`created_at` timestamp NOT NULL DEFAULT current_timestamp(),
`updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
-- ---------------------------------------------------------

--
-- Table structure for table `students`
--
CREATE TABLE `students` (
`id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
`user_id` int NOT NULL,
`room_id` int,
`year` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
`university` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
`student_id` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
`status` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
`updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
-- --------------------------------------------------------


--
-- Table structure for table `admin`
--
CREATE TABLE `admin` (
`id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
`user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--
CREATE TABLE `notifications` (
`id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
`manager_id` int NOT NULL,
`title` varchar(300) COLLATE utf8mb4_vietnamese_ci NOT NULL,
`description` varchar(5000) COLLATE utf8mb4_vietnamese_ci NOT NULL,
`created_at` timestamp NOT NULL DEFAULT current_timestamp(),
`updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
-- --------------------------------------------------------

--
-- Table structure for table `courts`
--
CREATE TABLE `courts` (
`id`int NOT NULL PRIMARY KEY AUTO_INCREMENT,
`name` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
`type` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
`status` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--
CREATE TABLE `rooms` (
`id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
`court_id` int NOT NULL,
`slot` int NOT NULL,
`fee` int(12) NOT NULL,
`room_number` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
`type` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
`status` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
`updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--
CREATE TABLE `facilities` (
`id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
`room_id` int NOT NULL,
`student_id` int NOT NULL,
`description` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
`status` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
`created_at` timestamp NOT NULL DEFAULT current_timestamp(),
`updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
-- --------------------------------------------------------

--
-- Add Foreign Key for table `students`
--
ALTER TABLE `students`
ADD FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD FOREIGN KEY (`room_id`) REFERENCES `rooms`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
-- --------------------------------------------------------

--
-- Add Foreign Key for table `admin`
--
ALTER TABLE `admin`
ADD FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
-- --------------------------------------------------------
-- --------------------------------------------------------
--
-- Add Foreign Key for table `notifications`
--
ALTER TABLE `notifications`
ADD FOREIGN KEY (`manager_id`) REFERENCES `admin`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
-- --------------------------------------------------------

--
-- Add Foreign Key for table `rooms`
--
ALTER TABLE `rooms`
ADD FOREIGN KEY (`court_id`) REFERENCES `courts`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
-- --------------------------------------------------------

--
-- Add Foreign Key for table `facilities`
--
ALTER TABLE `facilities`
ADD FOREIGN KEY (`room_id`) REFERENCES `rooms`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD FOREIGN KEY (`student_id`) REFERENCES `students`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
-- --------------------------------------------------------

--
-- INSERT DATA
--

INSERT INTO `users`
(
    id,
    ssn,
    firstname,
    lastname,
    gender,
    birthday,
    country,
    phone,
    email,
    role,
    address,
    username,
    password
)
VALUES
(
    NULL,
    '099999999999',
    'Tín',
    'Lý Chánh',
    'Nam',
    '2002-1-1',
    'Việt Nam',
    '0999999999',
    'admin1@gmail.com',
    'admin',
    'Dĩ An, Bình Dương',
    'admin1',
    '123456'
),
(
    NULL,
    '099999999998',
    'Trọng',
    'Nguyễn Văn Trọng',
    'Nam',
    '2002-2-2',
    'Việt Nam',
    '0999999998',
    'admin2@gmail.com',
    'admin',
    'Dĩ An, Bình Dương',
    'admin2',
    '123456'
),
(
    NULL,
    '012345678901',
    'Hùng',
    'Nguyễn Hữu',
    'Nam',
    '2002-12-12',
    'Việt Nam',
    '0123456789',
    'nguyenhuuhung@gmail.com',
    'student',
    'Quận 1, Thành phố HCM',
    '012345678901',
    '012345678901'
),
(
    NULL,
    '012345678902',
    'Nguyên',
    'Nguyễn Chí',
    'Nam',
    '2002-1-1',
    'Việt Nam',
    '0223456789',
    'nguyenchinguyen@gmail.com',
    'student',
    'Quận 7, Thành phố HCM',
    '012345678902',
    '012345678902'
),
(
    NULL,
    '012345678903',
    'Tín',
    'Nguyễn Trung',
    'Nam',
    '2002-12-1',
    'Việt Nam',
    '0323456789',
    'nguyentrungtin@gmail.com',
    'student',
    'Quận 3, Thành phố HCM',
    '012345678903',
    '012345678903'
),
(
    NULL,
    '012345678904',
    'Hưng',
    'Trần Trung',
    'Nam',
    '2002-1-12',
    'Việt Nam',
    '0423456789',
    'trantrunghung@gmail.com',
    'student',
    'Quận 3, Thành phố HCM',
    '012345678904',
    '012345678904'
),
(
    NULL,
    '012345678905',
    'Dung',
    'Nguyễn Thị',
    'Nữ',
    '2001-2-2',
    'Việt Nam',
    '0523456789',
    'nguyenthidung@gmail.com',
    'student',
    'Quận 4, Thành phố HCM',
    '012345678905',
    '012345678905'
),
(
    NULL,
    '012345678906',
    'Hân',
    'Nguyễn Ngọc',
    'Nữ',
    '2001-3-3',
    'Việt Nam',
    '0623456789',
    'nguyenngochan@gmail.com',
    'student',
    'Quận 6, Thành phố HCM',
    '012345678906',
    '012345678906'
),
(
    NULL,
    '012345678907',
    'Dung',
    'Trần Kim',
    'Nữ',
    '2003-2-3',
    'Việt Nam',
    '0723456789',
    'trankimdung@gmail.com',
    'student',
    'Quận 1, Thành phố HCM',
    '012345678907',
    '012345678907'
);

INSERT INTO `courts`
(
    id,
    name,
    type,
    status
)
VALUES
(
    NULL,
    'A1',
    'Nữ',
    'Hoạt động'
),
(
    NULL,
    'A2',
    'Nam',
    'Hoạt động'
),
(
    NULL,
    'A3',
    'Nữ',
    'Hoạt động'
),
(
    NULL,
    'A4',
    'Nam',
    'Hoạt động'
),
(
    NULL,
    'A5',
    'Nữ',
    'Hoạt động'
),
(
    NULL,
    'A6',
    'Nam',
    'Hoạt động'
);



INSERT INTO `rooms`
(
    id,
    court_id,
    slot,
    fee,
    room_number,
    type,
    status
)
VALUES
(
    NULL,
    1,
    2,
    1000000,
    "101",
    "Phòng 2",
    "Còn 2 giường"
),
(
    NULL,
    1,
    4,
    750000,
    "102",
    "Phòng 4",
    "Còn 4 giường"
),
(
    NULL,
    1,
    6,
    500000,
    "201",
    "Phòng 6",
    "Còn 3 giường"
),
(
    NULL,
    1,
    0,
    0,
    "202",
    "Phòng Kho",
    "Kho"
),
(
    NULL,
    2,
    2,
    1000000,
    "101",
    "Phòng 2",
    "Còn 0 giường"
),
(
    NULL,
    2,
    4,
    750000,
    "102",
    "Phòng 4",
    "Còn 3 giường"
),
(
    NULL,
    2,
    6,
    500000,
    "201",
    "Phòng 6",
    "Còn 6 giường"
),
(
    NULL,
    2,
    0,
    0,
    "202",
    "Phòng Kho",
    "Kho"
),
(
    NULL,
    3,
    2,
    1000000,
    "101",
    "Phòng 2",
    "Còn 2 giường"
),
(
    NULL,
    3,
    4,
    750000,
    "102",
    "Phòng 4",
    "Còn 4 giường"
),
(
    NULL,
    3,
    6,
    500000,
    "201",
    "Phòng 6",
    "Còn 6 giường"
),
(
    NULL,
    3,
    0,
    0,
    "202",
    "Phòng Kho",
    "Kho"
),
(
    NULL,
    4,
    2,
    1000000,
    "101",
    "Phòng 2",
    "Còn 2 giường"
),
(
    NULL,
    4,
    4,
    750000,
    "102",
    "Phòng 4",
    "Còn 4 giường"
),
(
    NULL,
    4,
    6,
    500000,
    "201",
    "Phòng 6",
    "Còn 6 giường"
),
(
    NULL,
    4,
    0,
    0,
    "202",
    "Phòng Kho",
    "Kho"
);


INSERT INTO `admin`
(
    id,
    user_id
)
VALUES
(
    NULL,
    1
),
(
    NULL,
    2
);

INSERT INTO `students`
(
    id,
    user_id,
    room_id,
    year,
    university,
    student_id,
    status
)
VALUES
(
    NULL,
    3,
    5,
    '3',
    "Đại học Bách Khoa",
    "2012000",
    "Gia hạn"
),
(
    NULL,
    4,
    5,
    '3',
    "Đại học Bách Khoa",
    "2012001",
    "Gia hạn"
),
(
    NULL,
    5,
    6,
    '3',
    "Đại học Khoa học tự nhiên",
    "2012002",
    "Gia hạn"
),
(
    NULL,
    6,
    6,
    '3',
    "Đại học Bách Khoa",
    "2012003",
    "Trả phòng"
),
(
    NULL,
    7,
    3,
    '4',
    "Đại học Bách Khoa",
    "2012004",
    "Gia hạn"
),
(
    NULL,
    8,
    3,
    '4',
    "Đại học Bách Khoa",
    "2012005",
    "Gia hạn"
),
(
    NULL,
    9,
    3,
    '1',
    "Đại học Bách Khoa",
    "2012006",
    "Gia hạn"
);

INSERT INTO `notifications`
(
    id,
    manager_id,
    title,
    description
)
VALUES
(
    NULL,
    1,
    "Thông báo gia hạn phòng ở",
    "Sinh viên vào phần gia hạn để gia hạn phòng ở từ ngày 30/12/2022 đến ngày 5/1/2022"
),
(
    NULL,
    2,
    "Thông báo làm khảo sát nghỉ Tết",
    "Sinh viên vào forms.office.com/r/0000000 để làm khảo sát nghỉ Tết Âm lịch"
),
(
    NULL,
    2,
    "Thông báo lịch cúp điện",
    "Ký túc xá đại học Quốc gia thông báo với sinh viên ngày 3/1/2022 cúp điện từ 7h00 đến 11h00"
),
(
    NULL,
    2,
    "Thông báo lịch cúp nước",
    "Ký túc xá đại học Quốc gia thông báo với sinh viên ngày 4/1/2022 cúp điện từ 17h00 đến 19h00"
);

INSERT INTO `facilities`
(
    id,
    room_id,
    student_id,
    description,
    status
)
VALUES
(
    NULL,
    5,
    3,
    "Quạt trần bị hỏng",
    "Đang chờ"
),
(
    NULL,
    5,
    4,
    "Sàn nhà bị nứt",
    "Đã sửa chữa"
),
(
    NULL,
    3,
    7,
    "Tủ bị hư",
    "Đang chờ"
);