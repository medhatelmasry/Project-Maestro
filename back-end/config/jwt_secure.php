<?php
require "../vendor/autoload.php";

include_once '../app/cors.php';

$app_config = '../appconfig.ini';
$ini = parse_ini_file($app_config);
$secret_key = $ini['secret_key'];

$jwt = null;

$data = json_decode(file_get_contents("php://input"));


$authHeader = $_SERVER['HTTP_AUTHORIZATION'];

$arr = explode(" ", $authHeader);


$jwt = $arr[1];
?>
