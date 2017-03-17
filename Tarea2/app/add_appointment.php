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
                require_once '../models/Subject.php';
                require_once '../models/Day.php';

                $prueba = filter_input(INPUT_POST, 'prueba');
                session_start();
                if (isset($_SESSION['id_student'])) {
                    $student_id = $_SESSION['id_student'];
                }
                else {
                    $student_id = filter_input(INPUT_POST, 'id_student');
                }
                $teacher_id = filter_input(INPUT_POST, 'id_teacher');

                $db = new Database;
                $Student = new Student($db);
                $student = $Student->getStudent($student_id);

                $Teacher = new Teacher($db);
                $teacher = $Teacher->getTeacher($teacher_id);
                $appointments = $Teacher->schedulesAvaliable($teacher_id);

                $Subject = new Subject($db);
                $subjects = $Subject->get();

            ?>
            <h3 class="text-center text-info">Hello <?php echo $student->name ?> </h3>
            <h3 class="text-center text-info">Select the info for your appointment</h3>

            <form action="save_appointment.php" method="post">            
                <label for="schedule">Schedule:</label>
                <select name="schedule" class="form-control">
                    <?php
                        foreach ($appointments as $appointment) {
                            echo '<option value="' . $appointment->Id . '">' . $appointment->Start . " " . $appointment->End . " " . $appointment->Day . '</option>'; 
                        }
                    ?>
                </select>
                <br>
                <label for="subject">Subject:</label>
                <select name="subject"class="form-control">
                    <?php
                        foreach($subjects as $subject) {
                            echo '<option value="' . $subject->id . '">' . $subject->name . '</option>'; 
                        }                        
                    ?>
                </select>
                <br>
                <label for="Topic">Topic:</label>
                <input type="text" name="topic" class="form-control">
                <br>
                <label for="Day">Date:</label>
                <input type="date" name="day" class="form-control">
                <input type="hidden" name="teacher" value="<?php echo $teacher_id ?>">
                <br>
                <input class="btn btn-success btn-block btn-md" type="submit" name="submit" value="Seleccionar"></input>
            </form>
            <br>
            <a class="btn btn-danger btn-block btn-md" href="teacher_appointment_select.php">Return</a>
        </div>
    </div>
</body>
</html>
