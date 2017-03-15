<?php
    require_once "../DB/Database.php";
    require_once "../interfaces/IStudent.php";

    class Student implements IStudent
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
                    $query = "SELECT * FROM student";
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

        public function getStudent($id)
        {
            try {
                $query = "SELECT * FROM student WHERE id = ?";
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

        public function getAppointment($id)
        {
            try {
                $query = 'SELECT schedule.begin_hour AS "Start", schedule.end_hour AS "End", 
                teacher.name AS "Teacher", subject.name as "Subject", appointment.topic as "Topic", appointment.day as "Day" 
                from appointment 
                inner join schedule on (appointment.schedule = schedule.id) 
                inner join teacher on (appointment.teacher = teacher.id) 
                inner join subject on (appointment.subject = subject.id)
                where appointment.student = ?';
                $q = $this->connection->prepare($query);
                $q->bindParam(1, $id, PDO::PARAM_INT);
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