<?php
include("../connect/connect.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';

$query = "select *, u.created_at as s_created_at, s.updated_at as s_updated_at, s.status as s_status
          from (((students as s
          left outer join users as u on s.user_id = u.id)
          left outer join rooms as r on s.room_id = r.id)
          left outer join courts as c on r.court_id = c.id)
          where u.id=" . $id;
$result = mysqli_query($ktx, $query);

$student = mysqli_fetch_assoc($result);

echo json_encode(
    array(
        'ssn' => $student['ssn'],
        'firstname' => $student['firstname'],
        'lastname' => $student['lastname'],
        'gender' => $student['gender'],
        'birthday' => date('Y-m-d', strtotime(str_replace('/', '-', $student['birthday']))),
        'country' => $student['country'],
        'phone' => $student['phone'],
        'email' => $student['email'],
        'role' => $student['role'],
        'address' => $student['address'],
        'username' => $student['username'],
        'password' => $student['password'],
        'room_number' => $student['room_number'],
        'name' => $student['name'],
        'year' => $student['year'],
        'university' => $student['university'],
        's_status' => $student['s_status'],
        's_created_at' => $student['s_created_at'],
        's_updated_at' => $student['s_updated_at'],
        'student_id' => $student['student_id']
    )
)
    ?>