<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>

<nav class="navbar navbar-default">
		<div class="container-fluid">
			<a class="navbar-brand" href="home.php">Project Maestro</a>
		</div>
</nav>

<h2>Courses</h2>
<?php
include ('../db/inc_db_helper.php');

$db = new DatabaseHelper('../db/projectmaestro.db');
$connection = $db->getConn();

$res = $connection->query('SELECT * FROM Course');
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
            echo "<a class='btn btn-small btn-success' href=''>Add Students</a>";
            echo "&nbsp;";
            //Add hrefs here for view projects page
            echo "<a class='btn btn-small btn-warning' href=''>View Projects</a>";
            echo "&nbsp;";
            echo "<a class='btn btn-small btn-danger' href='delete.php?id={$row[0]}'>Delete</a>";
            echo "</td></tr>\n" ;

        };

        echo "</table>\n";

?>
<a href="home.php" class="btn btn-small btn-success">Back</a>
<a href="createCourse.php" class="btn btn-small btn-success">Add Course</a>
