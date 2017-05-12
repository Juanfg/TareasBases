<?php
    session_start();
    require_once "../models/User.php";

    if (empty($_POST['submit']))
    {
        header("Location:player_menu.php");
    }

    $args = array(
        'user_id'  => FILTER_SANITIZE_STRING,
        'password'  => FILTER_SANITIZE_STRING,
    );

    $post = (object)filter_input_array(INPUT_POST, $args);

    $db = new database;

    $user = new User($db);
    $user->updatePassword($post->user_id, sha1($post->password));

    header("Location:player_menu.php");
?>