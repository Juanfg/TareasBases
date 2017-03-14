<?php
    require_once "../DB/Database.php";
    require_once "../interfaces/ITeacher.php";

    class Teacher implements ITeacher
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
                if(empty($this->id))
                {
                    $query = "SELECT * FROM teacher";
                    $q = $this->connection->prepare($query);
                    $q->execute();
                    $this->connection->close();
                    return $q->fetchAll(PDO::FETCH_OBJ);
                }
                else
                {

                }
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>