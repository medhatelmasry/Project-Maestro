<?php
    class DatabaseHelper {
        
        /** The SQLite3 database connection object */
        protected $conn;

        /**
         * Constructor that initializes the SQLite3 database connection object
         * and creates the tables if they do not exist.
         * @param $dbPath the path where the database file exists or will be 
         *                created at
         */
        public function __construct($dbPath) {
            $this->conn = new SQLite3($dbPath);

            $this->conn->busyTimeout(5000);
            // WAL mode has better control over concurrency.
            // Source: https://www.sqlite.org/wal.html
            $this->conn->exec('PRAGMA journal_mode = wal');
            
            // Array of SQL commands to create the tables if they do not exist 
            // already
            $sqlCreateTable = [
                "CREATE TABLE IF NOT EXISTS User (
                    UserId INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
                    UserEmail VARCHAR(80),
                    UserFName VARCHAR(80),
                    UserLName VARCHAR(80),
                    UserPassword VARCHAR(255)
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
                    UserId INTEGER,
                    FOREIGN KEY (UserId) REFERENCES User(UserId)
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
                    ProjectDesc VARCHAR(255),
                    ProjectOutlineId VARCHAR(80),
                    FOREIGN KEY (ProjectOutlineId) REFERENCES ProjectOutline(ProjectOutlineId)
                );",
                "CREATE TABLE IF NOT EXISTS Goal (
                    GoalId INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
                    ProjectId VARCHAR(80),
                    GoalDesc VARCHAR(80),
                    GoalStart VARCHAR(80),
                    GoalEnd VARCHAR(80),
                    FOREIGN KEY (ProjectId) REFERENCES Project(ProjectId)
                );",
                "CREATE TABLE IF NOT EXISTS Student (
                    StudentId VARCHAR(80) NOT NULL PRIMARY KEY,
                    UserId INTEGER,
                    StudentSet VARCHAR(80),
                    FOREIGN KEY (UserId) REFERENCES User(UserId)
                );",
                "CREATE TABLE IF NOT EXISTS ProjectMember (
                    ProjectMemberId INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
                    ProjectId INTEGER,
                    UserId INTEGER,
                    FOREIGN KEY (UserId) REFERENCES User(UserId)
                    FOREIGN KEY (ProjectId) REFERENCES Project(ProjectId)
                );",
                "CREATE TABLE IF NOT EXISTS ProjectOutline (
                    ProjectOutlineId INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
                    CourseId VARCHAR(80),
                    ProjectOutlineName VARCHAR(255),
                    ProjectOutlineReq VARCHAR(80),
                    ProjectOutlineStart VARCHAR(80),
                    ProjectOutlineEnd VARCHAR(80),
                    FOREIGN KEY (CourseId) REFERENCES Course(CourseId)
                );",
            ];
    
            foreach ($sqlCreateTable as $command) {
                // For each command in the array
                $this->conn->exec($command);
            }

            $this->addUserPasswordColumn();
        }

        /**
         * Adds the UserPassword column to the User table if it does not 
         * already exist.
         */
        private function addUserPasswordColumn() {
            $colExists = FALSE;

            $res = $this->conn->query("PRAGMA table_info(User);");

            while ($col = $res->fetchArray(SQLITE3_ASSOC)) {
                if (strcmp($col['name'], "UserPassword") == 0) {
                    // If the column 'UserPassword' exists
                    $colExists = TRUE;
                }
            }

            if (!$colExists) {
                $sql = "ALTER TABLE User ADD COLUMN UserPassword VARCHAR(255);";

                $this->conn->exec($sql);
            }
        }

        /**
         * Inserts dummy data into the database.
         */
        public function insertDummyData() {
            $rows = $this->conn->query("SELECT COUNT(*) as count FROM User");
            $row = $rows->fetchArray();
            $numRows = $row['count'];
            if ($row['count'] === 0) {
                $password1 = password_hash('password1', PASSWORD_BCRYPT);
                $password2 = password_hash('password2', PASSWORD_BCRYPT);
                $password3 = password_hash('password3', PASSWORD_BCRYPT);
                $password4 = password_hash('password4', PASSWORD_BCRYPT);
    
                $SQL_insert_data = "INSERT INTO User (UserEmail, UserFName, UserLName, UserPassword)
                VALUES 
                    ('BobBuilder@gmail.com', 'Bob', 'Builder', '$password1'),
                    ('GalvinKlein@hotmail.com', 'Galvin', 'Klein', '$password2'),
                    ('MedhatE@my.bcit.ca', 'Medhat', 'Elmasry', '$password3'),
                    ('jeff@my.bcit.ca', 'Jeff', 'BCIT', '$password4')
                ";
                $this->conn->exec($SQL_insert_data);
            }

            $rows = $this->conn->query("SELECT COUNT(*) as count FROM Project");
            $row = $rows->fetchArray();
            $numRows = $row['count'];
            if ($row['count'] === 0) {
                $SQL_insert_data = "INSERT INTO Project (ProjectName, ProjectDesc, ProjectOutlineId)
                VALUES 
                ('Project Maestro', 'Project desc 1', '1'),
                ('Hello Fresh', 'Project desc 2', '2'),
                ('FAM', 'Project desc 3', '3')
                ";
                $this->conn->exec($SQL_insert_data);
            }

            $rows = $this->conn->query("SELECT COUNT(*) as count FROM Instructor");
            $row = $rows->fetchArray();
            $numRows = $row['count'];
            if ($row['count'] === 0) {
                $SQL_insert_data = "INSERT INTO Instructor (InstructorId, UserId)
                VALUES 
                ('A08888', '3'),
                ('A07777', '4')
                ";
                $this->conn->exec($SQL_insert_data);
            }

            $rows = $this->conn->query("SELECT COUNT(*) as count FROM Student");
            $row = $rows->fetchArray();
            $numRows = $row['count'];
            if ($row['count'] === 0) {
                $SQL_insert_data = "INSERT INTO Student (StudentId, UserId, StudentSet)
                VALUES 
                ('A011293','1', 'S'),
                ('A011111','2', 'M')
                ";
                $this->conn->exec($SQL_insert_data);
            }

            $rows = $this->conn->query("SELECT COUNT(*) as count FROM Course");
            $row = $rows->fetchArray();
            $numRows = $row['count'];
            if ($row['count'] === 0) {
                $SQL_insert_data = "INSERT INTO Course (CourseId, CourseName, CourseTerm, UserId)
                VALUES 
                ('COMP3975', 'Web/Mobile', '3', '3'),
                ('COMP3522', 'Python', '3', '4')
                ";
                $this->conn->exec($SQL_insert_data);
            }

            $rows = $this->conn->query("SELECT COUNT(*) as count FROM CourseList");
            $row = $rows->fetchArray();
            $numRows = $row['count'];
            if ($row['count'] === 0) {
                $SQL_insert_data = "INSERT INTO CourseList (CourseId, UserId)
                VALUES 
                ('COMP3975', '1'),
                ('COMP3522', '2')
                ";
                $this->conn->exec($SQL_insert_data);
            }

            $rows = $this->conn->query("SELECT COUNT(*) as count FROM ProjectMember");
            $row = $rows->fetchArray();
            $numRows = $row['count'];
            if ($row['count'] === 0) {
                $SQL_insert_data = "INSERT INTO ProjectMember (ProjectId, UserId)
                VALUES 
                ('1', '1'),
                ('2', '2')
                ";
                $this->conn->exec($SQL_insert_data);
            }

            $rows = $this->conn->query("SELECT COUNT(*) as count FROM Goal");
            $row = $rows->fetchArray();
            $numRows = $row['count'];
            if ($row['count'] === 0) {
                $SQL_insert_data = "INSERT INTO Goal (ProjectId, GoalDesc, GoalStart, GoalEnd)
                VALUES 
                ('1', 'Code Rest API backend for front end team', '2021-03-20', '2021-03-22'),
                ('2', 'Code UI for Hello Fresh', '2019-12-23', '2020-01-03'),
                ('3', 'Code UI for FAM', '2019-12-23', '2020-01-03')
                ";
                $this->conn->exec($SQL_insert_data);
            }

            $rows = $this->conn->query("SELECT COUNT(*) as count FROM ProjectOutline");
            $row = $rows->fetchArray();
            $numRows = $row['count'];
            if ($row['count'] === 0) {
                $SQL_insert_data = "INSERT INTO ProjectOutline (CourseId, ProjectOutlineName, ProjectOutlineReq, ProjectOutlineStart, ProjectOutlineEnd)
                VALUES
                ('COMP3975', 'Assignment 1', 'Create a system that registers users to a project', '2021-03-18', '2021-04-21'),
                ('COMP3975', 'Assignment 2', 'Build a website with React.js and PHP', '2021-03-20', '2021-04-17'),
                ('COMP3522', 'Assignment 1', 'Create FAM using OOP principles', '2021-03-20', '2021-04-17')
                ";
                $this->conn->exec($SQL_insert_data);
            }
        }

        /**
         * Returns the SQL command based on the HTTP method.
         * @param $method the HTTP method
         * @return String SQL command
         */
        public function getCommandByMethod($method, $table, $key, $pk, $updateSet, $insertSet, $insertVal) {
            // echo "method: " . $method . "\n";
            // echo "table: " . $table . "\n";
            // echo "key: " . $key . "\n";
            // echo "pk: " . $pk . "\n";
            // echo "updateSet: " . $updateSet . "\n";
            // echo "insertSet: " . $insertSet . "\n";
            // echo "insertVal: " . $insertVal . "\n";
            switch ($method) {
                case 'GET':
                    $sql = "SELECT * FROM $table WHERE $pk = '$key'";

                    if ($key == '') {
                        $sql = "SELECT * FROM $table";
                    }
                    break;
                case 'PUT':
                    $sql = "UPDATE $table SET $updateSet WHERE $pk='$key'"; 
                    break;
                case 'POST':
                    $sql = "INSERT INTO $table ($insertSet) VALUES ($insertVal)"; 
                    break;
                case 'DELETE':
                    $sql = "DELETE FROM $table WHERE $pk='$key'"; 
                    break;
            }

            return $sql;
        }

        /**
         * Returns the SQLite3 database connection object
         * @return SQLite3 the SQLite3 database connection object
         */
        public function getConn() {
            return $this->conn;
        }

        /**
         * Get data from the database.
         * @param $table insert to which table
         * @param $key
         */
        public function getData($table, $pk, $key) {
            $sql = "SELECT * FROM `$table`".($key? " WHERE $pk='$key'":''); 
            return $this->conn->query($sql);
        }

        /**
         * Get data from the database.
         * @param $table insert to which table
         * @param $key
         */
        public function getExists($table, $pk, $key) {
            $sql = "SELECT EXISTS(SELECT 1 FROM '$table' WHERE $pk='$key')";
            return $this->conn->query($sql);
        }

        /**
         * Delete data in the database.
         * @param $table insert to which table
         * @param $key
         */
        public function deleteData($table, $pk, $key) {
            $sql = "DELETE FROM `$table` WHERE $pk='$key'"; 
            $this->conn->exec($sql);
        }

        /**
         * Inserts data into the database.
         * @param $table insert to which table
         * @param $insertSet 
         * @param $insertVal inserting values
         */
        public function insertData($table, $insertSet, $insertVal) {
            $sql = "INSERT INTO `$table` ($insertSet) VALUES ($insertVal)"; 
            $this->conn->exec($sql);
        }

        /**
         * Update data in the database.
         * @param $table insert to which table
         * @param $updateSet 
         * @param $key
         */
        public function updateData($table, $updateSet, $pk, $key) {
            $sql = "UPDATE `$table` SET $updateSet WHERE $pk='$key'"; 
            $this->conn->exec($sql);
        }
        
        /**
         * Create table into database if not exist 
         * @param $table insert to which table
         */
        public function createTable($table, $insertSet) {
            $sql = "CREATE TABLE IF NOT EXISTS `$table` ($insertSet);"; 
            $this->conn->exec($sql);
        }
        
        /**
         * Explicitely close the SQLite3 database connection.
         */
        public function close() {
            $this->conn->close();
        }
    }
    
?>