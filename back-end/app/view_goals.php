<?php
include ('../db/inc_db_helper.php');
session_start();
// Get project name, redirect to index otherwise
if(!isset($_SESSION['projectName'])) {
    header("Location: ../index.php");
}
//Assign project name
$projectName = $_SESSION['projectName'];
$db = new DatabaseHelper('../db/projectmaestro.db');
// Connect to db
$connection = $db->getConn();
//Get project id, redirect to index otherwise
if(!$_GET["projectId"]) {
    header("Location: ../index.php");
}
// Assign project id
$projectId = $_GET["projectId"];
//Get project data from project name, 
$projSql = "SELECT * FROM Project WHERE Project.ProjectId IS " . $projectId;
// Chceck if sql statement returns false, error msg if not
if(!$connection->query($projSql)) {
    echo "DB not loaded, or " . $userSql . " failed.";
}
// Get project information
$projectRes =  $connection->query($projSql);
//Get goal info
$goalSql = "SELECT *
FROM Goal
INNER JOIN Project ON Goal.ProjectId=Project.ProjectId 
WHERE Project.ProjectId IS " . $projectId;
// Check if sql is successful
if(!$connection->query($goalSql)) {
    echo "DB not loaded, or " . $userSql . " failed.";
}
// Get goal information
$goalRes = $connection->query($goalSql);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="css/backend_style.css"/>
	</head>
	<body>
        <!-- Temp -->
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<a class="navbar-brand" href="javascript:window.location.href=window.location.href">Project Maestro</a>
				<a class="navbar-brand navbar-right" href="logout.php">Logout</a>
			</div>
		</nav>
		<div id="view">
            <?php
            echo "<h3>" . $projectName ." Goals</h3>"
            ?>
            <div id="list">
                <?php
                    $temp = 0; //Swap to get students in team
                    echo "<table width='100%' class='table table-striped'>\n";
                    while ($row = $goalRes->fetchArray()) {
                        // Check if team is empty
                        $temp+=1;
                        //Update these statements to get FN, LN and ID if not printing
                        echo "<tr>";
                        echo "<th>" . $row['GoalDesc'] . "</th>";
                        echo "<th>By: " . $row['GoalEnd'] . "</th>";
                        echo "</tr>";
                    }
                    if ($temp == 0) {
                        echo "<tr><th>No Goal<th><tr>";
                    }
                    echo "</table>\n";
                ?>
            </div>

            <button id="viewbtn" class="btn btn-small btn-primary"; 
            onclick="window.location.href='./view_team.php?projectId=<?php echo $projectId ?>'"><==</button>
		</div>
	</body>
</html>