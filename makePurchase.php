<?php 
	require 'database.php';

	$commit = true;
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

			$sqlfirstTemp = "INSERT INTO purchase(manager, provider, time) VALUES(1, 1, NOW())";
			$sqltemp = "SELECT Id FROM purchase order by Id desc LIMIT 1";
			$sql2 = "INSERT INTO purchaseProduct (purchase,product,quantity) values(?, ?, ?)";
			$sql3 = "UPDATE inventory SET quantity = quantity + ? WHERE Id = ?";

            try {
        		$dbh = Database::connect();
				$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		} catch(PDOException $e) {
        		echo "Failed to connect to the database";
        		exit;
    		}
            try{
            	$dbh->beginTransaction();

				$q = $dbh->prepare($sqlfirstTemp);
				$q->execute();
				if($q->rowCount() <= 0) $commit = false;

				$idPurchase;
				foreach($dbh->query($sqltemp) as $row)
				{
					$idPurchase = $row['Id'];
				}

				$q = $dbh->prepare($sql2);
				$q->execute(array($idPurchase, $product, $quantity));
				if($q->rowCount() <= 0 ) $commit = false;


				$q = $dbh->prepare($sql3);
				$q->execute(array($quantity, $product));
				if($q->rowCount() <= 0 ) $commit = false;
			} catch(PDOException $e) {
	        	$commit = false;
	    	}

	    	if(!$commit){
	        	$dbh->rollback();
	     	} else {
	        	$dbh->commit();
	        	header("Location: purchase.php");
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
		   			<h3>Make a purchase</h3>
		   		</div>
	    		
				<form class="form-horizontal" action="makePurchase.php" method="post">

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
							<div class="controls">
								<div class="quantity">
									<input name="quantity" type="number" placeholder="Quantity" value="0">
										<?php if(($quantityError != null)) ?>
										<span class="help-inline"><?php echo $quantityError;?></span>				      	
								</div>
							</div>
					</div>

					<div class="form-actions">
						<button type="submit" class="btn btn-success">Add purchase</button>
						<a class="btn" href="purchase.php">Back</a>
					</div>

				</form>
			</div>					
	    </div> <!-- /container -->
	</body>
</html>