<!DOCTYPE html>
<html>
<head>
    <!--Imports css-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Player</title>
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
        if (isset($_SESSION['player_id'])) {
            $coach_id = $_SESSION['player_id'];
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
							<h1><span>Gerne</span>ral table</h1>
						</div>
					</div>
					<div class="navbar-collapse collapse">							
						<div class="menu">
							<ul class="nav nav-tabs" role="tablist">							
								<li role="presentation"><a href="player_menu.php">Player menu</a></li>
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
        require_once '../models/Team.php';
        $db = new database;

        $Team = new Team($db);
        $teams = $Team->get();
    ?>
    <!--End gets -->

    <!--Start table-->
    <div class="container" style="margin-top:120px">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Wins</th>
                    <th>Loses</th>
                    <th>Ties</th>
                    <th>Points</th>
                    </thead>
                <tbody>
                    <?php
                        foreach ($teams as $team) {
                            echo "<tr>";
                            echo "<td>" . $team->id . "</td>";
                            echo "<td>" . $team->name . "</td>";
                            echo "<td>" . $team->wins . "</td>";
                            echo "<td>" . $team->loses . "</td>";
                            echo "<td>" . $team->ties . "</td>";
                            echo "<td>" . $team->points . "</td>";
                            echo "<tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!--End table-->

</body>
</html>