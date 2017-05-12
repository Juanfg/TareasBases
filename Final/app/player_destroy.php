<?php
    session_start();
    require_once "../models/Player.php";

    if (isset($_POST['id'])) {
        $player_id = filter_input(INPUT_POST, 'id');
    }
    else{
         header("Location:coach_team.php");
    }
    
    $db = new database;
    $player = new Player($db);
    $player->setId($player_id);
    $player->destroy();
    header("Location:coach_team.php");
?>