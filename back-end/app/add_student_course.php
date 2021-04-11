<!DOCTYPE html>
<?php 
include_once('../db/inc_db_helper.php');
$db = new DatabaseHelper('../db/projectmaestro.db');
$connection = $db->getConn();
session_start();
$courseId='COMP1111';
$res = $connection->query('SELECT * FROM Student');
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
    <h1 class="courseInfo"><?php echo $courseId?></h1>
    <h2 class="courseInfo">Students</h2>
    <div class="col-md-3"></div>
    <table class="tableList">
        <?php 
            while ($row = $res->fetchArray()) {
                echo"<td>";
                $userId = $row['UserId'];
                $userRes = $connection->query("SELECT * FROM User WHERE UserId=$userId");
                while ($row2 = $userRes->fetchArray()) { 
                    echo $row2["UserFName"];
                    echo $row2["UserLName"];
                } 
                echo"</td>";
                echo"<td class='alignRight'>";
                $stdId = $row['StudentId'];
                echo"$stdId";
                echo"<td>";
                echo"<form action='process_add_std_course.php' method='post'>";
                echo"<input type='hidden' value='$courseId' name='CourseId' id='CourseId'/>";
                echo"<input type='hidden' value='$stdId' name='UserId' id='Userid'/>";
                echo"<input type='submit' value='Add' class='btn btn-danger addBtn' />";
                echo"</form>";
                echo"</td>";
                echo"</td> </tr>";
            }
            ?>
    </table>
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