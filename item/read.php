<?php 
	require 'database.php';
	$item_id = null;
	if ( !empty($_GET['item_id'])) {
		$item_id = $_REQUEST['item_id'];
	}
	
	if ( null==$item_id ) {
		header("Location: item.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM item where item_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($item_id));
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
		    			<h3>Read an Item</h3>
		    		</div>
		    		
					  <div class="control-group">
					    <label class="control-label">Title</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['item_title'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Type</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['item_type'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Quality</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['item_quality'];?>
						    </label>
					    </div>
					  </div>
					    <div class="form-actions">
						  <a class="btn" href="item.php">Back</a>
					   </div>
					
					 
					</div>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>