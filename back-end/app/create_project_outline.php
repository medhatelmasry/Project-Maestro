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
	<div class="container-fluid">
		<form method="POST" action="process_project_outline.php">
			<div class="form-group">
				<label for="project_name">Project Name</label>
    			<input type="text" class="form-control" name="project_name" required="required" >
			</div>
			<div class="form-group">
				<label for="due_date">Due Date</label>
    			<input type="date" name="due_date" class="form-control" required="required"/>
			</div>
			<div class="form-group">
				<label for="description">Description</label>
    			<textarea class="form-control" placeholder="Leave a description for this project outline" name="description" style="height: 100px"></textarea>
			</div>
			<!-- <div class="label-input, form-inline">
				<div class="col-sm-2">
					<label>Due Date:</label>
				</div>
				<div class="col-sm-8, input">
					<input type="date" name="due_date" class="form-control" required="required"/>
				</div>
			</div>
			<div class="label-input">
				<div class="col-sm-2">
					<label>Description:</label>
				</div>
				<div class="">
  					<textarea class="form-control" placeholder="Leave a description for this project outline" name="description" style="height: 100px"></textarea>
				</div>
			</div> -->
			<!-- <button class="button" name="create_project_outline">Create Project Outline</button> -->
			<button type="submit" name="create_project_outline" class="btn btn-success">Create</button>
		</form>	
	</div>
</body>
</html>