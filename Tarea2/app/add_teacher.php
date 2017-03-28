<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Add Teacher</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
    <div class="container">
        <div class="col-md-12">
            <?php
                require_once '../models/Teacher.php';
                function createToken(){
                    $seed = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
                    $token = '';
                    for($i=0; $i<16; $i++){
                        $token .= $seed[rand(0,sizeof($seed))];
                    }
                    return $token;
                }
                session_start();
                if (isset($_SESSION['id_admin'])) {
                    $user_id = $_SESSION['id_admin'];
                }
                else {
                    header('Location: logout.php');
                }

                $db = new Database;
                $Teacher = new Teacher($db);
                $teachers = $Teacher->get();
            ?>
            <h3 class="text-center text-info">Add your teacher</h3>

            <form action="save_teacher.php" method="post">
                <label for="Name">Name:</label>
                <input type="text" name="name" class="form-control">
                <br>
                <label for="LastName">Last Name:</label>
                <input type="text" name="lastname" class="form-control">
                <br>
                <label for="Username">Username:</label>
                <input type="text" name="username" class="form-control">
                <br>
                <label for="Password">Password:</label>
                <input type="password" name="password" class="form-control">
                <br>
                <input type="hidden" name="valid" value="false">
                <input type="hidden" name="token" value="gd22de123fd3der3">
                <input type="hidden" name="type" value="2">
                <br>
                <input class="btn btn-success btn-block btn-md" type="submit" name="submit" value="Add Teacher"></input>
            </form>
            <br>
            <a class="btn btn-danger btn-block btn-md" href="manage_teacher.php">Return</a>
        </div>
    </div>
</body>
</html>
