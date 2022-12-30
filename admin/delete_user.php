<?php
include("../connect/connect.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';
$header = isset($_GET['header']) ? $_GET['header'] : '';

$result = mysqli_query($ktx, "SELECT room_id FROM students where user_id='$id' ");
$row = mysqli_fetch_array($result);
if (mysqli_num_rows($result) > 0) {
    $old_room = $row['room_id'];

    $query = "delete from students where user_id=" . $id;
    mysqli_query($ktx, $query);

    $mql = "select (slot-count(s.id)) as count
                                from (rooms as r
                                left outer join students as s on s.room_id = r.id)
                                where room_id='$old_room' ";
    mysqli_query($ktx, $mql);
    $result = mysqli_query($ktx, $mql);
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];

    $mql = "update rooms set status='Còn $count giường' where id='$old_room' ";
    mysqli_query($ktx, $mql);
} else {
    $query = "delete from admin where user_id=" . $id;
    mysqli_query($ktx, $query);
}

$query = "delete from users where id=" . $id;
mysqli_query($ktx, $query);

header("Location:./$header.php");
?>