<?php
    session_start();
    require '../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
    require_once "../models/User.php";
    require_once "../models/Player.php";

    if (empty($_POST['submit']))
    {
        header("Location:coach_team.php");
    }

    $args = array(
        'player_name'  => FILTER_SANITIZE_STRING,
        'player_email'  => FILTER_SANITIZE_STRING,
        'team_id'  => FILTER_SANITIZE_STRING,
    );

    $post = (object)filter_input_array(INPUT_POST, $args);

    $seed = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
    $token = "";
    for($i=0; $i<20; $i++){
        $token .= $seed[rand(0,sizeof($seed))];
    }

    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'lalo.lunagt@gmail.com';
    $mail->Password = 'htcflnidiumlpjop';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('lalo.lunagt@gmail.com', 'Football Leagues');
    $mail->addAddress($post->player_email, $post->player_name);
    $mail->addReplyTo('lalo.lunagt@gmail.com', 'Football Leagues');

    $mail->Subject = 'Football Leagues account';
    $mail->Body = $token;
    $mail->send();

    $db = new database;

    $user = new User($db);
    $user->setEmail($post->player_email);
    $user->setPassword("secret");
    $user->setToken($token);
    $user->setType(3);
    $user->save();

    $lastUser = new User($db);
    $lastU = $lastUser->getLast();

    $player = new Player($db);
    $player->setName($post->player_name);
    $player->setTeam($post->team_id);
    $player->setUser($lastU->id);
    $player->save();

    header("Location:coach_team.php");
?>