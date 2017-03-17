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

                $schedules = $Teacher->schedules($teacher_id);
            ?>
            <h3 class="text-center text-info">Hello <?php echo $teacher->name ?> </h3>
            <h3 class="text-center text-info">These is your schedule</h3>
            <table class="table">
                <th>Day</th>
                <th>Type</th>
                <th>Begin Hour</th>
                <th>End Hour</th>

                <?php
                    foreach ($schedules as $schedule) {
                        echo "<tr>";
                        echo "<td>" . $schedule->Day . "</td>";
                        echo "<td>" . $schedule->Type . "</td>";
                        echo "<td>" . $schedule->Start . "</td>";
                        echo "<td>" . $schedule->End . "</td>";
                        echo "<tr>";
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
