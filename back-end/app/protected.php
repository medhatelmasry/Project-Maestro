<?php
require "../vendor/autoload.php";

use \Firebase\JWT\JWT;

include_once 'cors.php';

$app_config = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "appconfig.ini";
$ini = parse_ini_file($app_config);
$secret_key = $ini['secret_key'];

$jwt = null;

$data = json_decode(file_get_contents("php://input"));

$authHeader = $_SERVER['HTTP_AUTHORIZATION'];

$arr = explode(" ", $authHeader);


/*echo json_encode(array(
    "message" => "sd" .$arr[1]
));*/

$jwt = $arr[1];

if ($jwt) {

    try {

        $decoded = JWT::decode($jwt, $secret_key, array('HS256'));

        // Access is granted. Add code of the operation here 

        echo json_encode(array(
            "message" => "Access granted:"
        ));
    } catch (Exception $e) {

        http_response_code(401);

        echo json_encode(array(
            "message" => "Access denied.",
            "error" => $e->getMessage()
        ));
    }
}
