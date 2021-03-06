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
			                	<th>ID</th>
			                	<th>Product</th> 
			                	<th>Quantity</th>
								<th>Time</th>          		                  
			                </tr>
			            </thead>
			            <tbody>
			              	<?php 
						   	include 'database.php';
						   	$pdo = Database::connect();
						   	$sql = 'SELECT saleProduct.Id, product.name AS "product", sale.time, saleProduct.quantity FROM saleProduct, sale, product WHERE saleProduct.product = product.Id AND saleProduct.sale = sale.Id ORDER BY saleProduct.Id';
						   	foreach ($pdo->query($sql) as $row) {
								echo '<tr>';							   	
	    					   	echo '<td>'. $row['Id'] . '</td>';
	    					  	echo '<td>'. $row['product'] . '</td>';
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
						<a href="makeSale.php" class="btn btn-success">Make a Sale</a>
					</p>
	    	</div>
	    </div> 
	</body>
</html>