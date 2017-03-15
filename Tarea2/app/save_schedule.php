<?php
    session_start();
    require_once "../models/Schedule.php";
    if (empty($_POST['submit']))
    {
        header("Location:add_schedule.php");
        exit;
    }

    $args = array(
        'type'  => FILTER_SANITIZE_STRING,
        'teacher'  => FILTER_SANITIZE_STRING,
        'day'  => FILTER_SANITIZE_STRING,
        'begin'  => FILTER_SANITIZE_STRING,
        'end'  => FILTER_SANITIZE_STRING,
    );

    $post = (object)filter_input_array(INPUT_POST, $args);

    $db = new Database;
    $schedule = new Schedule($db);
    $schedule->setType($post->type);
    $schedule->setTeacher($_SESSION['id_teacher']);
    $schedule->setDay($post->day);
    $schedule->setStart($post->begin);
    $schedule->setEnd($post->end);
    $schedule->save();
    header("Location:teacher_schedule.php");
?>