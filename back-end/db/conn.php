<?php
	//check if the database file exists and create a new if not
	$userdbPath = 'users.db';
	if(!is_file($userdbPath)){
		file_put_contents($userdbPath, null);
	}
	// connecting the database
	$conn = new PDO('sqlite:users.db');
	//Setting connection attributes
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//Query for creating users table in the database if not exist yet.
	$create_db_query = "CREATE TABLE IF NOT EXISTS Users (
		id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
		firstname VARCHAR(50),
		lastname VARCHAR(50),
		username VARCHAR(50),
		password VARCHAR(50),
		userrole VARCHAR(50)
	  );";

	//Executing the query
	$conn->exec($create_db_query);
	
	//Query for creating creating dummy data
	$check_empty_sql = "SELECT * FROM Users";
	$stmt1 = $conn->prepare($check_empty_sql);
	$stmt1->execute();
	$data = $stmt1->fetch();

	// will be false if empty
	if (!$data) {
		$SQL_insert_data = "INSERT INTO Users (firstname, lastname, username, password, userrole) 
		VALUES (?,?,?,?,?)
		";

		$statement = $conn->prepare($SQL_insert_data);
		$statement->execute(array('Snoopy', 'Doggo', 'test@test.com', 'test123', 'Instructor'));
		$statement->execute(array('Seafood', 'Pancake', 'test1@test.com', 'test123', 'Student'));
	}
?>