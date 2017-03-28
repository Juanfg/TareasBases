<?php
    session_start();
    require_once "../models/User.php";
    require_once "../models/Teacher.php";

    if (empty($_POST['submit']))
    {
        header("Location:manage_teacher.php");
    }

    $args = array(
        'name'  => FILTER_SANITIZE_STRING,
        'lastname'  => FILTER_SANITIZE_STRING,
        'username'  => FILTER_SANITIZE_STRING,
        'id_user'  => FILTER_SANITIZE_STRING,
        'id_teacher'  => FILTER_SANITIZE_STRING,
    );

    $post = (object)filter_input_array(INPUT_POST, $args);

    $db = new Database;
    $user = new User($db);
    $user->setUsername($post->username);
    $user->setId($post->id_user);
    $user->update();
    
    $teacher = new Teacher($db);
    $teacher->setName($post->name);
    $teacher->setLastname($post->lastname);
    $teacher->setId($post->id_teacher);
    $teacher->update();
    header("Location:manage_teacher.php");
?>