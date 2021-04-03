<?php

include_once '../config/database.php';
require "../vendor/autoload.php";

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

		$app_config ="../appconfig.ini";
		$ini = parse_ini_file($app_config);
        $secret_key = $ini['secret_key'];

        $issuer_claim = "THE_ISSUER"; // this can be the servername
        $audience_claim = "THE_AUDIENCE";
        $issuedat_claim = time(); // issued at
        $notbefore_claim = $issuedat_claim + 10; //not before in seconds
        $expire_claim = $issuedat_claim + (60 * 10); // 600 seconds (10 minutes) expire time
        $token = array(
            "iss" => $issuer_claim,
            "aud" => $audience_claim,
            "iat" => $issuedat_claim,
            "nbf" => $notbefore_claim,
            "exp" => $expire_claim,
            "data" => array(
                "id" => $id,
                "firstName" => $firstName,
                "lastName" => $lastName,
                "email" => $email
            )
        );

        http_response_code(200);

        $jwt = JWT::encode($token, $secret_key);
        echo json_encode(
            array(
                "message" => "Successful login.",
                "jwt" => $jwt,
                "email" => $email,
                "expireAt" => $expire_claim
            )
		);
		header('Location: home.php'); //comment this line out if you would like to see JWT encoded array
    } else {

        http_response_code(401);
        echo json_encode(array("message" => "Login failed.", "password" => $password));
    }
} else {
    http_response_code(401);
    echo json_encode(array("message" => "Login failed.", "email" => $email, "password" => $password));
}
	}
?>