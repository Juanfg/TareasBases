<?php
    session_start();
    require_once "../models/User.php";

    if (isset($_POST['id'])) {
        $user_id = filter_input(INPUT_POST, 'id');
    }
    else{
         header("Location:manage_student.php");
    }
    
    $db = new Database;
    $user = new User($db);
    $user->setId($user_id);
    $user->destroy();
    header("Location:manage_student.php");
?>