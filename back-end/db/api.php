<?php
#JWT implementation---------------------------------------------------------------------
include_once '../config/jwt_secure.php';
include_once '../config/database.php';
use \Firebase\JWT\JWT;
if ($jwt) {

  try {

      $decoded = JWT::decode($jwt, $secret_key, array('HS256'));

      $databaseService = new DatabaseService();
      $conn = $databaseService->getConnection('');

      define("DEBUG", 0);

      #===============================================
      # get the HTTP method, path and body of the request
      #===============================================
      $method = $_SERVER['REQUEST_METHOD'];
      $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
      $input = json_decode(file_get_contents('php://input'),true);

      #===============================================
      # Create database or open if it already exists
      #===============================================
      $conn = new SQLite3('projectmaestro.db');

      #===============================================
      # Create tables IF NO EXIST
      #===============================================

      $SQL_create_table = [
        "CREATE TABLE IF NOT EXISTS User (
        UserId INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
        UserEmail VARCHAR(80),
        UserFName VARCHAR(80),
        UserLName VARCHAR(80)
      );",
      "CREATE TABLE IF NOT EXISTS Instructor (
        InstructorId VARCHAR(80) NOT NULL PRIMARY KEY,
        UserId INTEGER,
        FOREIGN KEY (UserId) REFERENCES User(UserId)
      );",
      "CREATE TABLE IF NOT EXISTS Course (
        CourseId VARCHAR(80) NOT NULL PRIMARY KEY,
        CourseName VARCHAR(80),
        CourseTerm INTEGER,
        InstructorId VARCHAR(80),
        FOREIGN KEY (InstructorId) REFERENCES Instructor(InstructorId)
      );",
      "CREATE TABLE IF NOT EXISTS CourseList (
        CourseListId INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
        CourseId VARCHAR(80),
        UserId INTEGER,
        FOREIGN KEY (CourseId) REFERENCES Course(CourseId)
        FOREIGN KEY (UserId) REFERENCES User(UserId)
      );",
        "CREATE TABLE IF NOT EXISTS Project (
        ProjectId INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
        ProjectName VARCHAR(80),
        CourseId VARCHAR(80),
        FOREIGN KEY (CourseId) REFERENCES Course(CourseId)
      );",
      "CREATE TABLE IF NOT EXISTS ProjectList (
        ProjectListId INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
        ProjectId INTEGER,
        UserId INTEGER,
        FOREIGN KEY (ProjectId) REFERENCES Project(Project),
        FOREIGN KEY (UserId) REFERENCES User(UserId)
      );",
      "CREATE TABLE IF NOT EXISTS Team (
        TeamId INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
        TeamName VARCHAR(80),
        ProjectId INTEGER,
        FOREIGN KEY (ProjectId) REFERENCES Project(Project)
      );",
      "CREATE TABLE IF NOT EXISTS Goal (
        GoalId INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
        TeamId VARCHAR(80),
        GoalDesc VARCHAR(80),
        GoalStart VARCHAR(80),
        GoalEnd VARCHAR(80),
        FOREIGN KEY (TeamId) REFERENCES Team(TeamId)
      );",
      "CREATE TABLE IF NOT EXISTS Student (
        StudentId VARCHAR(80) NOT NULL PRIMARY KEY,
        UserId INTEGER,
        StudentSet VARCHAR(80),
        FOREIGN KEY (UserId) REFERENCES User(UserId)
      );",
      "CREATE TABLE IF NOT EXISTS TeamMember (
        TeamMemberId INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
        ProjectId INTEGER,
        UserId INTEGER,
        TeamMemberRole VARCHAR(80),
        FOREIGN KEY (UserId) REFERENCES User(UserId)
        FOREIGN KEY (ProjectId) REFERENCES Project(ProjectId)
      );",
      ];

      foreach ($SQL_create_table as $command) {
        $conn->exec($command);
      }

      #===============================================
      # Insert dummy data
      #===============================================

      $rows = $conn->query("SELECT COUNT(*) as count FROM User");
      $row = $rows->fetchArray();
      $numRows = $row['count'];
      if ($row['count'] === 0) {
          $SQL_insert_data = "INSERT INTO User (UserEmail, UserFName, UserLName)
          VALUES 
          ('BobBuilder@gmail.com', 'Bob', 'Builder'),
          ('GalvinKlein@hotmail.com', 'Galvin', 'Klein'),
          ('jeff@my.bcit.ca', 'Jeff', 'BCIT'),
          ('MedhatE@my.bcit.ca', 'Medhat', 'Elmasry')
          ";
          $conn->exec($SQL_insert_data);
      }

      $rows = $conn->query("SELECT COUNT(*) as count FROM Project");
      $row = $rows->fetchArray();
      $numRows = $row['count'];
      if ($row['count'] === 0) {
          $SQL_insert_data = "INSERT INTO Project (ProjectName, CourseId)
          VALUES 
          ('Project Maestro', 'COMP3975'),
          ('Hello Fresh', 'COMP3522')
          ";
          $conn->exec($SQL_insert_data);
      }

      $rows = $conn->query("SELECT COUNT(*) as count FROM ProjectList");
      $row = $rows->fetchArray();
      $numRows = $row['count'];
      if ($row['count'] === 0) {
          $SQL_insert_data = "INSERT INTO ProjectList (ProjectId, UserId)
          VALUES 
          ('1', '1'),
          ('2', '2')
          ";
          $conn->exec($SQL_insert_data);
      }

      $rows = $conn->query("SELECT COUNT(*) as count FROM Instructor");
      $row = $rows->fetchArray();
      $numRows = $row['count'];
      if ($row['count'] === 0) {
          $SQL_insert_data = "INSERT INTO Instructor (InstructorId, UserId)
          VALUES 
          ('A08888', '3'),
          ('A07777', '4')
          ";
          $conn->exec($SQL_insert_data);
      }

      $rows = $conn->query("SELECT COUNT(*) as count FROM Student");
      $row = $rows->fetchArray();
      $numRows = $row['count'];
      if ($row['count'] === 0) {
          $SQL_insert_data = "INSERT INTO Student (StudentId, UserId, StudentSet)
          VALUES 
          ('A011293','1', 'S'),
          ('A011111','2', 'M')
          ";
          $conn->exec($SQL_insert_data);
      }

      $rows = $conn->query("SELECT COUNT(*) as count FROM Course");
      $row = $rows->fetchArray();
      $numRows = $row['count'];
      if ($row['count'] === 0) {
          $SQL_insert_data = "INSERT INTO Course (CourseId, CourseName, CourseTerm, InstructorId)
          VALUES 
          ('COMP3975', 'Web/Mobile', '3', 'A08888'),
          ('COMP3522', 'Python', '3', 'A07777')
          ";
          $conn->exec($SQL_insert_data);
      }

      $rows = $conn->query("SELECT COUNT(*) as count FROM CourseList");
      $row = $rows->fetchArray();
      $numRows = $row['count'];
      if ($row['count'] === 0) {
          $SQL_insert_data = "INSERT INTO CourseList (CourseId, UserId)
          VALUES 
          ('COMP3975', '1'),
          ('COMP3522', '2')
          ";
          $conn->exec($SQL_insert_data);
      }

      $rows = $conn->query("SELECT COUNT(*) as count FROM Team");
      $row = $rows->fetchArray();
      $numRows = $row['count'];
      if ($row['count'] === 0) {
          $SQL_insert_data = "INSERT INTO Team (TeamName, ProjectId)
          VALUES 
          ('Team Maestro', '1'),
          ('Team Alpha', '2')
          ";
          $conn->exec($SQL_insert_data);
      }

      $rows = $conn->query("SELECT COUNT(*) as count FROM TeamMember");
      $row = $rows->fetchArray();
      $numRows = $row['count'];
      if ($row['count'] === 0) {
          $SQL_insert_data = "INSERT INTO TeamMember (ProjectId, UserId, TeamMemberRole)
          VALUES 
          ('1', '1', 'Coder'),
          ('1', '2', 'Admin')
          ";
          $conn->exec($SQL_insert_data);
      }

      $rows = $conn->query("SELECT COUNT(*) as count FROM Goal");
      $row = $rows->fetchArray();
      $numRows = $row['count'];
      if ($row['count'] === 0) {
          $SQL_insert_data = "INSERT INTO Goal (TeamId, GoalDesc, GoalStart, GoalEnd)
          VALUES 
          ('1', 'Code Rest API backend for front end team', '2021-03-20', '2021-03-22'),
          ('2', 'Code UI for Hello Fresh', '2019-12-23', '2020-01-03')
          ";
          $conn->exec($SQL_insert_data);
      }
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
          $sql = "SELECT * FROM `$table`".($key? " WHERE $pk='$key'":''); 
          break;
        case 'PUT':
          $sql = "UPDATE `$table` SET $updateSet WHERE $pk='$key'"; 
          break;
        case 'POST':
          $sql = "INSERT INTO `$table` ($insertSet) VALUES ($insertVal)"; 
          break;
        case 'DELETE':
          $sql = "DELETE FROM `$table` WHERE $pk='$key'"; 
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

      
  } catch (Exception $e) {

    http_response_code(401);

    echo json_encode(array(
        "message" => "Access denied.",
        "error" => $e->getMessage()
    ));
  }
}
#_______________________________________________________________________________________

?>