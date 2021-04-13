<?php 
session_start();
include ('../db/inc_db_helper.php');
$db = new DatabaseHelper('../db/projectmaestro.db');
$connection = $db->getConn();
if(isset($_SESSION['instructor_id'])){
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<!-- Bootstrap -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
		<!-- <link rel="stylesheet" type="text/css" href="css/backend_style.css"/> -->
	</head>
    <body>
        <nav class="navbar navbar-default">
		    <div class="container-fluid">
			    <a class="navbar-brand" href="home.php">Project Maestro</a>
                <a class="navbar-brand navbar-right" href="logout.php">Logout</a>
		    </div>
        </nav>
    <div class = "container">
    <a href="viewCourse.php" class="btn btn-small btn-success">View Courses</a>
    <h1>Create Course</h1>

    <?php
    //checking if the session 'dup_course' is set. Dup_course session is the message if the course already exists in the database.
    if(ISSET($_SESSION['dup_course'])){
    ?>
            <div id="error" class="alert alert-danger"><?php echo $_SESSION['dup_course']?></div>
            <?php
            //Unsetting the 'dup_course' session after displaying the message.
            unset($_SESSION['dup_course']);
    }
    ?> 
    
    <div class="row">
        <div class="col-md-4">
            <form action="processCreate.php" method="post">
        
            <div class="form-group">
                    <label for="InstructorID" class="control-label">Instructor ID: <?php echo $_SESSION['instructor_id'] ?></label>                
                </div>

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
                <a href="home.php" class="btn btn-small btn-success">Back</a>
                <input type="submit" value="Create" name="create" class="btn btn-small btn-success" />  
                </div>
            </form> 
        </div>
    </div>  
   <?php } else {
            $_SESSION['require_login_error'] = "Restricted Access, please login to access.";
                if (isset($_SESSION['require_login_error'])){
                    header('Location: ../index.php');
                    exit();
    }
  }?> 
        
        </div>
    </body>
</html>

