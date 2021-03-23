<!DOCTYPE html>
<?php 
// include('../db/conn.php');
//starting the session
session_start();
$_SESSION["valid"] = 0;
?>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
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
		<h3 class="text-primary">Project Maestro</h3>
		<hr style="border-top:1px dotted #ccc;"/>
		<!-- Link for redirecting page to Registration page -->
		<a href="registration.php">Not an existing user? Click here to Register...</a>
		<br style="clear:both;"/><br />
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<!-- Login Form Starts -->
			<form method="POST" action="login_validation.php">	
				<div class="alert alert-info">Login</div>
				<div class="form-group">
					<label>Email</label>
					<input type="text" name="email" class="form-control" required="required"/>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" class="form-control" required="required"/>
				</div>
				
				<?php
					//checking if the session 'success' is set. Success session is the message that the credetials are successfully saved.
					if(isset($_SESSION['success'])){
				?>
				<!-- Display registration success message -->
				<div class="alert alert-success"><?php echo $_SESSION['success']?></div>
				<?php
					//Unsetting the 'success' session after displaying the message. 
					unset($_SESSION['success']);
					}
				?>

				<?php
					//checking if the session 'error' is set. Error session is the message if the 'Username' and 'Password' is not valid.
					if(ISSET($_SESSION['error'])){
				?>
				<!-- Display Login Error message -->
					<div id="error" class="alert alert-danger"><?php echo $_SESSION['error']?></div>
				<?php
                    //Unsetting the 'error' session after displaying the message.
                    unset($_SESSION['error']);
					}
				?>
				<button class="btn btn-primary btn-block" name="login">Login</button>
			</form>	
			<!-- Login Form Ends -->
		</div>
	</div>
</body>
</html>