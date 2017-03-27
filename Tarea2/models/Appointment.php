<?php
    require_once("../DB/Database.php");
    require_once("../interfaces/IAppointment.php");

    class Appointment implements IAppointment {
        private $con;
        private $student;
        private $schedule;
        private $teacher;
        private $subject;
        private $topic;
        private $day;

        public function __construct(Database $db){
            $this->con = new $db;
        }

        public function setStudent($student){
            $this->student = $student;
        }
        public function setSchedule($schedule){
            $this->schedule = $schedule;
        }

        public function setTeacher($teacher){
            $this->teacher = $teacher;
        }

        public function setSubject($subject){
            $this->subject = $subject;
        }

        public function setTopic($topic){
            $this->topic = $topic;
        }

        public function setDay($day){
            $this->day = $day;
        }


        //insertamos usuarios en una tabla con postgreSql
        public function save() {
            try{
                $query = $this->con->prepare('INSERT INTO appointment (student, schedule, teacher, subject, topic, day) values (?,?,?,?,?,?)');
                $query->bindParam(1, $this->student, PDO::PARAM_INT);
                $query->bindParam(2, $this->schedule, PDO::PARAM_INT);
                $query->bindParam(3, $this->teacher, PDO::PARAM_INT);
                $query->bindParam(4, $this->subject, PDO::PARAM_INT);
                $query->bindParam(5, $this->topic, PDO::PARAM_STR);
                $query->bindParam(6, $this->day, PDO::PARAM_STR);
                $query->execute();

                $this->con->close();
            }
            catch(PDOException $e) {
                echo  $e->getMessage();
            }
        }
    }
?>