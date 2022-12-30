<!DOCTYPE html>
<html lang="en">
<?php
session_start();
error_reporting(0);
include("../connect/connect.php");
if (isset($_POST['submit'])) {
    if (
        empty($_POST['title']) ||
        empty($_POST['time']) ||
        empty($_POST['bill'])
    ) {

        $error = '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
																<strong>Bạn phải điền vào tất cả các ô!</strong>
															</div>';
    } else {
        $mql = "insert into bills (id, manager_id, student_id, room_id, title, time, bill, status) values (NULL, $_SESSION[admin_id], NULL, $_POST[room], '$_POST[title]','$_POST[time]',$_POST[bill], 'Chưa thanh toán')";
        mysqli_query($ktx, $mql);

        $success = '<div class="alert alert-success alert-dismissible fade show">
																<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
																<strong>Hóa đơn được thêm vào thành công</strong></div>';
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
                        <li>
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
                        <li class=" tag--active">
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

                <!-- Notification -->
                <div class="notification">
                    <div class="row page-title">
                        <h2 class="user-title text-primary col-12">Add Bill</h2>
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
                                        Bill Data
                                    </h2>

                                    <div class="card">

                                        <div class="card-body">
                                            <form action="" method="POST" class="add-form">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Court</label><br>
                                                            <select
                                                                style="font-size:medium; padding: 8px; border:1px solid rgb(232,232,232); color:rgb(80,80,80)"
                                                                name="court" aria-label="select example">
                                                                <option value="0" type="0">Chọn Tòa</option>
                                                                <?php
                                                                $query = "select * from courts";
                                                                $result = mysqli_query($ktx, $query);
                                                                while ($court = mysqli_fetch_array($result)) {
                                                                    echo "<option value='" . $court['id'] . "' type='" . $court['type'] . "'>" . $court['name'] . "</option>";
                                                                }
                                                                ?>
                                                            </select>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Room</label><br>
                                                            <select
                                                                style="font-size:medium; padding: 8px; border:1px solid rgb(232,232,232); color:rgb(80,80,80)"
                                                                name="room" aria-label="select example">
                                                                <option value="0" court="0">Chọn Phòng</option>

                                                                <?php
                                                                $query = "select *, count(s_id) as slot_count
                                                                                from (rooms
                                                                                left outer join (select id as s_id, room_id from students) as s on rooms.id = s.room_id)
                                                                                GROUP by id;";
                                                                $result = mysqli_query($ktx, $query);
                                                                while ($room = mysqli_fetch_array($result)) {
                                                                    echo "<option value='" . $room['id'] . "' court='" . $room['court_id'] . "'>" . $room['room_number'] . "</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" placeholder="Title"
                                                                name="title" onchange="validateTitle(this)">
                                                            <div class="validate-msg">

                                                            </div>
                                                            <label for="title" class="form__label">Title</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control"
                                                                placeholder="Month/Year" name="time"
                                                                onchange="validateTitle(this)">
                                                            <div class="validate-msg">

                                                            </div>
                                                            <label for="time" class="form__label">Month/Year</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" placeholder="Bill"
                                                                name="bill" onchange="validateTitle(this)">
                                                            <div class="validate-msg">

                                                            </div>
                                                            <label for="bill" class="form__label">Bill</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" placeholder="Note"
                                                                name="note" onchange="validateTitle(this)">
                                                            <div class="validate-msg">

                                                            </div>
                                                            <label for="note" class="form__label">Note</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <input type="submit" id="submit"
                                                    class="form-control action-btn action-btn--add btn btn-primary"
                                                    name="submit">

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
    <script>
    changeCourt()

    $("select[name='court']")
        .change(changeCourt)

    function changeCourt() {
        $(`select[name='room'] option`).hide();
        $(`select[name='room'] option:selected`).removeAttr("selected");

        const court = $("select[name='court'] option:selected").val();
        const rooms = $(`select[name='room'] option[court='${court}']`);

        rooms.show();
        rooms.first().attr("selected", "selected");
    }
    </script>
    <script src="../js/bills.js"></script>

</body>

</html>