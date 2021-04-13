<?php
include_once('../db/inc_db_helper.php');
$db = new DatabaseHelper('../db/projectmaestro.db');
session_start();
$connection = $db->getConn();
extract($_POST);
$insertSet = "CourseId, UserId";
$insertVal = "'$CourseId', '$UserId'";
$stm = $db->insertData("CourseList", $insertSet, $insertVal);
$_SESSION['addStd'] = 'Student Sucessfully added';
header("Location: add_student_course.php?id=$CourseId");
exit;
?>