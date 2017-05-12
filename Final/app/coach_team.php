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
        require_once '../models/Coach.php';
        require_once '../models/Team.php';
        $db = new database;
        $Coach = new Coach($db);
        $coach = $Coach->getCoach($coach_id);
        $_SESSION['team_id'] = $coach->team_id;
        $Team = new Team($db);
        $actTeam = $Team->getTeam($coach->team_id);
        $team = $Coach->getTeam($coach->team_id);
    ?>
    <!--End verification-->
    
    <!--Start topbar-->
    <header>		
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="navigation">
				<div class="container">					
					<div class="navbar-header">
						<div class="navbar-brand">
							<h1><span>Te</span>am <?php echo $actTeam->name; ?></h1>
						</div>
					</div>
					<div class="navbar-collapse collapse">							
						<div class="menu">
							<ul class="nav nav-tabs" role="tablist">							
								<li role="presentation"><a href="coach_menu.php">Coach menu</a></li>
								<li role="presentation"><a href="logout.php">Logout</a></li>						
							</ul>
						</div>
					</div>						
				</div>
			</div>	
		</nav>		
	</header>
    <!--End topbar-->

    <!--Start table-->
    <div class="container" style="margin-top:120px">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </thead>
                <tbody>
                    <?php
                        foreach ($team as $player) {
                            echo "<tr>";
                            echo "<td>" . $player->id . "</td>";
                            echo "<td>" . $player->name . "</td>";
                            echo "<td>" . $player->email . "</td>";
                            echo '<td width="15%">
                                    <div class="col-xs-1">
                                        <form action="player_edit.php" method="POST">
                                            <input type="hidden" name="user_id" value='.$player->user_id.'>
                                            <input type="hidden" name="player_id" value='.$player->id.'>
                                            <button class="btn btn-primary"><i class="fa fa-pencil"></i></button>
                                        </form>
                                    </div>
                                </td>';
                            echo '<td width="15%">
                                    <div class="col-xs-1">
                                        <form action="player_destroy.php" method="POST">
                                            <input type="hidden" name="id" value='.$player->id.'>
                                            <button class="btn btn-danger"><i class="fa fa-pencil"></i></button>
                                        </form>
                                    </div>
                                </td>';
                            echo "<tr>";
                        }
                    ?>
                </tbody>
            </table>
            <a href="coach_player_add.php" class="btn btn-success btn-block"> ADD PLAYER</a> 
        </div>
    </div>
    <!--End table-->

</body>
</html>