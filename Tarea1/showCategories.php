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
		   			<h3>Categories</h3>
		   		</div>
				<div class="row">			
					<table class="table table-striped table-bordered">
			            <thead>
			                <tr>		                 
			                	<th>ID</th>
			                	<th>Categorie</th> 
			                	<th>Number of products</th>          		                  
			                </tr>
			            </thead>
			            <tbody>
			              	<?php 
						   	include 'database.php';
						   	$pdo = Database::connect();
						   	$sql = 'SELECT * FROM category';
							$sql2 = 'CALL productsbycategorie(?, @q)';
							$sql3 = 'SELECT @q';
						   	foreach ($pdo->query($sql) as $row) {
								echo '<tr>';							   	
	    					   	echo '<td>'. $row['Id'] . '</td>';
	    					  	echo '<td>'. $row['name'] . '</td>';
								$cat = $row['Id'];
								$holi = $pdo->prepare($sql2);
								$holi->execute(array($cat));
								foreach ($pdo->query($sql3) as $roww)
								{
									$q = $roww['@q'];
								}
	    					  	echo '<td>'. $q . '</td>';
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