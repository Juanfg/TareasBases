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
            $user_id = $_SESSION['admin_id'];
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
							<h1><span>Ad</span>min</h1>
						</div>
					</div>
					<div class="navbar-collapse collapse">							
						<div class="menu">
							<ul class="nav nav-tabs" role="tablist">							
								<!--<li role="presentation"><a href="blog.html">Blog</a></li>-->
								<li role="presentation"><a href="logout.php">Logout</a></li>						
							</ul>
						</div>
					</div>						
				</div>
			</div>	
		</nav>		
	</header>
    <!--End topbar-->

    <!--Start menu-->
    <div class="feature">
		<div class="container" style="margin-top:120px">
			<div class="text-center">
            	<div class="col-md-6">
					<div class="hi-icon-wrap hi-icon-effect wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms" >
						<a href="admin_team.php">
                            <i class="fa fa-users"></i>	
                        </a>
						<h2>Manage teams</h2>
						<p>Edit the teams that belong to this league.</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="hi-icon-wrap hi-icon-effect wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" >
						<a href="admin_game.php">
							<i class="fa fa-calendar"></i>
						</a>	
						<h2>Schedule Games</h2>
						<p>Here you can edit the game schedules and register the wins and loses.</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="hi-icon-wrap hi-icon-effect wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" >
						<a href="admin_results.php">
							<i class="fa fa-check"></i>
						</a>	
						<h2>Watch Results</h2>
						<p>Here you can see the results of the previous matches.</p>
					</div>
				</div>
				<div class="col-md-4">
					<div  class="hi-icon-wrap hi-icon-effect wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="900ms" >
						<a href="admin_table.php">
							<i class="fa fa-table"></i>	
						</a>
						<h2>General table</h2>
						<p>See the information of all the teams.</p>
					</div>
				</div>
				<div class="col-md-4">
					<div  class="hi-icon-wrap hi-icon-effect wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms" >
						<a id="fields" href="">
							<i class="fa fa-trophy"></i>	
						</a>
						<script>
							document.getElementById('fields').href = "http://" + window.location.hostname + ":8004/fields"; 
						</script>
						<h2>Championships</h2>
						<p>Here you can add/edit/delete fields of the games.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
    <!--End menu-->
</body>
</html>