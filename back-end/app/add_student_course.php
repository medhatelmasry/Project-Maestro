<!DOCTYPE html>
<?php 
	include ('../db/inc_db_helper.php');

	$db = new DatabaseHelper('../db/projectmaestro.db');
?>
<?php 
//$test = [["Bob","a01111"],["Bill","a02222"],["Galvin","a03333"]]; 
// include('../db/conn.php');
//starting the session
//session_start()//?\;
$endpoint = 'http://localhost:8000/api.php/Student';
$response = file_get_contents($endpoint);
$json = json_decode($response);
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
    <h1 class="courseInfo">Course Name</h1>
    <h2 class="courseInfo">Students</h2>
    <div class="col-md-3"></div>
    <table class="tableList">
        <?php foreach ($json as $item) { ?>
        <tr">
            <td>
                <?php 
                $getUser = 'http://localhost:8000/api.php/User/'.$item->UserId;
                $response2 = file_get_contents($getUser);
                $userJson = json_decode($response2);
                echo $userJson->UserEmail?>
            </td>
            <td class="alignRight">
                <?php echo $item->StudentId;?>
                <input type="button" value="Add" class="homebutton addBtn" id="addStd"
                    onClick="document.location.href='./home.php'" />
            </td>
            </tr>
            <?php } ?>
    </table>
    </div>
</body>

</html>