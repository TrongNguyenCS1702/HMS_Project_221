<?php
include("../connect/connect.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';

$query = "update facilities set status='Đã tiếp nhận' where id=" . $id;
mysqli_query($ktx, $query);
header("Location:./facilities.php");

?>