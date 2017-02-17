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
		   			<h3>All Sales</h3>
		   		</div>
				<div class="row">			
					<table class="table table-striped table-bordered">
			            <thead>
			                <tr>		                 
			                	<th>ID Product</th>
			                	<th>Name</th> 
                                <th>Ordered</th>
			                	<th>In Stock</th>
								<th>Time</th>          		                  
			                </tr>
			            </thead>
			            <tbody>
			              	<?php 
						   	include 'database.php';
						   	$pdo = Database::connect();
						   	$sql = 'SELECT productname, product.name AS "product", productsinstock, inventory.quantity AS "quantity", purchaseOrders.timeorder AS "time" FROM purchaseOrders, product, inventory WHERE purchaseOrders.productName = product.Id AND inventory.product = product.Id';
                               foreach ($pdo->query($sql) as $row) {
								echo '<tr>';							   	
	    					   	echo '<td>'. $row['productname'] . '</td>';
	    					  	echo '<td>'. $row['product'] . '</td>';
	    					  	echo '<td>'. $row['productsinstock'] . '</td>';
								echo '<td>'. $row['quantity'] . '</td>';
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