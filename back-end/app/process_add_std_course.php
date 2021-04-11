<?php
include_once('../db/inc_db_helper.php');
$db = new DatabaseHelper('../db/projectmaestro.db');
$connection = $db->getConn();
extract($_POST);
$insertSet = "CourseId, UserId";
$insertVal = "'$CourseId', '$UserId'";
$stm = $db->insertData("CourseList", $insertSet, $insertVal);
header('Location: ../app/add_student_course.php');
exit;
?>