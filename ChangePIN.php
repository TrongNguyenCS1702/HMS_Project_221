<?php
session_start();
include_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = mysqli_query(
        $conn,
        "select password from users where id = {$_SESSION['user_id']}"
    );
    $row = mysqli_fetch_assoc($result);
    if ($_POST['new-pass'] != $_POST['verify-pass']) {
        $err = "Mật khẩu xác nhận không chính xác.";
    } else if ($_POST['old-pass'] != $row['password']) {
        $err = "Mật khẩu hiện tại không chính xác.";
    } else if ($_POST['old-pass'] == $_POST['new-pass']) {
        $err = "Mật khẩu mới trùng với mật khẩu hiện tại.";
    } else {
        $result = mysqli_query($conn, "update users set password = {$_POST['new-pass']} where id = {$_SESSION['user_id']}");
        $success = "Mật khẩu thay đổi thành công.";
    }
}

?>

<!DOCTYPE html>
<html>

<?php
$title = "Thay đổi mật khẩu";
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
                <div class="col-md-6 offset-md-3 mt-5">
                    <!-- <span class="anchor" id="formChangePassword"></span> -->
                    <div class="card card-outline-secondary">
                        <div class="card-header">
                            <h3 class="mb-0">Thay đổi mật khẩu</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" method="post">
                                <div class="form-group mb-3">
                                    <label>Mật khẩu hiện tại</label>
                                    <input type="password" class="form-control" name="old-pass" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Mật khẩu mới</label>
                                    <input type="password" class="form-control" name="new-pass" required>
                                    <!-- <span class="form-text small text-muted">
                                        The password must be 8-20 characters, and must <em>not</em> contain spaces.
                                    </span> -->
                                </div>
                                <div class="form-group mb-3">
                                    <label>Xác nhận</label>
                                    <input type="password" class="form-control" name="verify-pass" required>
                                    <!-- <span class="form-text small text-muted">
                                        Để xác nhận hãy nhập lại mật khẩu mới
                                    </span> -->
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Lưu mật khẩu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /form card change password -->
                </div>
            </div>
        </div>
    </div>

    <div class="overlay"></div>

    <?php require 'includes/script.php' ?>
</body>

</html>