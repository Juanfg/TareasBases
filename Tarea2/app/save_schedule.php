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

    $query = $db->prepare('SELECT schedule.begin_hour as start, schedule.end_hour as end, schedule.day as day FROM schedule, teacher_schedule,
                        teacher WHERE teacher_schedule.teacher = teacher.id AND teacher_schedule.schedule = schedule.id AND teacher.id = ?');
    $query->bindParam(1, $_SESSION['id_teacher'], PDO::PARAM_INT);
    $query->execute();
    $ss = $query->fetchAll(PDO::FETCH_OBJ);
    foreach ($ss as $s) {
        if (strcmp($s->day, $post->day) == 0) {
            if (($s->start <= $post->begin && $s->end > $post->begin) || ($s->start < $post->end && $s->end >= $post->end)) {
                header("Location:add_schedule.php?id=1");
                exit;
            }
        }
    }

    $schedule = new Schedule($db);
    $schedule->setType($post->type);
    $schedule->setTeacher($_SESSION['id_teacher']);
    $schedule->setDay($post->day);
    $schedule->setStart($post->begin);
    $schedule->setEnd($post->end);
    $schedule->save();
    header("Location:teacher_schedule.php");
?>