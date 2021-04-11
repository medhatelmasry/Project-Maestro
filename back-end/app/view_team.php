<!DOCTYPE html>
<?php 
include ('../db/inc_db_helper.php');
session_start();
$projectName = $_SESSION['projectName'];
//__________________________________________________
echo $projectName; //Test code for passing project name backwards. 
//__________________________________________________
$teamId = $_GET["teamId"];
$db = new DatabaseHelper('../db/projectmaestro.db');
// Connect to db
$connection = $db->getConn();
//Get project data from project name
$sql = " ";// Enter something like: 
//SELECT User.UserId, User.UserFName, User.UserLName 
// FROM User
// INNER JOIN TeamMember ON User.UserId=TeamMember.UserId 
// INNER JOIN Team ON Team.TeamId = TeamMember.TeamId
// WHERE Team.TeamId = "PASSED IN TEAM ID"
//
// THis sql string goes below and gets the Team members based on ID
$teamRes =  $connection->query($sql);
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
                    $temp = 0; //Swap to get students in team
                    echo "<table width='100%' class='table table-striped'>\n";
                    while ($row = $teamRes->fetchArray()) {
                        // Check if team is empty
                        $temp+=1;
                        //Update these statements to get FN, LN and ID if not printing
                        //echo var_dump($row); for testing
                        echo "<tr>";
                        echo "<th>Name: " . $row['UserFName'] . " " . $row['UserLName'] ."</th>";
                        echo '<th>Student ID: ' . $row['UserId'] . '</th>';
                        echo "</tr>";
                    }
                    if ($temp == 0) {
                        echo "<tr><th>No Members<th><tr>";
                    }
                    echo "</table>\n";

                    $button = "window.location.href='./view_team.php?teamId={$row['TeamId']}'";
                ?>
            </div>
			<button id="viewbtn" class="btn btn-small btn-primary"; onclick="window.location.href='./add_members.php?teamId=<?php echo $teamId ?>'">Add member</button>
            <button id="viewbtn" class="btn btn-small btn-primary"; onclick="window.location.href='./view_teams.php?project=<?php echo $projectName ?>'">Back</button>
		</div>
	</body>
</html>