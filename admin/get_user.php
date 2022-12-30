<?php
include("../connect/connect.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';

$query = "select * from users where id=" . $id;
$result = mysqli_query($ktx, $query);

$user = mysqli_fetch_assoc($result);

echo json_encode(
    array(
        'ssn' => $user['ssn'],
        'firstname' => $user['firstname'],
        'lastname' => $user['lastname'],
        'gender' => $user['gender'],
        'birthday' => date('Y-m-d', strtotime(str_replace('/', '-', $user['birthday']))),
        'country' => $user['country'],
        'phone' => $user['phone'],
        'email' => $user['email'],
        'role' => $user['role'],
        'address' => $user['address'],
        'username' => $user['username'],
        'password' => $user['password']
    )
)
    ?>