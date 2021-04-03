<?php

if (isset($_POST['create'])) 

$db = new SQLite3("school.db");
    extract($_POST);
    function sanitize_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    extract($_POST);

    $CourseID = sanitize_input($CourseID);
    $CourseName = sanitize_input($CourseName);
    $CourseTerm = sanitize_input($CourseTerm);
    $InstructorID = sanitize_input($InstructorID);

 echo "<p>CourseID: $CourseID </p>";
 echo "<p>CourseName: $CourseName </p>";
 echo "<p>CourseTerm: $CourseTerm </p>";
 echo "<p>InstructorID: $InstructorID </p>";


$SQL_insert_data = "INSERT INTO Course (CourseId, CourseName, CourseTerm, InstructorId) 
VALUES 
('$CourseID', '$CourseName', '$CourseTerm', '$InstructorID')";

 $db->exec($SQL_insert_data);
 $changes = $db->changes();
 echo "<p>The INSERT statement added $changes rows</p>";
?>


<a href="../createCourses/createCourse.php" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
