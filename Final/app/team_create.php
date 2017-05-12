<?php
    session_start();
    require '../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
    require_once "../models/User.php";
    require_once "../models/Coach.php";
    require_once "../models/Team.php";

    if (empty($_POST['submit']))
    {
        header("Location:admin_team.php");
    }

    $args = array(
        'coach_name'  => FILTER_SANITIZE_STRING,
        'team_name'  => FILTER_SANITIZE_STRING,
        'coach_email'  => FILTER_SANITIZE_STRING,
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
    $mail->addAddress($post->coach_email, $coach_name);
    $mail->addReplyTo('lalo.lunagt@gmail.com', 'Football Leagues');

    $mail->Subject = 'Football Leagues account';
    $mail->Body = $token;
    $mail->send();

    $db = new database;

    $team = new Team($db);
    $team->setName($post->team_name);
    $team->save();

    $lastTeam = new Team($db);
    $lastT = $lastTeam->getLast();

    $user = new User($db);
    $user->setEmail($post->coach_email);
    $user->setPassword("secret");
    $user->setToken($token);
    $user->setType(2);
    $user->save();

    $lastUser = new User($db);
    $lastU = $lastUser->getLast();

    $coach = new Coach($db);
    $coach->setName($post->coach_name);
    $coach->setTeam($lastT->id);
    $coach->setUser($lastU->id);
    $coach->save();

    header("Location:coach_team.php");
?>