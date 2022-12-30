<!DOCTYPE html>
<html lang="en">
<?php
session_start();
error_reporting(0);
include("../connect/connect.php");

if ($_POST['submit']) {
    if (
        empty($_POST['ssn']) ||
        empty($_POST['firstname']) ||
        empty($_POST['lastname']) ||
        empty($_POST['gender']) ||
        empty($_POST['birthday']) ||
        empty($_POST['country']) ||
        empty($_POST['phone']) ||
        empty($_POST['email']) ||
        empty($_POST['username']) ||
        empty($_POST['password']) ||
        empty($_POST['address'])
    ) {
        $error = '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
																<strong>Bạn phải điền vào tất cả các ô!</strong>
															</div>';
    } else {
        $mql = "select *, users.id as u_id
                from users, admin
                where admin.id='$_SESSION[admin_id]'";
        $res = mysqli_query($ktx, $mql);
        $newrow = mysqli_fetch_array($res);

        $mql = "update users set ssn='$_POST[ssn]',
                                 firstname='$_POST[firstname]',
                                 lastname='$_POST[lastname]',
                                 gender='$_POST[gender]',
                                 birthday='$_POST[birthday]',
                                 country='$_POST[country]',
                                 phone='$_POST[phone]',
                                 email='$_POST[email]',
                                 username='$_POST[username]',
                                 password='$_POST[password]',
                                 address='$_POST[address]'
                where id = $newrow[u_id];
        ";
        $res = mysqli_query($ktx, $mql);

        $success = '<div class="alert alert-success alert-dismissible fade show">
																<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
																<strong>Tài khoản cập nhật thành công</strong></div>';
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
                <!-- Info -->
                <div class="dashboard">
                    <div class="row page-title">
                        <h2 class="dashboard-title text-primary col-12">Infomation</h2>
                    </div>

                    <?php
                    echo $error;
                    echo $success;
                    ?>

                    <div class="page-content">
                        <?php $ssql = "select *
                                        from users, admin
                                        where admin.id='$_SESSION[admin_id]'";
                        $res = mysqli_query($ktx, $ssql);
                        $newrow = mysqli_fetch_array($res);
                        ?>
                        <form action='' method='post'>
                            <div class="form-body">
                                <hr>
                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Username</label>
                                            <input type="text" name="username" class="form-control"
                                                value="<?php echo $newrow['username']; ?>">
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group has-danger">
                                            <label class="control-label">SSN</label>
                                            <input type="text" name="ssn" class="form-control form-control-danger"
                                                value="<?php echo $newrow['ssn']; ?>" placeholder="123456789012">
                                        </div>
                                    </div>
                                    <!--/span-->

                                </div>
                                <!--/row-->
                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group has-danger">
                                            <label class="control-label">Last Name</label>
                                            <input type="text" name="lastname" class="form-control form-control-danger"
                                                value="<?php echo $newrow['lastname']; ?>" placeholder="jon">
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">First Name</label>
                                            <input type="text" name="firstname" class="form-control" placeholder="doe"
                                                value="<?php echo $newrow['firstname']; ?>">
                                        </div>
                                    </div>

                                </div>
                                <!--/row-->

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
                                        <div class="form-group has-danger">
                                            <label class="control-label">Birthday</label>
                                            <input type="date" name="birthday" class="form-control form-control-danger"
                                                value="<?php echo date('Y-m-d', strtotime(str_replace('/', '-', $newrow['birthday']))); ?>"
                                                placeholder="01/01/2002">
                                        </div>
                                    </div>
                                    <!--/span-->

                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Address</label>
                                            <input type="text" name="address" class="form-control form-control-danger"
                                                value="<?php echo $newrow['address']; ?>" placeholder="Address">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Phone</label>
                                            <input type="text" name="phone" class="form-control form-control-danger"
                                                value="<?php echo $newrow['phone']; ?>" placeholder="Phone">

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Country</label>
                                            <input type="text" name="country" class="form-control form-control-danger"
                                                value="<?php echo $newrow['country']; ?>" placeholder="Country">

                                        </div>
                                    </div>

                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group has-danger">
                                            <label class="control-label">Email</label>
                                            <input type="text" name="email" class="form-control form-control-danger"
                                                value="<?php echo $newrow['email']; ?>" placeholder="example@gmail.com">
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Password</label>
                                            <input type="password" name="password"
                                                class="form-control form-control-danger" value=""
                                                placeholder="Nhập Mật khẩu">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Confirm Password</label>
                                            <input type="password" name="cpassword"
                                                class="form-control form-control-danger" value=""
                                                placeholder="Confirm Password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions mt-16">
                                <input type="submit" name="submit" class="btn btn-success" value="Update">
                                <a href="users.php" class="btn btn-inverse">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End Info -->




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