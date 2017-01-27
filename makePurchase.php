<?php 
	
	require 'database.php';

        $productError = null;
        $quantityError = null;

	if ( !empty($_POST)) {
		
		// keep track post values		
        $product = $_POST['product'];
        $quantity = $_POST['quantity'];
		
		// validate input
		$valid = true;
		
		if (empty($product)) {
			$productError = 'Please select the product';
			$valid = false;
		}
		if (empty($quantity)) {
			$quantityError = 'Please write the quantity';
			$valid = false;
		}			
		
		// insert data
		if ($valid) {
            //TODO: Transaccion por hacer
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = "SELECT quantity FROM inventory WHERE product = '.$product.'";
			if ($sql['quantity'] < $quantity)
			{
				$quantityError = 'The quantity is incorrect';
				$valid = false;
			}

			if($valid)
			{
				echo $sql['quantity'];
				echo $quantity;
				$sql = "INSERT INTO saleproduct (sale,product) values(1, ?)";			
				$q = $pdo->prepare($sql);
				$q->execute(array($product));			
				Database::disconnect();
				header("Location: index.php");
			}
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta 	charset="utf-8">
	    <link   href=	"css/bootstrap.min.css" rel="stylesheet">
	    <script src=	"js/bootstrap.min.js"></script>
	</head>

	<body>
	    <div class="container">
	    	<div class="span10 offset1">
	    		<div class="row">
		   			<h3>Hacer una nueva compra</h3>
		   		</div>
	    		
				<form class="form-horizontal" action="makeSale.php" method="post">

					<div class="control-group <?php echo !empty($productError)?'error':'';?>">
				    	<label class="control-label">Product</label>
				    	<div class="controls">
	                       	<select name ="product">
		                        <option value="">Select the product</option>
		                        <?php
							   		$pdo = Database::connect();
							   		$query = 'SELECT * FROM product';
			 				   		foreach ($pdo->query($query) as $row) {
		                        		if ($row['Id']==$product)
		                        			echo "<option selected value='" . $row['Id'] . "'>" . $row['name'] . "</option>";
		                        		else
		                        			echo "<option value='" . $row['Id'] . "'>" . $row['name'] . "</option>";
			   						}
			   						Database::disconnect();
			  					?>
                            </select>
						</div>
					</div>

					<div class="control-group <?php echo !empty($quantityError)?'error':'';?>">
					    <label class="control-label"> Quantity </label>
						    <div class="quantity">
	                    	    <input name="quantity" type="number" placeholder="Quantity" value="0">
	                               	<?php if(($quantityError != null)) ?>
									   <span class="help-inline"><?php echo $quantityError;?></span>				      	
						    </div>
					</div>

					<div class="form-actions">
						<button type="submit" class="btn btn-success">Agregar</button>
						<a class="btn" href="index.php">Regresar</a>
					</div>

				</form>
			</div>					
	    </div> <!-- /container -->
	</body>
</html>