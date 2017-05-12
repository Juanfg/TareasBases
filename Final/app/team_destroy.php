<?php
    session_start();
    require_once "../models/Team.php";

    if (isset($_POST['id'])) {
        $team_id = filter_input(INPUT_POST, 'id');
    }
    else{
         header("Location:admin_team.php");
    }
    
    $db = new database;
    $team = new Team($db);
    $team->setId($team_id);
    $team->destroy();
    header("Location:coach_team.php");
?>