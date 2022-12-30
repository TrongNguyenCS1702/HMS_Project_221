<?php
include("../connect/connect.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';

$query = "select * from bills where id=" . $id;
$result = mysqli_query($ktx, $query);

$bill = mysqli_fetch_assoc($result);

echo json_encode(
    array(
        'title' => $bill['title'],
        'time' => $bill['time'],
        'bill' => $bill['bill'],
        'note' => $bill['note']
    )
)
    ?>