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
            <h3>Project Title Filler</h3>
            <div id="list">
                <?php
                    $temp = 3; //Swap to get all teams in project
                    $button = "window.location.href='./view_team.php'";
                    echo "<table width='100%' class='table table-striped'>\n";
                    
                    for ($x = 0; $x <= $temp; $x++) {
                        echo "<tr>";
                        echo "<th>Team " . $x ."</th>";
                        echo '<th><button id="viewbtn" class="btn btn-small btn-primary"; onclick="' . $button . '">View Details</button></th>';
                        echo "</tr>";
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