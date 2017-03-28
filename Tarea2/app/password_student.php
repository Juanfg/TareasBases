<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Password Student</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
    <div class="container">
        <div class="col-md-12">
            <?php
                require_once '../models/Student.php';
                session_start();
                if (isset($_SESSION['id_student'])) {
                    $student_id = $_SESSION['id_student'];
                }
                else {
                    header('Location: logout.php');
                }
                $db = new Database;
                $Student = new Student($db);
                $student = $Student->getStudent($student_id);
            ?>
            <h3 class="text-center text-info">Welcome <?php echo $student->name ?> </h3>
            <h3 class="text-center text-info">What is your new password?</h3>
            <form action="new_password_student.php" method="post">
                <label for="Password">New Password:</label>
                <input type="password" name="password" class="form-control">
                <input type="hidden" name="id_user" value="<?php echo $student->user ?>">
                <br>
                <input class="btn btn-success btn-block btn-md" type="submit" name="submit" value="Update Student"></input>
            </form>
            <br>
            <a class="btn btn-danger btn-block btn-md" href="student_menu.php">Return</a>
        </div>
    </div>
</body>
</html>