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
                        <li class=" tag--active">
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
                    </ul>
                </nav>
            </div>
            <!-- End Left Sidebar -->

            <!-- Page Wrapper -->
            <div class="page-wrapper">
                <!-- User -->
                <div class="user">
                    <div class="row page-title">
                        <h2 class="user-title text-primary col-12">User</h2>
                    </div>

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title">
                                        User Data
                                    </h2>

                                    <div class="table-responsive">
                                        <table id="user__table"
                                            class="table table-striped table-hover table-bordered no-wrap">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope='col'>#</th>
                                                    <th scope='col'>Role</th>
                                                    <th scope='col'>Username</th>
                                                    <th scope='col'>SSN</th>
                                                    <th scope='col'>Name</th>
                                                    <th scope='col'>Gender</th>
                                                    <th scope='col'>Birthday</th>
                                                    <th scope='col'>Phone</th>
                                                    <th scope='col'>Email</th>
                                                    <th scope='col'>Address</th>
                                                    <th scope='col'>Created Date</th>
                                                    <th scope='col'>Updated Date</th>
                                                    <th scope='col'>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $query = "select * from users";

                                                $result = mysqli_query($ktx, $query);

                                                $count = 1;

                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "
                                                    <tr>
                                                        <td>" . $count . "</td>
                                                        <td>" . $row['role'] . "</td>
                                                        <td>" . $row['username'] . "</td>
                                                        <td>" . $row['ssn'] . "</td>
                                                        <td>" . $row['lastname'] . " " . $row['firstname'] . "</td>
                                                        <td>" . $row['gender'] . "</td>
                                                        <td>" . $row['birthday'] . "</td>
                                                        <td>" . $row['phone'] . "</td>
                                                        <td>" . $row['email'] . "</td>
                                                        <td>" . $row['address'] . "</td>
                                                        <td>" . $row['created_at'] . "</td>
                                                        <td>" . $row['updated_at'] . "</td>
                                                        <td>
                                                            <input value='$row[id]' style='display:none;'>
                                                            <button class='detail-btn btn btn-primary' data-bs-toggle='modal'
                                                                data-bs-target='#detail'>
                                                                <i class='ti-info-alt'></i>
                                                            </button>
                                                            <a class='edit-btn btn btn-warning' href='./update_user.php?user=" . $row['id'] . "'>
                                                                <i class='ti-settings'></i>
                                                            </a>
                                                            <a class='delete-btn btn btn-danger' href='./delete_user.php?id=" . $row['id'] . "&header=users'>
                                                                <i class='ti-close'></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    ";

                                                    $count++;
                                                }
                                                ?>
                                            </tbody>

                                        </table>
                                    </div>

                                    <div class="row">
                                        <a class="action-btn action-btn--add" href="./add_user.php
                                    ">Add User</a>
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
                    <div>
                        <div class="form__info form-floating">
                            <input disabled type="text" class="form-control" placeholder="SSN" name="ssn"
                                onchange="validateSSN(this)">
                            <div class="validate-msg">

                            </div>
                            <label for="ssn" class="form__label">SSN</label>
                        </div>

                        <div class="form__info form-floating">
                            <input disabled type="text" class="form-control" placeholder="Name" name="name"
                                onchange="validateName(this)">
                            <div class="validate-msg">

                            </div>
                            <label for="name" class="form__label">Name</label>
                        </div>

                        <div class="form__info">
                            <label for="gender" class="form__label">Gender:</label>
                            <div class="form-check form-check-inline">
                                <input disabled type="radio" class="form-check-input" value="Nam" name="gender">
                                <label for="gender" class="form-check-label">Nam</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input disabled type="radio" class="form-check-input" value="Nữ" name="gender">
                                <label for="gender" class="form-check-label">Nữ</label>
                            </div>
                        </div>
                    </div>

                    <div class="form__info form-floating">
                        <input disabled type="date" class="form-control" placeholder="Birthday" name="birthday"
                            onchange="validateBirthday(this)">
                        <div class="validate-msg">

                        </div>
                        <label for="birthday" class="form__label">Birthday</label>
                    </div>

                    <div class="form__info form-floating">
                        <input disabled type="text" class="form-control" placeholder="Country" name="country"
                            onchange="validateCountry(this)">
                        <div class="validate-msg">

                        </div>
                        <label for="country" class="form__label">Country</label>
                    </div>

                    <div class="form__info form-floating">
                        <input disabled type="text" class="form-control" placeholder="Phone" name="phone"
                            onchange="validatePhone(this)">
                        <div class="validate-msg">

                        </div>
                        <label for="phone" class="form__label">Phone</label>
                    </div>

                    <div class="form__info form-floating">
                        <input disabled type="text" class="form-control" placeholder="Email" name="email"
                            onchange="validateEmail(this)">
                        <div class="validate-msg">

                        </div>
                        <label for="email" class="form__label">Email</label>
                    </div>

                    <div class="form__info form-floating">
                        <input disabled type="text" class="form-control" placeholder="Role" name="role">
                        <div class="validate-msg">

                        </div>
                        <label for="role" class="form__label">Role</label>

                    </div>

                    <div class="form__info form-floating">
                        <input disabled type="text" class="form-control" placeholder="Address" name="address"
                            onchange="validateAddress(this)">
                        <div class="validate-msg">

                        </div>
                        <label for="address" class="form__label">Address</label>
                    </div>

                    <div class="form__info form-floating">
                        <input disabled type="text" class="form-control" placeholder="Username" name="username"
                            onchange="validateUsername(this)">
                        <div class="validate-msg">

                        </div>
                        <label for="username" class="form__label">Username</label>
                    </div>

                    <div class="form__info form-floating">
                        <input disabled type="text" class="form-control" placeholder="Password" name="password"
                            onchange="validatePassword(this)">
                        <div class="validate-msg">

                        </div>
                        <label for="password" class="form__label">Password</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    </div>

    <!-- Edit Modal -->
    <!-- <div class="modal fade" id="edit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Infomation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="edit-form">
                        <div class="form__info form-floating">
                            <input type="text" class="form-control" placeholder="SSN" name="ssn"
                                onchange="validateSSN(this)">
                            <div class="validate-msg">

                            </div>
                            <label for="ssn" class="form__label">SSN</label>
                        </div>

                        <div class="form__info form-floating">
                            <input type="text" class="form-control" placeholder="Name" name="name"
                                onchange="validateName(this)">
                            <div class="validate-msg">

                            </div>
                            <label for="name" class="form__label">Name</label>
                        </div>

                        <div class="form__info">
                            <label for="gender" class="form__label">Gender:</label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" value="male" name="gender" checked>
                                <label for="male" class="form-check-label">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" value="female" name="gender">
                                <label for="female" class="form-check-label">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" value="unknown" name="gender">
                                <label for="unknown" class="form-check-label">Unknown</label>
                            </div>
                        </div>

                        <div class="form__info form-floating">
                            <input type="date" class="form-control" placeholder="Birthday" name="birthday"
                                onchange="validateBirthday(this)">
                            <div class="validate-msg">

                            </div>
                            <label for="birthday" class="form__label">Birthday</label>
                        </div>

                        <div class="form__info form-floating">
                            <input type="text" class="form-control" placeholder="Country" name="country"
                                onchange="validateCountry(this)">
                            <div class="validate-msg">

                            </div>
                            <label for="country" class="form__label">Country</label>
                        </div>

                        <div class="form__info form-floating">
                            <input type="text" class="form-control" placeholder="Phone" name="phone"
                                onchange="validatePhone(this)">
                            <div class="validate-msg">

                            </div>
                            <label for="phone" class="form__label">Phone</label>
                        </div>

                        <div class="form__info form-floating">
                            <input type="text" class="form-control" placeholder="Email" name="email"
                                onchange="validateEmail(this)">
                            <div class="validate-msg">

                            </div>
                            <label for="email" class="form__label">Email</label>
                        </div>

                        <div class="form__info">
                            <select name="role" class="form-select">
                                <option value="student">Student</option>
                                <option value="admin">Admin</option>
                                <option value="manager">Manager</option>
                            </select>
                            <div class="validate-msg">

                            </div>
                        </div>

                        <div class="form__info form-floating">
                            <input type="text" class="form-control" placeholder="Address" name="address"
                                onchange="validateAddress(this)">
                            <div class="validate-msg">

                            </div>
                            <label for="address" class="form__label">Address</label>
                        </div>

                        <div class="form__info form-floating">
                            <input type="text" class="form-control" placeholder="Username" name="username"
                                onchange="validateUsername(this)">
                            <div class="validate-msg">

                            </div>
                            <label for="username" class="form__label">Username</label>
                        </div>

                        <div class="form__info form-floating">
                            <input type="password" class="form-control" placeholder="Password" name="password"
                                onchange="validatePassword(this)">
                            <div class="validate-msg">

                            </div>
                            <label for="password" class="form__label">Password</label>
                        </div>

                        <input type="submit" id="submit" class="form-control action-btn action-btn--add btn btn-primary"
                            name="submit">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> -->




    <script src="../js/jquery-3.6.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#user__table").DataTable();
    })
    </script>
    <script src="../js/users.js"></script>
</body>

</html>