<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Professor-Student</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
    <div class="container">
        <div class="col-md-12">
            <h3 class="text-center text-info">Select your student</h3>
            <br>
            <div class="col-md-12">
                <form action="student_menu.php" method="post">
                    <select name="id_student" class="form-control">
                        <?php
                            require_once '../models/Student.php';
                            session_start();
                            if (isset($_SESSION['id_student'])) {
                                unset($_SESSION['id_student']);
                            }
                            $db = new Database;
                            $Student= new Student($db);
                            $students = $Student->get();
                            foreach ($students as $student) {
                                echo '<option value="' . $student->id . '">' . $student->name . ' ' . $student->last_name . '</option>';
                            }
                        ?>
                    </select>
                    <br>
                    <input class="btn btn-success btn-block btn-md" type="submit" value="Seleccionar"></input>
                </form>
                <br>
                <a class="btn btn-danger btn-block btn-md" href="main.php">Return</a>
            </div>
        </div>
    </div>
</body>
</html>
