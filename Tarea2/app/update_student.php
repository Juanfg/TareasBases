<?php
    session_start();
    require_once "../models/User.php";
    require_once "../models/Student.php";

    if (empty($_POST['submit']))
    {
        header("Location:manage_student.php");
    }

    $args = array(
        'name'  => FILTER_SANITIZE_STRING,
        'lastname'  => FILTER_SANITIZE_STRING,
        'username'  => FILTER_SANITIZE_STRING,
        'id_user'  => FILTER_SANITIZE_STRING,
        'id_student'  => FILTER_SANITIZE_STRING,
    );

    $post = (object)filter_input_array(INPUT_POST, $args);

    $db = new Database;
    $user = new User($db);
    $user->setUsername($post->username);
    $user->setId($post->id_user);
    $user->update();
    
    $student = new Student($db);
    $student->setName($post->name);
    $student->setLastname($post->lastname);
    $student->setId($post->id_student);
    $student->update();
    header("Location:manage_student.php");
?>