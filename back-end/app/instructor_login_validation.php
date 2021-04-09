<?php
session_start();
include_once '../config/database.php';
// require "../vendor/autoload.php";

use \Firebase\JWT\JWT;

include_once 'cors.php';

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection('../db/');

if(ISSET($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];
    $table_name = 'User';

    $query = "SELECT UserId, UserEmail, UserFName, UserLName, UserPassword FROM " . $table_name . " WHERE UserEmail = ? LIMIT 0,1";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $email);
    $res = $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $num = count($data);

    $id = '';
    $firstName = '';
    $lastName = '';
    $password2 = '';

    foreach ($data as $row) {
        $id = $row['UserId'];
        $firstName =  $row['UserFName'];
        $lastName = $row['UserLName'];
        $password2 = $row['UserPassword'];
    }

    if ($num > 0) {
        if (password_verify($password, $password2)) {
            header('Location: home.php');
        } else {
            $_SESSION['error'] = "Invalid credentials entered. Try Again";
            if (isset($_SESSION['error'])){
                header('Location: login.php');
                exit();
            }
        }
    } else {
        $_SESSION['error'] = "Invalid credentials entered. Try Again";
        if (isset($_SESSION['error'])){
            header('Location: login.php');
            exit();
        }
    }
}
?>