<!DOCTYPE html>
<?php 
include_once('../db/inc_db_helper.php');
$db = new DatabaseHelper('../db/projectmaestro.db');
$connection = $db->getConn();
$CourseId = $_GET['id']; //gets the course id from viewProjects page

//goes throught he course table and gets the items corresponding with the course id we got
$stm = $connection->prepare('SELECT * FROM Course WHERE CourseId = :id');
$stm->bindValue(':id', $CourseId, SQLITE3_TEXT);
$res1 = $stm->execute();
$row1 = $res1->fetchArray(SQLITE3_NUM);  

$res = $connection->query('SELECT * FROM Student');
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
    <h1 class="courseInfo">Course Name: <?php echo $row1[1] . " " . $CourseId ?></h1> <!--gets the values of course name adn course id -->
    <h2 class="courseInfo">Students</h2>
    <div class="col-md-3"></div>
    <table class="tableList">
        <?php 
            while ($row = $res->fetchArray()) {
                echo"<td>";
                $test = $row['UserId'];
                $userRes = $connection->query("SELECT * FROM User WHERE UserId=$test");
                while ($row2 = $userRes->fetchArray()) { 
                    echo $row2["UserFName"];
                    echo $row2["UserLName"];
                }
                echo"</td>";
                echo"<td class='alignRight'>";
                echo"{$row['StudentId']}";
                echo"<input type='button' value='Add' class='homebutton addBtn' id='addStd'
                    onClick='document.location.href='./home.php''/>";
                echo"</td> </tr>";
            }
            ?>
    </table>
    </div>
</body>

</html>