<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Show Appointment Interval</title>
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
                }
                $db = new Database;
                $Teacher = new Teacher($db);
                $teacher = $Teacher->getTeacher($teacher_id);
            ?>
            <h3 class="text-center text-info">Hello <?php echo $teacher->name ?> </h3>
            <h3 class="text-center text-info">Select your Interval</h3>
            <br>
            <form action="show_appointment_interval.php" method="post">
                <label for="Start">Start Date:</label>
                <input type="date" name="start" class="form-control">
                <br>
                <label for="End">End Date:</label>
                <input type="date" name="end" class="form-control">
                <br>
                <input class="btn btn-success btn-block btn-md" type="submit" name="submit" value="Seleccionar"></input>
            </form>
            <table class="table">
                <th>Begin Hour</th>
                <th>End Hour</th>
                <th>Student</th>
                <th>Subject</th>
                <th>Topic</th>
                <th>Day</th>
                <?php
                    if (isset($_POST['start']) && isset($_POST['end'])) {
                        $appointmentsInterval = $Teacher->getAppointmentInterval($teacher_id, $_POST['start'], $_POST['end']);
                        foreach ($appointmentsInterval as $appointment) {
                            
                            echo "<tr>";
                            echo "<td>" . $appointment->Start . "</td>";
                            echo "<td>" . $appointment->End . "</td>";
                            echo "<td>" . $appointment->Student . "</td>";
                            echo "<td>" . $appointment->Subject . "</td>";
                            echo "<td>" . $appointment->Topic . "</td>";
                            echo "<td>" . $appointment->Day . "</td>";
                            echo "<tr>";
                        }
                    }
                ?>
            </table>
            <br>
            <br>
            <div class="col-md-12">
                <a class="btn btn-danger btn-block btn-md" href="teacher_menu.php">Return</a>
            </div>
        </div>
    </div>
</body>
</html>