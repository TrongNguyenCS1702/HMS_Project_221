<?php
include("../connect/connect.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';

$query = "select *, f.status as f_status, f.created_at as f_created_at, f.updated_at as f_updated_at
          from ((((facilities as f
          left outer join rooms as r on r.id = f.room_id)
          left outer join courts as c on c.id = r.court_id)
          left outer join students as s on s.id = f.student_id)
          left outer join users as u on u.id = s.user_id)
          where f.id=" . $id;
$result = mysqli_query($ktx, $query);

$faci = mysqli_fetch_assoc($result);

echo json_encode(
    array(
        'court' => $faci['name'],
        'room' => $faci['room_number'],
        'created_by' => $faci['lastname'] . " " . $faci['firstname'],
        'description' => $faci['description'],
        'status' => $faci['f_status'],
        'created_at' => $faci['f_created_at'],
        'updated_at' => $faci['f_updated_at']
    )
)
    ?>