<?php
if (isset($_SESSION['user_id']))
    header('Location: index.php');
?>

<?php
include_once 'dbconn.php';
if (isset($_POST['login'])) {
    session_start();
    $result = mysqli_query(
        $conn,
        "select users.id, students.id as std_id
        from users, students
        where users.username = '" . $_POST['username'] . "' and users.password = '" . $_POST['password'] . "' and students.user_id = users.id"
    );
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['std_id'] = $row['std_id'];
        header("Location: index.php");
    } else {
        $err = "Email hoặc Mật khẩu không chính xác.";
    }
}
?>

<!DOCTYPE html>
<html>

<?php
$title = "Đăng nhập";
require 'includes/head.php';
?>

<body>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="assets/images/draw2.svg" class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <div class="my-5 text-center">
                        <h4>TRANG DÀNH CHO SINH VIÊN</h4>
                    </div>
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Tên đăng nhập</label>
                            <input type="text" class="form-control" name="username" required placeholder="Nhập username">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" required placeholder="Nhập mật khẩu">
                        </div>
                        <div class="mb-3">
                            Chưa có tài khoản? <a href="register.php" class="text-primary"><strong>Đăng ký</strong></a> 
                        </div>
                        <button type="submit" class="btn btn-primary" name="login">Đăng nhập</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>