<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta 	charset="utf-8">
	    <link   href="css/bootstrap.min.css" rel="stylesheet">
	    <script src="js/bootstrap.min.js"></script>
	</head>

	<body>
	    <div class="container">
				<div class="row">
					<p>
						<a href="create.php" class="btn btn-success">No se que va</a>
					</p>
					
					<table class="table table-striped table-bordered">
			            <thead>
			                <tr>		                 
			                	<th>submarcamarca	</th>
			                	<th>marca 			</th>
	                        	<th>A/C 			</th>                          		                  
			                </tr>
			            </thead>
			            <tbody>
			              	<?php 
						   	include 'database.php';
						   	$pdo = Database::connect();
						   	Database::disconnect();
						  	?>
					    </tbody>
		            </table>
	    	</div>
	    </div> 
	</body>
</html>