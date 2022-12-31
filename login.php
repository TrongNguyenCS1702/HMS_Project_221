<?php
session_start();

?>
<html>

<head>
    <title>Trang đăng nhập</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords"
        content="Official Signup Form Responsive, Login form web template,Flat Pricing tables,Flat Drop downs  Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
    <!-- fonts -->
    <link href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
    <!-- /fonts -->
    <!-- css -->

    <link href="css/style.css" rel='stylesheet' type='text/css' media="all" />
    <!-- /css -->
</head>

<body>
    <?php
    //Gọi file connection.php ở bài trước
    require_once "connection.php";
    // Kiểm tra nếu người dùng đã ân nút đăng nhập thì mới xử lý
    if (isset($_POST["btn_submit"])) {
        // lấy thông tin người dùng
        $username = $_POST["username"];
        $password = $_POST["password"];
        //làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt
        //mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
        $username = strip_tags($username);
        $username = addslashes($username);
        $password = strip_tags($password);
        $password = addslashes($password);
        if ($username == "" || $password == "") {
            echo "username hoặc password bạn không được để trống!";
        } else {
            $sql = "select * from users where username = '$username' and password = '$password' ";
            $query = mysqli_query($conn, $sql);
            $num_rows = mysqli_num_rows($query);
            if ($num_rows == 0) {
                echo '<script>alert("Incorrect email and passwword")</script>';
                require_once "login.php";

            } else {
                //tiến hành lưu tên đăng nhập vào session để tiện xử lý sau này
                $_SESSION['username'] = $username;
                // Thực thi hành động sau khi lưu thông tin vào session
                // ở đây mình tiến hành chuyển hướng trang web tới một trang gọi là index.php
                header('Location: index.php');
            }
        }
    }
    ?>
    <h3 class="w3ls">TRANG THÔNG TIN SINH VIÊN KTX ĐẠI HỌC QUỐC GIA</h3>

    <div class="content-w3ls">
        <div class="content-agile1">
            <h2 class="agileits1">Official</h2>
            <p class="agileits2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
        <div class="content-agile2">
            <h3 class="w3ls">Đăng nhập</h3>
            <form method="POST" action="login.php">
                <div class="form-control w3layouts">
                    <input type="text" id="firstname" name="username" placeholder="CMND/CCCD"
                        title="Please enter your First Name" required="">
                </div>



                <div class="form-control agileinfo">
                    <input type="password" class="lock" name="password" placeholder="Password" id="password1"
                        required="">
                </div>
                <input class="login" name="btn_submit" type="submit" value="Đăng nhập">
                <a href="register.php"><input class="login" value="Đăng Ký"></a>
            </form>

        </div>
        <div class="clear"></div>
</body>

</html>