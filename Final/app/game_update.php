<!DOCTYPE html>
<html>
<head>
    <!--Imports css-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
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
        if (isset($_SESSION['admin_id'])) {
            $admin_id = $_SESSION['admin_id'];
        }
        else {
            header('Location: logout.php');
        }

        if (isset($_POST['game_id'])) {
            $game_id = filter_input(INPUT_POST, 'game_id');
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
							<h1><span>Edit Ga</span>me</h1>
						</div>
					</div>
					<div class="navbar-collapse collapse">							
						<div class="menu">
							<ul class="nav nav-tabs" role="tablist">							
								<li role="presentation"><a href="admin_menu.php">Admin menu</a></li>
                                <li role="presentation"><a href="admin_team.php">Manage teams</a></li>
								<li role="presentation"><a href="logout.php">Logout</a></li>						
							</ul>
						</div>
					</div>						
				</div>
			</div>	
		</nav>		
	</header>
    <!--End topbar-->

    <!--Start gets-->
    <?php
        require_once '../models/Team.php';
        require_once '../models/Game.php';
        $db = new database;
        $Team = new Team($db);
        $Game = new Game($db);
        $game = $Game->getGame($game_id);
        $local_team = $Team->getSpecific($game->local_id);
        $visitor_team = $Team->getSpecific($game->visitor_id);
    ?>
    <!--End get-->

    <!--Start table-->
    <div class="container" style="margin-top:120px">
        <div class="col-md-12">
            <form action="game_save_goals.php" method="post">
                <label for="local_team_goals"><?php echo $local_team[0]->name ?></label>
                <input type="number" name="local_team_goals" class="form-control">
                <input type="number" name="visitor_team_goals" class="form-control">
                <label for="visitor_team_goals"><?php echo $visitor_team[0]->name ?></label>
                <br><br>
                <input name="game_id" type="hidden" value="<?php echo $game_id ?>" class="form-control">
                <input class="btn btn-success btn-block btn-md" type="submit" name="submit" value="Update Game"></input>
            </form>
        </div>
    </div>
    <!--End table-->

</body>
</html>