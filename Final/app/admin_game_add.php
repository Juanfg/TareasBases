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
        if (isset($_SESSION['admin_id'])) {
            $admin_id = $_SESSION['admin_id'];
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
							<h1><span>Add Te</span>am</h1>
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
        $db = new database;
        $Team = new Team($db);
        $teams = $Team->get();
    ?>
    <!--End get-->

    <!--Start table-->
    <div class="container" style="margin-top:120px">
        <div class="col-md-12">
            <form action="game_save.php" method="post">
                <label for="Local">Local Team:</label>
                <select name="local_team" class="form-control">
                    <?php
                        foreach ($teams as $team)
                            echo "<option value='" . $team->id . "'>" . $team->name . "</option>";
                    ?>
                </select>
                <br>
                <label for="Visitor">Visitor Team:</label>
                <select name="visitor_team" class="form-control">
                    <?php
                        foreach ($teams as $team)
                            echo "<option value='" . $team->id . "'>" . $team->name . "</option>";
                    ?>
                </select>
                <br>
                <label for="Date">Date of the game:</label>
                <input type="datetime-local" name="date" class="form-control">
                <br>
                <input class="btn btn-success btn-block btn-md" type="submit" name="submit" value="Add Game"></input>
            </form>
        </div>
    </div>
    <!--End table-->

</body>
</html>