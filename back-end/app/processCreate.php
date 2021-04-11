<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/backend_style.css"/>

<?php

session_start();

include ('../db/inc_db_helper.php');
include 'sanitize_input.php'; // moved sanitize_input to a separate php file

$db = new DatabaseHelper('../db/projectmaestro.db');
$conn = null;

$conn = $db->getConn();

if (isset($_POST['create'])) {

    extract($_POST);
// function sanitize_input($data) {
//     $data = trim($data);
//     $data = stripslashes($data);
//     $data = htmlspecialchars($data);
//     return $data;
// }

    $CourseID = sanitize_input($CourseID);
    $CourseName = sanitize_input($CourseName);
    $CourseTerm = sanitize_input($CourseTerm);
    $InstructorID = $_SESSION['instructor_id'];


    $check_duplicate_course = "SELECT COUNT(*) FROM Course WHERE CourseId = ?";
    $stmt1 = $conn->prepare($check_duplicate_course);
    $stmt1->bindParam(1, $CourseID);
    $result = $stmt1->execute();
    while ($row = $result->fetchArray())
    if ($row[0] < 1) {
        $table = "Course";
        
        $insertSet = "CourseId, CourseName, CourseTerm, InstructorId";
        
        $insertVal = "'$CourseID', '$CourseName', '$CourseTerm', '$InstructorID'";
        
        $insert = $db->insertData($table, $insertSet, $insertVal);    
        $_SESSION['created'] = 'Successfully created course';
         header('Location: viewCourse.php');

    } else {
        $_SESSION['dup_course'] = 'Course with this ID already exists';
            header('Location: createCourse.php');
            $_SESSION["courseid"] = $CourseID;
    }


}
