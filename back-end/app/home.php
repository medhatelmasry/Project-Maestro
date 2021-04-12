<?php 
session_start();
include ('../db/inc_db_helper.php');
$db = new DatabaseHelper('../db/projectmaestro.db');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<!-- Bootstrap -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="css/backend_style.css"/>
	</head>
	<body>
		<?php
			if(isset($_SESSION['instructor_id'])){
		?>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<a class="navbar-brand" href="javascript:window.location.href=window.location.href">Project Maestro</a>
				<a class="navbar-brand navbar-right" href="logout.php">Logout</a>
			</div>
		</nav>
		<h1 class="title">Welcome Instructor</h1>

		<div class="content">
			<button class="button"; onclick="window.location.href='./createCourse.php'">Create Course</button>
			<button class="button"; onclick="window.location.href='./viewCourse.php'">View Courses</button> <!-- CHECK TO SEE IF THIS PATH NEEDS TO CHANGE :^) -->
		</div>
		<?php	
			} else {
				$_SESSION['require_login_error'] = "Restricted Access, please login to access.";
				if (isset($_SESSION['require_login_error'])){
					header('Location: ../index.php');
					exit();
				}
			}
		?>
	</body>
</html>