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
        if (isset($_SESSION['coach_id'])) {
            $coach_id = $_SESSION['coach_id'];
        }
        else {
            header('Location: logout.php');
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
							<h1><span>Sched</span>ule games</h1>
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

    <!--Start gets -->
    <?php
        require_once '../models/Game.php';
        require_once '../models/Team.php';
        $db = new database;

        $Game = new Game($db);
        $games = $Game->get();
        $Team = new Team($db);
    ?>
    <!--End gets -->

    <!--Start table-->
    <div class="container" style="margin-top:120px">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>ID</th>
                    <th>Local</th>
                    <th>Visitor</th>
                    <th>Date</th>
                    </thead>
                <tbody>
                    <?php
                        foreach ($games as $game) {
                            if($game->active == false){
                                $local_team = $Team->getSpecific($game->local_id);
                                $visitor_team = $Team->getSpecific($game->visitor_id);
                                echo "<tr>";
                                echo "<td>" . $game->id . "</td>";
                                echo "<td>" . $local_team[0]->name . "</td>";
                                echo "<td>" . $visitor_team[0]->name . "</td>";
                                echo "<td>" . $game->date . "</td>";
                                echo "<tr>";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!--End table-->

</body>
</html>