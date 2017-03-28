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
                }
                $db = new Database;
                $Teacher = new Teacher($db);
                $teacher = $Teacher->getTeacher($teacher_id);
                $appointmentsMonth = $Teacher->getAppointmentMonth($teacher_id);
            ?>
            <h3 class="text-center text-info">Hello <?php echo $teacher->name ?> </h3>
            <h3 class="text-center text-info">These are your appointments</h3>
            <br>
            <table class="table">
                <th>Begin Hour</th>
                <th>End Hour</th>
                <th>Student</th>
                <th>Subject</th>
                <th>Topic</th>
                <th>Day</th>
                <?php
                    foreach ($appointmentsMonth as $appointment) {
                        echo "<tr>";
                        echo "<td>" . $appointment->Start . "</td>";
                        echo "<td>" . $appointment->End . "</td>";
                        echo "<td>" . $appointment->Student . "</td>";
                        echo "<td>" . $appointment->Subject . "</td>";
                        echo "<td>" . $appointment->Topic . "</td>";
                        echo "<td>" . $appointment->Day . "</td>";
                        echo "<tr>";
                    }
                ?>
            </table>
            <div class="col-md-12">
                <a class="btn btn-danger btn-block btn-md" href="teacher_menu.php">Return</a>
            </div>
        </div>
    </div>
</body>
</html>