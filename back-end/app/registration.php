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
	<a href="../index.php"><button class="btn-back">Back</button></a>
	<div class="content">
		<!-- Login Form Starts -->
			<!-- Registration Form start -->
			<form method="POST" action="registration_validation.php">
				<div class="label-input-wrapper">
					<div class="label-input, form-inline">
						<div class="col-sm-2">
							<label>Email</label>
						</div>
						<div class="col-sm-8, input">
							<input type="text" name="email" class="form-control" required="required" placeholder="email"/>
						</div>
					</div><br><br>
					<div class="label-input, form-inline">
						<div class="col-sm-2">
							<label>Password</label>
						</div>
						<div class="col-sm-8, input">
							<input type="password" name="password" class="form-control" required="required" placeholder="password"/>
						</div>
					</div><br><br>
					<div class="label-input, form-inline">
						<div class="col-sm-2">
							<label>Firstname</label>
						</div>
						<div class="col-sm-8, input">
							<input type="text" name="firstName" class="form-control" required="required" placeholder="firstname"/>
						</div>
					</div><br><br>
					<div class="label-input, form-inline">
						<div class="col-sm-2">
							<label>Lastname</label>
						</div>
						<div class="col-sm-8, input">
							<input type="text" name="lastName" class="form-control" required="required" placeholder="lastname"/>
						</div>
					</div>
				</div>

				<button class="button" name="register">Sign Up</button>
			</form>	
			<!-- Registration Form end -->
		</div>
	</div>
</body>
</html>