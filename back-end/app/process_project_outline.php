<?php 
session_start();
include ('../db/inc_db_helper.php');
include 'sanitize_input.php';
$db = new DatabaseHelper('../db/projectmaestro.db');
extract($_POST);

if(isset($create_project_outline)){
    $CourseId = trim($CourseId, "/");
    $project_name = sanitize_input($project_name);
    $due_date = sanitize_input($due_date);
    $requirement = sanitize_input($requirement);
    
    $table = "ProjectOutline";  
    $insertSet = "CourseId, ProjectOutlineName, ProjectOutlineReq, ProjectOutlineStart, ProjectOutlineEnd";
    $insertVal = "'$CourseId', '$project_name', '$requirement', '$due_date' ,'$due_date'";
    $insert = $db->insertData($table, $insertSet, $insertVal);
    header("Location: check_projects.php?id=$CourseId");
}
?>