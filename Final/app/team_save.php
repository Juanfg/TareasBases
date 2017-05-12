<?php
    session_start();
    require_once "../models/Team.php";

    if (empty($_POST['submit']))
    {
        header("Location:admin_team.php");
    }

    $args = array(
        'team_id'  => FILTER_SANITIZE_STRING,
        'name'  => FILTER_SANITIZE_STRING,
    );

    $post = (object)filter_input_array(INPUT_POST, $args);

    $db = new database;
    echo $post->team_id;
    echo $post->name;
    $team = new Team($db);
    $team->updateName($post->team_id, $post->name);

    header("Location:admin_team.php");
?>