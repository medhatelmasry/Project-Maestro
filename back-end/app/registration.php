<!DOCTYPE html>
<?php
include('../db/conn.php');
//starting the session
session_start();
$_SESSION["valid"] = 0;
?>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<!-- Bootstrap -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<a class="navbar-brand" target="_balnk">Project Maestro</a>
		</div>
	</nav>
	<div class="col-md-3"></div>
	<div class="col-md-6 well">
		<h3 class="text-primary">Registration</h3>
		<hr style="border-top:1px dotted #ccc;"/>
		<!-- Link for redirecting to Login Page -->
		<a href="login.php">Already a user? Click here to Log in...</a>
		<br style="clear:both;"/><br />
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<!-- Registration Form start -->
			<form method="POST" action="register_user.php">	
				<div class="alert alert-info">Registration</div>
				<div class="form-group">
					<label>Firstname</label>
					<input type="text" name="firstname" class="form-control" required="required"/>
				</div>
				<div class="form-group">
					<label>Lastname</label>
					<input type="text" name="lastname" class="form-control" required="required"/>
				</div>
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username" class="form-control" required="required"/>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" class="form-control" required="required"/>
				</div>
				<div class="form-group">
					<label>Role</label>
					<input type="text" name="userrole" class="form-control" required="required"/>
				</div>

				<button class="btn btn-primary btn-block" name="register">Register</button>
			</form>	
			<!-- Registration Form end -->
		</div>
	</div>
</body>
</html>