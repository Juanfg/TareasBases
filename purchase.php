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
						<a href="create.php" class="btn btn-success">Buy</a>
					</p>
					
					<table class="table table-striped table-bordered">
			            <thead>
			                <tr>		                 
			                	<th>ID</th>
			                	<th>Name</th>
	                        	<th>Category</th>   
	                        	<th>Department</th>   
	                        	<th>Price</th>   
	                        	<th>Quantity</th>  
	                        	<th>Actions</th>                          		                  
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
								// echo '<td>';    echo ($row['ac'])?"SI":"NO"; echo'</td>';
								// echo '<td width=250>';
								// echo '<a class="btn" href="read.php?id='.$row['Id'].'">Detalles</a>';
								// echo '&nbsp;';
								// echo '<a class="btn btn-success" href="update.php?id='.$row['Id'].'">Actualizar</a>';
								// echo '&nbsp;';
							 // 	echo '<a class="btn btn-danger" href="delete.php?id='.$row['Id'].'">Eliminar</a>';
	    					    echo '</td>';
							  	echo '</tr>';
						    }
						   	Database::disconnect();
						  	?>
					    </tbody>
		            </table>
	    	</div>
	    </div> 
	</body>
</html>