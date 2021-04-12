<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<!-- Bootstrap -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
		<!-- <link rel="stylesheet" type="text/css" href="css/backend_style.css"/> -->
	</head>
<nav class="navbar navbar-default">
		<div class="container-fluid">
			<a class="navbar-brand" href="home.php">Project Maestro</a>
            <a class="navbar-brand navbar-right" href="logout.php">Logout</a>
		</div>
</nav>

<h1>Course Deleted</h1>

<?php
session_start();
if (isset($_POST['CourseId'])) {
    include ('../db/inc_db_helper.php');

    $db = new DatabaseHelper('../db/projectmaestro.db');
    $connection = $db->getConn();
   
    extract($_POST);

    $key = $CourseId;

    $table = "Course";
    $pk = "CourseId";

    $stm = $db->deleteData($table, $pk, $key);

    echo "<p>COURSE with id $key</b> was deleted</p>";
    $_SESSION['deleted'] = 'Course was successfully deleted';
} 

header('Location: viewCourse.php');


?>

