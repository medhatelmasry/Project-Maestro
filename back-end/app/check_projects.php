
<!DOCTYPE html>

<?php 
// MOCK PAGE_______________________________________________________________
// Please update if required
//_________________________________________________________________________
include_once("../db/inc_db_helper.php");
$db = new DatabaseHelper('../db/projectmaestro.db');
$connection = $db->getConn();

$res = $connection->query('SELECT * FROM Project');
?>
<html lang="en">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/add_course_std.css" />
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <a class="navbar-brand" target="_balnk">Project Maestro</a>
        </div>
    </nav>
    <h1 class="courseInfo">Project Outline</h1>
    <div class="col-md-3"></div>
    <table class="tableList">
        <?php     
        while ($row = $res->fetchArray()) {
            // Use this variable to send the project to the next page to find teams
            $viewTeam = "window.location.href='./view_teams.php?project={$row['ProjectName']}'";
            $_SESSION["Project"] = $row['ProjectName'];
            //______________________________________________________________________-
            echo "<tr><td>{$row['ProjectName']}</td>";
            echo "<td class='alignRight'>";
            echo "<input 
            type='button' value='View Details' class='homebutton addBtn' 
            id='viewDet'onClick='document.location.href='./home.php'' />";
            // Use this button for redirection, this sends the projectname via the link
            // NOT VALIDATED, USERS CAN ENTER W/E THEY WANT INTO THE LINK
            echo '<button id="viewProj" class="homebutton addBtn"; value="'. $row['ProjectName'] .'" onclick="' 
            . $viewTeam . '">View Teams</button>';
            //______________________________________________________________________
            echo "</td>";
            echo "</tr>";
        };
        ?>
    </table>
    <input type="button" value="Create Projects" class="homebutton createProj addBtn" id="createProj"
        onClick="document.location.href='./home.php'" />
    </div>
</body>

</html>