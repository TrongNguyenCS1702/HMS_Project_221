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
                        <li class=" tag--active">
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
                <!-- Dashboard -->
                <div class="dashboard">
                    <div class="row page-title">
                        <h2 class="dashboard-title text-primary col-12">Dashboard</h2>
                    </div>

                    <div class="page-content">
                        <div class="row">
                            <?php
                            $query = "select count(id) as count from users";

                            $result = mysqli_query($ktx, $query);

                            $row = mysqli_fetch_assoc($result);
                            ?>
                            <div class="col-xl-3">
                                <a href="./users.php">
                                    <div class="card p-32 m-8">
                                        <div class="card-content">
                                            <i class="card-icon ti-user"></i>
                                            <div class="card-text">
                                                <h2>
                                                    <?php echo $row['count'] ?>
                                                </h2>
                                                <p>User</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                            $query = "select count(id) as count from students";

                            $result = mysqli_query($ktx, $query);

                            $row = mysqli_fetch_assoc($result);
                            ?>
                            <div class="col-xl-3">
                                <a href="./students.php">
                                    <div class="card p-32 m-8">
                                        <div class="card-content">
                                            <i class="card-icon ti-plus"></i>
                                            <div class="card-text">
                                                <h2>
                                                    <?php echo $row['count'] ?>
                                                </h2>
                                                <p>Student</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                            $query = "select count(id) as count from notifications";

                            $result = mysqli_query($ktx, $query);

                            $row = mysqli_fetch_assoc($result);
                            ?>
                            <div class="col-xl-3">
                                <a href="./notifications.php">
                                    <div class="card p-32 m-8">
                                        <div class="card-content">
                                            <i class="card-icon ti-bell"></i>
                                            <div class="card-text">
                                                <h2>
                                                    <?php echo $row['count'] ?>
                                                </h2>
                                                <p>Notification</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                            $query = "select count(id) as count from facilities";

                            $result = mysqli_query($ktx, $query);

                            $row = mysqli_fetch_assoc($result);
                            ?>
                            <div class="col-xl-3">
                                <a href="./facilities.php">
                                    <div class="card p-32 m-8">
                                        <div class="card-content">
                                            <i class="card-icon ti-home"></i>
                                            <div class="card-text">
                                                <h2>
                                                    <?php echo $row['count'] ?>
                                                </h2>
                                                <p>Facilities</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Dashboard -->




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

</body>