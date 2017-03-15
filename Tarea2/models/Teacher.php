<?php
    require_once "../DB/Database.php";
    require_once "../interfaces/ITeacher.php";

    class Teacher implements ITeacher
    {
        private $connection;

        public function __construct(Database $db)
        {
            $this->connection = new $db;
        }

        public function get()
        {
            try {
                $query = "SELECT * FROM teacher";
                $q = $this->connection->prepare($query);
                $q->execute();
                $this->connection->close();
                return $q->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function getTeacher($id)
        {
            try {
                $query = "SELECT * FROM teacher WHERE id = ?";
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