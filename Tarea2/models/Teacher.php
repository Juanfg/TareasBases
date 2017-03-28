<?php
    require_once "../DB/Database.php";
    require_once "../interfaces/ITeacher.php";

    class Teacher implements ITeacher
    {
        private $connection;
        private $id;

        private $name;
        private $lastname;
        private $user_id;

        public function setName($name){
            $this->name = $name;
        }

        public function setLastname($lastname){
            $this->lastname = $lastname;
        }

        public function setUser($user_id){
            $this->user_id = $user_id;
        }

        public function __construct(Database $db)
        {
            $this->connection = new $db;
        }

        public function setId($id)
        {
            $this->id = $id;
        }

        public function save() {
            try{
                $query = $this->connection->prepare('INSERT INTO teacher (name, last_name, "user") values (?,?,?)');
                $query->bindParam(1, $this->name, PDO::PARAM_STR);
                $query->bindParam(2, $this->lastname, PDO::PARAM_STR);
                $query->bindParam(3, $this->user_id, PDO::PARAM_INT);
                $query->execute();

                $this->connection->close();
            }
            catch(PDOException $e) {
                echo  $e->getMessage();
            }
        }

        public function update() {
            try{
                $query = $this->connection->prepare('UPDATE teacher SET name = ? , last_name = ? WHERE id = ?');
                $query->bindParam(1, $this->name, PDO::PARAM_STR);
                $query->bindParam(2, $this->lastname, PDO::PARAM_STR);
                $query->bindParam(3, $this->id, PDO::PARAM_INT);
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

        public function schedules($id)
        {
            try {
                $query = 'SELECT * FROM view_schedule_id WHERE "Id" = ?';
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

        public function schedulesAvaliable($id)
        {
            try {
                $query = 'SELECT * FROM view_schedule_avaliable WHERE "Teacher" = ?';
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

        public function getAppointmentMonth($id)
        {
            try {
                $query = 'SELECT schedule.begin_hour AS "Start", schedule.end_hour AS "End", 
                student.name AS "Student", subject.name as "Subject", appointment.topic as "Topic", appointment.day as "Day" 
                from appointment 
                inner join schedule on (appointment.schedule = schedule.id) 
                inner join student on (appointment.student = student.id) 
                inner join subject on (appointment.subject = subject.id)
                where appointment.teacher = ? and extract(month from now()) = extract(month from appointment.day)';
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

        public function getAppointmentInterval($id, $start, $end)
        {
            try {
                $query = 'SELECT schedule.begin_hour AS "Start", schedule.end_hour AS "End", 
                student.name AS "Student", subject.name as "Subject", appointment.topic as "Topic", appointment.day as "Day" 
                from appointment 
                inner join schedule on (appointment.schedule = schedule.id) 
                inner join student on (appointment.student = student.id) 
                inner join subject on (appointment.subject = subject.id)
                where appointment.teacher = ? and appointment.day > ? and appointment.day < ?';
                $q = $this->connection->prepare($query);
                $q->bindParam(1, $id, PDO::PARAM_INT);
                $q->bindParam(2, $start, PDO::PARAM_STR);
                $q->bindParam(3, $end, PDO::PARAM_STR);
                $q->execute();
                $this->connection->close();
                return $q->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function getAppointmentWeek($id)
        {
            try {
                $query = 'SELECT schedule.begin_hour AS "Start", schedule.end_hour AS "End", 
                student.name AS "Student", subject.name as "Subject", appointment.topic as "Topic", appointment.day as "Day" 
                from appointment 
                inner join schedule on (appointment.schedule = schedule.id) 
                inner join student on (appointment.student = student.id) 
                inner join subject on (appointment.subject = subject.id)
                where appointment.teacher = ? and extract(week from now()) = extract(week from appointment.day)';
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
