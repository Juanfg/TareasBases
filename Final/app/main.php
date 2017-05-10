<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
    <?php
        require_once '../models/Teacher.php';
        require_once '../models/User.php';
        require_once '../models/Student.php';
        session_start();
        function startLogin($inputUsername, $inputPassword){
            $db = new Database;

            $Teacher = new Teacher($db);
            $teachers = $Teacher->get();

            $Student= new Student($db);
            $students = $Student->get();

            $User= new User($db);
            $users = $User->get();

            foreach($users as $user){
                if(strcmp($inputUsername, $user->username) == 0){
                    echo $user->token;
                    if((strcmp(sha1($inputPassword), $user->password)== 0) || (strcmp($inputPassword, $user->token)== 0) ){
                        switch($user->type){
                            case 1:
                                $_SESSION['id_admin'] = $user->id;
                                header('Location: admin.php');
                                break;
                            case 2:
                                $teacher_id;
                                foreach($teachers as $teacher){
                                    if(strcmp($teacher->user, $user->id) == 0){
                                        $teacher_id = $teacher->id;
                                    }
                                }
                                $_SESSION['id_teacher'] = $teacher_id;
                                header('Location: teacher_menu.php');
                                break;
                            case 3:
                                $student_id;
                                foreach($students as $student){
                                    if(strcmp($student->user, $user->id) == 0){
                                        $student_id = $student->id;
                                    }
                                }
                                $_SESSION['id_student'] = $student_id;
                                header('Location: student_menu.php');
                                break;
                        }
                    }
                }
            }
        }
    ?>
    <div class="container">
        <div class="col-md-12">
            <h3 class="text-center text-info">Welcome to the Consulting Management System</h3>
            <h3 class="text-center text-info">Please Login</h3>
            <br>
            <?php
                if (isset($_POST['login'])) {
                    startLogin($_POST['username'], $_POST['password']);
                }
            ?>
            <div class="col-md-3">
                <form action="main.php" method="post">
                    <label for="Username">Username:</label>
                        <input type="text" name="username" class="form-control" >
                    <br>
                    <label for="Password">Password:</label>
                        <input type="password" name="password" class="form-control" >
                    <br>
                    <input class="btn btn-success btn-block btn-md" type="submit" name="login"></input>
                </form>
            </div>
        </div>
    </div>
</body>
</html>