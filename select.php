<?php
if (isset($_POST["employee_id"])) {
    include_once 'dbconn.php';
    $result = mysqli_query($conn, "select description from notifications where id = {$_POST["employee_id"]}");
    $output = mysqli_fetch_assoc($result);
    echo $output['description'];
}

if (isset($_POST["bill_id"])) {
    include_once 'dbconn.php';
    $result = mysqli_query($conn, "update bills set status = 'Đã thanh toán' where id = {$_POST["bill_id"]}");
}