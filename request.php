<?php
session_start();
include_once 'dbconn.php';
?>

<!DOCTYPE html>
<html>

<?php
$title = "Lịch sử yêu cầu sửa chữa";
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
                <li><a href="rent.php">Thông tin lưu trú</a></li>
                <li><a href="invoice.php">Hóa đơn, biên lai</a></li>
                <li class="active"><a href="#">Yêu cầu sửa chữa</a></li>
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
                            aria-selected="true" disabled>Yêu cầu sửa chữa</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                        tabindex="0">
                        <div class="container-fluid mt-3">
                            <div class="mb-3">
                                <?php
                                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                    $rs = mysqli_query(
                                        $conn,
                                        "insert into facilities (room_id, student_id, description, status)
                                        values (
                                            (select room_id from students where id = {$_SESSION['std_id']}),
                                            {$_SESSION['std_id']},
                                            '{$_POST['content-request']}',
                                            'Đã tiếp nhận'
                                        )"
                                    );
                                }
                                ?>
                                <form class="form" method="post">
                                    <input type="text" name="content-request" class="form-control"
                                        placeholder="Nhập nội dung sửa chữa">
                                    <input type="submit" class="btn btn-success mt-3" value="Gửi yêu cầu">
                                </form>
                            </div>
                            <hr>
                            <h4 class="text-success mb-3">Danh sách yêu cầu</h4>
                            <!-- <h3 class="text-success my-3">Danh sách yêu cầu</h3> -->
                            <table class="table table-bordered table-sm table-hover">
                                <thead>
                                    <tr class="bg-light">
                                        <th style="width: 20%">Ngày gửi yêu cầu</th>
                                        <th style="width: 15%">Nhà/Phòng KTX</th>
                                        <th style="width: 50%">Nội dung sửa chữa</th>
                                        <th style="width: 15%">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = mysqli_query(
                                        $conn,
                                        "select facilities.created_at, facilities.description, facilities.status, rooms.room_number, courts.name
                                        from facilities, rooms, courts
                                        where facilities.student_id	= {$_SESSION['std_id']} and rooms.id = (select room_id from students where id = {$_SESSION['std_id']}) and courts.id = rooms.court_id
                                        order by facilities.created_at desc;"
                                    );
                                    while ($row = mysqli_fetch_assoc($result)):
                                        ?>
                                    <tr>
                                        <td><?= $row['created_at'] ?></td>
                                        <td>
                                            <?= $row['name'] . " - " . $row['room_number'] ?>
                                        </td>
                                        <td><?= $row['description'] ?></td>
                                        <td>
                                            <?= $row['status'] ?>
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