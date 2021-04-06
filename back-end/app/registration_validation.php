<?php
session_start();
include_once '../config/database.php';
include_once 'cors.php';

$conn = null;
$table_name = 'User';

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection('../db/');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$SQL_create_table = "CREATE TABLE IF NOT EXISTS $table_name (
    UserId INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    UserEmail VARCHAR(80),
    UserFName VARCHAR(80),
    UserLName VARCHAR(80),
    UserPassword VARCHAR(255)
);";

$conn->exec($SQL_create_table);

if(ISSET($_POST['register'])){

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$password = $_POST['password'];

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

if($stmt->execute()) {
    http_response_code(200);
    echo json_encode(array("message" => "User was successfully registered."));
    $_SESSION['success'] = 'Successfully registered a user';
    conn->close();
    header('Location: login.php');
}
else{
    http_response_code(400);

    echo json_encode(array("message" => "Unable to register the user."));
}
}
?>
