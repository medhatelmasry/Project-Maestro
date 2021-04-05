<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="../css/backend_style.css"/>

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

$SQL_insert_data = "INSERT INTO Course (CourseId, CourseName, CourseTerm, InstructorId) 
VALUES 
('$CourseID', '$CourseName', '$CourseTerm', '$InstructorID')";

 $db->exec($SQL_insert_data);
 $changes = $db->changes();
 
?>

<div class="row">
    <div class="col-md-4">
        <form action="processCreate.php" method="post">
            <div class="form-group">
</br></br></br>
                <label for="CourseID" class="control-label">CourseID:</label>
                <?php echo "<p>$CourseID</p>" ?>
            </div>

            <div class="form-group">
                <label for="CourseName" class="control-label">Course Name:</label>
                <?php echo "<p>$$CourseName</p>" ?>
            </div>

            <div class="form-group">
                <label for="CourseTerm" class="control-label">Term:</label>
                <?php echo "<p>$CourseTerm</p>" ?>
            </div>

            <div class="form-group">
                <label for="InstructorID" class="control-label">Instructor ID:</label>
                <?php echo "<p>$InstructorID</p>" ?>
               
            </div>
            
            <?php echo "<p>$CourseID ($CourseName)  was added</p>"; ?>
        </form>


<a href="../viewCourse.php" class="btn btn-small btn-success">View Courses</a>
                </br></br>
        

<a href="../createCourses/createCourse.php" class="btn btn-small btn-success">&lt;&lt; BACK</a>
