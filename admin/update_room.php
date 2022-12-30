<!DOCTYPE html>
<html lang="en">
<?php
session_start();
error_reporting(0);
include("../connect/connect.php");

if (isset($_POST['submit'])) {
    if (
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
            $mql = "update rooms set slot = $_POST[slot],
                                     fee = $_POST[fee],
                                     room_number = $_POST[room],
                                     type = 'Phòng $_POST[slot]'
                    where id = $_GET[id]";
            mysqli_query($ktx, $mql);

            $mql = "select (slot-count(s.id)) as count
                                from (rooms as r
                                left outer join students as s on s.room_id = r.id)
                                where room_id='$_GET[id]' ";
            mysqli_query($ktx, $mql);
            $result = mysqli_query($ktx, $mql);
            $row = mysqli_fetch_assoc($result);
            $count = $row['count'];

            $mql = "update rooms set status='Còn $count giường' where id='$_GET[id]' ";
            mysqli_query($ktx, $mql);

            $success = '<div class="alert alert-success alert-dismissible fade show">
                                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                            <strong>Phòng được cập nhật thành công</strong></div>';
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
                        <li>
                            <a href="./bills.php" class="nav-link">
                                <i class="nav-link-icon ti-notepad"></i>
                                <span>
                                    Bills
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
                        <h2 class="user-title text-primary col-12">Update Room</h2>
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

                                                    $query = "select *, c.type as c_type,c.id as c_id
                                                                  from rooms as r
                                                                  left outer join courts as c on r.court_id = c.id
                                                                  where r.id = $_GET[id]
                                                                  ";
                                                    $result = mysqli_query($ktx, $query);
                                                    $room = mysqli_fetch_array($result);

                                                    $selected_male = "";
                                                    $selected_female = "";

                                                    if ($room['c_type'] == 'Nam') {
                                                        $selected_male = 'selected';
                                                    } else {
                                                        $selected_female = 'selected';
                                                    }
                                                    ?>
                                                    <div class="row p-t-20">
                                                        <div class="col-md-6">
                                                            <div class="form-group has-danger">
                                                                <label class="control-label">Gender</label><br>
                                                                <select disabled
                                                                    style="font-size:medium; padding: 8px; border:1px solid rgb(232,232,232); color:rgb(80,80,80);background-color:#ddd;"
                                                                    name="gender" aria-label="select example">
                                                                    <option <?php echo $selected_male; ?>>Nam</option>
                                                                    <option <?php echo $selected_female; ?>>Nữ</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Court</label><br>
                                                                <select disabled
                                                                    style="font-size:medium; padding: 8px; border:1px solid rgb(232,232,232); color:rgb(80,80,80);background-color:#ddd;"
                                                                    name="court" aria-label="select example">
                                                                    <?php
                                                                    echo "<option selected value='" . $room['c_id'] . "' type='" . $room['c_type'] . "'>" . $room['name'] . "</option>";
                                                                    ?>
                                                                </select>

                                                            </div>
                                                        </div>


                                                    </div>

                                                    <?php
                                                    $type = array(
                                                        2 => '',
                                                        4 => '',
                                                        6 => '',
                                                        8 => ''
                                                    );
                                                    $type[$room['slot']] = 'selected';
                                                    ?>
                                                    <!--/row-->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Room</label>
                                                                <input type="text" name="room"
                                                                    class="form-control form-control-danger"
                                                                    value="<?php echo $room['room_number'] ?>"
                                                                    placeholder="Room">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Type</label><br>
                                                                <select
                                                                    style="font-size:medium; padding: 8px; border:1px solid rgb(232,232,232); color:rgb(80,80,80)"
                                                                    name="slot" aria-label="select example">
                                                                    <option <?php echo $type[2]; ?> value="2">Phòng 2
                                                                    </option>
                                                                    <option <?php echo $type[4]; ?> value="4">Phòng 4
                                                                    </option>
                                                                    <option <?php echo $type[6]; ?> value="6">Phòng 6
                                                                    </option>
                                                                    <option <?php echo $type[8]; ?> value="8">Phòng 8
                                                                    </option>
                                                                </select>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Fee</label>
                                                                <input type="text" name="fee"
                                                                    class="form-control form-control-danger"
                                                                    value="<?php echo $room['fee'] ?>"
                                                                    placeholder="Fee">
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <h2 class="card-title">
                                                            Room Member
                                                        </h2>
                                                        <div class="table-responsive">
                                                            <table id="student__table"
                                                                class="table table table-striped table-hover table-bordered no-wrap">
                                                                <thead class="thead-dark">
                                                                    <tr>
                                                                        <th scope='col'>Room</th>
                                                                        <th scope='col'>SSN</th>
                                                                        <th scope='col'>Name</th>
                                                                        <th scope='col'>Phone</th>
                                                                        <th scope='col'>Year</th>
                                                                        <th scope='col'>University</th>
                                                                        <th scope='col'>Username</th>
                                                                        <th scope='col'>Action</th>
                                                                    </tr>
                                                                </thead>

                                                                <tbody>
                                                                    <?php
                                                                    $query = "select * from (((users as u
                                                                            inner join
                                                                                        (select user_id, year, university, room_id, student_id, status as s_status from students) as s on u.id = s.user_id)
                                                                            left outer join
                                                                                        (select id as r_id, room_number, court_id from rooms) as r on s.room_id = r.r_id)
                                                                            left outer join
                                                                                        (select id as c_id, name from courts) as c on r.court_id = c.c_id)
                                                                            where r.r_id = $_GET[id]";

                                                                    $result = mysqli_query($ktx, $query);

                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                        if ($row['s_status'] == 'Trả phòng') {
                                                                            continue;
                                                                        }

                                                                        echo "
                                                                                <tr>
                                                                                    <td>" . $row['name'] . "-" . $row['room_number'] . "</td>
                                                                                    <td>" . $row['ssn'] . "</td>
                                                                                    <td>" . $row['lastname'] . " " . $row['firstname'] . "</td>
                                                                                    <td>" . $row['phone'] . "</td>
                                                                                    <td>" . $row['year'] . "</td>
                                                                                    <td>" . $row['university'] . "</td>
                                                                                    <td>" . $row['username'] . "</td>
                                                                                    <td>
                                                                                        <input value='$row[id]' style='display:none;'>
                                                                                        <button class='detail-btn btn btn-primary' data-bs-toggle='modal'
                                                                                            data-bs-target='#detail' type='button'>
                                                                                            <i class='ti-info-alt'></i>
                                                                                        </button>
                                                                                        <a class='edit-btn btn btn-warning' href='./update_user.php?user=" . $row['id'] . "'>
                                                                                            <i class='ti-settings'></i>
                                                                                        </a>
                                                                                        <a class='delete-btn btn btn-danger' href='./delete_user.php?id=" . $row['id'] . "&header=students'>
                                                                                            <i class='ti-close'></i>
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                                ";
                                                                    }
                                                                    ?>
                                                                </tbody>

                                                            </table>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-actions mt-16">
                                                    <input type="submit" name="submit" class="btn btn-success"
                                                        value="Update">
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



    <!-- Detail Modal -->
    <div class="modal fade" id="detail" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Infomation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form__info form-floating">
                                <input disabled type="text" class="form-control" placeholder="SSN" name="ssn">
                                <div class="validate-msg">

                                </div>
                                <label for="ssn" class="form__label">SSN</label>
                            </div>

                            <div class="form__info form-floating">
                                <input disabled type="text" class="form-control" placeholder="Name" name="name">
                                <div class="validate-msg">

                                </div>
                                <label for="name" class="form__label">Name</label>
                            </div>

                            <div class="form__info form-floating">
                                <input disabled type="text" class="form-control" placeholder="Gender" name="gender">
                                <div class="validate-msg">

                                </div>
                                <label for="gender" class="form__label">Gender</label>
                            </div>

                            <div class="form__info form-floating">
                                <input disabled type="date" class="form-control" placeholder="Birthday" name="birthday">
                                <div class="validate-msg">

                                </div>
                                <label for="birthday" class="form__label">Birthday</label>
                            </div>

                            <div class="form__info form-floating">
                                <input disabled type="text" class="form-control" placeholder="Country" name="country">
                                <div class="validate-msg">

                                </div>
                                <label for="country" class="form__label">Country</label>
                            </div>

                            <div class="form__info form-floating">
                                <input disabled type="text" class="form-control" placeholder="Phone" name="phone">
                                <div class="validate-msg">

                                </div>
                                <label for="phone" class="form__label">Phone</label>
                            </div>

                            <div class="form__info form-floating">
                                <input disabled type="text" class="form-control" placeholder="Email" name="email">
                                <div class="validate-msg">

                                </div>
                                <label for="email" class="form__label">Email</label>
                            </div>

                            <div class="form__info form-floating">
                                <input disabled type="text" class="form-control" placeholder="Address" name="address">
                                <div class="validate-msg">

                                </div>
                                <label for="address" class="form__label">Address</label>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form__info form-floating">
                                <input disabled type="text" class="form-control" placeholder="Username" name="username">
                                <div class="validate-msg">

                                </div>
                                <label for="username" class="form__label">Username</label>
                            </div>

                            <div class="form__info form-floating">
                                <input disabled type="text" class="form-control" placeholder="Password" name="password">
                                <div class="validate-msg">

                                </div>
                                <label for="password" class="form__label">Password</label>
                            </div>

                            <div class="form__info form-floating">
                                <input disabled type="text" class="form-control" placeholder="Year" name="year">
                                <div class="validate-msg">

                                </div>
                                <label for="year" class="form__label">Year</label>
                            </div>

                            <div class="form__info form-floating">
                                <input disabled type="text" class="form-control" placeholder="University"
                                    name="university">
                                <div class="validate-msg">

                                </div>
                                <label for="university" class="form__label">University</label>
                            </div>

                            <div class="form__info form-floating">
                                <input disabled type="text" class="form-control" placeholder="Student ID"
                                    name="student_id">
                                <div class="validate-msg">

                                </div>
                                <label for="student_id" class="form__label">Student ID</label>
                            </div>

                            <div class="form__info form-floating">
                                <input disabled type="text" class="form-control" placeholder="Room" name="room">
                                <div class="validate-msg">

                                </div>
                                <label for="room" class="form__label">Room</label>
                            </div>

                            <div class="form__info form-floating">
                                <input disabled type="text" class="form-control" placeholder="Status" name="status">
                                <div class="validate-msg">

                                </div>
                                <label for="status" class="form__label">Status</label>
                            </div>

                            <div class="form__info form-floating">
                                <input disabled type="text" class="form-control" placeholder="Register At"
                                    name="created_at">
                                <div class="validate-msg">

                                </div>
                                <label for="created_at" class="form__label">Register At</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <script src="../js/jquery-3.6.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
    changeRole();

    $("select[name='gender']")
        .change(changeGender)

    $("select[name='role']")
        .change(changeRole)

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

    function changeRole() {
        const role = $("select[name='role'] option:selected");

        if (role.val() == 'student') {
            $(".student_infomation").show();
            changeGender();
        } else {
            $(".student_infomation").hide();
        }

    }

    function changeCourt() {
        $(`select[name='room'] option`).hide();
        $(`select[name='room'] option:selected`).removeAttr("selected");

        const court = $("select[name='court'] option:selected").val();
        const rooms = $(`select[name='room'] option[court='${court}']`);

        rooms.show();
        rooms.first().attr("selected", "selected");
    }
    $(document).ready(function() {
        $("#student__table").DataTable();
    })
    </script>
    <script src="../js/students.js"></script>

</body>

</html>