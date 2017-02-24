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
		   			<h3>Last Sales Per Hour</h3>
		   		</div>
				<div class="row">
					<table class="table table-striped table-bordered">
			            <thead>
			                <tr>		                 
			                	<th>ID</th>
			                	<th>Amount of Sales</th> 
								<th>Time</th>                		                  
			                </tr>
			            </thead>
			            <tbody>
			              	<?php 
						   	include 'database.php';
						   	$pdo = Database::connect();
						   	$sql = 'SELECT * FROM salesperhour ORDER BY time asc';
						   	foreach ($pdo->query($sql) as $row) {
								echo '<tr>';							   	
	    					   	echo '<td>'. $row['id'] . '</td>';
	    					  	echo '<td>'. $row['amountofsales'] . '</td>';
								echo '<td>'. $row['time'] . '</td>';
	    					    echo '</td>';
							  	echo '</tr>';
						    }
						   	Database::disconnect();
						  	?>
					    </tbody>
		            </table>
		            <p>
						<a href="index.php" class="btn btn-success">Home</a>
					</p>
	    	</div>
	    </div> 
	</body>
</html>