<?php 
	
	require 'database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$titleError = null;
		$typeError = null;
		$qualityError = null;
		
		// keep track post values
		$title = $_POST['item_title'];
		$type = $_POST['item_type'];
		$quality = $_POST['item_quality'];
		
		// validate input
		$valitem_id = true;
		if (empty($title)) {
			$titleError = 'Please enter Title';
			$valid = false;
		}
		
		if (empty($type)) {
			$typeError = 'Please enter Type';
			$valitem_id = false;
		}
		
		if (empty($quality)) {
			$qualityError = 'Please enter Quality';
			$valitem_id = false;
		}
		
		// insert data
		if ($valitem_id) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO item (item_title,item_type,item_quality) values(?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($title,$type,$quality));
			Database::disconnect();
			header("Location: item.php");
		}
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
		    			<h3>Create an Item</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="create.php" method="post">
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
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="item.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>