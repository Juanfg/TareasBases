<?php
    require_once("../db/Database.php");
    require_once("../interfaces/ISchedule.php");

    class Schedule implements ISchedule {
        private $con;
        private $id;
        private $type;
        private $teacher;
        private $day;
        private $begin;
        private $end;

        public function __construct(Database $db){
            $this->con = new $db;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setType($type){
            $this->type = $type;
        }

        public function setTeacher($teacher){
            $this->teacher = $teacher;
        }

        public function setDay($day){
            $this->day = $day;
        }

        public function setStart($start){
            $this->begin = $start;
        }

        public function setEnd($end){
            $this->end = $end;
        }

        //insertamos usuarios en una tabla con postgreSql
        public function save() {
            try{
                $query = $this->con->prepare('INSERT INTO schedule (begin_hour, end_hour, schedule_type, semester, day, visible) values (?,?,?,1,?,true)');
                $query->bindParam(1, $this->begin, PDO::PARAM_STR);
                $query->bindParam(2, $this->end, PDO::PARAM_STR);
                $query->bindParam(3, $this->type, PDO::PARAM_INT);
                $query->bindParam(4, $this->day, PDO::PARAM_INT);
                $query->execute();

                $query = $this->con->prepare('SELECT id FROM schedule ORDER BY id DESC LIMIT 1');
                $query->execute();
                $id_schedule = $query->fetch(PDO::FETCH_OBJ);

                $query = $this->con->prepare('INSERT INTO teacher_schedule (schedule, teacher) values (?, ?)');
                $query->bindParam(1, $id_schedule->id, PDO::PARAM_INT);
                $query->bindParam(2, $this->teacher, PDO::PARAM_INT);
                $query->execute();

                $this->con->close();
            }
            catch(PDOException $e) {
                echo  $e->getMessage();
            }
        }

        public function update(){
            try{
                $query = $this->con->prepare('UPDATE users SET username = ?, password = ? WHERE id = ?');
                $query->bindParam(1, $this->username, PDO::PARAM_STR);
                $query->bindParam(2, $this->password, PDO::PARAM_STR);
                $query->bindParam(3, $this->id, PDO::PARAM_INT);
                $query->execute();
                $this->con->close();
            }
            catch(PDOException $e){
                echo  $e->getMessage();
            }
        }

        //obtenemos usuarios de una tabla con postgreSql
        public function get(){
            try{
                if(is_int($this->id)){
                    $query = $this->con->prepare('SELECT * FROM users WHERE id = ?');
                    $query->bindParam(1, $this->id, PDO::PARAM_INT);
                    $query->execute();
                    $this->con->close();
                    return $query->fetch(PDO::FETCH_OBJ);
                }
                else{
                    $query = $this->con->prepare('SELECT * FROM users');
                    $query->execute();
                    $this->con->close();
                    return $query->fetchAll(PDO::FETCH_OBJ);
                }
            }
            catch(PDOException $e){
                echo  $e->getMessage();
            }
        }

        public function delete(){
            try{
                $query = $this->con->prepare('DELETE FROM users WHERE id = ?');
                $query->bindParam(1, $this->id, PDO::PARAM_INT);
                $query->execute();
                $this->con->close();
                return true;
            }
            catch(PDOException $e){
                echo  $e->getMessage();
            }
        }

        public static function baseurl() {
            return stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://' . $_SERVER['HTTP_HOST'] . "/crudpgsql/";
        }

        public function checkUser($user) {
            if( ! $user ) {
                header("Location:" . User::baseurl() . "app/list.php");
            }
        }
    }
?>