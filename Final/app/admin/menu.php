<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link href="../../public/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../public/css/animate.css">
    <link href="../../public/css/prettyPhoto.css" rel="stylesheet">
    <link href="../../public/css/style.css" rel="stylesheet" />
    <link href="../../public/css/custom.css" rel="stylesheet" />
</head>
<body>
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
								<li role="presentation"><a href="../logout.php">Logout</a></li>						
							</ul>
						</div>
					</div>						
				</div>
			</div>	
		</nav>		
	</header>

    <?php
        session_start();
        if (isset($_SESSION['admin_id'])) {
            $user_id = $_SESSION['admin_id'];
        }
        else {
            header('Location: ../logout.php');
        }
    ?>

    <div class="feature">
		<div class="container" style="margin-top:120px">
			<div class="text-center">
            	<div class="col-md-4">
					<div class="hi-icon-wrap hi-icon-effect wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms" >
						<a href="#">
                            <i class="fa fa-book"></i>	
                        </a>
						<h2>Manage teams</h2>
						<p>Quisque eu ante at tortor imperdiet gravida nec sed turpis phasellus.</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="hi-icon-wrap hi-icon-effect wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" >
						<i class="fa fa-laptop"></i>	
						<h2>Manage schedules</h2>
						<p>Quisque eu ante at tortor imperdiet gravida nec sed turpis phasellus.</p>
					</div>
				</div>
				<div class="col-md-4">
					<div  class="hi-icon-wrap hi-icon-effect wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="900ms" >
						<i class="fa fa-heart-o" href="manage_student.php"></i>	
						<h2>General table</h2>
						<p>Quisque eu ante at tortor imperdiet gravida nec sed turpis phasellus.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>