<?php 
    include ('../db/inc_db_helper.php');

    $db = new DatabaseHelper('../db/projectmaestro.db');
?>
<!DOCTYPE html>
<?php 

//Used for redirect
session_start();
//From Link
$project = $_GET["project"];
//Redirect
$_SESSION['projectName'] = $project;
// Cconnect to db
$connection = $db->getConn();
//Get project data from project name [PLEASE UPDATE IF THIS CHANGES]
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
                    $temp = 0; //checks if there are teams
                    
                    echo "<table width='100%' class='table table-striped'>\n";
                    while ($row = $res->fetchArray()) {
                        $temp+=1;
                        // Sends team Id to the next page
                        $button = "window.location.href='./view_team.php?teamId={$row['TeamId']}'";
                        // Update these variables if they change
                        echo "<tr>";
                        echo "<th>Team " . $row['TeamId'] ."</th>";
                        echo "<th>" . $row['TeamName'] ."</th>";
                        // Redirect that adds teamId into the link
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
                //Add db code here to add a fresh team to DB
            }
            ?>
            <!-- add input boxes here to add team etc. -->
            <form action="" method="POST">
                <input type="submit" name="submit" value="Add Team">
            </form>
            <!-- Uncomment this button, and change the echo statement to return to projects list. 
            Send the information that check_projects needs to display properly -->
            <!-- <button id="viewbtn" class="btn btn-small btn-primary"; onclick="window.location.href='./view_teams.php?project=<?php echo $projectName ?>'">Back</button> -->
		</div>
	</body>
</html>