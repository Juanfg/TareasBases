<?php
    session_start();
    require_once "../models/User.php";
    require_once "../models/Teacher.php";

    if (empty($_POST['submit']))
    {
        header("Location:manage_teacher.php");
    }

    $args = array(
        'name'  => FILTER_SANITIZE_STRING,
        'lastname'  => FILTER_SANITIZE_STRING,
        'username'  => FILTER_SANITIZE_STRING,
        'password'  => FILTER_SANITIZE_STRING,
        'valid'  => FILTER_SANITIZE_STRING,
        'token'  => FILTER_SANITIZE_STRING,
        'type'  => FILTER_SANITIZE_STRING,
    );

    $post = (object)filter_input_array(INPUT_POST, $args);

    $db = new Database;
    $user = new User($db);
    $user->setUsername($post->username);
    $user->setPassword(sha1($post->password));
    $user->setValid($post->valid);
    $user->setToken($post->token);
    $user->setType($post->type);
    $user->save();

    $query = $db->prepare('SELECT users.id FROM users WHERE users.username = ?');
    $query->bindParam(1, $post->username, PDO::PARAM_INT);
    $query->execute();
    $ss = $query->fetchAll(PDO::FETCH_OBJ);
    $user_id;
    foreach ($ss as $s) {
        $user_id = $s->id;
    }
    $msg = "Your token is: ". $post->token.". Use it wisely";
    $headers = "From: servicio@itesm.mx" . "\r\n" .
    "CC: A01322804@itesm.mx";
    mail($post->username.'@mailinator.com',"My subject",$msg, $headers);

    $teacher = new Teacher($db);
    $teacher->setName($post->name);
    $teacher->setLastname($post->lastname);
    $teacher->setUser($user_id);
    $teacher->save();
    header("Location:manage_teacher.php");
?>