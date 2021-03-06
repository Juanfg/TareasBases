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
        if (isset($_SESSION['coach_id']) && isset($_SESSION['team_id'])) {
            $coach_id = $_SESSION['coach_id'];
            $team_id = $_SESSION['team_id'];
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
							<h1><span>Add Pla</span>yer</h1>
						</div>
					</div>
					<div class="navbar-collapse collapse">							
						<div class="menu">
							<ul class="nav nav-tabs" role="tablist">							
								<li role="presentation"><a href="coach_menu.php">Coach menu</a></li>
                                <li role="presentation"><a href="coach_team.php">Manage team</a></li>
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
            <form action="player_create.php" method="post">
                <label for="Name">Name of the player:</label>
                <input type="text" name="player_name" class="form-control">
                <br>
                <label for="Name">Email of the player:</label>
                <input type="text" name="player_email" class="form-control">
                <input type="hidden" name="team_id" value= "<?php echo $team_id; ?>">
                <br>
                <input class="btn btn-success btn-block btn-md" type="submit" name="submit" value="Add player"></input>
            </form>
        </div>
    </div>
    <!--End table-->

</body>
</html>