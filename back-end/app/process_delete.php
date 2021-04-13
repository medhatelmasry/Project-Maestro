<?php
session_start();
include ('../db/inc_db_helper.php');
$db = new DatabaseHelper('../db/projectmaestro.db');
$connection = $db->getConn();
if(isset($_SESSION['instructor_id'])){
    if (isset($_POST['CourseId'])) {
        header('Location: viewCourse.php');
        extract($_POST);
        $key = $CourseId;
        $table = "Course";
        $pk = "CourseId";
        $stm = $db->deleteData($table, $pk, $key);
        echo "<p>COURSE with id $key</b> was deleted</p>";
        $_SESSION['deleted'] = 'Course was successfully deleted';
    } 

} else {
    $_SESSION['require_login_error'] = "Restricted Access, please login to access.";
        if (isset($_SESSION['require_login_error'])){
            header('Location: ../index.php');
            exit();
        }   
    } 
?>

