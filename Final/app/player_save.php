<?php
    session_start();
    require_once "../models/User.php";
    require_once "../models/Player.php";

    if (empty($_POST['submit']))
    {
        header("Location:coach_team.php");
    }

    $args = array(
        'user_id'  => FILTER_SANITIZE_STRING,
        'player_id'  => FILTER_SANITIZE_STRING,
        'name'  => FILTER_SANITIZE_STRING,
        'email'  => FILTER_SANITIZE_STRING,
    );

    $post = (object)filter_input_array(INPUT_POST, $args);

    $db = new database;

    $user = new User($db);
    $user->setId($post->user_id);
    $user->setEmail($post->email);
    $user->updateEmail();

    $player = new Player($db);
    $player->setId($post->player_id);
    $player->setName($post->name);
    $player->updateName();

    header("Location:coach_team.php");
?>