<!DOCTYPE html>
<html lang="en">
<?php
session_start();
error_reporting(0);
include("dbconn.php");

if (isset($_POST['submit'])) {
    if (
        empty($_POST['ssn']) ||
        empty($_POST['firstname']) ||
        empty($_POST['lastname']) ||
        empty($_POST['gender']) ||
        empty($_POST['birthday']) ||
        empty($_POST['country']) ||
        empty($_POST['phone']) ||
        empty($_POST['email']) ||
        empty($_POST['password']) ||
        empty($_POST['address']) ||
        empty($_POST['room']) ||
        empty($_POST['court']) ||
        empty($_POST['year']) ||
        empty($_POST['university']) ||
        empty($_POST['student_id'])

    ) {

        $error = '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
																<strong>Bạn phải điền vào tất cả các ô!</strong>
															</div>';
    } else {
        $check_username = mysqli_query($conn, "SELECT username FROM users where username = '$_POST[ssn]' ");


        if (mysqli_num_rows($check_username) > 0) {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
																<strong>Đã tồn tại căn cước công dân này!</strong>
															</div>';
        } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) // Validate email address
        {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
																<strong>Email không hợp lệ!</strong>
															</div>';
        } else if (strlen($_POST['ssn']) != 12) {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
																<strong>SSN có 12 ký tự!</strong>
															</div>';
        } else if (strlen($_POST['password']) < 6) {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
																<strong>Mật khẩu phải có nhiều hơn 5 ký tự!</strong>
															</div>';
        } else if (strlen($_POST['phone']) != 10) {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
																<strong>Số điện thoại không hợp lệ!</strong>
															</div>';
        } else if ($_POST['password'] != $_POST['cpassword']) { //matching passwords
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                <strong>Mật khẩu chưa chính xác! Vui lòng nhập lại</strong>
                                                            </div>';
        } else {
            if ($_POST['date'] == 1) {
                $start_date = "10/10/2022";
                $end_date = "10/8/2023";
            } else {
                $start_date = "10/10/2022";
                $end_date = "10/3/2023";
            }

            $mql = "insert into users
                                    (id,
                                    ssn,
                                    firstname,
                                    lastname,
                                    gender,
                                    birthday,
                                    country,
                                    phone,
                                    email,
                                    username,
                                    password,
                                    address,
                                    role)
                            values (NULL,
                                     '$_POST[ssn]',
                                     '$_POST[firstname]',
                                     '$_POST[lastname]',
                                     '$_POST[gender]',
                                     '$_POST[birthday]',
                                     '$_POST[country]',
                                     '$_POST[phone]',
                                     '$_POST[email]',
                                     '$_POST[ssn]',
                                     '$_POST[password]',
                                     '$_POST[address]',
                                     'student')";
            mysqli_query($conn, $mql);

            $mql = "select id, username from users where username = '$_POST[ssn]'";
            $result = mysqli_query($conn, $mql);
            $row = mysqli_fetch_assoc($result);
            $user_id = $row['id'];

            $mql = "insert into students
                                    (id,
                                    user_id,
                                    room_id,
                                    year,
                                    university,
                                    student_id,
                                    status,
                                    start_date,
                                    end_date)
                            values (NULL,
                                    '$user_id',
                                    '$_POST[room]',
                                    '$_POST[year]',
                                    '$_POST[university]',
                                    '$_POST[student_id]',
                                    'Gia hạn',
                                    '$start_date',
                                    '$end_date')";
            mysqli_query($conn, $mql);

            $mql = "select (slot-count(s.id)) as count
                            from (rooms as r
                            left outer join students as s on s.room_id = r.id)
                            where room_id='$_POST[room]' ";
            $result = mysqli_query($conn, $mql);
            $row = mysqli_fetch_assoc($result);
            $count = $row['count'];

            $mql = "update rooms set status='Còn $count giường' where id='$_POST[room]' ";
            mysqli_query($conn, $mql);

            $success = '<div class="alert alert-success alert-dismissible fade show">
																<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
																<strong>Tài khoản được tạo thành công</strong></div>';
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
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="./themify-icons/themify-icons.css">
    <title>Admin</title>
</head>

<body class="body_register">
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <?php include("./header.php"); ?>

        <div class="d-flex">

            <!-- End Left Sidebar -->

            <!-- Page Wrapper -->
            <div class="page-wrapper">
                <!-- User -->
                <div class="user">

                    <?php
                    echo $error;
                    echo $success;
                    ?>

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">


                                    <div class="card">

                                        <div class="card-body">
                                            <h1>Đăng Ký</h1>
                                            <form action='' method='post'>
                                                <div class="form-body">
                                                    <hr>
                                                    <div class="row p-t-20">
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group has-danger">
                                                                <label class="form-label">CCCD</label>
                                                                <input type="text" name="ssn"
                                                                    class="form-control form-control-danger" value=""
                                                                    placeholder="123456789012">
                                                            </div>
                                                        </div>
                                                        <!--/span-->

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Quốc tịch</label>
                                                                <input type="text" name="country"
                                                                    class="form-control form-control-danger" value=""
                                                                    placeholder="Việt Nam">

                                                            </div>
                                                        </div>

                                                    </div>
                                                    <!--/row-->
                                                    <div class="row p-t-20">
                                                        <div class="col-md-6">
                                                            <div class="form-group has-danger">
                                                                <label class="form-label">Họ và tên lót</label>
                                                                <input type="text" name="lastname"
                                                                    class="form-control form-control-danger" value=""
                                                                    placeholder="Nguyễn Văn">
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Tên</label>
                                                                <input type="text" name="firstname" class="form-control"
                                                                    placeholder="A" value="">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <!--/row-->

                                                    <div class="row p-t-20">
                                                        <div class="col-md-6">
                                                            <div class="form-group has-danger">
                                                                <label class="form-label">Giới tính</label><br>
                                                                <select
                                                                    style="font-size:medium; padding: 8px; border:1px solid rgb(232,232,232); color:rgb(80,80,80)"
                                                                    name="gender" aria-label="select example">
                                                                    <option>Nam</option>
                                                                    <option>Nữ</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group has-danger">
                                                                <label class="form-label">Ngày sinh</label>
                                                                <input type="date" name="birthday"
                                                                    class="form-control form-control-danger" value=""
                                                                    placeholder="01/01/2002">
                                                            </div>
                                                        </div>
                                                        <!--/span-->

                                                    </div>
                                                    <!--/row-->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Địa chỉ</label>
                                                                <input type="text" name="address"
                                                                    class="form-control form-control-danger" value=""
                                                                    placeholder="Dĩ An, Bình Dương">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Số điện thoại</label>
                                                                <input type="text" name="phone"
                                                                    class="form-control form-control-danger" value=""
                                                                    placeholder="0123456789">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="student_infomation">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Sinh viên năm</label>
                                                                    <input type="text" name="year"
                                                                        class="form-control form-control-danger"
                                                                        value="" placeholder="1">

                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Trường</label>
                                                                    <input type="text" name="university"
                                                                        class="form-control form-control-danger"
                                                                        value="" placeholder="Đại học Bách Khoa">

                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Mã số sinh viên</label>
                                                                    <input type="text" name="student_id"
                                                                        class="form-control form-control-danger"
                                                                        value="" placeholder="Mã số sinh viên">

                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group has-danger">
                                                                    <label class="form-label">Email</label>
                                                                    <input type="text" name="email"
                                                                        class="form-control form-control-danger"
                                                                        value="" placeholder="example@gmail.com">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Tòa</label><br>
                                                                    <select
                                                                        style="font-size:medium; padding: 8px; border:1px solid rgb(232,232,232); color:rgb(80,80,80)"
                                                                        name="court" aria-label="select example">
                                                                        <option value="0" type="0">Chọn tòa</option>
                                                                        <?php
                                                                        $query = "select * from courts";
                                                                        $result = mysqli_query($conn, $query);
                                                                        while ($court = mysqli_fetch_array($result)) {
                                                                            echo "<option value='" . $court['id'] . "' type='" . $court['type'] . "'>" . $court['name'] . "</option>";
                                                                        }
                                                                        ?>
                                                                    </select>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Phòng</label><br>
                                                                    <select
                                                                        style="font-size:medium; padding: 8px; border:1px solid rgb(232,232,232); color:rgb(80,80,80)"
                                                                        name="room" aria-label="select example">
                                                                        <option value="0" court="0">Chọn phòng</option>

                                                                        <?php
                                                                        $query = "select *, count(s_id) as slot_count
                                                                                from (rooms
                                                                                left outer join (select id as s_id, room_id from students) as s on rooms.id = s.room_id)
                                                                                GROUP by id;";
                                                                        $result = mysqli_query($conn, $query);
                                                                        while ($room = mysqli_fetch_array($result)) {
                                                                            if ($room['slot_count'] != $room['slot'])
                                                                                echo "<option value='" . $room['id'] . "' court='" . $room['court_id'] . "'>" . $room['room_number'] . "</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Đăng ký</label><br>
                                                                    <input type="radio" name="date" value="1"
                                                                        placeholder="Cả năm">
                                                                    <span style="font-size: 1.5rem; margin-left:4px"> Cả
                                                                        năm</span>
                                                                    <br>
                                                                    <input type="radio" name="date" value="2"
                                                                        placeholder="1 Học kì">
                                                                    <span style="font-size: 1.5rem; margin-left:4px">1
                                                                        Học kì</span>
                                                                    <br>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Nhập mật khẩu</label>
                                                                <input type="password" name="password"
                                                                    class="form-control form-control-danger" value=""
                                                                    placeholder="Nhập Mật khẩu">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Nhập lại mật khẩu</label>
                                                                <input type="password" name="cpassword"
                                                                    class="form-control form-control-danger" value=""
                                                                    placeholder="Nhập lại mật khẩu">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions mt-16">
                                                    <input type="submit" name="submit" class="btn btn-success"
                                                        value="Đăng ký">
                                                    <a href="login.php" class="btn btn-success">Đăng Nhập</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- End User -->

                <!-- Footer -->
                <div class="footer">
                    <h3 class="copyright">© 2022 All right reserved</h3>
                </div>
                <!-- End Footer -->
            </div>
            <!-- End Wrapper -->
        </div>
    </div>
    <!-- End Wrapper -->







    <script src="./js/jquery-3.6.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script>
    changeGender();

    $("select[name='gender']")
        .change(changeGender)

    $("select[name='court']")
        .change(changeCourt)

    function changeGender() {
        $(`select[name='court'] option`).hide();
        $(`select[name='court'] option:selected`).removeAttr("selected");

        const gender = $("select[name='gender'] option:selected").text();
        const courts = $(`select[name='court'] option[type='${gender}']`);

        courts.show();
        courts.first().attr("selected", "selected");
        changeCourt()
    }

    function changeCourt() {
        $(`select[name='room'] option`).hide();
        $(`select[name='room'] option:selected`).removeAttr("selected");

        const court = $("select[name='court'] option:selected").val();
        const rooms = $(`select[name='room'] option[court='${court}']`);

        rooms.show();
        rooms.first().attr("selected", "selected");
    }
    </script>
</body>

</html>