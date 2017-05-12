<?php
    require_once('../db/database.php');

    class Team
    {
        private $connection;
        private $name;

        public function setName($name){
            $this->name = $name;
        }
        
        public function __construct(database $db)
        {
            $this->connection = new $db;
        }

        public function save() {
            try{
                $query = $this->connection->prepare('INSERT INTO teams (name) values (?)');
                $query->bindParam(1, $this->name, PDO::PARAM_STR);
                $query->execute();

                $this->connection->close();
            }
            catch(PDOException $e) {
                echo  $e->getMessage();
            }
        }

        public function get()
        {
            try {
                $query = "SELECT * FROM teams";
                $result = $this->connection->prepare($query);
                $result->execute();
                $this->connection->close();
                return $result->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function getLast()
        {
            try {
                $query = "SELECT * FROM teams ORDER BY id DESC LIMIT 1";
                $result = $this->connection->prepare($query);
                $result->execute();
                $this->connection->close();
                return $result->fetch(PDO::FETCH_OBJ);
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function getWithCoach()
        {
            try {
                $query = 'SELECT teams.id, teams.name, coaches.name as "coach" 
                FROM teams
                INNER JOIN coaches ON (coaches.team_id = teams.id)';
                $result = $this->connection->prepare($query);
                $result->execute();
                $this->connection->close();
                return $result->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>
