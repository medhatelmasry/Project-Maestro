<?php
include_once './db/inc_db_helper.php';
$db_name = dirname(__FILE__) . DIRECTORY_SEPARATOR . "db" . DIRECTORY_SEPARATOR . "projectmaestro.db";
$db_helper = new DatabaseHelper($db_name);
$db_helper->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./app/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="./app/css/backend_style.css"/>
    <title>Project Maestro</title>
</head>
<body>
    <nav class="navbar navbar-default">
		<div class="container-fluid">
			<a class="navbar-brand" href="./">Project Maestro</a>
		</div>
	</nav>
    <div class="content">
        <h1 class="title">Project Maestro</h1>
        <button class="button"; onclick="window.location.href='./app/login.php'">Login</button>
        <button class="button"; onclick="window.location.href='./app/registration.php'">Sign Up</button>
    </div>
</body>
</html>