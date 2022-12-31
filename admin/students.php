<!DOCTYPE html>
<html lang="en">
<?php
session_start();
error_reporting(0);
include("../connect/connect.php");
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
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
                <!-- Student -->
                <div class="student">
                    <div class="row page-title">
                        <h2 class="student-title text-primary col-12">
                            Students

                        </h2>
                    </div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="student-tab" data-bs-toggle="tab"
                                data-bs-target="#student-tab-content" type="button" role="tab"
                                aria-controls="student-tab-content" aria-selected="true">Student</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="room-tab" data-bs-toggle="tab"
                                data-bs-target="#room-tab-content" type="button" role="tab"
                                aria-controls="room-tab-content" aria-selected="true">Rooms</button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="row tab-pane fade show active" id="student-tab-content">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h2 class="card-title">
                                            Student Data
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
                                                        <th scope='col'>Status</th>
                                                        <th scope='col'>Start Date</th>
                                                        <th scope='col'>End Date</th>
                                                        <th scope='col'>Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    $query = "select * from (((users as u
                                                      inner join
                                                                (select user_id, year, university, room_id, student_id, status as s_status , start_date, end_date from students) as s on u.id = s.user_id)
                                                      left outer join
                                                                (select id as r_id, room_number, court_id from rooms) as r on s.room_id = r.r_id)
                                                      left outer join
                                                                (select id as c_id, name from courts) as c on r.court_id = c.c_id)";

                                                    $result = mysqli_query($ktx, $query);

                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "
                                                    <tr>
                                                        <td>" . $row['name'] . "-" . $row['room_number'] . "</td>
                                                        <td>" . $row['ssn'] . "</td>
                                                        <td>" . $row['lastname'] . " " . $row['firstname'] . "</td>
                                                        <td>" . $row['phone'] . "</td>
                                                        <td>" . $row['year'] . "</td>
                                                        <td>" . $row['university'] . "</td>
                                                        <td>" . $row['username'] . "</td>
                                                        <td>" . $row['s_status'] . "</td>
                                                        <td>" . $row['start_date'] . "</td>
                                                        <td>" . $row['end_date'] . "</td>
                                                        <td>
                                                            <input value='$row[id]' style='display:none;'>
                                                            <button class='detail-btn btn btn-primary' data-bs-toggle='modal'
                                                                data-bs-target='#detail'>
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

                                        <div class="row">
                                            <a class="action-btn action-btn--add" href="./add_user.php
                                    ">Add Student</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row tab-pane fade" id="room-tab-content">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h2 class="card-title">
                                            Room Data
                                        </h2>

                                        <div class="row">
                                            <?php
                                            $query = "select *, c.id as c_id, count(r.id) as count
                                                      from (courts as c
                                                      left outer join rooms as r on r.court_id = c.id)
                                                      group by name";

                                            $result = mysqli_query($ktx, $query);

                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<div class='col-xl-3 room-btn'>
                                                        <input value='$row[c_id]' style='display:none;'>
                                                        <div class='card p-32 m-8'  style='background-color:#1c2d41; color:#fff;'>
                                                            <div class='card-content'>
                                                                $row[name]
                                                                <div class='card-text'>
                                                                    <h2 style='color:#fff;'>$row[count]</h2>
                                                                    <p>Room</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>";
                                            }
                                            ?>
                                        </div>

                                        <div class="row mt-16 room-container"></div>

                                        <div class="row">
                                            <a class="action-btn action-btn--add" href="./add_room.php
                                    ">Add Room</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- End Student -->

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
    $(document).ready(function() {
        $("#student__table").DataTable();
    })
    </script>
    <script src="../js/students.js"></script>

</body>

</html>