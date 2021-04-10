<!DOCTYPE html>
<?php 
include ('../db/inc_db_helper.php');
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
            echo "<tr><td>{$row['ProjectName']}</td>";
            echo "<td class='alignRight'>";
            echo "<input 
            type='button' value='View Details' class='homebutton addBtn' 
            id='viewDet'onClick='document.location.href='./home.php'' />";
            echo "<input type='button' value='View Projects' class='homebutton addBtn' id='viewProj'
            onClick='document.location.href='./home.php'' />";
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