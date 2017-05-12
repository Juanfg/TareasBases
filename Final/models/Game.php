<?php
    require_once('../db/database.php');

    class Game
    {
        private $connection;
        private $id;
        private $local_id;
        private $visitor_id;
        private $local_goals;
        private $visitor_goals;
        private $active;
        private $date;
        private $field;
        
        public function __construct(database $db)
        {
            $this->connection = new $db;
        }

        public function setLocal($local_id)
        {
            $this->local_id = $local_id;
        }

        public function setVisitor($visitor_id)
        {
            $this->visitor_id = $visitor_id;
        }

        public function setLocalGoals($local_goals)
        {
            
        }

        public function setVisitorGoals($visitor_goals)
        {
            $this->visitor_goals = $visitor_goals;
        }

        public function setActive($active)
        {
            $this->active = $active;
        }

        public function setDate($date)
        {
            $this->date = $date;
        }

        public function setField($field_id)
        {
            $this->field = $field_id;
        }

        public function save()
        {
            try{
                $query = $this->connection->prepare('INSERT INTO games (local_id, visitor_id, date, field_id) values (?,?,?,?)');
                $query->bindParam(1, $this->local_id, PDO::PARAM_STR);
                $query->bindParam(2, $this->visitor_id, PDO::PARAM_STR);
                $query->bindParam(3, $this->date, PDO::PARAM_STR);
                $query->bindParam(4, $this->field, PDO::PARAM_INT);
                $query->execute();

                $this->connection->close();
            }
            catch(PDOException $e) {
                echo  $e->getMessage();
            }
        }

        public function saveGoals($local_goals, $visitor_goals, $game_id)
        {
            try{
                $query = $this->connection->prepare('UPDATE games SET local_goals = ?, visitor_goals = ?, active = true WHERE id = ?');
                $query->bindParam(1, $local_goals, PDO::PARAM_STR);
                $query->bindParam(2, $visitor_goals, PDO::PARAM_STR);
                $query->bindParam(3, $game_id, PDO::PARAM_STR);
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
                $query = "SELECT * FROM games";
                $result = $this->connection->prepare($query);
                $result->execute();
                $this->connection->close();
                return $result->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function getGame($id)
        {
            try {
                $query = "SELECT * FROM games WHERE id = ?";
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
    }
?>
