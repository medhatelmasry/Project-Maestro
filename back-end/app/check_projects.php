<!DOCTYPE html>
<?php 
include_once('../db/inc_db_helper.php');
session_start();
$db = new DatabaseHelper('../db/projectmaestro.db');
$connection = $db->getConn();
$id = $_SESSION['instructor_id'];
$res = $connection->query('SELECT * FROM ProjectOutline');
if(isset($_SESSION['instructor_id'])){
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
            <a class="navbar-brand" href="javascript:window.location.href=window.location.href">Project Maestro</a>
            <a class="navbar-brand navbar-right" href="logout.php">Logout</a>
        </div>
    </nav>
    <h1 class="courseInfo">Project Outline</h1>
    <div class="col-md-3"></div>
    <table class="tableList">
        <?php 
        while ($row = $res->fetchArray()) {
                    $prjId = "1";
                    echo "<tr><td>{$row['ProjectOutlineName']}</td>";
                    echo "<td class='alignRight'>";
                    echo "<a href='home.php?prjId=$prjId'>";
                    echo "<input type='button' value='View Details' class='homebutton addBtn' id='viewDet'/>";
                    echo "</td>";
                    echo "</tr>";
        };
        ?>
    </table>
    <input type="button" value="Create Projects" class="homebutton createProj addBtn" id="createProj"
        onClick="document.location.href='./home.php'" />
    </div>
    <?php    
    } else {
      $_SESSION['require_login_error'] = "Restricted Access, please login to access.";
      if (isset($_SESSION['require_login_error'])){
        header('Location: ../index.php');
        exit();
      }
    }
     ?>
</body>

</html>