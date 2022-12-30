<?php
$dbuser = "root";
$dbpass = "";
$host = "localhost";
$db = "ktx";
$ktx = new mysqli($host, $dbuser, $dbpass, $db);

if (!$ktx) {
    die('Could not connect: ' . mysqli_error($ktx));
}



// Users
function searchUserBySSN($ssn)
{
    $query = "SELECT * FROM users WHERE ssn LIKE '%$ssn%'";

    $result = mysqli_query($GLOBALS['ktx'], $query);

    $data = "";


    foreach ($result as $user) {
        $data .= "<tr>
                        <td>" . $user['id'] . "</td>
                        <td>" . $user['ssn'] . "</td>
                        <td>" . $user['name'] . "</td>
                        <td>" . $user['gender'] . "</td>
                        <td>" . $user['birthday'] . "</td>
                        <td>" . $user['country'] . "</td>
                        <td>" . $user['phone'] . "</td>
                        <td>" . $user['email'] . "</td>
                        <td>" . $user['role'] . "</td>
                        <td>" . $user['address'] . "</td>
                        <td>" . $user['username'] . "</td>
                        <td>" . $user['password'] . "</td>
                        <td>
                            <a class='action-btn action-btn--view' href='./view_users.php?id=" . $user['id'] . "'>View</a>
                            <a class='action-btn action-btn--edit' href='./edit_users.php?id=" . $user['id'] . "'>Edit</a>
                            <a class='action-btn action-btn--delete' href='./delete_users.php?id=" . $user['id'] . "'>Delete</a>
                        </td>
                    </tr>";
    }
    return $data;
}
;


function searchUserByName($name)
{
    $query = "SELECT * FROM users WHERE name=LIKE '%$name%'";

    $result = mysqli_query($GLOBALS['ktx'], $query);

    $data = "";

    foreach ($result as $user) {
        $data .= "<tr>
                        <td>" . $user['id'] . "</td>
                        <td>" . $user['ssn'] . "</td>
                        <td>" . $user['name'] . "</td>
                        <td>" . $user['gender'] . "</td>
                        <td>" . $user['birthday'] . "</td>
                        <td>" . $user['country'] . "</td>
                        <td>" . $user['phone'] . "</td>
                        <td>" . $user['email'] . "</td>
                        <td>" . $user['role'] . "</td>
                        <td>" . $user['address'] . "</td>
                        <td>" . $user['username'] . "</td>
                        <td>" . $user['password'] . "</td>
                        <td>
                            <a class='action-btn action-btn--view' href='./view_users.php?id=" . $user['id'] . "'>View</a>
                            <a class='action-btn action-btn--edit' href='./edit_users.php?id=" . $user['id'] . "'>Edit</a>
                            <a class='action-btn action-btn--delete' href='./delete_users.php?id=" . $user['id'] . "'>Delete</a>
                        </td>
                    </tr>";
    }

    return $data;
}
;


function getUsers()
{
    $query = "SELECT * FROM users";

    $result = mysqli_query($GLOBALS['ktx'], $query);

    $data = "";

    foreach ($result as $user) {
        $data .= "<tr>
                        <td>" . $user['id'] . "</td>
                        <td>" . $user['ssn'] . "</td>
                        <td>" . $user['name'] . "</td>
                        <td>" . $user['gender'] . "</td>
                        <td>" . $user['birthday'] . "</td>
                        <td>" . $user['country'] . "</td>
                        <td>" . $user['phone'] . "</td>
                        <td>" . $user['email'] . "</td>
                        <td>" . $user['role'] . "</td>
                        <td>" . $user['address'] . "</td>
                        <td>" . $user['username'] . "</td>
                        <td>" . $user['password'] . "</td>
                        <td>
                            <a class='action-btn action-btn--view' href='./view_users.php?id=" . $user['id'] . "'>View</a>
                            <a class='action-btn action-btn--edit' href='./edit_users.php?id=" . $user['id'] . "'>Edit</a>
                            <a class='action-btn action-btn--delete' href='./delete_users.php?id=" . $user['id'] . "'>Delete</a>
                        </td>
                    </tr>";
    }

    return $data;
}
;


function addUser($register)
{
    $query = "INSERT INTO users () VALUES ()";
}
;

// Students
function searchStudentBySSN($ssn)
{
    $query = "SELECT * FROM users WHERE ssn LIKE '%$ssn%'";

    $result = mysqli_query($GLOBALS['ktx'], $query);

    $data = "";


    foreach ($result as $student) {
        $data .= "<tr>
                        <td>" . $student['id'] . "</td>
                        <td>" . $student['ssn'] . "</td>
                        <td>" . $student['name'] . "</td>
                        <td>" . $student['gender'] . "</td>
                        <td>" . $student['birthday'] . "</td>
                        <td>" . $student['country'] . "</td>
                        <td>" . $student['phone'] . "</td>
                        <td>" . $student['email'] . "</td>
                        <td>" . $student['role'] . "</td>
                        <td>" . $student['address'] . "</td>
                        <td>" . $student['username'] . "</td>
                        <td>" . $student['password'] . "</td>
                        <td>
                            <a class='action-btn action-btn--view' href='./view_users.php?id=" . $student['id'] . "'>View</a>
                            <a class='action-btn action-btn--edit' href='./edit_users.php?id=" . $student['id'] . "'>Edit</a>
                            <a class='action-btn action-btn--delete' href='./delete_users.php?id=" . $student['id'] . "'>Delete</a>
                        </td>
                    </tr>";
    }
    return $data;
}
;


function searchStudentByName($name)
{
    $query = "SELECT * FROM users WHERE name=LIKE '%$name%'";

    $result = mysqli_query($GLOBALS['ktx'], $query);

    $data = "";

    foreach ($result as $student) {
        $data .= "<tr>
                        <td>" . $student['id'] . "</td>
                        <td>" . $student['ssn'] . "</td>
                        <td>" . $student['name'] . "</td>
                        <td>" . $student['gender'] . "</td>
                        <td>" . $student['birthday'] . "</td>
                        <td>" . $student['country'] . "</td>
                        <td>" . $student['phone'] . "</td>
                        <td>" . $student['email'] . "</td>
                        <td>" . $student['role'] . "</td>
                        <td>" . $student['address'] . "</td>
                        <td>" . $student['username'] . "</td>
                        <td>" . $student['password'] . "</td>
                        <td>
                            <a class='action-btn action-btn--view' href='./view_users.php?id=" . $student['id'] . "'>View</a>
                            <a class='action-btn action-btn--edit' href='./edit_users.php?id=" . $student['id'] . "'>Edit</a>
                            <a class='action-btn action-btn--delete' href='./delete_users.php?id=" . $student['id'] . "'>Delete</a>
                        </td>
                    </tr>";
    }

    return $data;
}
;


function getStudents()
{
    $query = "SELECT * FROM users";

    $result = mysqli_query($GLOBALS['ktx'], $query);

    $data = "";

    foreach ($result as $student) {
        $data .= "<tr>
                        <td>" . $student['id'] . "</td>
                        <td>" . $student['ssn'] . "</td>
                        <td>" . $student['name'] . "</td>
                        <td>" . $student['gender'] . "</td>
                        <td>" . $student['birthday'] . "</td>
                        <td>" . $student['country'] . "</td>
                        <td>" . $student['phone'] . "</td>
                        <td>" . $student['email'] . "</td>
                        <td>" . $student['role'] . "</td>
                        <td>" . $student['address'] . "</td>
                        <td>" . $student['username'] . "</td>
                        <td>" . $student['password'] . "</td>
                        <td>
                            <a class='action-btn action-btn--view' href='./view_users.php?id=" . $student['id'] . "'>View</a>
                            <a class='action-btn action-btn--edit' href='./edit_users.php?id=" . $student['id'] . "'>Edit</a>
                            <a class='action-btn action-btn--delete' href='./delete_users.php?id=" . $student['id'] . "'>Delete</a>
                        </td>
                    </tr>";
    }

    return $data;
}
;


function addStudent($register)
{
    $query = "INSERT INTO users () VALUES ()";
}
;















?>