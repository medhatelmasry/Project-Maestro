<?php
	session_start();
	require_once '../db/conn.php';
	
	if(ISSET($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$query = "SELECT COUNT(*) as count FROM Users WHERE username = :username AND password = :password";
		$stmt = $conn->prepare($query);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $password);
		$stmt->execute();
		$row = $stmt->fetch();
		
		$count = $row['count'];
		
		if($count > 0){
			// temp session var to check if user has logged on
			// Reset when landing on login/registration page
			// Currently user can access home directly, thus they can technically
			// Trigger the variable by hoping direclty to home without logging in otherwise. 
			$_SESSION["valid"] = 1;
			header('location:home.php');
		}else{
			$_SESSION['error'] = "Invalid username or password";
			header('location:login.php');
		}
	}
?>