<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Password Teacher</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
    <div class="container">
        <div class="col-md-12">
            <?php
                require_once '../models/Teacher.php';
                session_start();
                if (isset($_SESSION['id_teacher'])) {
                    $teacher_id = $_SESSION['id_teacher'];
                }
                else {
                    header('Location: logout.php');
                }
                $db = new Database;
                $Teacher = new Teacher($db);
                $teacher = $Teacher->getTeacher($teacher_id);
            ?>
            <h3 class="text-center text-info">Welcome <?php echo $teacher->name ?> </h3>
            <h3 class="text-center text-info">What is your new password?</h3>
            <form action="new_password_teacher.php" method="post">
                <label for="Password">New Password:</label>
                <input type="password" name="password" class="form-control">
                <input type="hidden" name="id_user" value="<?php echo $teacher->user ?>">
                <br>
                <input class="btn btn-success btn-block btn-md" type="submit" name="submit" value="Update Teacher"></input>
            </form>
            <br>
            <a class="btn btn-danger btn-block btn-md" href="teacher_menu.php">Return</a>
        </div>
    </div>
</body>
</html>