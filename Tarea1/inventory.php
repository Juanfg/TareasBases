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
		   			<h3>Inventory</h3>
		   		</div>
				<div class="row">					
					<table class="table table-striped table-bordered">
			            <thead>
			                <tr>		                 
			                	<th>ID</th>
			                	<th>Name</th>
			                	<th>Price</th> 
			                	<th>Department</th>  
	                        	<th>Category</th>   
	                        	<th>Quantity</th>                    		                  
			                </tr>
			            </thead>
			            <tbody>
			              	<?php 
						   	include 'database.php';
						   	$pdo = Database::connect();
						   	$sql = 'SELECT product.Id, product.name, product.price, department.name AS "department", category.name AS "category", inventory.quantity FROM product INNER JOIN department ON product.department = department.Id INNER JOIN category on product.category = category.Id inner join inventory ON inventory.product = product.Id ORDER BY product.Id';
						   	foreach ($pdo->query($sql) as $row) {
								echo '<tr>';							   	
	    					   	echo '<td>'. $row['Id'] . '</td>';
	    					  	echo '<td>'. $row['name'] . '</td>';
	    					  	echo '<td>'. $row['price'] . '</td>';
	    					  	echo '<td>'. $row['department'] . '</td>';
	    					  	echo '<td>'. $row['category'] . '</td>';
	    					  	echo '<td>'. $row['quantity'] . '</td>';
	    					    echo '</td>';
							  	echo '</tr>';
						    }
						   	Database::disconnect();
						  	?>
					    </tbody>
		            </table>
		            <p>
						<a href="index.php" class="btn btn-success">Home</a>
						<a href="showCategories.php" class="btn btn-success">Show Categories</a>
						<a href="sales.php" class="btn btn-success">Sales</a>
						<a href="purchase.php" class="btn btn-success">Purchases</a>
						
					</p>
	    	</div>
	    </div> 
	</body>
</html>