<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}
include_once 'dbconn.php';
$result = mysqli_query(
    $conn,
    "select users.image, users.firstname, users.lastname, users.birthday, users.gender, students.year, students.university, students.student_id, users.ssn, users.address, users.email, users.phone
    from students, users
    where students.user_id = users.id and users.id = {$_SESSION['user_id']}"
);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>

<?php
$title = "Thông tin sinh viên";
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
                <li class="active"><a href="#">Thông tin sinh viên</a></li>
                <li><a href="rent.php">Thông tin lưu trú</a></li>
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
                        <button class="nav-link active" id="nav-info-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-info" type="button" role="tab" aria-controls="nav-info"
                            aria-selected="true" disabled>
                            Thông tin chung
                        </button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab"
                        tabindex="0">
                        <div class="container-fluid mt-3">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <div class="border border-3 border-light rounded-3 mx-auto shadow"
                                        style="width: 12em;">
                                        <img src="<?= $row['image'] == "" ? "assets/images/noimage.png" : $row['image'] ?>"
                                            class="img-fluid" alt="...">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h4 class="text-success my-3">
                                        <?= $row['lastname'] . " " . $row['firstname'] ?>
                                    </h4>
                                    <table id="table-info" class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Ngày sinh</th>
                                                <td>
                                                    <?= $row['birthday'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Giới tính</th>
                                                <td><?= $row['gender'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>SV năm</th>
                                                <td>
                                                    <?= $row['year'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Sinh viên trường</th>
                                                <td>
                                                    <?= $row['university'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>MSSV</th>
                                                <td><?= $row['student_id'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>CCCD</th>
                                                <td>
                                                    <?= $row['ssn'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Địa chỉ</th>
                                                <td>
                                                    <?= $row['address'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>
                                                    <?= $row['email'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Điện thoại</th>
                                                <td>
                                                    <?= $row['phone'] ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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