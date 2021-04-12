<!DOCTYPE html>
<?php
session_start();
include_once('../db/inc_db_helper.php');
if(isset($_SESSION['instructor_id'])){
    $db = new DatabaseHelper('../db/projectmaestro.db');
    $connection = $db->getConn();
    $courseId = $_GET['id']; //gets the course id from viewProjects page
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
            <a class="navbar-brand" href="home.php">Project Maestro</a>
            <a class="navbar-brand navbar-right" href="logout.php">Logout</a>
        </div>
    </nav>
    <h1 class="courseInfo"><?php echo $courseId?></h1>
    <h2 class="courseInfo">Students</h2>
    <?php
    //checking if the session 'deleted' is set. Deleted session is the message if the course was deleted.
    if(ISSET($_SESSION['addStd'])){
    ?>
    <div class="alert alert-success addedMsg"><?php echo $_SESSION['addStd']?></div>
    <?php
        unset($_SESSION['addStd']);
    }
    ?>
    <div class="col-md-3"></div>
    <table class="tableList">
        <?php 
            while ($row = $res->fetchArray()) {
                echo"<td>";
                $userId = $row['UserId'];
                $userRes = $connection->query("SELECT * FROM User WHERE UserId=$userId");
                while ($row2 = $userRes->fetchArray()) { 
                    echo $row2["UserFName"];
                    echo"  ";
                    echo $row2["UserLName"];
                } 
                echo"</td>";
                echo"<td class='alignRight'>";
                $stdId = $row['StudentId'];
                echo"$stdId";
                echo"<td>";
                echo"<form action='process_add_std_course.php' method='post'>";
                echo"<input type='hidden' value='$courseId' name='CourseId' id='CourseId'/>";
                echo"<input type='hidden' value='$userId' name='UserId' id='Userid'/>";
                echo"<input type='submit' value='Add' class='btn btn-success addBtn' />";
                echo"</form>";
                echo"</td>";
                echo"</td> </tr>";
            }
            ?>
    </table>
    <a href="viewCourse.php" class="btn btn-small btn-success backBtn">Back</a>
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