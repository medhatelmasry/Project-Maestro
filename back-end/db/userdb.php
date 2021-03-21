<?php

# http://localhost:8888/apicrud_sqlite.php/users

# https://www.leaseweb.com/labs/2015/10/creating-a-simple-rest-api-in-php/

# URL components should look like this: http://localhost/api.php/{$table}/{$id}

# it is assumed that the first column in the table is the primary key

define("DEBUG", 0);

#===============================================
# get the HTTP method, path and body of the request
#===============================================
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));

session_start();
// Checking if session variable has been triggered. 
if($_SESSION["valid"] == 1) {
  $input = json_decode(file_get_contents('php://input'),true);
} else {
  // redirect if no session is running
  header('location: ../../app/login.php');
}

 
#===============================================
# Create database or open if it already exists
#===============================================
$conn = new SQLite3('users.db');

#===============================================
# Create Users table IF NO EXIST
#===============================================
$SQL_create_table = "CREATE TABLE IF NOT EXISTS Users (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  firstname VARCHAR(50),
  lastname VARCHAR(50),
  username VARCHAR(50),
  password VARCHAR(50),
  userrole VARCHAR(50)
);";
$conn->exec($SQL_create_table);

#===============================================
# Insert dummy data
#===============================================
$rows = $conn->query("SELECT COUNT(*) as count FROM Users");
$row = $rows->fetchArray();
$numRows = $row['count'];

// if ($row['count'] < 2) {
//   $SQL_insert_data = "INSERT INTO Users (firstname, lastname, username, password, userrole) 
//   VALUES 
//   ('Snoopy', 'Doggo', 'test@test.com', test123', 'Instructor'),
// 	('Winnie', 'Pooh', 'test1@test.com', 'test123', 'Student'),
// 	('Sushi', 'California', 'test2@test.com', 'test123', 'Student'),
// 	('French', 'Fries', 'test3@test.com', 'test123', 'Student'),
// 	('Tofu', 'Soup', 'test4@test.com', 'test123', 'Student'),
// 	('Seafood', 'Pancake', 'test5@test.com', 'test123', 'Student')
//   ";
//   $conn->exec($SQL_insert_data);
// }

if (DEBUG === 1) {
    echo "<h3>request</h3>";
    var_dump($request);
}

#===============================================
# retrieve the table from the path
#===============================================
if (isset($request[0])) {
    $table = $request[0];

    if (DEBUG === 1) {
        echo "<h3>table</h3>";
        var_dump($table);
    }
} else {
    $table = NULL;
}

#===============================================
# retrieve the key from the path
#===============================================
if (isset($request[1])) {
    $key = $request[1];
    if (DEBUG === 1) {
        echo "<h3>key</h3>";
        var_dump($key);
    }
} else {
    $key = NULL;
}

if (DEBUG === 1) {
    echo "<h3>input</h3>";
    var_dump($input);
}
 
#===============================================
# get columns & values then construct insert & update
#===============================================
if (isset($input)) {
    // escape the columns and values from the input object
    $columns = preg_replace('/[^a-z0-9_]+/i','',array_keys($input));
    $values = array_map(function ($value) {
      if ($value===null) {
        return null;
      }
        return SQLite3::escapeString((string)$value);
    },array_values($input));
    
    // build the SET part of the SQL command
    $insertSet = '';
    $insertVal='';
    $updateSet = '';
    for ($i=0;$i<count($columns);$i++) {
      $insertSet.=($i>0?',':'').'`'.$columns[$i].'`';
      $insertVal.=($values[$i]===null?'NULL':'"'.$values[$i].'",');

      $updateSet.=($i>0?',':'').'`'.$columns[$i].'`=';
      $updateSet.=($values[$i]===null?'NULL':'"'.$values[$i].'"');
    }

    $insertVal = str_replace("\"", "'", $insertVal);
    $insertVal = substr_replace($insertVal, "", -1);

    if (DEBUG === 1) {
      echo "<h3>set</h3>";
      echo "*" . $insertSet . "*";
      echo "<h3>val</h3>";
      echo "*" . $insertVal . "*";    
    }
}

#===============================================
# Get first column name and assume it is PK
#===============================================
$result = $conn->query("SELECT * FROM $table");
$pk = $result->columnName(0);
 
#===============================================
# create SQL based on HTTP method
#===============================================
switch ($method) {
  case 'GET':
    $sql = "SELECT * FROM `$table`".($key?" WHERE $pk=$key":''); 
    break;
  case 'PUT':
    $sql = "UPDATE `$table` SET $updateSet WHERE $pk=$key"; 
    break;
  case 'POST':
    $sql = "INSERT INTO `$table` ($insertSet) VALUES ($insertVal)"; 
    break;
  case 'DELETE':
    $sql = "DELETE FROM `$table` WHERE $pk=$key"; 
    break;
}

if (DEBUG === 1) {
  echo "<h3>SQL</h3>";
  echo $sql;
}
 
#===============================================
# excecute SQL statement
#===============================================
$result = $conn->query($sql);
 
#===============================================
# die if SQL statement failed
#===============================================
if (!$result) {
  http_response_code(404);
  die("Error in fetch ".$conn->lastErrorMsg());
}

if (DEBUG === 1) {
    echo "<h3>JSON</h3>";
}

#===============================================
# print results, insert id or affected row count
#===============================================
if ($method == 'GET') {
  header('Content-type:application/json;charset=utf-8');
    $collection = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
      $collection[] = $row;
    }
    if (count($collection) > 1){
      echo json_encode($collection);
    }
    else {
      if (isset($collection[0])){
        echo json_encode($collection[0]);
      } else {
        http_response_code(404);
      }
    }
} elseif ($method == 'POST') {
  echo $conn->lastInsertRowid();
} else {
  echo $conn->changes();
}
 
#===============================================
# close SQLite connection
#===============================================
$conn->close();

?>