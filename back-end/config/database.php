<?php
// used to get database connection
class DatabaseService {
  private $connection;

  public function getConnection($path) {
    $app_config = '../appconfig.ini';
    $ini = parse_ini_file($app_config);
    $db_name = $path . $ini['db_name'];  // create jwt-userdb.db in db folder

    $this->connection = null;

    try {
      $this->connection = new PDO("sqlite:$db_name");
    } catch (PDOExecption $Execption) {
      echo "Connection failed: " . $exception->getMessage();
    }

    return $this->connection;
  }
}
?>