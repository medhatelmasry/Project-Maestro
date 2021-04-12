<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<nav class="navbar navbar-default">
		<div class="container-fluid">
			<a class="navbar-brand" href="home.php">Project Maestro</a>
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

