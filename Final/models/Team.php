<?php
    require_once('../db/database.php');

    class Team
    {
        private $connection;
        private $id;
        private $name;

        public function setId($id)
        {
            $this->id = $id;
        }


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

        public function getTeam($id)
        {
            try {
                $query = "SELECT * FROM teams WHERE id = ?";
                $result = $this->connection->prepare($query);
                $result->bindParam(1, $id, PDO::PARAM_INT);
                $result->execute();
                $this->connection->close();
                return $result->fetch(PDO::FETCH_OBJ);
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

        public function getSpecific($team_id)
        {
            try {
                $query = $this->connection->prepare('SELECT name FROM teams WHERE id = (?) LIMIT 1');
                $query->bindParam(1, $team_id, PDO::PARAM_STR);
                $query->execute();
                $this->connection->close();
                return $query->fetchAll(PDO::FETCH_OBJ);                
            }
            catch(PDOException $e){
                echo $e->getMessage();

        public function updateName($id, $name) {
            try{
                $query = $this->connection->prepare('UPDATE teams SET name = ? WHERE id = ?');
                $query->bindParam(1, $name, PDO::PARAM_STR);
                $query->bindParam(2, $id, PDO::PARAM_INT);
                $query->execute();

                $this->connection->close();
            }
            catch(PDOException $e) {
                echo  $e->getMessage();
            }
        }

        public function destroy() {
            try{

                $query = $this->connection->prepare('DELETE FROM teams WHERE id = ?');
                $query->bindParam(1, $this->id, PDO::PARAM_STR);
                $query->execute();

                $this->connection->close();
            }
            catch(PDOException $e) {
                echo  $e->getMessage();
            }
        }
    }
?>
