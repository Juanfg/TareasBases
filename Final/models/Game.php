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
    }
?>
