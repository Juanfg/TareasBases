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
            <?php
                require_once '../models/Student.php';
                require_once '../models/Teacher.php';
                session_start();
                if (isset($_SESSION['id_student'])) {
                    $student_id = $_SESSION['id_student'];
                }
                else {
                    $student_id = filter_input(INPUT_POST, 'id_student');
                }
                $db = new Database;
                $Student = new Student($db);
                $student = $Student->getStudent($student_id);

                $Teacher = new Teacher($db);
                $teachers = $Teacher->get();
            ?>
            <h3 class="text-center text-info">Hello <?php echo $student->name ?> </h3>
            <h3 class="text-center text-info">Select the teacher for your tutoring session</h3>
            <form action="add_appointment.php" method="post">            
                <label for="teacher">Teacher:</label>
                <select name="teacher" class="form-control">
                    <?php
                        foreach ($teachers as $teacher) {
                            echo '<option value="' . $teacher->id . '">' . $teacher->name ." ". $teacher->last_name . '</option>'; 
                        }
                    ?>
                </select>
            </form>
            <br>
            <a class="btn btn-success btn-block btn-md" href="add_appointment.php">Next</a>
            <br>
            <a class="btn btn-danger btn-block btn-md" href="student_menu.php">Return</a>
        </div>
    </div>
</body>
</html>