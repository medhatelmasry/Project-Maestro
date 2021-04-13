<!DOCTYPE html>
<?php 
	include ('../db/inc_db_helper.php');
	$db = new DatabaseHelper('../db/projectmaestro.db');
    $connection = $db->getConn();
    // Get project name, redirect otherwise
    session_start();
    if(!isset($_SESSION['projectName'])) {
        header("Location: ../index.php");
    }
    $projectName = $_SESSION['projectName']; // Assign
    // Get project id, redirect otherwise
    if(!isset($_GET["projectId"])) {
        header("Location: ../index.php");
    }
    $projectId = $_GET["projectId"]; //Assign

    // Get course id, redirect otherwise
    if(!isset($_GET["crsId"])) {
        header("Location: ../index.php");
    }
    $projectId = $_GET["projectId"]; //Assign
    $CourseId = $_GET["crsId"];
    // Depends on use case, edit if searching only students etc.
    $sql = "SELECT User.UserId, User.UserFName, User.UserLName FROM User
    INNER JOIN CourseList ON User.UserId=CourseList.UserId 
    WHERE CourseList.CourseId='$CourseId'";
    // Check sql query, error if false
    if(!$connection->query($sql)) {
        echo "DB not loaded, or " . $sql . " failed.";
    }
    $userRes =  $connection->query($sql);
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
            <h3>Add Users to <?php echo $projectName ?></h3>
            <h4>Users</h4>
            <div id="list">
                <?php
                    echo "<table width='100%' class='table table-striped'>\n";
                    $temp = 0;
                    while ($row = $userRes->fetchArray()) {
                        $temp+=1;
                        echo "<tr>";
                        echo "<th>Name: " . $row['UserFName'] . " " . $row['UserLName'] ."</th>";
                        echo '<th>Student ID: ' . $row['UserId'] . '</th>';
                        echo '<th><form action="" method="POST">
                        <input type="submit" name="'. $row['UserId'] . '" value="Add">
                        </form></th>';
                        //check
                        if (isset($_POST[$row['UserId']])) {
                            lmao();
                        }
                        //henceforth
                        echo "</tr>";
                    }

                    // Function that is attached to submit form, change name as required
                    function lmao() {
                        $db_helper = new DatabaseHelper('../db/projectmaestro.db');
                        $conn = $db_helper->getConn();

                        foreach($_POST as $name => $content) {
                            $sqlInsert = "INSERT INTO ProjectMember (ProjectId, UserId)
                            VALUES (" . $_GET["projectId"] . ", " . $name .")";
                            echo "<br>";
                            echo $sqlInsert;
                        }
                        if ($conn->query($sqlInsert)) {
                            echo "Successfully added.";
                        } else {
                            echo "Error: " . $sqlInsert . "<br>" . $conn->error;
                        }
                    }
                    if ($temp == 0) {
                        echo "<tr><th>No Users<th><tr>";
                    }
                    echo "</table>\n";
                    //test
                    // $sqlInsert = "INSERT INTO ProjectMember (ProjectId, UserId) VALUES (3, 6)";
                    // echo "<br>";
                    // echo $sqlInsert;
                    // if ($connection->query($sqlInsert)) {
                    //     echo "Successfully added.";
                    // } else {
                    //     echo "Error: " . $sqlInsert . "<br>" . $connection->error;
                    // }
                    $db->close();
                    unset($db);
                ?>
            </div>
			
            <button id="viewbtn" class="btn btn-small btn-primary"; onclick="window.location.href='./view_team.php?projectId=<?php echo $projectId ?>'">Back</button>
		</div>
	</body>
</html>