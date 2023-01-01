<?php
session_start();
include_once 'dbconn.php';

?>

<!DOCTYPE html>
<html>

<?php
$title = "Lịch sử hóa đơn";
require 'includes/head.php';
?>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div id="dismiss">
                <i class="fas fa-arrow-left"></i>
            </div>
            <div class="sidebar-header">
                <img src="assets/images/logo.png" class="img-thumbnail" style="width: 40%;" alt="...">
            </div>
            <!-- list-unstyled components -->
            <ul class="list-unstyled border-top border-bottom py-5">
                <li><a href="index.php">Thông tin sinh viên</a></li>
                <li><a href="rent.php">Thông tin lưu trú</a></li>
                <li class="active"><a href="#">Hóa đơn, biên lai</a></li>
                <li><a href="request.php">Yêu cầu sửa chữa</a></li>
                <li><a href="notification.php">Thông báo</a></li>
            </ul>
            <ul class="list-unstyled CTAs">
                <li><a href="ChangePIN.php" class="download">Đổi mật khẩu</a></li>
                <li><a href="logout.php" class="article">Đăng xuất</a></li>
            </ul>
        </nav>
        <!-- Page Content  -->
        <div id="content">
            <!-- Top navigation-->
            <?php require 'includes/navigation.php' ?>
            <!-- Main content-->
            <div class="container-fluid">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                            aria-selected="true" disabled>Hóa đơn biên lai</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                        tabindex="0">
                        <div class="container-fluid mt-3">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <a href="#"><i>Hướng dẫn thanh toán</i></a>.
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <table class="table table-bordered table-sm table-hover">
                                <thead>
                                    <tr class="bg-light">
                                        <th style="width: 20%">Nội dung</th>
                                        <th style="width: 20%">Tháng/Năm</th>
                                        <th style="width: 10%">Số tiền</th>
                                        <th style="width: 15%">Trạng thái</th>
                                        <th style="width: 15%">Thao tác</th>
                                        <th style="width: 20%">Ghi chú</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = mysqli_query($conn, "select *, bills.id as b_id, bills.status as b_status from ((bills
                                                                    inner join rooms on bills.room_id = rooms.id)
                                                                    inner join students on students.room_id = rooms.id)
                                                                    where students.id = {$_SESSION['std_id']}");
                                    while ($row = mysqli_fetch_assoc($result)):
                                        ?>
                                    <tr>
                                        <td><?= $row['title'] ?></td>
                                        <td>
                                            <?= $row['time'] ?>
                                        </td>
                                        <td>
                                            <?= $row['bill'] . "đ" ?>
                                        </td>
                                        <td>
                                            <?= $row['b_status'] ?>
                                        </td>
                                        <td>
                                            <input name="bill_id" style="display:none"
                                                value="<?= $row["b_id"] ?>"></input>
                                            <?="<input type='button' class='btn btn-success " . ($row['b_status'] == "Đã thanh toán" ? "disabled" : "") . " thanh_toan' value='Thanh toán'>" ?>
                                        </td>
                                        <td>
                                            <?= $row['note'] ?>
                                        </td>
                                    </tr>
                                    <?php endwhile ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="overlay"></div>
    <?php require 'includes/script.php'; ?>


    <script>
    $(document).ready(function() {
        $('.thanh_toan').click(function() {
            $.ajax({
                url: "select.php",
                method: "post",
                data: {
                    bill_id: $(this).parent().find("input[name='bill_id']").val(),
                    student_id: <?= $_SESSION["std_id"] ?>
                },
                success: function(data) {
                    location.reload();
                },
            });
        });
    });
    </script>

</body>

</html>