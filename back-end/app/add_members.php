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
				<a class="navbar-brand navbar-right" href="login.php">Logout</a>
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
                    
                    for ($x = 0; $x <= $temp; $x++) {
                        echo "<tr>";
                        echo "<th>Name " . $x ."</th>";
                        echo '<th>Student #: ' . $x;
                        echo '<button id="addbtn" class="btn btn-small btn-primary"; onclick="' . $button . '">Add</button></th>';
                        echo "</tr>";
                    }
                    echo "</table>\n";
                ?>
            </div>
			
            <button id="viewbtn" class="btn btn-small btn-primary"; onclick="window.location.href='./view_team.php'">Back</button> 
		</div>
	</body>
</html>