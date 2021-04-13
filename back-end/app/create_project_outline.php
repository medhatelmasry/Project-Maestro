<?php 
include 'database_init.php'; 
$CourseId = $_GET['crsId'];
if(isset($_SESSION['instructor_id'])){?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<!-- Bootstrap -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>

	</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<a class="navbar-brand" href="home.php">Project Maestro</a>
			<a class="navbar-brand navbar-right" href="logout.php">Logout</a>
		</div>
	</nav>
	<div class="container">
	<a href="check_projects.php?id=<?php echo $CourseId;?>" class="btn btn-small btn-success">Back</a>
		<form method="POST" action="process_project_outline.php">
			<div class="form-group">
				<label for="project_name">Project Outline Name</label>
    			<input type="text" class="form-control" name="project_name" required="required" >
			</div>
			<div class="form-group">
				<label for="due_date">Due Date</label>
    			<input type="date" name="due_date" class="form-control" required="required"/>
			</div>
			<div class="form-group">
				<label for="requirement">Requirements</label>
    			<textarea class="form-control" placeholder="Leave requirements for this project outline" name="requirement" style="height: 100px" required="required"></textarea>
			</div>
			<input type="hidden" name="CourseId" value=<?php echo $CourseId;?>/>
			<button type="submit" name="create_project_outline" class="btn btn-success">Create</button>
		</form>
	</div>
	<?php	
	echo $_SESSION['instructor_id'];
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