<?php
    session_start();
    require_once "../models/User.php";

    if (empty($_POST['submit']))
    {
        header("Location:teacher_menu.php");
    }

    $args = array(
        'password'  => FILTER_SANITIZE_STRING,
        'id_user'  => FILTER_SANITIZE_STRING,
    );

    $post = (object)filter_input_array(INPUT_POST, $args);
    
    $db = new Database;
    $user = new User($db);
    $user->setId($post->id_user);
    $user->setPassword(sha1($post->password));
    $user->password();
    header("Location:teacher_menu.php");
?>