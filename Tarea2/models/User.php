<?php
    require_once "../DB/Database.php";
    require_once "../interfaces/IUsers.php";

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
                $query = "SELECT * FROM users";
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
