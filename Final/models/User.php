<?php
    define('__ROOT__', dirname(dirname(__FILE__)));
    require_once(__ROOT__.'/db/database.php');
    require_once(__ROOT__.'/interfaces/IUsers.php');

    class User implements IUsers
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
