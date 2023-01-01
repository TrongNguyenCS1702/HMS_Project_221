<?php
include_once 'dbconn.php';
$result = mysqli_query($conn, "select * from notifications order by created_at desc");
?>

<!DOCTYPE html>
<html>

<?php
$title = "Thông tin";
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
                <li><a href="invoice.php">Hóa đơn, biên lai</a></li>
                <li><a href="request.php">Yêu cầu sửa chữa</a></li>
                <li class="active"><a href="#">Thông báo</a></li>
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
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Nhấn vào tiêu đề để xem chi tiết thông báo.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr class="bg-light">
                            <th style="width: 5%" class="text-center">STT</th>
                            <th style="width: 75%">Tiêu đề</th>
                            <th style="width: 20%">Ngày thông báo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $index = 0;
                        while ($row = mysqli_fetch_assoc($result)):
                            $index++;
                            ?>
                        <tr>
                            <td class="text-center">
                                <?= $index ?>
                            </td>
                            <td><input type="button" name="view" value="<?= $row['title'] ?>"
                                    id="<?php echo $row['id']; ?>" class="btn btn-light view_data"></td>
                            <td>
                                <?= $row['updated_at'] ?>
                            </td>
                        </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
                <!-- Modal -->
                <div id="dataModal" class="modal fade" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="notification_detail"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="overlay"></div>

    <?php require 'includes/script.php' ?>

    <script>
    $(document).ready(function() {
        $('.view_data').click(function() {
            var employee_id = $(this).attr("id");
            $.ajax({
                url: "select.php",
                method: "post",
                data: {
                    employee_id: employee_id
                },
                success: function(data) {
                    $('#notification_detail').html(data);
                    $('#dataModal').modal("show");
                },
                error: function() {
                    $('#notification_detail').html("Đã có lỗi xảy ra.");
                }
            });
        });
    });
    </script>
</body>

</html>