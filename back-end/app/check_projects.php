<!DOCTYPE html>
<?php 
// include('../db/conn.php');
//starting the session
//session_start()//?\;
$endpoint = 'http://localhost:8000/api.php/Project';
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
    <h1 class="courseInfo">Project Outline</h1>
    <div class="col-md-3"></div>
    <table class="tableList">
        <?php foreach ($json as $item) { ?>
        <tr">
            <td>
                <?php echo$item->ProjectName?>
            </td>
            <td class="alignRight">
                <input type="button" value="View Details" class="homebutton addBtn" id="viewDet"
                    onClick="document.location.href='./home.php'" />
                <input type="button" value="View Projects" class="homebutton addBtn" id="viewProj"
                    onClick="document.location.href='./home.php'" />
            </td>
            </tr>
            <?php } ?>
    </table>
    <input type="button" value="Create Projects" class="homebutton createProj addBtn" id="createProj"
        onClick="document.location.href='./home.php'" />
    </div>
</body>

</html>