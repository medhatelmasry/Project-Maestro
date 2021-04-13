<?php 
// include('../db/conn.php');
//starting the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
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
	<div class="container">
		<div class="content">
			<!-- Login Form Starts -->
			<form method="POST" action="instructor_login_validation.php">	
				<div class="label-input-wrapper">
					<div class="label-input, form-inline">
						<div class="col-sm-2">
							<label>Email: </label>
						</div>
						<div class="col-sm-8, input">
							<input type="text" name="email" class="form-control" required="required" placeholder='email'/>
						</div>
					</div><br><br>
					<div class="label-input, form-inline">
						<div class="col-sm-2">
							<label>Password:</label>
						</div>
						<div class="col-sm-8, input">
							<input type="password" name="password" class="form-control" required="required" placeholder='password'/>
						</div>
					</div>
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
				<button class="button" name="login">Login</button>
			</form>	
			<!-- Login Form Ends -->
		</div>
	</div>
</body>
</html>