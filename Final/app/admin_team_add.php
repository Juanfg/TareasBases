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

    <!--Start table-->
    <div class="container" style="margin-top:120px">
        <div class="col-md-12">
            <form action="team_create.php" method="post">
                <label for="Name">Name of the team:</label>
                <input type="text" name="team_name" class="form-control">
                <br>
                <label for="Name">Name of the coach:</label>
                <input type="text" name="coach_name" class="form-control">
                <br>
                <label for="Email">Email for the coach:</label>
                <input type="text" name="coach_email" class="form-control">
                <br>
                <input class="btn btn-success btn-block btn-md" type="submit" name="submit" value="Edit player"></input>
            </form>
        </div>
    </div>
    <!--End table-->

</body>
</html>