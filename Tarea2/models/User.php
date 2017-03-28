<?php
    require_once "../DB/Database.php";
    require_once "../interfaces/IUsers.php";

    class User implements IUsers
    {
        private $connection;
        private $username;
        private $password;
        private $valid;
        private $token;
        private $type;
        private $id;

        public function setUsername($username){
            $this->username = $username;
        }

        public function setPassword($password){
            $this->password = $password;
        }

        public function setValid($valid){
            $this->valid = $valid;
        }

        public function setToken($token){
            $this->token = $token;
        }

        public function setType($type){
            $this->type = $type;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function __construct(Database $db)
        {
            $this->connection = new $db;
        }

        public function destroy() {
            try{

                $query = $this->connection->prepare('DELETE FROM users WHERE id = ?');
                $query->bindParam(1, $this->id, PDO::PARAM_STR);
                $query->execute();

                $this->connection->close();
            }
            catch(PDOException $e) {
                echo  $e->getMessage();
            }
        }

        public function password() {
            try{
                $query = $this->connection->prepare('UPDATE users SET password = ? WHERE id = ?');
                $query->bindParam(1, $this->password, PDO::PARAM_STR);
                $query->bindParam(2, $this->id, PDO::PARAM_INT);
                $query->execute();

                $this->connection->close();
            }
            catch(PDOException $e) {
                echo  $e->getMessage();
            }
        }

        public function save() {
            try{
                $query = $this->connection->prepare('INSERT INTO users (username, password, valid, token, type) values (?,?,?,?,?)');
                $query->bindParam(1, $this->username, PDO::PARAM_STR);
                $query->bindParam(2, $this->password, PDO::PARAM_STR);
                $query->bindParam(3, $this->valid, PDO::PARAM_INT);
                $query->bindParam(4, $this->token, PDO::PARAM_STR);
                $query->bindParam(5, $this->type, PDO::PARAM_INT);
                $query->execute();

                $this->connection->close();
            }
            catch(PDOException $e) {
                echo  $e->getMessage();
            }
        }

        public function update() {
            try{
                $query = $this->connection->prepare('UPDATE users SET username = ? WHERE id = ?');
                $query->bindParam(1, $this->username, PDO::PARAM_STR);
                $query->bindParam(2, $this->id, PDO::PARAM_INT);
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
