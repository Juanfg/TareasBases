<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
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
                    if($user->valid){
                        if(strcmp($newPassword, $user->password) == 0){
                            $pass = true;
                        }
                    }
                    else{
                        if(strcmp($newPassword, $user->token) == 0){
                            $pass = true;
                        }
                    }
                    if($pass){
                        switch($user->type){
                            case 1:
                                $_SESSION['admin_id'] = $user->id;
                                header('Location: admin/menu.php');
                                break;
                            case 2:
                                $coach_id;
                                foreach($coaches as $coach){
                                    if(strcmp($coach->user_id, $user->id) == 0){
                                        $coach_id = $coach->id;
                                    }
                                }
                                $_SESSION['coach_id'] = $coach_id;
                                header('Location: coach/menu.php');
                                break;
                            case 3:
                                $player_id;
                                foreach($players as $player){
                                    if(strcmp($player->user_id, $user->id) == 0){
                                        $player_id = $player->id;
                                    }
                                }
                                $_SESSION['player_id'] = $player_id;
                                header('Location: student_menu.php');
                                break;
                        }
                    }
                }
            }
        }
    ?>
    <div class="container">
        <div class="col-md-12">
            <h3 class="text-center text-info">Welcome to the League System</h3>
            <h3 class="text-center text-info">Please Login</h3>
            <br>
            <?php
                if (isset($_POST['login'])) {
                    startLogin($_POST['email'], $_POST['password']);
                }
            ?>
            <div class="col-md-3">
                <form action="main.php" method="post">
                    <label for="Email">Email:</label>
                        <input type="text" name="email" class="form-control" >
                    <br>
                    <label for="Password">Password:</label>
                        <input type="password" name="password" class="form-control" >
                    <br>
                    <input class="btn btn-success btn-block btn-md" type="submit" name="login"></input>
                </form>
            </div>
        </div>
    </div>
</body>
</html>