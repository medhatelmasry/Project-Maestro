<?php
session_start();
include ('../db/inc_db_helper.php');
$db = new DatabaseHelper('../db/projectmaestro.db');
$connection = $db->getConn();
if(isset($_SESSION['instructor_id'])){
?>
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
    if (isset($_POST['CourseId'])) {

        extract($_POST);
        $key = $CourseId;
        $table = "Course";
        $pk = "CourseId";
        $stm = $db->deleteData($table, $pk, $key);
        echo "<p>COURSE with id $key</b> was deleted</p>";
        $_SESSION['deleted'] = 'Course was successfully deleted';
    } 

    header('Location: viewCourse.php');

} else {
    $_SESSION['require_login_error'] = "Restricted Access, please login to access.";
        if (isset($_SESSION['require_login_error'])){
            header('Location: ../index.php');
            exit();
        }   
    } 
?>

