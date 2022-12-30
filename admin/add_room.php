<!DOCTYPE html>
<html lang="en">
<?php
session_start();
error_reporting(0);
include("../connect/connect.php");

if (isset($_POST['submit'])) {
    if (
        empty($_POST['gender']) ||
        empty($_POST['court']) ||
        empty($_POST['room']) ||
        empty($_POST['slot']) ||
        empty($_POST['fee'])
    ) {

        $error = '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
																<strong>Bạn phải điền vào tất cả các ô!</strong>
															</div>';
    } else {
        $check_room = mysqli_query($ktx, "  select *
                                            from (rooms as r
                                            left outer join courts as c on r.court_id = c.id)
                                            where r.room_number = '$_POST[room]' and r.court_id=$_POST[court];");

        if (mysqli_num_rows($check_room) > 0) {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                <strong>Phòng đã tồn tại!</strong>
                                                            </div>';
        } else {
            $mql = "insert into rooms (id,
                                      court_id,
                                      slot,
                                      fee,
                                      room_number,
                                      type,
                                      status)
                    values (NULL,
                            $_POST[court],
                            $_POST[slot],
                            $_POST[fee],
                            $_POST[room],
                            'Phòng $_POST[slot]',
                            'Còn $_POST[slot] giường')";
            mysqli_query($ktx, $mql);

            $success = '<div class="alert alert-success alert-dismissible fade show">
                                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                            <strong>Phòng được tạo thành công</strong></div>';
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
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../themify-icons/themify-icons.css">
    <title>Admin</title>
</head>

<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <?php include("./header.php"); ?>

        <div class="d-flex">
            <!-- Left Sidebar -->
            <div class="left-sidebar collapse show" id="sidebar">
                <nav class="sidebar-nav">
                    <ul class="sidebar-list">
                        <li class="nav-title">Home</li>
                        <li>
                            <a href="./dashboard.php" class="nav-link">
                                <i class="nav-link-icon ti-dashboard"></i>
                                <span>
                                    Dashboard
                                </span>
                                <i class="ti-angle-right collapse-icon"></i>
                            </a>
                        </li>
                        <li class="nav-title">Log</li>
                        <li>
                            <a href="./users.php" class="nav-link">
                                <i class="nav-link-icon ti-user"></i>
                                <span>
                                    User
                                </span>
                                <i class="ti-angle-right collapse-icon"></i>
                            </a>
                        </li>
                        <li class=" tag--active">
                            <a href="./students.php" class="nav-link">
                                <i class="nav-link-icon ti-face-smile"></i>
                                <span>
                                    Students
                                </span>
                                <i class="ti-angle-right collapse-icon"></i>
                            </a>
                        </li>
                        <li>
                            <a href="./notifications.php" class="nav-link">
                                <i class="nav-link-icon ti-bell"></i>
                                <span>
                                    Notification
                                </span>
                                <i class="ti-angle-right collapse-icon"></i>
                            </a>
                        </li>
                        <li>
                            <a href="./facilities.php" class="nav-link">
                                <i class="nav-link-icon ti-home"></i>
                                <span>
                                    Facilities
                                </span>
                                <i class="ti-angle-right collapse-icon"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- End Left Sidebar -->

            <!-- Page Wrapper -->
            <div class="page-wrapper">
                <!-- User -->
                <div class="user">
                    <div class="row page-title">
                        <h2 class="user-title text-primary col-12">Add Room</h2>
                    </div>

                    <?php
                    echo $error;
                    echo $success;
                    ?>

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title">
                                        Room Data
                                    </h2>

                                    <div class="card">

                                        <div class="card-body">
                                            <form action='' method='post'>
                                                <div class="form-body">
                                                    <hr>
                                                    <?php

                                                    if ($newrow['role'] == "student") {
                                                        $query = "select *
                                                                  from (((students
                                                                  inner join (select id as u_id from users) as u on students.user_id = u.u_id)
                                                                  inner join (select id as r_id, room_number, court_id from rooms) as r on students.room_id = r.r_id)
                                                                  inner join (select id as c_id, name as court from courts) as c on r.court_id = c.c_id)
                                                                  where u_id='$_GET[user]'";
                                                        $result = mysqli_query($ktx, $query);
                                                        $student = mysqli_fetch_array($result);
                                                    }


                                                    ?>
                                                    <div class="row p-t-20">
                                                        <div class="col-md-6">
                                                            <div class="form-group has-danger">
                                                                <label class="control-label">Gender</label><br>
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
                                                            <div class="form-group">
                                                                <label class="control-label">Court</label><br>
                                                                <select
                                                                    style="font-size:medium; padding: 8px; border:1px solid rgb(232,232,232); color:rgb(80,80,80)"
                                                                    name="court" aria-label="select example">
                                                                    <?php
                                                                    $query = "select * from courts";
                                                                    $result = mysqli_query($ktx, $query);
                                                                    while ($court = mysqli_fetch_array($result)) {
                                                                        if ($student['court'] == $court['name'])
                                                                            $selected = " selected";
                                                                        else
                                                                            $selected = "";
                                                                        echo "<option" . $selected . " value='" . $court['id'] . "' type='" . $court['type'] . "'>" . $court['name'] . "</option>";
                                                                    }
                                                                    ?>
                                                                </select>

                                                            </div>
                                                        </div>


                                                    </div>
                                                    <!--/row-->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Room</label>
                                                                <input type="text" name="room"
                                                                    class="form-control form-control-danger" value=""
                                                                    placeholder="Room">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Type</label><br>
                                                                <select
                                                                    style="font-size:medium; padding: 8px; border:1px solid rgb(232,232,232); color:rgb(80,80,80)"
                                                                    name="slot" aria-label="select example">
                                                                    <option value="2">Phòng 2</option>
                                                                    <option value="4">Phòng 4</option>
                                                                    <option value="6">Phòng 6</option>
                                                                    <option value="8">Phòng 8</option>
                                                                </select>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Fee</label>
                                                                <input type="text" name="fee"
                                                                    class="form-control form-control-danger" value=""
                                                                    placeholder="Fee">
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="form-actions mt-16">
                                                    <input type="submit" name="submit" class="btn btn-success"
                                                        value="Add">
                                                    <a href="students.php" class="btn btn-inverse">Cancel</a>
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







    <script src="../js/jquery-3.6.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="../js/users.js"></script>
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