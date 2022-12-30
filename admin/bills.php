<!DOCTYPE html>
<html lang="en">
<?php
session_start();
error_reporting(0);
include("../connect/connect.php");

if (isset($_POST['submit'])) {
    if (
        empty($_POST['bill_id']) ||
        empty($_POST['title']) ||
        empty($_POST['time']) ||
        empty($_POST['bill'])
    ) {

        $error = '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
																<strong>Bạn phải điền vào tất cả các ô!</strong>
															</div>';
    } else {
        $mql = "update bills set title='$_POST[title]',time='$_POST[time]',bill=$_POST[bill] where id =$_POST[bill_id]";
        mysqli_query($ktx, $mql);

        $success = '<div class="alert alert-success alert-dismissible fade show">
																<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
																<strong>Hóa đơn được cập nhật thành công</strong></div>';
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
                <div class="bill">
                    <div class="row page-title">
                        <h2 class="bill-title text-primary col-12">Bill</h2>
                    </div>

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title">
                                        Bill Data
                                    </h2>

                                    <?php
                                    echo $error;
                                    echo $success;
                                    ?>
                                    <div class="talbe-responsive">
                                        <table id="bill__table"
                                            class="table table-striped table-hover table-bordered no-wrap">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope='col'>#</th>
                                                    <th scope='col'>Title</th>
                                                    <th scope='col'>Month/Year</th>
                                                    <th scope='col'>Room</th>
                                                    <th scope='col'>Pay By</th>
                                                    <th scope='col'>Status</th>
                                                    <th scope='col'>Created At</th>
                                                    <th scope='col'>Updated At</th>
                                                    <th scope='col'>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $query = "select *, b.id as b_id, b.created_at as b_created_at, b.updated_at as b_updated_at, b.status as b_status
                                                        from ((((bills as b
                                                        left outer join rooms as r on r.id = b.room_id)
                                                        left outer join courts as c on c.id = r.court_id)
                                                        left outer join students as s on s.id = b.student_id)
                                                        left outer join (select id as s_id, firstname, lastname from users) as u on u.s_id = s.user_id)";

                                                $result = mysqli_query($ktx, $query);
                                                $count = 1;
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "
                                                <tr>
                                                    <td>" . $count . "</td>
                                                    <td>" . $row['title'] . "</td>
                                                    <td>" . $row['time'] . "</td>
                                                    <td>" . $row['name'] . "-" . $row['room_number'] . "</td>
                                                    <td>" . $row['lastname'] . " " . $row['firstname'] . "</td>
                                                    <td>" . $row['b_status'] . "</td>
                                                    <td>" . $row['b_created_at'] . "</td>
                                                    <td>" . $row['b_updated_at'] . "</td>
                                                    <td>
                                                        <input value='$row[b_id]' style='display:none;'>
                                                        <button class='detail-btn btn btn-primary' data-bs-toggle='modal'
                                                            data-bs-target='#detail'>
                                                            <i class='ti-info-alt'></i>
                                                        </button>
                                                        <button class='edit-btn btn btn-warning' data-bs-toggle='modal'
                                                            data-bs-target='#edit'>
                                                            <i class='ti-pencil'></i>
                                                        </button>
                                                        <a class='delete-btn btn btn-danger' href='./delete_bill.php?id=" . $row['b_id'] . "'>
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
                                        <a class="action-btn action-btn--add" href="./add_bill.php
                                    ">Add Bill</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- End Notification -->

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
                            <input disabled type="text" class="form-control" placeholder="Title" name="title"
                                onchange="validateTitle(this)">
                            <div class="validate-msg">

                            </div>
                            <label for="title" class="form__label">Title</label>
                        </div>

                        <div class="form__info form-floating">
                            <input disabled type="text" class="form-control" placeholder="Month/Year" name="time"
                                onchange="validateTitle(this)">
                            <div class="validate-msg">

                            </div>
                            <label for="time" class="form__label">Month/Year</label>
                        </div>

                        <div class="form__info form-floating">
                            <input disabled type="text" class="form-control" placeholder="Bill" name="bill"
                                onchange="validateTitle(this)">
                            <div class="validate-msg">

                            </div>
                            <label for="bill" class="form__label">Bill</label>
                        </div>

                        <div class="form__info form-floating">
                            <input disabled type="text" class="form-control" placeholder="" name="note"
                                onchange="validateTitle(this)">
                            <div class="validate-msg">

                            </div>
                            <label for="note" class="form__label">Note</label>
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
    <div class="modal fade" id="edit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Infomation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="edit-form" method="post" action=''>
                        <input type="text" class="form-control" name="bill_id" style="display: none;" value="">
                        <div class="form__info form-floating">
                            <input type="text" class="form-control" placeholder="Title" name="title"
                                onchange="validateTitle(this)">
                            <div class="validate-msg">

                            </div>
                            <label for="title" class="form__label">Title</label>
                        </div>

                        <div class="form__info form-floating">
                            <input type="text" class="form-control" placeholder="Month/Year" name="time"
                                onchange="validateTitle(this)">
                            <div class="validate-msg">

                            </div>
                            <label for="time" class="form__label">Month/Year</label>
                        </div>

                        <div class="form__info form-floating">
                            <input type="text" class="form-control" placeholder="Bill" name="bill"
                                onchange="validateTitle(this)">
                            <div class="validate-msg">

                            </div>
                            <label for="bill" class="form__label">Bill</label>
                        </div>

                        <div class="form__info form-floating">
                            <input type="text" class="form-control" placeholder="" name="note"
                                onchange="validateTitle(this)">
                            <div class="validate-msg">

                            </div>
                            <label for="note" class="form__label">Note</label>
                        </div>


                        <input type="submit" name="submit"
                            class="form-control action-btn action-btn--add btn btn-success" value="Update">
                    </form>
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
        $("#bill__table").DataTable();
    })
    </script>
    <script src="../js/bills.js"></script>

</body>

</html>