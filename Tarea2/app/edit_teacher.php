<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Edit Profesor</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
    <div class="container">
        <div class="col-md-12">
            <?php
                require_once '../models/Teacher.php';
                session_start();
                if (isset($_SESSION['id_admin'])) {
                    $user_id = $_SESSION['id_admin'];
                }
                else {
                    header('Location: logout.php');
                }
                $id = $_POST['id_user'];
                $teacher_id = $_POST['id_teacher'];
            ?>
            <h3 class="text-center text-info">Edit your student</h3>

            <form action="update_teacher.php" method="post">
                <label for="Name">Name:</label>
                <input type="text" name="name" class="form-control">
                <br>
                <label for="LastName">Last Name:</label>
                <input type="text" name="lastname" class="form-control">
                <br>
                <label for="Username">Username:</label>
                <input type="text" name="username" class="form-control">
                <input type="hidden" name="id_user" value="<?php echo $id ?>">
                <input type="hidden" name="id_teacher" value="<?php echo $teacher_id ?>">
                <br>
                <input class="btn btn-success btn-block btn-md" type="submit" name="submit" value="Update Teacher"></input>
            </form>
            <br>
            <a class="btn btn-danger btn-block btn-md" href="manage_teacher.php">Return</a>
        </div>
    </div>
</body>
</html>
