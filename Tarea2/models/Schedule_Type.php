<?php
    require_once "../DB/Database.php";
    require_once "../interfaces/ISchedule_Type.php";

    class Schedule_Type implements ISchedule_Type
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
                $query = "SELECT * FROM schedule_type";
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