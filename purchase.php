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
		   			<h3>Purchases</h3>
		   		</div>
				<div class="row">
					<table class="table table-striped table-bordered">
			            <thead>
			                <tr>		                 
			                	<th>ID</th>
			                	<th>Product</th> 
			                	<th>Quantity</th>                  		                  
			                </tr>
			            </thead>
			            <tbody>
			              	<?php 
						   	include 'database.php';
						   	$pdo = Database::connect();
						   	$sql = 'SELECT purchaseProduct.Id, product.name AS "product", purchaseProduct.quantity FROM purchaseProduct INNER JOIN product ON purchaseProduct.product = product.Id  ORDER BY purchaseProduct.Id';
						   	foreach ($pdo->query($sql) as $row) {
								echo '<tr>';							   	
	    					   	echo '<td>'. $row['Id'] . '</td>';
	    					  	echo '<td>'. $row['product'] . '</td>';
	    					  	echo '<td>'. $row['quantity'] . '</td>';
	    					    echo '</td>';
							  	echo '</tr>';
						    }
						   	Database::disconnect();
						  	?>
					    </tbody>
		            </table>
		            <p>
						<a href="index.php" class="btn btn-success">Index</a>
						<a href="makePurchase.php" class="btn btn-success">Make a Purchase</a>
					</p>
	    	</div>
	    </div> 
	</body>
</html>