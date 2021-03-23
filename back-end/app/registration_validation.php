<?php
include_once '../config/database.php';
include_once 'cors.php';

$conn = null;
$table_name = 'Users';

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$SQL_create_table = "CREATE TABLE IF NOT EXISTS $table_name (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    firstName VARCHAR(150) NOT NULL,
    lastName VARCHAR(150) NOT NULL,
    email VARCHAR(255),
    password VARCHAR(255)
);";

$conn->exec($SQL_create_table);

if(ISSET($_POST['register'])){

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$password = $_POST['password'];

$query = "INSERT INTO $table_name";
$query .= " (firstName,lastName,email,password)";
$query .= " VALUES";
$query .= " (:firstName,:lastName,:email,:password)";

$stmt = $conn->prepare($query);

$stmt->bindParam(':firstName', $firstName);
$stmt->bindParam(':lastName', $lastName);
$stmt->bindParam(':email', $email);

$password_hash = password_hash($password, PASSWORD_BCRYPT);

$stmt->bindParam(':password', $password_hash);

if($stmt->execute()) {
    http_response_code(200);
    echo json_encode(array("message" => "User was successfully registered."));
    session_start();
    header('Location: home.php');
}
else{
    http_response_code(400);

    echo json_encode(array("message" => "Unable to register the user."));
}
}
?>