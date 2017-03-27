<?php 
	require 'database.php';
	$cust_id = null;
	if ( !empty($_GET['cust_id'])) {
		$cust_id = $_REQUEST['cust_id'];
	}
	
	if ( null==$cust_id ) {
		header("Location: customers.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM customers where cust_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($cust_id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Read a Customer</h3>
		    		</div>
		    		
					  <div class="control-group">
					    <label class="control-label">Name</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['cust_name'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Email</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['cust_email'];?>
						    </label>
					    </div>
					  </div>
					    <div class="form-actions">
						  <a class="btn" href="customers.php">Back</a>
					   </div>
					
					 
					</div>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>