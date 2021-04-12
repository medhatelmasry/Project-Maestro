<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<!-- Bootstrap -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
		<!-- <link rel="stylesheet" type="text/css" href="css/backend_style.css"/> -->
	</head>
<nav class="navbar navbar-default">
		<div class="container-fluid">
			<a class="navbar-brand" href="home.php">Project Maestro</a>
            <a class="navbar-brand navbar-right" href="logout.php">Logout</a>
		</div>
</nav>

<h1>Confirm Delete Course</h1>

<?php
if (isset($_GET['id'])) {
    $db = new SQLite3("../db/projectmaestro.db");

      $CourseId = $_GET['id'];
    
        $stm = $db->prepare('SELECT * FROM Course WHERE CourseId = :id');
        $stm->bindValue(':id', $CourseId, SQLITE3_TEXT);
    
        $res = $stm->execute();
    
        $row = $res->fetchArray(SQLITE3_NUM);  

       
}

?>
<table>
    <tr>
        <td>Course ID:</td>
        <td><?php echo $row[0] ?></td>
    </tr>
    <tr>
        <td>Course Name: </td>
        <td><?php echo $row[1] ?></td>
    </tr>
    <tr>
        <td>Course Term: </td>
        <td><?php echo $row[2] ?></td>
    </tr>
    <tr>
        <td>Instructor ID: </td>
        <td><?php echo $row[3] ?></td>
    </tr>
</table>
<br />
<form action="process_delete.php" method="post">
    <input type="hidden" value="<?php echo $CourseId ?>" name="CourseId" />
    <a href="viewCourse.php" class="btn btn-small btn-success">BACK</a>
    &nbsp;&nbsp;&nbsp;
    <input type="submit" value="Delete" class="btn btn-danger" />
</form>

<br />

