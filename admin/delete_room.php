<?php
include("../connect/connect.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';


$query = "update students set room_id = NULL, status = 'Chưa có phòng' where room_id=" . $id;
mysqli_query($ktx, $query);

$query = "delete from rooms where id=" . $id;
mysqli_query($ktx, $query);
header("Location:./students.php");

?>