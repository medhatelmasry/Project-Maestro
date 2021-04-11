<?php session_start(); ?>

<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>

<nav class="navbar navbar-default">
		<div class="container-fluid">
			<a class="navbar-brand" href="home.php">Project Maestro</a>
		</div>
</nav>

<h2>Courses</h2>


<?php
//checking if the session 'created' is set. Created session is the message to see if the course was created.
if(isset($_SESSION['created'])){
?>  
    <div class="alert alert-success"><?php echo $_SESSION['created']?></div>
    <?php
    //Unsetting the 'created' session after displaying the message. 
    unset($_SESSION['created']);
}

?>

<?php
//checking if the session 'deleted' is set. Deleted session is the message if the course was deleted.
if(ISSET($_SESSION['deleted'])){
?>
        <div id="error" class="alert alert-success"><?php echo $_SESSION['deleted']?></div>
        <?php echo $_SESSION['deleted']?>
        <?php
        //Unsetting the 'deleted' session after displaying the message.
        unset($_SESSION['deleted']);
}
?>  
			
<?php
include ('../db/inc_db_helper.php');

$db = new DatabaseHelper('../db/projectmaestro.db');
$connection = $db->getConn();

$id = $_SESSION['instructor_id'];
			
$check_id = "SELECT * FROM Course WHERE InstructorId = $id";

$res = $connection->query($check_id);
        echo "<table width='100%' class='table table-striped'>\n";
        echo "<tr><th>Course ID</th>".
             "<th>Course Name</th>".
             "<th>Term</th>".
             "<th>Instructor ID</th>\n";
             "<th>&nbsp;</th></tr>\n";    
        while ($row = $res->fetchArray()) {
            echo "<tr><td>{$row['CourseId']}</td>";
            echo "<td>{$row['CourseName']}</td>";
            echo "<td>{$row['CourseTerm']}</td>";
            echo "<td>{$row['InstructorId']}</td>";
            echo "<td>";
            //Add hrefs here for add Students page
            echo "<a class='btn btn-small btn-success' href='./add_student_course.php?id={$row[0]}'>Add Students</a>";
            echo "&nbsp;";
            //Add hrefs here for view projects page
            echo "<a class='btn btn-small btn-warning' href='./check_projects.php?id={$row[0]}'>View Projects</a>";
            echo "&nbsp;";
            echo "<a class='btn btn-small btn-danger' href='delete.php?id={$row[0]}'>Delete</a>";
            echo "</td></tr>\n" ;

        };

        echo "</table>\n";


    

?>

    
 

<a href="home.php" class="btn btn-small btn-success">Back</a>
<a href="createCourse.php" class="btn btn-small btn-success">Add Course</a>
