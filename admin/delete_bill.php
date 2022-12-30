<?php
include("../connect/connect.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';

$query = "delete from bills where id=" . $id;
mysqli_query($ktx, $query);
header("Location:./bills.php");

?>