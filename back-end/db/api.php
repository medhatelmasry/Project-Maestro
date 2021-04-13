<?php
#JWT implementation---------------------------------------------------------------------
include_once '../config/jwt_secure.php';
include_once '../config/database.php';
include_once 'inc_db_helper.php';
use \Firebase\JWT\JWT;
if ($jwt) {
  try {
      $decoded = JWT::decode($jwt, $secret_key, array('HS256'));

      define("DEBUG", 0);

      #===============================================
      # get the HTTP method, path and body of the request
      #===============================================
      $method = $_SERVER['REQUEST_METHOD'];
      $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
      $input = json_decode(file_get_contents('php://input'),true);

      # The path should be:
      # $request[0]/$request[1]/$request[2]
      # Table/Column/Value
      # $table/$pk/$key
      
      #===============================================
      # Create database or open if it already exists
      #===============================================
      $databaseHelper = new DatabaseHelper('projectmaestro.db');
      $conn = $databaseHelper -> getConn();

      #===============================================
      # Insert dummy data
      #===============================================
      $databaseHelper -> insertDummyData();
      

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
      if (isset($request[2])) {
          $key = $request[2];
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
      $insertSet = '';
      $insertVal='';
      $updateSet = '';
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
      
      if ($method == "GET") {
        if (count($request) > 1) {
          $pk = $request[1];
        }
      }

      $sql = $databaseHelper -> getCommandByMethod($method, $table, $key, $pk, $updateSet, $insertSet, $insertVal);
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
      $databaseHelper -> close();

      
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