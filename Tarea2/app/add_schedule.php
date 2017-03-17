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
                function alert($msg) {
                    echo "<script type='text/javascript'>alert('$msg');</script>";
                }
            
                if (isset($_GET['id']))
                {
                    if($_GET['id'] == 1)
                        alert("That hour is already registered");
                }

                require_once '../models/Teacher.php';
                require_once '../models/Day.php';
                require_once '../models/Schedule_Type.php';

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

                $Day = new Day($db);
                $days = $Day->get();

                $Type = new Schedule_Type($db);
                $types = $Type->get();

            ?>
            <h3 class="text-center text-info">Hello <?php echo $teacher->name ?> </h3>
            <h3 class="text-center text-info">You can add a new schedule here</h3>

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
