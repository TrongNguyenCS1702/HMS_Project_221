<?php
include("../connect/connect.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';

$query = "select * from notifications where id=" . $id;
$result = mysqli_query($ktx, $query);

$noti = mysqli_fetch_assoc($result);

echo json_encode(
    array(
        'manager_id' => $noti['manager_id'],
        'title' => $noti['title'],
        'description' => $noti['description'],
        'created_at' => $noti['created_at'],
        'updated_at' => $noti['updated_at']
    )
)
    ?>