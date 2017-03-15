<?php
    require_once "../DB/Database.php";
    require_once "../interfaces/IDay.php";

    class Day implements IDay
    {
        private $connection;
        private $id;

        public function __construct(Database $db)
        {
            $this->connection = new $db;
        }

        public function setId($id)
        {
            $this->id = $id;
        }

        public function get()
        {
            try {
                $query = "SELECT * FROM subject";
                $q = $this->connection->prepare($query);
                $q->execute();
                $this->connection->close();
                return $q->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>