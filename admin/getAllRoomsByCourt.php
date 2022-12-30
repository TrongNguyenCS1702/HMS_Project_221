<?php
include("../connect/connect.php");

$id = isset($_GET['court']) ? $_GET['court'] : '';

$query = "select *
          from rooms
          where court_id = $_GET[court]
         ";
$result = mysqli_query($ktx, $query);
$room_arr = array();

while ($room = mysqli_fetch_assoc($result)) {
    $room_item = array(
        'id' => $room['id'],
        'slot' => $room['slot'],
        'fee' => $room['fee'],
        'room_number' => $room['room_number'],
        'type' => $room['type'],
        'status' => $room['status'],
        'updated_at' => $room['updated_at']
    );

    array_push($room_arr, $room_item);


}

echo json_encode($room_arr);

?>