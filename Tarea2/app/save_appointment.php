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