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
			<a class="navbar-brand" href="../index.php">Project Maestro</a>
		</div>
	</nav>
	<?php 
	$CourseId = $_GET['crsId'];
	?>
	<div class="container">
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
    			<textarea class="form-control" placeholder="Leave requirements for this project outline" name="requirement" style="height: 100px"></textarea>
			</div>
			<input type="hidden" name="CourseId" value=<?php echo "'$CourseId'"?>/>
			<button type="submit" name="create_project_outline" class="btn btn-success">Create</button>
		</form>	
	</div>
</body>
</html>