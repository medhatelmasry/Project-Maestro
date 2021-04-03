<?php

//Created my own database and table just for testinng reasons as i couldnt find a functuional databse for our project
$db = new SQLite3("school.db");
   

#===============================================================================
# Creates a Students table if it doesnt exist.
#===============================================================================
$table ="Course";
$res = $db->query("PRAGMA table_info($table)");

if ($res->fetchArray(SQLITE3_NUM)) {
    // echo "<p>$table table already exists.</p>";

} else {
    $SQL_create_table = "CREATE TABLE $table (
        CourseId VARCHAR(10) NOT NULL,
        CourseName VARCHAR(80),
        CourseTerm VARCHAR(80),
        InstructorId VARCHAR(50),
        PRIMARY KEY (CourseId)
        );";
    
        $db->exec($SQL_create_table);

        echo "<p>$table created sucessfully.</p>";
  
}

#===============================================================================
# Inserts Values into the table if it doesnt exist.
#===============================================================================

$res1 = $db->query("SELECT * FROM $table");

if ($res1->fetchArray(SQLITE3_NUM)) {
 
    // echo "<p>Values already exist in the table.</p>";


} else {

    $SQL_insert_data = "INSERT INTO Course (
        CourseId, CourseName, CourseTerm, InstructorId) 
       VALUES 
       ('Comp 3975', 'Webscripting', '1', 'A00995222')";
           
   
       $db->exec($SQL_insert_data);

       echo "<p>Values inserted successfully.</p>";
    } 
?>

<h1>Create Course</h1>

<div class="row">
    <div class="col-md-4">
        <form action="processCreate.php" method="post">
            <div class="form-group">
                <label for="CourseID" class="control-label">Course ID</label>
                <input for="CourseID" class="form-control" name="CourseID" id="CourseID" />
            </div>

            <div class="form-group">
                <label for="CourseName" class="control-label">Course Name</label>
                <input for="CourseName" class="form-control" name="CourseName" id="CourseName" />
            </div>

            <div class="form-group">
                <label for="CourseTerm" class="control-label">Term</label>
                <input for="CourseTerm" class="form-control" name="CourseTerm" id="CourseTerm" />
            </div>

            <div class="form-group">
                <label for="InstructorID" class="control-label">Instructor ID</label>
                <input for="InstructorID" class="form-control" name="InstructorID" id="InstructorID" />
            </div>

            <div class="form-group">
                <input type="submit" value="Create" name="create" class="btn btn-success" />
            </div>
        </form>
    </div>

    <a href="../viewCourse.php" class="btn btn-small btn-primary">View Courses</a>

</div>

<br />
