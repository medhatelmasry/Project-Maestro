<!DOCTYPE html>
<?php 
include ('../db/inc_db_helper.php');
session_start();
$projectName = $_SESSION['projectName'];
//__________________________________________________
echo $projectName;
//__________________________________________________
$teamId = $_GET["teamId"];
$db = new DatabaseHelper('../db/projectmaestro.db');
// Connect to db
$connection = $db->getConn();
//Get project data from project name
$sql = 'SELECT Student.StudentId, Student.FName, Student.LName FROM Student INNER JOIN TeamMember ON Student.StudentId=TeamMember.UserId' 
        . ' INNER JOIN Team ON Team.TeamId=' . $teamId;
$teamRes =  $connection->query($sql);
//Get project id
?>
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
            echo "<h3>Team Id: " . $teamId ."</h3>"
            ?>
            <div id="list">
                <?php
                    $temp = 4; //Swap to get students in team
                    echo "<table width='100%' class='table table-striped'>\n";
                    while ($row = $teamRes->fetchArray()) {
                        echo var_dump($row);
                        echo "<tr>";
                        echo "<th>Name: " . $row['FName'] . " " . $row['LName'] ."</th>";
                        echo '<th>Student ID: ' . $row['StudentId'] . '</th>';
                        echo "</tr>";
                    }
                    echo "</table>\n";
                ?>
            </div>
			<button id="viewbtn" class="btn btn-small btn-primary"; onclick="window.location.href='./add_members.php'">Add Members</button>
            <button id="viewbtn" class="btn btn-small btn-primary"; onclick="window.location.href='./view_teams.php?project=<?php echo $projectName ?>'">Back</button>
            <?php
                // $one = '<button id="viewbtn" class="btn btn-small btn-primary"; ';
                // $two = 'onclick="window.location.href=';
                // $three = "./view_teams.php?project={$projectName}'";
                // $four = '">Back</button>';
                // echo $one .  $two . $three . $four;
            ?>
		</div>
	</body>
</html>