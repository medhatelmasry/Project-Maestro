<?php
	//starting the session
	session_start();

	//including the database connection
	require_once '../db/conn.php';
	
	if(ISSET($_POST['register'])){
		// Setting variables
		$username = $_POST['username'];
		$password = $_POST['password'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$userrole = $_POST['userrole'];
		
		// Insertion Query
		$query = "INSERT INTO Users (username, password, firstname, lastname, userrole) VALUES(:username, :password, :firstname, :lastname, :userrole)";
		$stmt = $conn->prepare($query);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $password);
		$stmt->bindParam(':firstname', $firstname);
		$stmt->bindParam(':lastname', $lastname);
		$stmt->bindParam(':userrole', $userrole);
		
		// Check if the execution of query is success
		if($stmt->execute()){
			//setting a 'success' session to save our insertion success message.
			$_SESSION['success'] = "Successfully created an account";

			//redirecting to the home.php 
			header('location: home.php');
		}

	}
?>