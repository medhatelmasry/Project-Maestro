<?php 
    include ('../db/inc_db_helper.php');

    $db = new DatabaseHelper('../db/projectmaestro.db');
?>
<!DOCTYPE html>
<?php 
include ('../db/inc_db_helper.php');

//Used for redirect
session_start();
//From Link
$project = $_GET["project"];
//Redirect
$_SESSION['projectName'] = $project;
$db = new DatabaseHelper('../db/projectmaestro.db');
// Cconnect to db
$connection = $db->getConn();
//Get project data from project name
$projectRes =  $connection->querySingle('SELECT * FROM Project WHERE ProjectName IS "' . $project .'"', true);
//Get project id
$projectId = $projectRes['ProjectId'];
//Get teams where project 
$res = $connection->query('SELECT * FROM Team WHERE ProjectId IS ' . $projectId);
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
                echo "<h3>$project</h3>";
            ?>
            <div id="list">
                <?php
                    $temp = 0; //Swap to get all teams in project
                    
                    echo "<table width='100%' class='table table-striped'>\n";
                    while ($row = $res->fetchArray()) {
                        $temp+=1;
                        $button = "window.location.href='./view_team.php?teamId={$row['TeamId']}'";
                        // echo var_dump($row);
                        echo "<tr>";
                        echo "<th>Team " . $row['TeamId'] ."</th>";
                        echo "<th>" . $row['TeamName'] ."</th>";
                        echo '<th><button id="viewbtn" class="btn btn-small btn-primary"; onclick="' . $button . '">View Details</button></th>';
                        echo "</tr>";
                    }
                   
                    if ($temp == 0) {
                        echo "<tr><th>No teams<th><tr>";
                    }

                    echo "</table>\n";
                ?>
            </div>
            <?php
            if (isset($_POST['submit'])) {
                lmao();
            }
            function lmao() {
                echo "Yeah uhh add a team to db";
            }
            ?>
            <form action="" method="POST">
                <input type="submit" name="submit" value="Add Team">
            </form>
		</div>
	</body>
</html>