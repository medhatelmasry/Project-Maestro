<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<!-- Bootstrap -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="css/backend_style.css"/>
	</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<a class="navbar-brand" href="../index.php">Project Maestro</a>
		</div>
	</nav>
	<div class="container">
        <h3>Projects</h3>
        <table width='100%' class='table table-striped'>
            <!-- <tr>
                <td>Team 1</td>
                <td><button type="button" class="btn btn-info" onclick="window.location.href='./view_project.php'">View Project</button></td>
            </tr> -->
			<?php
				include_once '../db/inc_db_helper.php';

				if (isset($_GET['id'])) {
					$db_helper = new DatabaseHelper('../db/projectmaestro.db');
					$conn = $db_helper->getConn();
					
					$courseId = $GET['id'];

					$res = $db_helper->getData("Project", "ProjectId", $courseId);
					echo "<tr><th>Project ID</th>" .
						"<th>Project Name</th>" .
						"<th>Course ID</th></tr>";
					while ($row = $res->fetchArray()) {
						echo "<tr><td>{$row['ProjectId']}</td>" .
							"<td>{$row['ProjectName']}</td>" .
							"<td>{$row['CourseId']}</td>";
						echo "<td>";
						echo "<a class='btn btn-small btn-success' href='./view_project.php?id={$row['ProjectId']}'>View</a>";
						echo "</td></tr>\n";
				}
				}
			?>
        </table>
	</div>
</body>
</html>