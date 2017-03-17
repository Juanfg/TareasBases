<?php
    session_start();
    require_once "../models/Appointment.php";
    if (empty($_POST['submit']))
    {
        header("Location:add_appointment.php");
        exit;
    }

    $args = array(
        'student'  => FILTER_SANITIZE_STRING,
        'schedule'  => FILTER_SANITIZE_STRING,
        'teacher'  => FILTER_SANITIZE_STRING,
        'subject'  => FILTER_SANITIZE_STRING,
        'topic'  => FILTER_SANITIZE_STRING,
        'day'  => FILTER_SANITIZE_STRING,
    );

    $post = (object)filter_input_array(INPUT_POST, $args);

    $db = new Database;
    $query = $db->prepare('SELECT days.name from schedule inner join days on (schedule.day = days.id) where schedule.id = ?');
    $query->bindParam(1, $post->schedule, PDO::PARAM_INT);
    $query->execute();
    $ss = $query->fetch(PDO::FETCH_OBJ);

    $datete = date('l', strtotime($post->day));
    if (strcmp($ss->name, $datete) != 0) {
        header("Location:teacher_appointment_select.php?id=1");
        exit;
    }
    
    $appointment = new Appointment($db);
    $appointment->setStudent($_SESSION['id_student']);
    $appointment->setSchedule($post->schedule);
    $appointment->setTeacher($post->teacher);
    $appointment->setSubject($post->subject);
    $appointment->setTopic($post->topic);
    $appointment->setDay($post->day);
    $appointment->save();
    header("Location:student_menu.php");
?>