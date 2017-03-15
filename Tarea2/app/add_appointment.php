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
                require_once '../models/Day.php';
                require_once '../models/Schedule_Type.php';

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
                $appointments = $Teacher->schedulesAvaliable($teacher_id);

                $Subject = new Subject($db);
                $subjects = $Teacher->get();

            ?>
            <h3>Hello <?php echo $student->name ?> </h3>

            <form action="save_schedule.php" method="post">            
                <label for="day">Day of the Week:</label>
                <select name="day" class="form-control">
                    <?php
                        foreach ($days as $day) {
                            echo '<option value="' . $day->id . '">' . $day->name . '</option>'; 
                        }
                    ?>
                </select>
                <br>
                <label for="schedule_type">Schedule Type:</label>
                <select name="type"class="form-control">
                    <?php
                        foreach($types as $type) {
                            echo '<option value="' . $type->id . '">' . $type->name . '</option>'; 
                        }                        
                    ?>
                </select>
                <br>
                <label for="begin_hour">Begin Hour:</label>
                <input type="time" name="begin" class="form-control">
                <br>
                <label for="end_hour">End Hour:</label>
                <input type="time" name="end" class="form-control">
                <br>
                <input class="btn btn-success btn-block btn-md" type="submit" name="submit" value="Seleccionar"></input>
            </form>
            <br>
            <a class="btn btn-danger btn-block btn-md" href="teacher_menu.php">Return</a>
        </div>
    </div>
</body>
</html>
