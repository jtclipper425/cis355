<?php 
	
	require 'database.php';

	$item_id = null;
	if ( !empty($_GET['item_id'])) {
		$item_id = $_REQUEST['item_id'];
	}
	
	if ( null==$item_id ) {
		header("Location: item.php");
	}
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$title = null;
		$typeError = null;
		$qualityError = null;
		
		// keep track post values
		$title = $_POST['item_title'];
		$type = $_POST['item_type'];
		$quality = $_POST['item_quality'];
		
		// validate input
		$valid = true;
		if (empty($title)) {
			$title = 'Please enter Title';
			$valid = false;
		}
		
		if (empty($type)) {
			$typeError = 'Please enter Type';
			$valid = false;
		}
		
		if (empty($quality)) {
			$qualityError = 'Please enter Quality';
			$valid = false;
		}
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE item  set item_title = ?, item_type = ?, item_quality = ? WHERE item_id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($title,$type,$quality,$item_id));
			Database::disconnect();
			header("Location: item.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM item where item_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($item_id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$title = $data['item_title'];
		$type = $data['item_type'];
		$quality = $data['item_quality'];
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
		    			<h3>Update a item</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="update.php?item_id=<?php echo $item_id?>" method="post">
					  <div class="control-group <?php echo !empty($titleError)?'error':'';?>">
					    <label class="control-label">Title</label>
					    <div class="controls">
					      	<input name="item_title" type="text"  placeholder="Title" value="<?php echo !empty($title)?$title:'';?>">
					      	<?php if (!empty($titleError)): ?>
					      		<span class="help-inline"><?php echo $titleError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($typeError)?'error':'';?>">
					    <label class="control-label">Type</label>
					    <div class="controls">
					      	<input name="item_type" type="text" placeholder="Type" value="<?php echo !empty($type)?$type:'';?>">
					      	<?php if (!empty($typeError)): ?>
					      		<span class="help-inline"><?php echo $typeError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($qualityError)?'error':'';?>">
					    <label class="control-label">Quality</label>
					    <div class="controls">
					      	<input name="item_quality" type="text" placeholder="Quality" value="<?php echo !empty($quality)?$quality:'';?>">
					      	<?php if (!empty($qualityError)): ?>
					      		<span class="help-inline"><?php echo $qualityError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn" href="item.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>