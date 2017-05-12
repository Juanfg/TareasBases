<?php
    require_once('../db/database.php');

    class Team
    {
        private $connection;
        
        public function __construct(database $db)
        {
            $this->connection = new $db;
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
    }
?>
