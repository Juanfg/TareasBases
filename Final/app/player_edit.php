<!DOCTYPE html>
<html>
<head>
    <!--Imports css-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coach</title>
    <link href="../public/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/font-awesome.min.css">
    <link rel="stylesheet" href="../public/css/animate.css">
    <link href="../public/css/prettyPhoto.css" rel="stylesheet">
    <link href="../public/css/style.css" rel="stylesheet" />
	<link href="../public/css/custom.css" rel="stylesheet" />
    <!--Ene imports-->
</head>
<body>
    <!--User verification-->
    <?php
        session_start();
        if (isset($_SESSION['coach_id'])) {
            $coach_id = $_SESSION['coach_id'];
        }
        else {
            header('Location: logout.php');
        }
        if (isset($_POST['player_id']) && isset($_POST['user_id'])) {
            $player_id = filter_input(INPUT_POST, 'player_id');
            $user_id = filter_input(INPUT_POST, 'user_id');
        }
        else{
                header("Location:coach_team.php");
        }
    ?>
    <!--End verification-->
    
    <!--Start topbar-->
    <header>		
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="navigation">
				<div class="container">					
					<div class="navbar-header">
						<div class="navbar-brand">
							<h1><span>Te</span>am</h1>
						</div>
					</div>
					<div class="navbar-collapse collapse">							
						<div class="menu">
							<ul class="nav nav-tabs" role="tablist">							
								<li role="presentation"><a href="coach_menu.php">Coach menu</a></li>
                                <li role="presentation"><a href="coach_team.php">Manage teams</a></li>
								<li role="presentation"><a href="logout.php">Logout</a></li>						
							</ul>
						</div>
					</div>						
				</div>
			</div>	
		</nav>		
	</header>
    <!--End topbar-->

    <!--Start gets -->
    <?php

        require_once '../models/Coach.php';
        $db = new database;
        $Coach = new Coach($db);
        $coach = $Coach->getCoach($coach_id);

    ?>
    <!--End gets -->

    <!--Start table-->
    <div class="container" style="margin-top:120px">
        <div class="col-md-12">
            <form action="player_save.php" method="post">
                <label for="Name">Name:</label>
                <input type="text" name="name" class="form-control">
                <br>
                <label for="Email">Email:</label>
                <input type="text" name="email" class="form-control">
                <input type="hidden" name="user_id" value= "<?php echo $user_id; ?>">
                <input type="hidden" name="player_id" value= "<?php echo $player_id; ?>">
                <br>
                <input class="btn btn-success btn-block btn-md" type="submit" name="submit" value="Edit player"></input>
            </form>
        </div>
    </div>
    <!--End table-->

</body>
</html>