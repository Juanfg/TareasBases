<!DOCTYPE html>
<html>
<head>
    <!--Import css-->
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="../public/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/font-awesome.min.css">
    <link rel="stylesheet" href="../public/css/animate.css">
    <link href="../public/css/prettyPhoto.css" rel="stylesheet">
    <link href="../public/css/style.css" rel="stylesheet" />
	<link href="../public/css/custom.css" rel="stylesheet" />
    <!--End imports-->
</head>
<body>
    <?php
        require_once '../models/User.php';
        require_once '../models/Coach.php';
        require_once '../models/Player.php';
        
        session_start();

        function startLogin($newEmail, $newPassword){
            
            $db = new database;

            $User= new User($db);
            $users = $User->get();

            $Coach = new Coach($db);
            $coaches = $Coach->get();

            $Player= new Player($db);
            $players = $Player->get();

            foreach($users as $user){
                if(strcmp($newEmail, $user->email) == 0){
                    $pass = false;
                    $id = 0;
                    //strcmp(sha1($newPassword)
                    if($user->valid == 1){
                        if(strcmp(sha1($newPassword), $user->password) == 0){
                            $pass = true;
                        }
                    }
                    else{
                        //echo $user->token;
                        //echo $newPassword;
                        if(strcmp($newPassword, $user->token) == 0){
                            echo $user->token;
                            $pass = true;
                        }
                    }
                    if($pass){
                        switch($user->type){
                            case 1:
                                $_SESSION['admin_id'] = $user->id;
                                header('Location: admin_menu.php');
                                break;
                            case 2:
                                $coach_id;
                                foreach($coaches as $coach){
                                    if(strcmp($coach->user_id, $user->id) == 0){
                                        $coach_id = $coach->id;
                                    }
                                }
                                $_SESSION['coach_id'] = $coach_id;
                                header('Location: coach_menu.php');
                                break;
                            case 3:
                                $player_id;
                                foreach($players as $player){
                                    if(strcmp($player->user_id, $user->id) == 0){
                                        echo "hshshshsh";
                                        $player_id = $player->id;
                                    }
                                }
                                $_SESSION['player_id'] = $player_id;
                                header('Location: player_menu.php');
                                break;
                        }
                    }
                }
            }
        }
    ?>
    <section id="main-slider">
        <div class="carousel slide">      
            <div class="carousel-inner">
                <div class="item active" style="background-image: url(../public/images/slider/bg1.jpg)">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                            
                                <div class="carousel-content">
                                    <h2 class="animation animated-item-1">Welcome to <span>Football Leagues</span></h2>
                                    <?php
                                        if (isset($_POST['login'])) {
                                            startLogin($_POST['email'], $_POST['password']);
                                        }
                                    ?>
                                    <div class="col-md-6">
                                        <form action="main.php" method="post">
                                            <label style="color:white;" for="Email">Email:</label>
                                                <input type="text" name="email" class="form-control" >
                                            <br>
                                            <label style="color:white;" for="Password">Password:</label>
                                                <input type="password" name="password" class="form-control" >
                                            <br>
                                            <input class="btn btn-success btn-block btn-md" type="submit" name="login" value="Enter"></input>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/.item-->             
            </div><!--/.carousel-inner-->
        </div><!--/.carousel-->
    </section><!--/#main-slider-->
</body>
</html>