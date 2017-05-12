<?php
    session_start();
    require_once "../models/Game.php";

    if (empty($_POST['submit']))
    {
        header("Location:admin_game_add.php");
    }

    $args = array(
        'local_team'  => FILTER_SANITIZE_STRING,
        'visitor_team'  => FILTER_SANITIZE_STRING,
        'date'  => FILTER_SANITIZE_STRING,
        'field'  => FILTER_SANITIZE_STRING,
    );

    $post = (object)filter_input_array(INPUT_POST, $args);

    $db = new database;

    $game = new Game($db);
    $game->setLocal($post->local_team);
    $game->setVisitor($post->visitor_team);
    $game->setDate($post->date);
    $game->setField($post->field);
    $game->save();

    header("Location:admin_game.php");
?>