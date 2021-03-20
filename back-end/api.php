<?php

# get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);
# Create database or open if it already exists
$db = new SQLite3('projects.db');

# Create Students table IF NO EXIST
$SQL_create_table = ["CREATE TABLE IF NOT EXISTS Project (
  ProjectId INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  ProjectName VARCHAR(80),
  CourseId INTEGER,
  TeamId INTEGER,
  FOREIGN KEY (CourseId) REFERENCES Course(CourseId),
  FOREIGN KEY (TeamId)  REFERENCES Team(TeamId)

);",
"CREATE TABLE IF NOT EXISTS Goal (
  GoalId INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  GoalDesc VARCHAR(80),
  GoalStart VARCHAR(80),
  GoalEnd VARCHAR(80)

  );",
"CREATE TABLE IF NOT EXISTS Team (
  TeamId INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  TeamName VARCHAR(80),
  StudentId INTEGER,
  ProjectId INTEGER,
  GoalId INTEGER,
  FOREIGN KEY (ProjectId) REFERENCES Project(ProjectId),
  FOREIGN KEY (StudentId) REFERENCES Student(StudentId),
  FOREIGN KEY (GoalId) REFERENCES Goal(GoalId) 

  )",
"CREATE TABLE IF NOT EXISTS Course (
  CourseId INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  CourseName VARCHAR(80),
  InstructorId INTEGER,
  StudentId INTEGER,
  Term VARCHAR(80),
  FOREIGN KEY (InstructorId) REFERENCES Instructor(InstructorId),
  FOREIGN KEY (StudentId) REFERENCES Student(StudentId)

  )",
"CREATE TABLE IF NOT EXISTS Student (
  StudentId INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  FName VARCHAR(80),
  LName VARCHAR(80),
  StudentSet VARCHAR(80),
  StudentEmail VARCHAR(80),
  StudentPassword VARCHAR(80),
  CourseId INTEGER,
  ProjectId INTEGER,
  FOREIGN KEY (ProjectId) REFERENCES Project(ProjectId),
  FOREIGN KEY (StudentId) REFERENCES Student(StudentId)
  )",
"CREATE TABLE IF NOT EXISTS Instructor (
  InstructorId INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  FName VARCHAR(80),
  LName VARCHAR(80),
  InstructorEmail VARCHAR(80),
  InstructorPassword VARCHAR(80),
  CourseId INTEGER,
  FOREIGN KEY (CourseId) REFERENCES Course(CourseId)
  )"
  ];


foreach ($SQL_create_table as $command) {
  $db->exec($command);
  }


$rows = $db->query("SELECT COUNT(*) as count FROM Project");
$row = $rows->fetchArray();
$numRows = $row['count'];
if ($row['count'] === 0) {
    $SQL_insert_data = "INSERT INTO Project (ProjectName)
    VALUES 
    ('Project Maestro'),
    ('Hello Fresh')
    ";

    $db->exec($SQL_insert_data);
}

$rows = $db->query("SELECT COUNT(*) as count FROM Goal");
$row = $rows->fetchArray();
$numRows = $row['count'];
if ($row['count'] === 0) {
    $SQL_insert_data = "INSERT INTO Goal (GoalDesc, GoalStart, GoalEnd)
    VALUES 
    ('Start', '12/12/21', '12/12/21'),
    ('End', '07/08/21', '08/08/21')
    ";

    $db->exec($SQL_insert_data);
}


$rows = $db->query("SELECT COUNT(*) as count FROM Team");
$row = $rows->fetchArray();
$numRows = $row['count'];
if ($row['count'] === 0) {
    $SQL_insert_data = "INSERT INTO Team (TeamName)
    VALUES 
    ('Team 1'),
    ('Team 2')
    ";

    $db->exec($SQL_insert_data);
}


$rows = $db->query("SELECT COUNT(*) as count FROM Course");
$row = $rows->fetchArray();
$numRows = $row['count'];
if ($row['count'] === 0) {
    $SQL_insert_data = "INSERT INTO Course (CourseName, Term)
    VALUES 
    ('Comp3795', '2'),
    ('Comp3522', '1')
    ";

    $db->exec($SQL_insert_data);
}

$rows = $db->query("SELECT COUNT(*) as count FROM Student");
$row = $rows->fetchArray();
$numRows = $row['count'];
if ($row['count'] === 0) {
    $SQL_insert_data = "INSERT INTO Student (FName, LName, StudentSet, StudentEmail, StudentPassword)
    VALUES 
    ('Oves', 'Patel', 'S', 'oves.patel98@gmail.com', 'password'),
    ('Calvin', 'L', 'S', 'calvin.l@gmail.com', 'password')
    ";

    $db->exec($SQL_insert_data);
}

$rows = $db->query("SELECT COUNT(*) as count FROM Instructor");
$row = $rows->fetchArray();
$numRows = $row['count'];
if ($row['count'] === 0) {
    $SQL_insert_data = "INSERT INTO Instructor (FName, LName, InstructorEmail, InstructorPassword)
    VALUES 
    ('Medhat', 'Elmasry', 'm.elmasry@hotmail.com', 'password'),
    ('Jeff', 'BCIT', 'j.bcit@hotmail.com', 'password')
    ";

    $db->exec($SQL_insert_data);
}

# retrieve the table from the path
if (isset($request[0])) {
    $table = $request[0];
} else {
    $table = NULL;
}

# retrieve the key from the path
if (isset($request[1])) {
    $key = $request[1];
} else {
    $key = NULL;
}

# get columns & values then construct insert & update
if (isset($input)) {
    // escape the columns and values from the input object
    $columns = preg_replace('/[^a-z0-9_]+/i','',array_keys($input));
    $values = array_map(function ($value) {
      if ($value===null) return null;
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

}

# Get first column name and assume it is PK
$result = $db->query("SELECT * FROM `$table`");
$pk = $result->columnName(0);
 
#===============================================
# Enable CORS
#===============================================
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 1000");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");

# create SQL based on HTTP method
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

# excecute SQL statement
$result = $db->query($sql);
 
# die if SQL statement failed
if (!$result) {
  http_response_code(404);
  die("Error in fetch ".$db->lastErrorMsg());
}

# print results, insert id or affected row count
if ($method == 'GET') {
  header('Content-type:application/json;charset=utf-8');
    $collection = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
      $collection[] = $row;
    }
    if (count($collection) > 1)
      echo json_encode($collection);
    else {
      if (isset($collection[0]))
        echo json_encode($collection[0]);
      else
        http_response_code(404);
    }
} elseif ($method == 'POST') {
  echo $db->lastInsertRowid();
} else {
  echo $db->changes();
}
 
# close SQLite connection
$db->close();

?>