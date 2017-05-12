<?php
    require_once('../db/database.php');

    class User
    {
        private $connection;

        private $id;
        private $email;
        private $password;
        private $valid;
        private $token;
        private $type;
        

        public function setId($id){
            $this->id = $id;
        }

        public function setEmail($email){
            $this->email = $email;
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

        public function __construct(database $db)
        {
            $this->connection = new $db;
        }

        public function save() {
            try{
                $query = $this->connection->prepare('INSERT INTO users (email, password, token, type) values (?,?,?,?)');
                $query->bindParam(1, $this->email, PDO::PARAM_STR);
                $query->bindParam(2, $this->password, PDO::PARAM_STR);
                $query->bindParam(3, $this->token, PDO::PARAM_STR);
                $query->bindParam(4, $this->type, PDO::PARAM_INT);
                $query->execute();

                $this->connection->close();
            }
            catch(PDOException $e) {
                echo  $e->getMessage();
            }
        }

        

        public function update() {
            try{
                $query = $this->connection->prepare('UPDATE users SET email = ? WHERE id = ?');
                $query->bindParam(1, $this->email, PDO::PARAM_STR);
                $query->bindParam(2, $this->id, PDO::PARAM_INT);
                $query->execute();

                $this->connection->close();
            }
            catch(PDOException $e) {
                echo  $e->getMessage();
            }
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

        public function updateEmail() {
            try{
                $query = $this->connection->prepare('UPDATE users SET email = ? WHERE id = ?');
                $query->bindParam(1, $this->email, PDO::PARAM_STR);
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
                $result = $this->connection->prepare($query);
                $result->execute();
                $this->connection->close();
                return $result->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function getUser($id)
        {
            try {
                $query = "SELECT * FROM users WHERE id = ?";
                $query->bindParam(1, $id, PDO::PARAM_INT);
                $query->execute();
                $this->connection->close();
                return $query->fetch(PDO::FETCH_OBJ);
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function updatePassword($id, $password)
        {
            try {
                $query = "UPDATE users SET password = ?, valid = true WHERE id = ?";
                $result = $this->connection->prepare($query);
                $result->bindParam(1, $password, PDO::PARAM_STR);
                $result->bindParam(2, $id, PDO::PARAM_INT);
                
                $result->execute();
                $this->connection->close();
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function getLast()
        {
            try {
                $query = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
                $result = $this->connection->prepare($query);
                $result->execute();
                $this->connection->close();
                return $result->fetch(PDO::FETCH_OBJ);
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function password() {
            try{
                $query = $this->connection->prepare('UPDATE users SET password = ?, SET valid = true WHERE id = ?');
                $query->bindParam(1, $this->password, PDO::PARAM_STR);
                $query->bindParam(2, $this->id, PDO::PARAM_INT);
                $query->execute();

                $this->connection->close();
            }
            catch(PDOException $e) {
                echo  $e->getMessage();
            }
        }
    }
?>
