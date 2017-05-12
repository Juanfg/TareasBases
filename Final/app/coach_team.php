<!DOCTYPE html>
<html>
<head>
    <!--Imports css-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coach</title>
    <link href="../public/css/bootstrap.min.css" rel="stylesheet">
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
							<h1><span>Te</span>am</h1>
						</div>
					</div>
					<div class="navbar-collapse collapse">							
						<div class="menu">
							<ul class="nav nav-tabs" role="tablist">							
								<li role="presentation"><a href="menu.php">Coach menu</a></li>
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

        $teams = $Coach->getTeam($coach->team_id);
    ?>
    <!--End gets -->

    <!--Start table-->
    <div class="container" style="margin-top:120px">
        <div class="col-md-12">
            <table class="table">
                <thead style="color:black;">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    </thead>
                <tbody>
                    <?php
                        foreach ($teams as $team) {
                            echo "<tr>";
                            echo "<td>" . $team->id . "</td>";
                            echo "<td>" . $team->name . "</td>";
                            echo "<td>" . $team->email . "</td>";
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