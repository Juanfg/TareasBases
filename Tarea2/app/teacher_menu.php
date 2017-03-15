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
                require_once '../models/Teacher.php';
                session_start();
                if (isset($_SESSION['id_teacher'])) {
                    $teacher_id = $_SESSION['id_teacher'];
                }
                else {
                    $teacher_id = filter_input(INPUT_POST, 'id_teacher');
                    $_SESSION['id_teacher'] = $teacher_id;
                }

                $db = new Database;
                $Teacher = new Teacher($db);
                $teacher = $Teacher->getTeacher($teacher_id);

                $schedules = $Teacher->schedules($teacher_id);
            ?>
            <h3 class="text-center text-info">Welcome <?php echo $teacher->name . " " . $teacher->last_name?> </h3>
            <h3 class="text-center text-info">What do you want to do?</h3>
            <br>
            <div class="col-md-12">
                <!--<form action="">
                <input type="hidden" value="">
                <input type="submit" class="btn btn-success btn-block btn-md" value="New Appointment">
                </form>-->
                <a class="btn btn-success btn-block btn-md" href="add_schedule.php">Register Schedule</a>
            </div>
            <br>
            <br>
            <div class="col-md-12">
                <a class="btn btn-success btn-block btn-md" href="teacher_schedule.php">View my Schedule</a>
            </div>
            <br>
            <br>
            <div class="col-md-12">
                <a class="btn btn-success btn-block btn-md" href="show_appointment_month.php">Check Appointments This Month</a>
            </div>
            <br>
            <br>
            <div class="col-md-12">
                <a class="btn btn-success btn-block btn-md" href="show_appointment_week.php">Check Appointments This Week</a>
            </div>
            <br>
            <br>
            <div class="col-md-12">
                <a class="btn btn-danger btn-block btn-md" href="teacher_select.php">Return</a>
            </div>
        </div>
    </div>
</body>
</html>