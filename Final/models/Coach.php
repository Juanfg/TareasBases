<?php
    require_once('../db/database.php');
    require_once('../interfaces/ICoaches.php');

    class Coach implements ICoaches
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
                $query = $this->connection->prepare('INSERT INTO coaches (name, team_id, user_id) values (?,?,?)');
                $query->bindParam(1, $this->name, PDO::PARAM_STR);
                $query->bindParam(2, $this->team_id, PDO::PARAM_INT);
                $query->bindParam(3, $this->user_id, PDO::PARAM_INT);
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
                $query = "SELECT * FROM coaches";
                $q = $this->connection->prepare($query);
                $q->execute();
                $this->connection->close();
                return $q->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function getCoach($id)
        {
            try {
                $query = "SELECT * FROM coaches WHERE id = ?";
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

        public function getTeam($team_id) {
            try{
                $query = $this->connection->prepare('SELECT players.id, players.name, users.email 
                FROM players 
                INNER JOIN users ON (players.user_id = users.id)
                WHERE players.team_id = ?');
                $query->bindParam(1, $team_id, PDO::PARAM_INT);
                $query->execute();

                $this->connection->close();
                return $query->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e) {
                echo  $e->getMessage();
            }
        }

    }
?>
