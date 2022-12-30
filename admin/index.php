<!DOCTYPE html>
<html lang="en">
<?php
include("../connect/connect.php");
error_reporting(0);
session_start();
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // $pwd = password_hash($password, PASSWORD_BCRYPT);
    if (!empty($_POST["submit"])) {
        $loginquery = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($ktx, $loginquery);
        $row = mysqli_fetch_array($result);

        if (is_array($row)) {
            if ($password == $row['password'] && $row['role'] == "admin") {
                $_SESSION["admin_id"] = $row['id'];
                $success = "Đăng nhập thành công";
                header("refresh:1;url=dashboard.php");
            } else {
                $message = "Mật khẩu không chính xác!";
            }
        } else {
            $message = "Tên đăng nhập không chính xác hoặc bạn không được cấp quyền đăng nhập!";
        }
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../css/admin_login.css">
    <link rel="stylesheet" href="../themify-icons/themify-icons.css">
    <title>Admin</title>
</head>

<body>


    <div class="modal show" style="display: block;">
        <div class="container">
            <div class="info">
                <h1 style="font-weight:600; color:blue">ADMINISTRATOR</h1><span style="color:red; font-weight:600;
            font-size:medium">Hãy rời đi nếu bạn không được cấp quyền truy cập!</span>
            </div>
        </div>
        <div class="form">
            <div class="thumbnail"><img src="../img/manager.png" /></div>

            <!--span>Tên đăng nhập:admin</span>&nbsp;<span>Mật khẩu:123456</span-->

            <div style="color:red;">
                <?php echo $message; ?>
            </div>
            <span style="color:green; font-weight:600"><?php echo $success; ?></span>
            <br><br>
            <form class="login-form" action="index.php" method="post">
                <input type="text" placeholder="Nhập tên đăng nhập" name="username" />
                <input type="password" placeholder="Nhập mật khẩu" name="password" />
                <input type="submit" name="submit" value="Đăng nhập" />
            </form>

        </div>
    </div>

    <script src="../js/jquery-3.6.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

</body>

</html>