<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/backend_style.css"/>

<?php
// add an error check for course id and if its the same make it redirect to create page

if (isset($_POST['create'])) 

include ('../db/inc_db_helper.php');

$db = new DatabaseHelper('../db/projectmaestro.db');
$db->getConn();

extract($_POST);
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$CourseID = sanitize_input($CourseID);
$CourseName = sanitize_input($CourseName);
$CourseTerm = sanitize_input($CourseTerm);
$InstructorID = sanitize_input($InstructorID);

$table = "Course";

$insertSet = "CourseId, CourseName, CourseTerm, InstructorId";

$insertVal = "'$CourseID', '$CourseName', '$CourseTerm', '$InstructorID'";

$insert = $db->insertData($table, $insertSet, $insertVal);    
 header('Location: viewCourse.php');

?>

