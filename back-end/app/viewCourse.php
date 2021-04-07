<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/backend_style.css"/>

<h2>Courses</h2>


<?php
$db = new SQLite3("createCourses/school.db");
        $res = $db->query('SELECT * FROM Course');
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
            //Add hrefs here for add Delete page
            echo "<a class='btn btn-small btn-danger' href=''>Delete</a>";
            echo "</td></tr>\n" ;

        };

        echo "</table>\n"

        
 

?>
<a href="createCourses/createCourse.php" class="btn btn-small btn-success">&lt;&lt; BACK</a>