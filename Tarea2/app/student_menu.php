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
                session_start();
                if (isset($_SESSION['id_student'])) {
                    $student_id = $_SESSION['id_student'];
                }
                else {
                    $student_id = filter_input(INPUT_POST, 'id_student');
                    $_SESSION['id_student'] = $student_id;
                }
                $db = new Database;
                $Student = new Student($db);
                $student = $Student->getStudent($student_id);
            ?>
            <h3 class="text-center text-info">Welcome <?php echo $student->name ?> </h3>
            <h3 class="text-center text-info">What do you want to do?</h3>
            <br>
            <div class="col-md-12">
                <!--<form action="">
                <input type="hidden" value="">
                <input type="submit" class="btn btn-success btn-block btn-md" value="New Appointment">
                </form>-->
                <a class="btn btn-success btn-block btn-md" href="new_appointment.php">New Appointment</a>
            </div>
            <br>
            <br>
            <div class="col-md-12">
                <a class="btn btn-success btn-block btn-md" href="show_appointment.php">Check Scheduled Appointments</a>
            </div>
            <br>
            <br>
            <div class="col-md-12">
                <a class="btn btn-danger btn-block btn-md" href="student_select.php">Return</a>
            </div>
        </div>
    </div>
</body>
</html>