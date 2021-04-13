<?php
include_once '../db/inc_db_helper.php';
include_once '../config/database.php';
include_once 'cors.php';
$db_helper = new DatabaseHelper('../db/projectmaestro.db');
$db_helper->close();
ini_set('display_errors', 1);

$conn = null;
$table_name = 'User';
$inputdata = json_decode(file_get_contents("php://input"));
$databaseService = new DatabaseService();
$conn = $databaseService->getConnection('../db/');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($inputdata->firstName) && isset($inputdata->lastName) && isset($inputdata->email) && isset($inputdata->password)){
    $firstName = $inputdata->firstName;
    $lastName = $inputdata->lastName;
    $email = $inputdata->email;
    $password = $inputdata->password;

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
        $query_results = NULL;  // closes connection
        http_response_code(200);
        $data = array(
            "firstName" => $firstName,
            "lastName" => $lastName,
            "email" => $email
        );
        echo json_encode($data);
    } else {
        http_response_code(400);

        echo json_encode(array("message" => "Unable to register the user."));
    }
}
$conn = null;
?>
