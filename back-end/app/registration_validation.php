<?php
session_start();
ini_set('display_errors', 1);
include_once '../config/database.php';
include_once 'cors.php';
include_once '../db/inc_db_helper.php';
$db_helper = new DatabaseHelper('../db/projectmaestro.db');

$conn = null;
$table_name = 'User';

$conn = $db_helper->getConn();

if (isset($_POST['register'])) {

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check_duplicate_email = "SELECT COUNT(*) FROM User WHERE UserEmail = ?";
    
    $stmt1 = $conn->prepare($check_duplicate_email);
    $stmt1->bindParam(1, $email);
    $result = $stmt1->execute();
    while ($row = $result->fetchArray()) {
        if($row[0] < 1) {
            $query = "INSERT INTO $table_name";
            $query .= " (UserEmail,UserFName,UserLName,UserPassword)";
            $query .= " VALUES";
            $query .= " (:email,:firstName,:lastName,:password)";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':email', $email);

            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            $stmt->bindParam(':password', $password_hash);
            $query_results = $stmt->execute();

            if ($query_results) {
                $id_query = $conn->query('SELECT UserId FROM User ORDER BY UserId DESC LIMIT 0,1');
                while ($row = $id_query->fetchArray()) {
                    $id = $row['UserId'];
                }
                $query_results = NULL;  // closes connection
                $id_query = NULL;  // closes connection
                http_response_code(200);
                $_SESSION['success'] = 'Successfully registered a user';
                $_SESSION['instructor_id'] = $id;
                header('Location: home.php');
            } else {
                http_response_code(400);

                echo json_encode(array("message" => "Unable to register the user."));
            }
        } else {
            $_SESSION['dup_error'] = 'User with this email already exists';
            header('Location: registration.php');
        }
    }
}
$db_helper->close();
?>
