<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<!-- Bootstrap -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="css/backend_style.css"/>
	</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<a class="navbar-brand" href="../index.php">Project Maestro</a>
		</div>
	</nav>
	<div class="container">
		<div class='row mb-4'>
            <div class="col-md-8 col-sm-8 col-xs-8">Project Outline 1</div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <button type="button" class="btn btn-info">View Details</button>
                <button type="button" class="btn btn-info">View Projects</button>
            </div>
		</div>

        <button type="button" class="btn btn-success" onclick="window.location.href='./create_project_outline.php'">Create Project Outline</button>
	</div>
</body>
</html>