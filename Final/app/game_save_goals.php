<?php
    session_start();
    require_once "../models/Game.php";

    if (empty($_POST['submit']))
    {
        header("Location:admin_game_add.php");
    }

    $args = array(
        'local_team_goals'  => FILTER_SANITIZE_STRING,
        'visitor_team_goals'  => FILTER_SANITIZE_STRING,
        'game_id' => FILTER_SANITIZE_STRING,
    );

    $post = (object)filter_input_array(INPUT_POST, $args);

    $db = new database;

    $game = new Game($db);
    $game->saveGoals($post->local_team_goals, $post->visitor_team_goals, $post->game_id);

    header("Location:admin_game.php");
?>