<?php
    require_once('../db/database.php');

    class Player
    {
        private $connection;
        private $id;
        private $name;
        private $team_id;
        private $user_id;

        public function setId($id)
        {
            $this->id = $id;
        }

        public function setName($name){
            $this->name = $name;
        }

        public function setTeam($team_id){
            $this->team_id = $team_id;
        }

        public function setUser($user_id){
            $this->user_id = $user_id;
        }

        public function __construct(database $db)
        {
            $this->connection = new $db;
        }

        public function save() {
            try{
                $query = $this->connection->prepare('INSERT INTO players (name, user_id, team_id) values (?,?,?)');
                $query->bindParam(1, $this->name, PDO::PARAM_STR);
                $query->bindParam(2, $this->user_id, PDO::PARAM_INT);
                $query->bindParam(3, $this->team_id, PDO::PARAM_INT);
                $query->execute();

                $this->connection->close();
            }
            catch(PDOException $e) {
                echo  $e->getMessage();
            }
        }

        public function destroy() {
            try{

                $query = $this->connection->prepare('DELETE FROM players WHERE id = ?');
                $query->bindParam(1, $this->id, PDO::PARAM_STR);
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
                $query = "SELECT * FROM players";
                $q = $this->connection->prepare($query);
                $q->execute();
                $this->connection->close();
                return $q->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function getPlayer($id)
        {
            try {
                $query = "SELECT * FROM players WHERE id = ?";
                $q = $this->connection->prepare($query);
                $q->bindParam(1, $id, PDO::PARAM_INT);
                $q->execute();
                $this->connection->close();
                return $q->fetch(PDO::FETCH_OBJ);
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function updateName()
        {
            try {
                $query = "UPDATE players SET name = ? WHERE id = ?";
                $query = $this->connection->prepare($query);
                $query->bindParam(1, $this->name, PDO::PARAM_STR);
                $query->bindParam(2, $this->id, PDO::PARAM_INT);
                $query->execute();
                $this->connection->close();
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }


        public function team() {
            try{
                $query = $this->connection->prepare('UPDATE players SET team_id = ? WHERE id = ?');
                $query->bindParam(1, $this->team_id, PDO::PARAM_INT);
                $query->bindParam(2, $this->id, PDO::PARAM_INT);
                $query->execute();

                $this->connection->close();
            }
            catch(PDOException $e) {
                echo  $e->getMessage();
            }
        }

    }
?>
