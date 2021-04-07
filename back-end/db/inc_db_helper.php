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
            
            // Array of SQL commands to create the tables if they do not exist 
            // already
            $sqlCreateTable = [
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
    
            foreach ($sqlCreateTable as $command) {
                // For each command in the array
                $this->conn->exec($command);
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
                $SQL_insert_data = "INSERT INTO User (UserEmail, UserFName, UserLName)
                VALUES 
                    ('BobBuilder@gmail.com', 'Bob', 'Builder'),
                    ('GalvinKlein@hotmail.com', 'Galvin', 'Klein'),
                    ('jeff@my.bcit.ca', 'Jeff', 'BCIT'),
                    ('MedhatE@my.bcit.ca', 'Medhat', 'Elmasry')
                ";
                $this->conn->exec($SQL_insert_data);
            }

            $rows = $this->conn->query("SELECT COUNT(*) as count FROM Project");
            $row = $rows->fetchArray();
            $numRows = $row['count'];
            if ($row['count'] === 0) {
                $SQL_insert_data = "INSERT INTO Project (ProjectName, CourseId)
                VALUES 
                ('Project Maestro', 'COMP3975'),
                ('Hello Fresh', 'COMP3522')
                ";
                $this->conn->exec($SQL_insert_data);
            }

            $rows = $this->conn->query("SELECT COUNT(*) as count FROM ProjectList");
            $row = $rows->fetchArray();
            $numRows = $row['count'];
            if ($row['count'] === 0) {
                $SQL_insert_data = "INSERT INTO ProjectList (ProjectId, UserId)
                VALUES 
                ('1', '1'),
                ('2', '2')
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
                $SQL_insert_data = "INSERT INTO Course (CourseId, CourseName, CourseTerm, InstructorId)
                VALUES 
                ('COMP3975', 'Web/Mobile', '3', 'A08888'),
                ('COMP3522', 'Python', '3', 'A07777')
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

            $rows = $this->conn->query("SELECT COUNT(*) as count FROM Team");
            $row = $rows->fetchArray();
            $numRows = $row['count'];
            if ($row['count'] === 0) {
                $SQL_insert_data = "INSERT INTO Team (TeamName, ProjectId)
                VALUES 
                ('Team Maestro', '1'),
                ('Team Alpha', '2')
                ";
                $this->conn->exec($SQL_insert_data);
            }

            $rows = $this->conn->query("SELECT COUNT(*) as count FROM TeamMember");
            $row = $rows->fetchArray();
            $numRows = $row['count'];
            if ($row['count'] === 0) {
                $SQL_insert_data = "INSERT INTO TeamMember (ProjectId, UserId, TeamMemberRole)
                VALUES 
                ('1', '1', 'Coder'),
                ('1', '2', 'Admin')
                ";
                $this->conn->exec($SQL_insert_data);
            }

            $rows = $this->conn->query("SELECT COUNT(*) as count FROM Goal");
            $row = $rows->fetchArray();
            $numRows = $row['count'];
            if ($row['count'] === 0) {
                $SQL_insert_data = "INSERT INTO Goal (TeamId, GoalDesc, GoalStart, GoalEnd)
                VALUES 
                ('1', 'Code Rest API backend for front end team', '2021-03-20', '2021-03-22'),
                ('2', 'Code UI for Hello Fresh', '2019-12-23', '2020-01-03')
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
            $this->conn->exec($sql);
        }

             /**
         * Get data from the database.
         * @param $table insert to which table
         * @param $key
         */
        public function getExists($table, $pk, $key) {
            $sql = "SELECT EXISTS(SELECT 1 FROM '$table' WHERE $pk='$key')";
            $this->conn->exec($sql);
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