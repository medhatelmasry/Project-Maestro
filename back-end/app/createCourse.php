
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
    
<?php
include ('../db/inc_db_helper.php');

$db = new DatabaseHelper('../db/projectmaestro.db');

?>


<nav class="navbar navbar-default">
		<div class="container-fluid">
			<a class="navbar-brand" href="home.php">Project Maestro</a>
		</div>
</nav>

<h1>Create Course</h1>
<div class="row">
    <div class="col-md-4">
        <form action="processCreate.php" method="post">
            <div class="form-group">

                <label for="CourseID" class="control-label">Course ID</label>
                <input for="CourseID" class="form-control" name="CourseID" id="CourseID" required="required" />
            </div>

            <div class="form-group">
                <label for="CourseName" class="control-label">Course Name</label>
                <input for="CourseName" class="form-control" name="CourseName" id="CourseName" required="required"  />
            </div>

            <div class="form-group">
                <label for="CourseTerm" class="control-label">Course Term</label>
                <input for="CourseTerm" class="form-control" name="CourseTerm" id="CourseTerm" required="required" />
            </div>

            <div class="form-group">
                <label for="InstructorID" class="control-label">Instructor ID</label>
                <input for="InstructorID" class="form-control" name="InstructorID" id="InstructorID" required="required" />
                
            </div>

            <div class="form-group">
            <input type="submit" value="Create" name="create" class="btn btn-small btn-success" />  
            </div>
                
     

        </form>
        
        
    </div>

</div>
<a href="home.php" class="btn btn-small btn-success">Back</a>
<a href="viewCourse.php" class="btn btn-small btn-success">View Courses</a>


