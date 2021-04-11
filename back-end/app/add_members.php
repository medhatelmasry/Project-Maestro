<!DOCTYPE html>
<!-- ------------------UNTESTED PAGE------------------ -->
<?php 
	include ('../db/inc_db_helper.php');
	$db = new DatabaseHelper('../db/projectmaestro.db');

    session_start();
    $teamId = $_GET["teamId"];
    //Depends on use case, edit if searching only students etc.
    $sql = "SELECT User.UserId, User.UserFName, User.UserLName FROM User";
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
            <h3>Add students to TEAM TEMP</h3>
            <h4>Students</h4>
            <div id="list">
                <?php
                    $temp = 5; // swap to get all studnets in table
                    $button = ""; //insert function to add students to team
                    echo "<table width='100%' class='table table-striped'>\n";
                    
                    //Function creation for adding students to team
                    if (isset($_POST['submit'])) {
                        lmao();
                    }
                    //Function that is attached to submit form, change name as required
                    function lmao() {
                        //Add db code here to add a user to team using $teamId
                        // may need to move into while loop to get information from $userRes
                    }

                    while ($row = $userRes->fetchArray()) {
                        $temp+=1;
                        echo "<tr>";
                        echo "<th>Name: " . $row['UserFName'] . " " . $row['UserLName'] ."</th>";
                        echo '<th>Student ID: ' . $row['UserId'] . '</th>';
                        echo '<form action="" method="POST">
                        <input type="submit" name="submit" value="Add to team">
                        </form>';
                        echo "</tr>";
                    }
                    if ($temp == 0) {
                        echo "<tr><th>No Users<th><tr>";
                    }
                    echo "</table>\n";
                ?>
            </div>
			
            <button id="viewbtn" class="btn btn-small btn-primary"; onclick="window.location.href='./view_team.php?teamId=<?php echo $teamId ?>'">Back</button>
		</div>
	</body>
</html>