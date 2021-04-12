<!DOCTYPE html>
<?php 
include ('../db/inc_db_helper.php');
session_start();
// Get course ID, return to index if not assignmed
if(!isset($_SESSION['courseId'])) {
    header("Location: ../index.php");
}
$courseId = $_SESSION['courseId'];
// Get outline Id, return to index if not assigned
if(!isset($_SESSION['outId'])) {
    header("Location: ../index.php");
}
$outlineId = $_SESSION['outId'];
// //__________________________________________________
//echo $courseId; //Test code for passing project name backwards. 
// //__________________________________________________
$db = new DatabaseHelper('../db/projectmaestro.db');
// Connect to db
$connection = $db->getConn();
// Get project Id
if(!isset( $_GET["projectId"])) {
    header("Location: ../index.php");
}
$projectId = $_GET["projectId"];
//Get project data from project name
$projSql = "SELECT * FROM Project WHERE Project.ProjectId IS " . $projectId;
$projectRes =  $connection->query($projSql);
//Get user info from project ID
$userSql = "SELECT User.UserId, User.UserFName, User.UserLName 
FROM User
INNER JOIN ProjectMember ON User.UserId=ProjectMember.UserId 
INNER JOIN Project ON Project.ProjectId = ProjectMember.ProjectId
WHERE ProjectMember.ProjectId = " . $projectId;
// Run sql query, error if fail
if(!$connection->query($userSql)) {
    echo "DB not loaded, or " . $userSql . " failed.";
}
// assign sql query for user data
$userRes = $connection->query($userSql);
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
            $temp = $projectRes->fetchArray()['ProjectName'];
            $_SESSION['projectName'] = $temp;
            echo "<h3>Project: " . $temp ."</h3>"
            ?>
            <div id="list">
                <?php
                    $temp = 0; //Swap to get students in team
                    echo "<table width='100%' class='table table-striped'>\n";
                    while ($row = $userRes->fetchArray()) {
                        // Check if team is empty
                        $temp+=1;
                        //Update these statements to get FN, LN and ID if not printing
                        echo "<tr>";
                        echo "<th>Name: " . $row['UserFName'] . " " . $row['UserLName'] ."</th>";
                        echo '<th>Student ID: ' . $row['UserId'] . '</th>';
                        echo "</tr>";
                    }
                    if ($temp == 0) {
                        echo "<tr><th>No Members<th><tr>";
                    }
                    echo "</table>\n";
                ?>
            </div>
			<button id="viewbtn" class="btn btn-small btn-primary"; onclick="window.location.href='./add_members.php?projectId=<?php echo $projectId ?>'">Add member</button>
            <button id="viewbtn" class="btn btn-small btn-primary"; onclick="window.location.href='./view_goals.php?projectId=<?php echo $projectId ?>'">View Goals</button>
            <br>
            <br>
            <button id="viewbtn" class="btn btn-small btn-primary"; 
            onclick="window.location.href='./view_projects.php?crsId=<?php echo $courseId ?>&outlineId=<?php echo $outlineId ?>'">Back</button>
		</div>
	</body>
</html>