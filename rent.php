<?php
session_start();
include_once 'dbconn.php';
?>

<!DOCTYPE html>
<html>

<?php
$title = "Thông tin lưu trú";
require 'includes/head.php';
?>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div id="dismiss">
                <i class="fas fa-arrow-left"></i>
            </div>
            <div class="sidebar-header">
                <img src="assets/images/logo.png" class="img-thumbnail" style="width: 40%;" alt="...">
            </div>
            <!-- list-unstyled components -->
            <ul class="list-unstyled border-top border-bottom py-5">
                <li><a href="index.php">Thông tin sinh viên</a></li>
                <li class="active"><a href="#">Thông tin lưu trú</a></li>
                <li><a href="invoice.php">Hóa đơn, biên lai</a></li>
                <li><a href="request.php">Yêu cầu sửa chữa</a></li>
                <li><a href="notification.php">Thông báo</a></li>
            </ul>
            <ul class="list-unstyled CTAs">
                <li><a href="ChangePIN.php" class="download">Đổi mật khẩu</a></li>
                <li><a href="logout.php" class="article">Đăng xuất</a></li>
            </ul>
        </nav>
        <!-- Page Content  -->
        <div id="content">
            <!-- Top navigation-->
            <?php require 'includes/navigation.php' ?>
            <!-- Main content-->
            <div class="container-fluid">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                            aria-selected="true">Lịch sử thuê phòng</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                            type="button" role="tab" aria-controls="nav-profile" aria-selected="false">DS cùng
                            phòng</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                        tabindex="0">
                        <div class="container-fluid mt-3">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                Lưu ý: Hệ thống chỉ lưu lần lưu trú mới nhất!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <table class="table table-bordered table-sm table-hover">
                                <thead>
                                    <tr class="bg-light">
                                        <th style="width: 15%">Ngày tạo</th>
                                        <th style="width: 15%">Tình trạng</th>
                                        <th style="width: 15%">Nhà/Phòng KTX</th>
                                        <th style="width: 25%">Loại phòng</th>
                                        <th style="width: 15%">Ngày bắt đầu ở</th>
                                        <th style="width: 15%">Ngày trả phòng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = mysqli_query(
                                        $conn,
                                        "select students.updated_at, students.status, courts.name, rooms.room_number, rooms.type, students.start_date, students.end_date
                                        from students, courts, rooms
                                        where students.id = {$_SESSION['std_id']} and rooms.id = students.room_id and courts.id = rooms.court_id"
                                    );
                                    while ($row = mysqli_fetch_assoc($result)):
                                        ?>
                                    <tr>
                                        <td><?= $row['updated_at'] ?></td>
                                        <td>
                                            <?= $row['status'] ?>
                                        </td>
                                        <td><?= $row['name'] . " - " . $row['room_number'] ?></td>
                                        <td>
                                            <?= substr_replace($row['type'], " dịch vụ ", 7, 0) . " sinh viên" ?>
                                        </td>
                                        <td><?= $row['start_date'] ?></td>
                                        <td>
                                            <?= $row['end_date'] ?>
                                        </td>
                                    </tr>
                                    <?php endwhile ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                        tabindex="0">
                        <div class="container-fluid mt-3">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Bạn có thể liên lạc thành viên cùng phòng với thông tin dưới đây.
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="bg-light">
                                        <th style="width: 20%">Họ tên</th>
                                        <th style="width: 20%">Điện thoại</th>
                                        <th style="width: 30%">Email</th>
                                        <th style="width: 30%">Trường</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = mysqli_query(
                                        $conn,
                                        "select users.id, users.firstname, users.lastname, users.phone, users.email, students.university
                                        from users, students
                                        where students.room_id = (
                                            select room_id
                                            from students
                                            where id = {$_SESSION['std_id']}
                                        ) and users.id = students.user_id;"
                                    );
                                    if (mysqli_num_rows($result) < 1):
                                        ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Bạn là thành viên đầu tiên ở phòng này.</td>
                                    </tr>
                                    <?php
                                    endif;
                                    while ($row = mysqli_fetch_assoc($result)):
                                        ?>
                                    <tr <?= $row['id'] == $_SESSION['user_id'] ? "style='display: none;'" : "" ?>>
                                        <td>
                                            <?= $row['lastname'] . " " . $row['firstname'] ?>
                                        </td>
                                        <td>
                                            <?= $row['phone'] ?>
                                        </td>
                                        <td><?= $row['email'] ?></td>
                                        <td>
                                            <?= $row['university'] ?>
                                        </td>
                                    </tr>
                                    <?php endwhile ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="overlay"></div>

    <?php require 'includes/script.php' ?>
</body>

</html>